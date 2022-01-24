<?php
require_once "./Model/UsersModel.php";
require_once "./View/UsersView.php";

class UsersController
{
    private $model;
    private $view;
    public function __construct()
    {
        $this->model = new UsersModel();
        $this->view = new UsersView();
    }

    public function getUsers()
    {
        if ($this->isAdmin()) {
            $users = $this->model->getUsers();
            if ($users) {
                $this->view->showUsers($users);
            } else
                header(HOME);
        } else
            header(HOME);
    }

    public function login()
    {
        if ($this->checkLoggedIn()) {
            header(HOME);
        } else
            $this->view->showLogin();
    }

    public function deleteUser($params = null)
    {
        if ($this->isAdmin()) {
            $id = $params[':ID'];
            if (isset($id)) {
                $this->model->deleteUser($id);
                header(USUARIOS);
            }
        } else
            header(HOME);
    }

    public function giveAdmin($params = null)
    {
        if ($this->isAdmin()) {
            $id = $params[':ID'];
            if (isset($id)) {
                $this->model->setAdmin($id);
                header(USUARIOS);
            }
        } else
            header(HOME);
    }

    public function registro() //Formulario de registro
    {
        $this->view->showRegistro();
    }

    public function verifyUser() //Comprobacion de los datos del login del lado del servidor
    {
        //Verifica que los imput vengan correctamente cargados
        $user = $_POST["email"];
        $pass = $_POST["contraseña"];
        if (isset($user) && $user != "") {
            //Se trae al usuario desde la DB
            $dbUser = $this->model->getUser($user);
            if (isset($dbUser) && $dbUser) {
                if (password_verify($pass, $dbUser->password)) {
                    session_start();
                    $_SESSION["EMAIL"] = $dbUser->email;
                    $_SESSION["NICK"] = $dbUser->nick;
                    $_SESSION["ADMIN"] = $dbUser->admin;
                    header(HOME);
                } else {
                    $mensaje = "Contraseña incorrecta";
                    $this->view->showLogin($mensaje);
                }
            } else {
                $mensaje = "Usuario incorrecto";
                $this->view->showLogin($mensaje);
            }
        } else {
            $mensaje = "Usuario y/o contraseña incorrectos";
            $this->view->showLogin($mensaje);
        }
    }

    public function verificarRegistro()
    {
        $nick = $_POST["nick"];
        $email = $_POST["email"];
        $pass = $_POST["contraseña"];
        echo "hola querido";
        if (isset($nick, $email, $pass)) {
            if (($email != "") && ($pass != "") && ($nick != "")) {
                $encryptedPass = password_hash($pass, PASSWORD_DEFAULT);
                $this->model->insertUser($nick, $email, $encryptedPass);
                session_start();
                $_SESSION["EMAIL"] = $email;
                $_SESSION["NICK"] = $nick;
                $_SESSION["ADMIN"] = 0;
                header(HOME);
            } else {
                $this->view->showRegistro("Rellene correctamente todos los campos");
            }
        } else
            $this->view->showRegistro("Rellene correctamente todos los campos");
    }

    public function logout() //Termina la sesion
    {
        session_start();
        session_destroy();
        header(HOME);
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
