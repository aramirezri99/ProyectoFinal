<!-- BARRA LATERAL -->
<aside id="sidebar">
	
	<div id="buscador" class="bloque">
		<h3>Buscar</h3>

		<form action="<?=base_url?>entrada/buscar_entrada" method="POST"> 
			<input type="text" name="busqueda" />
			<input type="submit" value="Buscar" />
		</form>
	</div>
  <?php if(isset($_SESSION['usuario'])): ?>
	  <div id="usuario-logueado" class="bloque">
			<h3>Bienvenido, <?=$_SESSION['usuario']->nombre?> <?=$_SESSION['usuario']->apellidos?></h3>
			<!--botones-->
			<a href="<?=base_url?>entrada/guardar" class="boton boton-verde">Crear entradas</a>
			<a href="<?=base_url?>categoria/vercategoria" class="boton">Crear categoria</a>
			<a href="<?=base_url?>usuario/misdatos" class="boton boton-naranja">Mis datos</a>
			<a href="<?=base_url?>usuario/logout" class="boton boton-rojo">Cerrar sesión</a>
		</div>
	<?php endif; ?>

  <?php if(!isset($_SESSION['usuario'])): ?>
	  <div id="login" class="bloque">
		  <h3>Identificate</h3>
      <?php if(isset($_SESSION['error_login'])): ?>
			  <div class="alerta alerta-error">
				  <?=$_SESSION['error_login'];?>
		    </div>
		  <?php endif; ?>
	
      <form action="<?=base_url?>usuario/login" method="POST"> 
        <label for="email">Email</label>
        <input type="email" name="email" />

        <label for="password">Contraseña</label>
        <input type="password" name="password" />

        <input type="submit" value="Entrar" />
      </form>
	  </div>

    <div id="register" class="bloque">
      <h3>Registrate</h3>
      
      <!-- Mostrar errores -->
      <?php if(isset($_SESSION['completado'])): ?>
			  <div class="alerta alerta-exito">
				  <?=$_SESSION['completado']?>
			  </div>
		  <?php elseif(isset($_SESSION['errores']['general'])): ?>
			  <div class="alerta alerta-error">
				  <?=$_SESSION['errores']['general']?>
			  </div>
		  <?php endif; ?>
      
      
      <form action="<?=base_url?>/usuario/registrar" method="POST"> 
        
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" />
			  <?php echo isset($_SESSION['errores']) ? Utils::mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

        <label for="apellidos">Apellidos</label>
        <input type="text" name="apellidos" />
        <?php echo isset($_SESSION['errores']) ? Utils::mostrarError($_SESSION['errores'], 'apellidos') : ''; ?>

        <label for="email">Email</label>
        <input type="email" name="email" />
        <?php echo isset($_SESSION['errores']) ? Utils::mostrarError($_SESSION['errores'], 'email') : ''; ?>

        <label for="password">Contraseña</label>
        <input type="password" name="password" />
        <?php echo isset($_SESSION['errores']) ? Utils::mostrarError($_SESSION['errores'], 'password') : ''; ?>

        <input type="submit" name="submit" value="Registrar" />
		  </form>
		  <?php Utils::borrarErrores(); ?>
      
    </div>
  <?php endif; ?>
</aside>
<!-- CAJA PRINCIPAL -->
<div id="principal">
