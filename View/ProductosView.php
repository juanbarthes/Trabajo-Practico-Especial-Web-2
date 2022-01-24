<?php
require_once "./libs/smarty/Smarty.class.php";
class ProductosView
{
    private $title;
    private $smarty;

    public function __construct()
    {
        $this->title = "EXA-Gamer";
        $this->smarty = new Smarty();
        $this->smarty->assign("titulo", $this->title);
    }

    public function showProductos($productos, $rutaTemplate, $logged = false)
    {
        $this->smarty->assign("logged", $logged);
        $this->smarty->assign("productos", $productos);
        $this->smarty->display($rutaTemplate);
    }

    public function showProducto($producto, $permits, $user = null)
    {
        $this->smarty->assign("permits", $permits);
        $this->smarty->assign("producto", $producto);
        $this->smarty->assign("user", $user);
        if ($permits == 'guest') {
            $this->smarty->assign("logged", false);
            $this->smarty->display("./templates/producto.tpl");
        }
        else{
            $this->smarty->assign("logged", true);
            $this->smarty->display("./templates/productoUser.tpl");
        }
        
    }
    
    public function showFormularioProducto($producto, $action, $categorias)
    {
        $logged = true;
        $categoriaActual = $producto["categoria"];
        $this->smarty->assign("categoriaActual", $categoriaActual);
        $this->smarty->assign("logged", $logged);
        $this->smarty->assign("producto", $producto);
        $this->smarty->assign("action", $action);
        $this->smarty->assign("categorias", $categorias);
        $this->smarty->display("./templates/formularioProductos.tpl");
    }

}
