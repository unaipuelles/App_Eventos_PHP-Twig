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

    public function defaultView()
    {
        $evento = new Evento($this->conexion);
        $eventos = $evento->getIndexViewData();
        $this->twigView('eventoView.html.twig', ['eventos' => $eventos]);
    }

    public function getEventData(){
        $evento = new Evento($this->conexion);
        $evento->setId($_POST['id']);
        $evento = $evento->findById();
        die(json_encode($evento));
    }

    public function deleteEvento()
    {
        $evento = new Evento($this->conexion);
        $evento->setId($_POST['id']);
        echo $evento->delete();
    }

    public function update(){
        $evento = new Evento($this->conexion);
        $evento->setId($_GET['idEvento']);
        $evento->setAllParameters($_POST['nombreEvento'], $_POST['tipoEvento'], $_POST['fechaEvento'], $_POST['descripcionEvento'], $_POST['lugarEvento'],'');
        echo $evento->update();
    }

    public function insert(){
        $evento = new Evento($this->conexion);
        $evento->setAllParameters($_POST['nombreEvento'], $_POST['tipoEvento'], $_POST['fechaEvento'], $_POST['descripcionEvento'], $_POST['lugarEvento'],$_POST['Local_idLocal']);
        echo $evento->create();
    }
}