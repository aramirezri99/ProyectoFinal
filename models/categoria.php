<?php

Class categoria {

  private $id;
  private $nombre;
  
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

  function getNombre(){
    return $this->nombre;
  }

  function setNombre($nombre){
    $this->nombre = $nombre;
  }

  
  function conseguirCategoria($id=null){
    
    $sql = "SELECT * FROM categorias";
    
    if ($id!=null) {
      $sql.="WHERE id = $id";
    }
    
    $resultado = $this->db->query($sql);
    
    return $resultado;
  }

  public function getOne(){
		$categoria = $this->db->query("SELECT * FROM categorias WHERE id={$this->getId()}");
		return $categoria->fetch_object();
	}

  public function getAll(){
		$categoria = $this->db->query("SELECT * FROM categorias");
		return $categoria;
	}

  public function save_categ(){

    $sql = "INSERT INTO categorias VALUES(NULL, '{$this->getNombre()}');";
      $save = $this->db->query($sql);
      
      $result = false;
      if($save){
        $result = true;
      }
    return $result;
  }

}