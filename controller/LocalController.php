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
    public function __construct()
    {
        parent::__construct();
    }

    public function cargarArchivos()
    {
        parent::cargarArchivos();
        require_once __DIR__ . '/../model/Local.php';
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

    public function detailsLocal($id){
        $local = new Local($this->conexion);
        $local->setId($id);
        $datos = $local->findById($id);

        $evento = new Evento($this->conexion);
        $evento->setLocalIdLocal($id);
        $listaEventos = $evento->findByLocalId($id);

        if($datos != null){
            $this->twigView("localView.twig", ["local" => $datos, "eventos"=>$listaEventos]);
        }else{
            header("Location: ./");
        }
    }

    public function editLocal($id){
        $local = new Local($this->conexion);
        $local->setId($id);
        $local->setAllParameters($_POST["nombre"], $_POST["categoria"], $_POST["direccion"], $_POST["telefono"], $_POST["email"]);
        if($local->update() !=null){
            header("Location: /index.php?controller=local&action=detailsLocal&id=" . $id);
        }
    }

    public function deleteLocal($id){
        $local = new Local($this->conexion);
        $local->setId($id);
        if($local->delete() !=null){
            header("Location: /.");
        }
    }

    public function createLocal(){
        $local = new Local($this->conexion);
        $local->setAllParameters($_POST["nombre"], $_POST["categoria"], $_POST["direccion"], $_POST["telefono"], $_POST["email"]);
        $idLocal = $local->create();
        if($idLocal != null){
            $this->detailsLocal($idLocal[0]);
        }else{
            echo "Hubo un error.";
        }
    }
}