<?php

echo "Hola Evento";

if(isset($_GET['controller'])){
    $controller = establecerControlador($_GET['controller']);
}
else
    $controller = establecerControlador();
cargarControlador($controller);


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