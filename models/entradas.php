<?php

Class Entradas {

  private $id;
  private $usuario_id;
  private $categoria_id;
  private $titulo;
  private $descripcion;
  private $fecha;

  private $db;

  public function __construct() {

    $this->db = Database::connect();

  }


  function getId(){
    return $this->id;
  }

  function setId($id){
    $this->id = $id;
  }

  function getusuario_Id(){
    return $this->usuario_id;
  }

  function setusuario_Id($usuario_id){
    $this->usuario_id = $usuario_id;
  }

  function getcategoria_Id(){
    return $this->categoria_id;
  }

  function setcategoria_Id($categoria_id){
    $this->categoria_id = $categoria_id;
  }

  function gettitulo(){
    return $this->titulo;
  }

  function settitulo($titulo){
    $this->titulo = $titulo;
  }

  function getdescripcion(){
    return $this->descripcion;
  }

  function setdescripcion($descripcion){
    $this->descripcion = $descripcion;
  }

  
  function ultimasEntradas($limit = null, $categoria = null, $busqueda = null){

    $result = false;
    $sql="SELECT e.*, c.nombre AS 'categoria' FROM entradas e ".
      "INNER JOIN categorias c ON e.categoria_id = c.id ";
    
    if(!empty($categoria)){
      $sql .= "WHERE e.categoria_id = $categoria ";
    }
    
    if(!empty($busqueda)){
      $sql .= "WHERE e.titulo LIKE '%$busqueda%' ";
    }
    
    $sql .= "ORDER BY e.id DESC ";
    
    if($limit){
      // $sql = $sql." LIMIT 4";
      $sql .= "LIMIT 4";
    }
    
    $entradas = $this->db->query($sql);
       
	  return $entradas;
  }

  function conseguirEntrada($id){
    
    $sql = "SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombre, ' ', u.apellidos) AS usuario"
        . " FROM entradas e ".
        "INNER JOIN categorias c ON e.categoria_id = c.id ".
        "INNER JOIN usuarios u ON e.usuario_id = u.id ".
        "WHERE e.id = $id";
    $resultado = $this->db->query($sql);
    
    return $resultado->fetch_object();
  }

  public function save(){
      
    $sql = "INSERT INTO entradas VALUES(NULL, '{$this->getusuario_Id()}', '{$this->getcategoria_Id()}', '{$this->gettitulo()}', '{$this->getdescripcion()}', CURDATE());";
      $save = $this->db->query($sql);
      
      $result = false;
      if($save){
        $result = true;
      }
      return $result;
	}

  public function borrar($id_entrada, $id_usuario){

    $sql = "DELETE FROM entradas WHERE usuario_id = $id_usuario AND id = $id_entrada";
    $save = $this->db->query($sql);
      
    $result = false;
    if($save){
      $result = true;
    }
    return $result;
  }
  
  public function encontrar($text){
    $sql="SELECT e.*, c.nombre AS 'categoria' FROM entradas e ".
      "INNER JOIN categorias c ON e.categoria_id = c.id WHERE e.titulo LIKE '%$text%' ";
    $result = $this->db->query($sql);

    return $result;
  }
}