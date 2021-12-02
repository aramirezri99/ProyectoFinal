<?php

require_once 'models/usuario.php';

class usuarioController{


  public function misdatos(){

    require_once 'views/usuario/misdatos.php';
  }

  public function cerrar(){

  }

  public function login(){
    if(isset($_POST)){
			// Identificar al usuario
			// Consulta a la base de datos


			$usuario = new Usuario();
			$usuario->setEmail($_POST['email']);
			$usuario->setPassword($_POST['password']);
			
			$identity = $usuario->login();
			
			if($identity && is_object($identity)){
				$_SESSION['usuario'] = $identity;
				
			}else{
				$_SESSION['error_login'] = 'Identificación fallida !!';
			}
		
		}
		header("Location:".base_url);
  }

  public function registrar(){
		
    if(isset($_POST)){
			
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
			$apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
			$email = isset($_POST['email']) ? $_POST['email'] : false;
			$password = isset($_POST['password']) ? $_POST['password'] : false;
      
      $errores = array();
	
      // Validar los datos antes de guardarlos en la base de datos
      // Validar campo nombre
      if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
        $nombre_validado = true;
      }else{
        $nombre_validado = false;
        $errores['nombre'] = "El nombre no es válido";
      }
    
      // Validar apellidos
      if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)){
        $apellidos_validado = true;
      }else{
        $apellidos_validado = false;
        $errores['apellidos'] = "Los apellidos no son válidos";
      }
    
      // Validar el email
      if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_validado = true;
      }else{
        $email_validado = false;
        $errores['email'] = "El email no es válido";
      }
    
      // Validar la contraseña
      if(!empty($password)){
        $password_validado = true;
      }else{
        $password_validado = false;
        $errores['password'] = "La contraseña está vacía";
      }
    
      $guardar_usuario = false;

      if (count($errores) == 0) {
        $guardar_usuario = true;
        $password_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);

        if($nombre && $apellidos && $email && $password){
          $usuario = new Usuario();
          $usuario->setNombre($nombre);
          $usuario->setApellidos($apellidos);
          $usuario->setEmail($email);
          $usuario->setPassword($password_segura);
          
          
          $save = $usuario->save();
          if($save){
            $_SESSION['completado'] = "El registro se ha completado con éxito";
          }else{
            $_SESSION['errores']['general'] = "Fallo al guardar el usuario!!";
          }
      
        }else{
          $_SESSION['errores'] = $errores;
        }
      }
      //$_SESSION['errores'] = $errores;
    }else{
      $_SESSION['errores'] = 'failed';
    }
    header("Location:".base_url);
  }

  public function logout(){
		if(isset($_SESSION['usuario'])){
			unset($_SESSION['usuario']);
		}
			
		header("Location:".base_url);
	}

  public function actualizar(){

    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
	  $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
	  $email = isset($_POST['email']) ? trim($_POST['email']) : false;

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
	
	// Validar apellidos
    if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)){
      $apellidos_validado = true;
    }else{
      $apellidos_validado = false;
      $errores['apellidos'] = "Los apellidos no son válido";
    }
    
    // Validar el email
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
      $email_validado = true;
    }else{
      $email_validado = false;
      $errores['email'] = "El email no es válido";
    }
    
    $guardar_usuario = false;

    if(count($errores) == 0){
      $id = $_SESSION['usuario']->id;
      $guardar_usuario = true;


      if($nombre && $apellidos && $email){
        $usuario = new Usuario();
        $usuario->setId($id);
        $usuario->setNombre($nombre);
        $usuario->setApellidos($apellidos);
        $usuario->setEmail($email);
          
          
        $save = $usuario->modificar();
        if($save){
          $_SESSION['completado'] = "Tus datos se han actualizado con éxito";
        }else{
          $_SESSION['errores']['general'] = "Fallo al guardar el actulizar tus datos!!";
        }
      
      }else{
          $_SESSION['errores']['general'] = "El usuario ya existe!!";
      }
    }else{
      $_SESSION['errores'] = $errores;
    }
    header("Location:".base_url . "usuario/misdatos");

  }
}