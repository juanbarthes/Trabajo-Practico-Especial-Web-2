<?php
    require_once 'RouterClass.php';
    require_once 'Controller/ProductosController.php';
    require_once "Controller/CategoriasController.php";
    require_once "Controller/UsersController.php";
    
    // CONSTANTES PARA RUTEO
    define('LOGIN', 'Location: http://' . $_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]) . '/login');
    define('HOME', 'Location: http://' . $_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]) . '/home');
    define('BASE_URL', 'http://' . $_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]) . '/');
    define('PRODUCTOS', 'Location: http://' . $_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]) . '/productos');
    define('USUARIOS', 'Location: http://' . $_SERVER["SERVER_NAME"] . dirname($_SERVER["PHP_SELF"]) . '/usuarios');    


    $r = new Router();

    // rutas
    //Categorias
    //ruta, metodo, controlador, funcion
    $r->addRoute("home", "GET", "CategoriasController", "home");
    $r->addRoute("formularioCategoria", "GET", "CategoriasController", "formularioCategoria");
    $r->addRoute("insertCategoria", "POST", "CategoriasController", "insertCategoria");
    $r->addRoute("updateCategoria", "POST", "CategoriasController", "updateCategoria");
    $r->addRoute("deleteCategoria/:id", "GET", "CategoriasController", "deleteCategoria");

    //Producto
    $r->addRoute("productos", "GET", "ProductosController", "getProductos");
    $r->addRoute("productos/:id", "GET", "ProductosController", "getProductosCategoria");
    $r->addRoute("producto/:id", "GET", "ProductosController", "getProducto");
    $r->addRoute("insertProducto", "POST", "ProductosController", "insertProducto");
    $r->addRoute("updateProducto", "POST", "ProductosController", "updateProducto");
    $r->addRoute("formularioProducto", "GET", "ProductosController", "formularioProducto");
    $r->addRoute("deleteProducto", "GET", "ProductosController", "deleteProducto");
    $r->addRoute("removeImage/:id", "GET", "ProductosController", "removeImage");

    //Usuario
    $r->addRoute("login", "GET", "UsersController", "login");
    $r->addRoute("logout", "GET", "UsersController", "logout");
    $r->addRoute("verificarusuario", "POST", "UsersController", "verifyUser");
    $r->addRoute("registro", "GET", "UsersController", "registro");
    $r->addRoute("verificarregistro", "POST", "UsersController", "verificarRegistro");
    $r->addRoute("usuarios", "GET", "UsersController", "getUsers");
    $r->addRoute("giveAdmin/:ID", "GET", "UsersController", "giveAdmin");
    $r->addRoute("deleteUser/:ID", "GET", "UsersController", "deleteUser");



    //Ruta por defecto.
    $r->setDefaultRoute("CategoriasController", "home");

    //run
    $r->route($_GET['action'], $_SERVER['REQUEST_METHOD']);
