<?php
require_once "./libs/smarty/Smarty.class.php";
class UsersView
{
    private $title;
    private $smarty;

    public function __construct()
    {
        $this->title = "Login";
        $this->smarty = new Smarty();
        $this->smarty->assign("titulo", $this->title);
    }

    public function showLogin($mensaje = "")
    {
        $logged = false;
        $this->smarty->assign("logged", $logged);
        $this->smarty->assign("mensaje", $mensaje);
        $this->smarty->display("./templates/login.tpl");
    }

    public function showRegistro($mensaje = "")
    {
        $logged = false;
        $this->smarty->assign("logged", $logged);
        $this->smarty->assign("mensaje", $mensaje);
        $this->smarty->display("./templates/registro.tpl");
    }

    public function showUsers($users)
    {
        $this->smarty->assign("users", $users);
        $this->smarty->display("./templates/users.tpl");
    }

    function ShowHomeLocation()
    {
        header("Location: " . BASE_URL . "home");
    }
}
