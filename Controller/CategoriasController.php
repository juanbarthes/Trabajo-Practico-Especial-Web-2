<?php
require_once './Model/CategoriasModel.php';
require_once './View/CategoriasView.php';

class CategoriasController
{
    private $model;
    private $view;

    public function __construct()
    {
        $this->model = new CategoriasModel();
        $this->view = new CategoriasView();
    }

    public function home() //Le pide al Model la lista Categorias y luego le pide al View que los muestre por pantalla
    {
        //Traer Categorias de la DB
        $categorias = $this->model->getCategorias();
        //Mostrar los productos por pantalla
        if ($this->isAdmin()) {
            $this->view->showHome($categorias, "./templates/homeAdmin.tpl");
        } else {
            $logged = false;
            if ($this->checkLoggedIn()) {
                $logged = true;
            }
            $this->view->showHome($categorias, "./templates/home.tpl", $logged);
        }
    }

    public function getModel() //Retorna el model
    {
        return $this->model;
    }

    public function getCategorias()
    {
        return $this->model->getCategorias();
    }

    public function insertCategoria() //Le pide al Model que agregue un producto nuevo
    {
        if ($this->isAdmin()) {
            if (isset($_POST["nombre"]) && $_POST["nombre"] != "") {
                $this->model->insertCategoria($_POST["nombre"]);
            }
        }
        header(HOME);
    }

    public function deleteCategoria($params = null) //Le pide al Model que borre un producto
    {
        if ($this->isAdmin()) {
            $id = $params[":id"];
            if (isset($id) && $id != "") {
                $this->model->deleteCategoria($id);
            }
        }
        header(HOME);
    }

    public function updateCategoria() //Le pide al Model que actualice un producto
    {
        if ($this->isAdmin()) {
            $id = $_POST["id"];
            $nombre = $_POST["nombre"];
            if (isset($id) && $id != "") {
                if (isset($nombre) && $nombre != "") {
                    $this->model->updateCategoria($id, $nombre);
                }
            }
        }
        header(HOME);
    }

    public function formularioCategoria() //Prepara lo necesario para mostrar el formulario de categoria
    {
        if ($this->isAdmin()) {
            if (isset($_GET["id_c"]) && $_GET["id_c"] != "") { //Si el GET contiene el id_c, el formulario se usa para editar una categoria
                $id = $_GET["id_c"];
                $action = "updateCategoria";
                $categoria = $this->model->getCategoria(intval($id));
                $this->view->showFormularioCategoria($categoria, $action);
            } else { //Si no contiene el id_c el formulario se usa para agregar una nueva categoria
                $action = "insertCategoria";
                $categoria = array("id_categoria" => "", "nombre_categoria" => "");
                $this->view->showFormularioCategoria($categoria, $action);
            }
        } else {
            header(LOGIN);
        }
    }

    private function checkLoggedIn() //Verifica si el usuario esta logueado. Deben llamarla todos los Controllers para cada accion que requiera permisos de usuario.
    {
        if (session_status() == PHP_SESSION_NONE) { //para evitar que se llame varias veces a session_start() en un mismo flujo
            session_start();
        }
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
