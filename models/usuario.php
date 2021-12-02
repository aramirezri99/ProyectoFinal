<?php

  class Usuario{
    
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $fecha;
    
    private $db;

    public function __construct(){
      $this->db = Database::connect();

    }

    function getId(){
      return $this->id;
    }

    function getNombre(){
      return $this->nombre;
    }

    function getApellido(){
      return $this->apellidos;
    }
    
    function getEmail(){
      return $this->email;
    }

    function getPassword(){
      return $this->password;
    }

    function getFecha(){
      return $this->fecha;
    }

    function setId($id){
      $this->id = $id;
    }
    
    function setNombre($nombre) {
      $this->nombre = $nombre;
    }

    function setApellidos($apellidos) {
      $this->apellidos = $apellidos;
    }

    function setEmail($email) {
      $this->email = $email;
    }

    function setPassword($password) {
      $this->password = $password;
    }

    function setFecha($fecha) {
      $this->$fecha = $fecha;
    }
   
    public function login(){
      $result = false;
      $email = $this->email;
      $password = $this->password;
      
      // Comprobar si existe el usuario
      $sql = "SELECT * FROM usuarios WHERE email = '$email'";
      $login = $this->db->query($sql);
      
      
      if($login && $login->num_rows == 1){
        $usuario = $login->fetch_object();
        
        // Verificar la contraseña
        $verify = password_verify($password , $usuario->password);
        
        if($verify){
          $result = $usuario;
        }
      }
      
      return $result;
    }

    public function save(){
      $sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getNombre()}', '{$this->getApellido()}', '{$this->getEmail()}', '{$this->getPassword()}', CURDATE());";
      $save = $this->db->query($sql);
      
      $result = false;
      if($save){
        $result = true;
      }
      return $result;
	  }

    public function modificar(){
      
      $sql = "UPDATE usuarios SET nombre = '{$this->getNombre()}', apellidos = '{$this->getApellido()}', email = '{$this->getEmail()}' WHERE id = ".$this->getId();
			
      $save = $this->db->query($sql);
      $result = false;
		  
      if($save){
			  $result = true;
		  }
		  return $result;

    }

  }
  