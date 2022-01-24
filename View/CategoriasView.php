<?php
require_once "./libs/smarty/Smarty.class.php";
class CategoriasView
{
    private $title;
    private $smarty;

    public function __construct()
    {
        $this->title = "EXA-Gamer";
        $this->smarty = new Smarty();
        $this->smarty->assign("titulo", $this->title);
    }

    public function showHome($categorias, $templateLink, $logged = false)
    {
        $this->smarty->assign("categorias", $categorias);
        $this->smarty->assign("logged", $logged);
        $this->smarty->display($templateLink);
    }

    public function showFormularioCategoria($categorias, $action)
    {
        $logged = true;
        $this->smarty->assign("categoria", $categorias);
        $this->smarty->assign("logged", $logged);
        $this->smarty->assign("action", $action);
        $this->smarty->display("./templates/formularioCategorias.tpl");
    }

}
