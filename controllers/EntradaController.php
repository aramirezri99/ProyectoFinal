<?php

require_once 'models/entradas.php';
require_once 'models/categoria.php';

class entradaController{

  public function index(){
  
    $entrada = new Entradas();  
    $entradas = $entrada->ultimasEntradas();
		require_once 'views/entrada/ultimasentradas.php';
	}

  public function ver_edit_entrada(){
    
    if (isset($_GET['id'])) {
      
      $categ = new categoria();
			$categorias = $categ->getAll();
      
      $id= $_GET['id'];
      $entrada = new Entradas();  
      $entrada_actual = $entrada->conseguirEntrada($id);
      
      require_once 'views/entrada/editar.php';   
    }
  }

  public function editar(){


  }

  public function ver_entrada(){
    
    if (isset($_GET['id'])) {
      
      $id = $_GET['id'];
      
      // Conseguir categoria
      $categoria = new categoria();
			$categoria->setId($id);
			$categoria = $categoria->getOne();

      // Conseguir entrada
      $entrada = new Entradas();  
      $entradas = $entrada->ultimasEntradas(null,$id,null);
      
      
      require_once 'views/categoria/entrada_categ.php';
    }
	}

  public function ver_entrada_personal(){
      
    $id = $_GET['id'];
    $entrada = new Entradas();
    $entradas = $entrada->conseguirEntrada($id);
    require_once 'views/categoria/entrada_personal.php';
    
	}

  public function guardar_entrada(){

    $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : false;
      
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
    $categoria = isset($_POST['categoria']) ? (int)$_POST['categoria'] : false;
    $usuario = $_SESSION['usuario']->id;
    
    // Validación
    $errores = array();
    
    if(empty($titulo)){
      $errores['titulo'] = 'El titulo no es válido';
    }
  
    if(empty($descripcion)){
      $errores['descripcion'] = 'La descripción no es válida';
    }
    
    if(empty($categoria) && !is_numeric($categoria)){
      $errores['categoria'] = 'La categoría no es válida';
    }

    if (count($errores) == 0) {
                
      if($titulo && $descripcion && $categoria && $usuario){
        
        $entrada = new Entradas();
        $entrada->setusuario_Id($usuario);
        $entrada->setcategoria_Id($categoria);
        $entrada->settitulo($titulo);
        $entrada->setdescripcion($descripcion);
        

        $save = $entrada->save(); 
        if($save){
          $_SESSION['completado'] = "El registro se ha completado con éxito";
        }else{
          $_SESSION['errores']['general'] = "Fallo al guardar la entrada!!";
        }
    
      }else{
        $_SESSION['errores'] = $errores;
      }
      
    }else{
      $_SESSION['errores'] = 'failed';
    }
    header("Location:".base_url);
  }

  public function guardar(){


    $categ = new categoria();  
    $categorias = $categ->conseguirCategoria();

    require_once 'views/entrada/guardar_entrada.php';
  }
  
  public function eliminar(){

    $id = $_GET['id'];
    $id_usuario = $_SESSION['usuario']->id;

    $entrada = new Entradas();

    if ($entrada->borrar($id,$id_usuario)) {
      header("Location:".base_url);
    }

  }

  public function buscar_entrada(){

    $busqueda = $_POST['busqueda'];
    $entrada = new Entradas();
    $entradas = $entrada->ultimasEntradas(null,null,$busqueda);
    
    require_once 'views/entrada/buscar.php';
    
  }


}