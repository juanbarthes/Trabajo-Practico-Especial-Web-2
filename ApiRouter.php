<?php
    require_once 'RouterClass.php';
    require_once 'Controller/ApiCommentsController.php';
    //require_once 'Controller/ApiController.php';
    
    $r = new Router();

    //rutas
    $r->addRoute('comments/:ID', 'GET', 'ApiCommentsController', 'get');
    $r->addRoute('comments/', 'POST', 'ApiCommentsController', 'insert');
    $r->addRoute('comments/:ID', 'DELETE', 'ApiCommentsController', 'delete');



    //run
    $r->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
