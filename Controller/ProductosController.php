<?php
require_once './Model/ProductosModel.php';
require_once './View/ProductosView.php';
require_once './Controller/CategoriasController.php';

class ProductosController
{
    private $model;
    private $view;
    private $controllerCategorias;

    public function __construct()
    {
        $this->model = new ProductosModel();
        $this->view = new ProductosView();
        $this->controllerCategorias = new CategoriasController();
    }

    public function getProductosCategoria($params) //Obtiene los productos de una categoria especifica
    {
        $id = $params[":id"];
        $categorias = $this->controllerCategorias->getCategorias();
        if (isset($id) && $id != "") {
            $productos = $this->model->getProductosCategoria($id);
            $a = 0;
            while ($a < sizeof($productos)) {
                $id = $productos[$a]["categoria"];
                foreach ($categorias as $categoria) {
                    if ($categoria->id_categoria == $id) {
                        $productos[$a]["nombre_categoria"] = $categoria->nombre_categoria;
                    }
                }
                $a++;
            }
        }
        //Mostrar los productos por pantalla
        if ($this->isAdmin()) {
            $this->view->showProductos($productos, "./templates/tablaProductosAdmin.tpl", "../");
        } else
            $this->view->showProductos($productos, "./templates/tablaProductos.tpl", "../");
    }

    public function getProductos() //Le pide al Model la lista productos y luego le pide al View que los muestre por pantalla
    {
        //Traer productos de la DB
        $productos = $this->model->getProductos();
        //Traer categorias de la DB
        $categorias = $this->controllerCategorias->getCategorias();
        if (empty($categorias)) {
            $categorias = null;
        } else {
            $a = 0;
            while ($a < sizeof($productos)) {
                $id = $productos[$a]["categoria"];
                foreach ($categorias as $categoria) {
                    if ($categoria->id_categoria == $id) {
                        $productos[$a]["nombre_categoria"] = $categoria->nombre_categoria;
                    }
                }
                $a++;
            }
        }
        //Mostrar los productos por pantalla
        if ($this->isAdmin()) {
            $this->view->showProductos($productos, "./templates/tablaProductosAdmin.tpl", true);
        } else {
            if ($this->checkLoggedIn()) {
                $this->view->showProductos($productos, "./templates/tablaProductos.tpl", true);
            }
            $this->view->showProductos($productos, "./templates/tablaProductos.tpl");
        }
    }

    public function getProducto($params) //Le pide al Model un producto y luego le pide al View que lo muestre por pantalla
    {
        $id = $params[":id"];
        if (isset($id) && $id != "") {
            $permits = 'guest';
            if ($this->checkLoggedIn()) {
                $permits = 'normal';
            }
            if ($this->isAdmin()) {
                $permits = 'admin';
            }
            $producto = $this->model->getProducto($id);
            if ($permits != "guest") {
                $this->view->showProducto($producto, $permits, $_SESSION["NICK"]);
            } else
                $this->view->showProducto($producto, $permits);
        }
    }

    public function insertProducto() //Le pide al Model que agregue un producto nuevo
    {
        if (!$this->isAdmin()) {
            header(LOGIN);
        } else {
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $precio = $_POST["precio"];
            $stock = $_POST["stock"];
            $categoria = $_POST["categoria"];
            $tmpImage = $_FILES['image']['tmp_name'];
            $name = $_FILES['image']['name'];
            if (isset($nombre, $descripcion, $precio, $stock, $categoria)) {
                if ($stock == "") {
                    $stock = 0;
                }
                if ($categoria == "") {
                    $categoria = null;
                }
                if ($tmpImage != '') {
                    $imgPath = $this->uploadImage($tmpImage, $name);
                    $this->model->insertProducto($nombre, $descripcion, $precio, $stock, $categoria, $imgPath);
                } else
                    $this->model->insertProducto($nombre, $descripcion, $precio, $stock, $categoria, 'img/imagen-generica.jpg');
            }
            header(HOME);
        }
    }

