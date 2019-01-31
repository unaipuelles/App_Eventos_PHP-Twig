<?php
/**
 * Created by PhpStorm.
 * User: unaipuelles
 * Date: 18/01/2019
 * Time: 20:40
 */

include_once __DIR__ .'/../controller/Controller.php';

class EventoController extends Controller
{
    private $connection, $conexion, $twig;

    public function __construct()
    {
        parent::__construct();
    }

    public function cargarArchivos()
    {
        parent::cargarArchivos();
        require_once __DIR__ . '/../model/Evento.php';
    }

    public function run($action = null, $id = null)
    {
        parent::run($action, $id);
    }

    public function twigView($page, $data)
    {
        parent::twigView($page, $data);
    }

<<<<<<< HEAD
    public function defaultView()
    {
        $evento = new Evento($this->conexion);
        $eventos = $evento->getAll();
        $this->twigView("eventoView.html.twig", ["eventos" => $eventos]);
    }
=======

>>>>>>> acaa404dda38ba8d16a6e0e060bb8fbd22a14bd5
}