<?php
/**
 * Created by PhpStorm.
 * User: v6222
 * Date: 18/01/2019
 * Time: 20:09
 */
require_once __DIR__ . "/../config/database.php";

class Evento
{
    private $conexion, $tableName = EVENTO_TABLENAME;
    private $id, $nombre, $tipo, $fecha, $descripcion, $lugar;

    /**
     * Evento constructor.
     * @param $conexion
     */
    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getConexion()
    {
        return $this->conexion;
    }

    /**
     * @param mixed $conexion
     */
    public function setConexion($conexion)
    {
        $this->conexion = $conexion;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param mixed $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getLugar()
    {
        return $this->lugar;
    }

    /**
     * @param mixed $lugar
     */
    public function setLugar($lugar)
    {
        $this->lugar = $lugar;
    }

    public function setAllParameters($nombre, $tipo, $fecha, $descripcion, $lugar){
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->fecha = $fecha;
        $this->descripcion = $descripcion;
        $this->lugar = $lugar;
    }

    public function create(){
        $data = array('nombre'=>$this->nombre, 'tipo'=>$this->tipo, 'fecha'=>$this->fecha, 'descripcion'=>$this->descripcion, 'lugar'=>$this->lugar);
        $stmnt = $this->conexion->prepare('INSERT INTO '.$this->tableName.' (nombre, tipo, fecha, descripcion, lugar) 
            VALUES (:nombre, :tipo, :fecha, :descripcion, :lugar)');
        $correcto = $stmnt->execute($data);
        $this->conexion = null;
        return $correcto;
    }

    public function getAll(){
        $consulta = $this->conexion->prepare("SELECT * FROM " . $this->tableName);
        $consulta->execute();
        $resultados = $consulta->fetchAll();
        $this->conexion = null;
        return $resultados;
    }

    public function findById(){
        $data = array('id' => $this->id);
        $consulta = $this->conexion->prepare("SELECT * FROM " . $this->tableName . " WHERE id = :id");
        $consulta->execute($data);
        $resultados = $consulta->fetch();
        $this->conexion = null;
        $this->setAllParameters($resultados['nombre'], $resultados['tipo'], $resultados['fecha'], $resultados['descripcion'], $resultados['lugar']);
    }

    public function update(){
        $data = array('nombre'=>$this->nombre, 'tipo'=>$this->tipo, 'fecha'=>$this->fecha, 'descripcion'=>$this->descripcion, 'lugar'=>$this->lugar, "id"=>$this->id);
        $stmnt = $this->conexion->prepare("UPDATE ".$this->tableName." SET nombre = :nombre, tipo = :tipo, fecha = :fecha, descripcion = :descripcion, lugar = :lugar
            WHERE id = :id");
        $correcto = $stmnt->execute($data);
        $this->conexion = null;
        return $correcto;
    }

    public function delete(){
        $data = array("id" => $this->id);
        $stmnt = $this->conexion->prepare('DELETE FROM '.$this->tableName.' WHERE id = :id');
        $correcto = $stmnt->execute($data);
        $this->conexion = null;
        return $correcto;
    }

}
