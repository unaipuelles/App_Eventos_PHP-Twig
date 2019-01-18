<?php
/**
 * Created by PhpStorm.
 * User: unai-
 * Date: 10/01/2019
 * Time: 12:14
 */

class Local
{
    private $conexion, $tableName;
    private $id, $nombre, $categoria, $direccion, $telefono, $email;

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
    public function setId($id): void
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
    public function setConexion($conexion): void
    {
        $this->conexion = $conexion;
    }

    /**
     * @return mixed
     */
    public function getTablename()
    {
        return $this->tablename;
    }

    /**
     * @param mixed $tablename
     */
    public function setTablename($tablename): void
    {
        $this->tablename = $tablename;
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
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param mixed $categoria
     */
    public function setCategoria($categoria): void
    {
        $this->categoria = $categoria;
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion): void
    {
        $this->direccion = $direccion;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param mixed $telefono
     */
    public function setTelefono($telefono): void
    {
        $this->telefono = $telefono;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function setAllParameters($nombre, $categoria, $direccion, $telefono, $email){
        $this->nombre = $nombre;
        $this->categoria = $categoria;
        $this->direccion = $direccion;
        $this->telefono = $telefono;
        $this->email = $email;
    }

    public function create(){
        $data = array('nombre'=>$this->nombre, 'categoria'=>$this->categoria, 'direccion'=>$this->direccion, 'telefono'=>$this->telefono, 'email'=>$this->email);
        $stmnt = $this->conexion->prepare('INSERT INTO '.$this->tableName.' (nombre, categoria, direccion, telefono, email) 
            VALUES (:nombre, :categoria, :direccion, :telefono, :email)');
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
        $this->setAllParameters($resultados['nombre'], $resultados['categoria'], $resultados['direccion'], $resultados['telefono'], $resultados['email']);
    }

    public function update(){
        $data = array('nombre'=>$this->nombre, 'categoria'=>$this->categoria, 'direccion'=>$this->direccion, 'telefono'=>$this->telefono, 'email'=>$this->email, "id"=>$this->id);
        $stmnt = $this->conexion->prepare("UPDATE ".$this->tableName." SET nombre = :nombre, categoria = :categoria, direccion = :direccion, telefono = :telefono, email = :email 
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