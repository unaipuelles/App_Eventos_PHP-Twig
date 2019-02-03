<?php

if(isset($_GET['api']))
{
    $request = explode("/", $_GET['api']);

    if($request[0] == "api")
    {
        require_once 'controller/ApiController.php';
        $apiController = new ApiController();
        $apiController->runController($request);
    }
    else
    {
        defaultCase();
    }
}
else
    defaultCase();

function defaultCase()
{
    if(isset($_GET['controller'])){
        $controller = establecerControlador($_GET['controller']);
    }
    else
        $controller = establecerControlador();
    cargarControlador($controller);
}

function establecerControlador($controller=null){
    switch ($controller){
        case 'local':
            $file = 'controller/LocalController.php';
            require_once $file;
            $controllerObj = new LocalController();
            break;
        case 'evento':
            $file = 'controller/EventoController.php';
            require_once $file;
            $controllerObj = new EventoController();
            break;
        default:
            $file = 'controller/EventoController.php';
            require_once $file;
            $controllerObj = new EventoController();
            break;
    }
    return $controllerObj;
}

function cargarControlador ($controller){
    if(isset($_GET['controller'])){
        if(isset($_GET['id'])){
            $controller->run($_GET['action'], $_GET['id']);
        }
        else
            $controller->run($_GET['action']);
    }
    else
        $controller->run();
}
