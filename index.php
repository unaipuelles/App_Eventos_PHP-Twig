<?php

if(isset($_GET['controller'])){
    $controller = establecerControlador($_GET['controller']);
}
else
    $controller = establecerControlador();
cargarControlador($controller);


function establecerControlador($controller=null){
    switch ($controller){
        case 'bodega':
            $file = 'controller/BodegaController.php';
            require_once $file;
            $controllerObj = new BodegaController();
            break;
        case 'vino':
            $file = 'controller/VinoController.php';
            require_once $file;
            $controllerObj = new VinoController();
            break;
        default:
            $file = 'controller/BodegaController.php';
            require_once $file;
            $controllerObj = new BodegaController();
            break;
    }
    return $controllerObj;
}

function cargarControlador ($controller){
    if(isset($_GET['controller'])){
        if(isset($_GET['id'])){
            if(isset($_GET['from']))
                $controller->run($_GET['action'], $_GET['id'], $_GET['from']);
            else
                $controller->run($_GET['action'], $_GET['id']);
        }
        else
            $controller->run($_GET['action']);
    }
    else
        $controller->run();
}