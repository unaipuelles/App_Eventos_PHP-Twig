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


    private $id, $nombre, $tipo, $fecha, $descripcion, $lugar, $Local_idLocal;

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

    /**
     * @return mixed
     */
    public function getLocalIdLocal()
    {
        return $this->Local_idLocal;
    }

    /**
     * @param mixed $Local_idLocal
     */
    public function setLocalIdLocal($Local_idLocal)
    {
        $this->Local_idLocal = $Local_idLocal;
    }

    public function setAllParameters($nombre, $tipo, $fecha, $descripcion, $lugar, $Local_idLocal){
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->fecha = $fecha;
        $this->descripcion = $descripcion;
        $this->lugar = $lugar;
        $this->Local_idLocal = $Local_idLocal;
    }

    public function create(){
        $data = array('nombre'=>$this->nombre, 'tipo'=>$this->tipo, 'fecha'=>$this->fecha, 'descripcion'=>$this->descripcion, 'lugar'=>$this->lugar, 'Local_idLocal' =>$this->Local_idLocal);
        var_dump($data);
        $stmnt = $this->conexion->prepare('INSERT INTO '.$this->tableName.' (nombre, tipo, fecha, descripcion, lugar, Local_idLocal) 
            VALUES (:nombre, :tipo, :fecha, :descripcion, :lugar, :Local_idLocal)');
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

    public function getIndexViewData(){
        $consulta = $this->conexion->prepare("SELECT e.idEvento idEvento, e.nombre nombre, e.fecha fecha, e.tipo ,l.idLocal idLocal, l.nombre localNombre
                                              FROM ".$this->tableName." e, local l
                                              WHERE e.local_idLocal = l.idLocal
                                              ORDER BY e.fecha");
        $consulta->execute();
        $resultados = $consulta->fetchAll();
        $this->conexion = null;
        return $resultados;
    }

    public function findById(){
        $data = array('id' => $this->id);
        $consulta = $this->conexion->prepare("SELECT * FROM " . $this->tableName . " WHERE idEvento = :id");
        $consulta->execute($data);
        $resultados = $consulta->fetch();
        $this->conexion = null;
        return $resultados;
    }

    public function findByLocalId(){
        $data = array('Local_idLocal' => $this->Local_idLocal);
        $consulta = $this->conexion->prepare("SELECT * FROM " . $this->tableName . " WHERE Local_idLocal = :Local_idLocal");
        $consulta->execute($data);
        $resultados = $consulta->fetchAll();
        $this->conexion = null;
        return $resultados;
    }

    public function update(){
        $data = array('nombre'=>$this->nombre, 'tipo'=>$this->tipo, 'fecha'=>$this->fecha, 'descripcion'=>$this->descripcion, 'lugar'=>$this->lugar, "id"=>$this->id);
        $stmnt = $this->conexion->prepare("UPDATE ".$this->tableName." SET nombre = :nombre, tipo = :tipo, fecha = :fecha, descripcion = :descripcion, lugar = :lugar
            WHERE idEvento = :id");
        $correcto = $stmnt->execute($data);
        $this->conexion = null;
        return $correcto;
    }

    public function delete(){
        $data = array("id" => $this->id);
        $stmnt = $this->conexion->prepare('DELETE FROM '.$this->tableName.' WHERE idEvento = :id');
        $correcto = $stmnt->execute($data);
        $this->conexion = null;
        return $correcto;
    }

    public function findByType(){
        $consulta = $this->conexion->prepare("SELECT e.idEvento idEvento, e.nombre nombre, e.fecha fecha, e.tipo ,l.idLocal idLocal, l.nombre localNombre
                                              FROM ".$this->tableName." e, local l
                                              WHERE e.local_idLocal = l.idLocal AND LOWER(tipo) LIKE ('%".$this->tipo."%')
                                              ORDER BY e.fecha");
        $consulta->execute();
        $resultados = $consulta->fetchAll();
        $this->conexion = null;
        return $resultados;
    }

    public function findByLocalName($local){
        $consulta = $this->conexion->prepare("SELECT e.idEvento idEvento, e.nombre nombre, e.fecha fecha, e.tipo ,l.idLocal idLocal, l.nombre localNombre
                                              FROM ".$this->tableName." e, local l
                                              WHERE e.local_idLocal = l.idLocal AND LOWER(l.nombre) LIKE ('%".$local."%')
                                              ORDER BY e.fecha");
        $consulta->execute();
        $resultados = $consulta->fetchAll();
        $this->conexion = null;
        return $resultados;
    }

    public function findByDate(){
        $consulta = $this->conexion->prepare("SELECT e.idEvento idEvento, e.nombre nombre, e.fecha fecha, e.tipo ,l.idLocal idLocal, l.nombre localNombre
                                              FROM ".$this->tableName." e, local l
                                              WHERE e.local_idLocal = l.idLocal AND e.fecha LIKE ('%".$this->fecha."%')
                                              ORDER BY e.fecha");
        $consulta->execute();
        $resultados = $consulta->fetchAll();
        $this->conexion = null;
        return $resultados;
    }

}
