<?php

require_once 'models/categoria.php';

class categoriaController{

  
  public static function mostrarcategoria(){
    
    $categ = new categoria();  
    $categorias = $categ->conseguirCategoria();
    
    require_once 'views/layout/header.php';
  } 

  
  public function crearcategoria(){
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
	
	// Array de errores
    $errores = array();
    
    // Validar los datos antes de guardarlos en la base de datos
    // Validar campo nombre
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
      $nombre_validado = true;
    }else{
      $nombre_validado = false;
      $errores['nombre'] = "El nombre no es válido";
    }

    if (count($errores) == 0) {
        
      if($nombre){

        $categoria = new categoria();
        $categoria->setNombre($nombre);
        
        $save = $categoria->save_categ();
        
        if($save){
          $_SESSION['completado'] = "El registro se ha completado con éxito";
        }else{
          $_SESSION['errores']['general'] = "Fallo al guardar la categoria!!";
        }
      
      }else{
          $_SESSION['errores'] = $errores;
      }
    }
      //$_SESSION['errores'] = $errores;
    header("Location:".base_url);
  }

  public function vercategoria(){
    
    require_once 'views/categoria/crear.php';
  }


}
