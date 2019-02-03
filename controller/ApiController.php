<?php
/**
 * Created by PhpStorm.
 * User: unaipuelles
 * Date: 03/02/2019
 * Time: 20:29
 */

include_once __DIR__ .'/../controller/Controller.php';

class ApiController extends Controller
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

    public function runController($request)
    {
        $this->verifyRequest($request);
    }

    public function verifyRequest($request)
    {
        if($request[0] == "api" && $request[1] == "evento" && is_numeric($request[2]))
        {
            $evento = new Evento($this->conexion);
            $evento->setId($request[2]);
            $evento = $evento->findById();
            if($evento != null)
            {
                http_response_code(200);
                echo json_encode($evento);
            }
            else
            {
                http_response_code(404);
                echo json_encode(array("message" => "El evento no existe"));
            }
        }
        else{
            http_response_code(404);
            echo json_encode(array("message" => "La peticion no se ha hecho correctamente"));
        }
        $_SERVER['REQUEST_METHOD'];
    }
}