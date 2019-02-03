<?php
/**
 * Created by PhpStorm.
 * User: unaipuelles
 * Date: 18/01/2019
 * Time: 20:20
 */

include_once __DIR__ . '/../controller/Controller.php';

class LocalController extends Controller
{
    private $connection, $conexion, $twig;

    public function __construct()
    {
        parent::__construct();
    }

    public function cargarArchivos()
    {
        parent::cargarArchivos();
        require_once __DIR__ . '/../model/Local.php';
    }

    public function run($action = null, $id = null)
    {
        parent::run($action, $id);
    }

    public function twigView($page, $data)
    {
        parent::twigView($page, $data);
    }

    public function detailsLocal($id){

    }
}