    public function updateProducto() //Le pide al Model que actualice un producto
    {
        if (!$this->isAdmin()) {
            header(LOGIN);
        } else {
            $id = $_POST["id_p"];
            $producto = $this->model->getProducto($id);
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            $precio = $_POST["precio"];
            $stock = $_POST["stock"];
            $categoria = $_POST["categoria"];
            $image = $producto['imagen'];
            $tmpImage = $_FILES['image']['tmp_name'];
            $name = $_FILES['image']['name'];
            if (isset($tmpImage) && ($tmpImage != '')) {
                if (($image != "img/imagen-generica.jpg") && ($image != "")) {
                    unlink($image);
                }
                $imgPath = $this->uploadImage($tmpImage, $name);
                $this->model->updateProducto($id, $nombre, $descripcion, $precio, $stock, $categoria, $imgPath);
            } else
                $this->model->updateProducto($id, $nombre, $descripcion, $precio, $stock, $categoria, $image);
            $this->getProductos();
        }
    }

    public function uploadImage($tmpName, $name)//sube la imagen al servidor
    {
        $path = "img/" . uniqid("", true) . "." . strtolower(pathinfo($name, PATHINFO_EXTENSION));
        move_uploaded_file($tmpName, $path);
        return $path;
    }

    public function removeImage($params)//remueve del servidor la imagen vinculada al producto y le asigna una imagen generica
    {
        $id = $params[':id'];
        $product = $this->model->getProducto($id);
        $image = $product['imagen'];
        if (($image != '') && ($image != 'img/imagen-generica.jpg')) {
            unlink($image);
        }
        $this->model->setGenericPath($id, 'img/imagen-generica.jpg');
        header(PRODUCTOS);
    }

    public function deleteProducto() //Le pide al Model que borre un producto
    {
        if (!$this->isAdmin()) {
            header(LOGIN);
        } else {
            $id = $_GET["id_p"];
            if (isset($id) && $id != "") {
                $producto = $this->model->getProducto($id);
                if ($producto['imagen'] != 'img/imagen-generica.jpg') {
                    unlink($producto['imagen']);
                }
                $this->model->deleteProducto($id);
            }
            header(PRODUCTOS);
        }
    }

    public function formularioProducto()
    {
        if (!$this->isAdmin()) {
            header(LOGIN);
        } else {
            //Obtiene las categorias
            $categorias = $this->controllerCategorias->getCategorias();
            if (!$categorias) { //Si no habia categorias creadas, agrega una generica y vuelve a hacer el get.
                $this->controllerCategorias->getModel()->insertCategoria("Ninguna");
                $categorias = $this->controllerCategorias->getCategorias();
            }
            if (isset($_GET["id_p"]) && $_GET["id_p"] != "") { //Si se llega al form a traves de un get con una id_p, hay que editar.
                $id = $_GET["id_p"];
                $action = "updateProducto";
                $producto = $this->model->getProducto(intval($id));
                $this->view->showFormularioProducto($producto, $action, $categorias);
            } else { //Como no se tiene la id_p, mostramos el form para insertar
                $action = "insertProducto";
                $producto = array("id" => "", "nombre" => "", "descripcion" => "", "precio" => "", "stock" => "", "categoria" => "");
                $this->view->showFormularioProducto($producto, $action, $categorias);
            }
        }
    }

    private function checkLoggedIn() //Verifica si el usuario esta logueado. Deben llamarla todos los Controllers para cada accion que requiera permisos de usuario.
    {
        if (session_status() == PHP_SESSION_NONE) //para evitar que se llame varias veces a session_start() en un mismo flujo
            session_start();
        if (!empty($_SESSION["EMAIL"])) {
            return true;
        }
        return false;
    }

    public function isAdmin()
    {
        if ($this->checkLoggedIn() && $_SESSION["ADMIN"] == "1") {
            return true;
        } else
            return false;
    }
}
