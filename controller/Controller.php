<?php
/**
 * Created by PhpStorm.
 * User: unaipuelles
 * Date: 14/01/19
 * Time: 9:00
 */

abstract class controller
{
    private $connection, $conexion, $twig;

    public function __construct()
    {
        $this->cargarArchivos();

        $this->connection = new Connection();
        $this->conexion = $this->connection->conexion();
        $loader = new Twig_Loader_Filesystem('view');
        $this->twig = new Twig_Environment($loader);
    }

    public function cargarArchivos()
    {
        require_once __DIR__ . '/../core/Connection.php';
        require_once __DIR__ . '/../vendor/autoload.php';
    }

    public function run($action, $id=null)
    {
        if($action == null)
            $action = 'defaultView';
        $this->$action($id);
    }

    public function twigView($page, $data)
    {
        echo $this->twig->render($page, $data);
    }
}