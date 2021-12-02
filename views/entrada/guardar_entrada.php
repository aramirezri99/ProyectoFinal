<h1>Crear entradas</h1>
	<p>
		Añade nuevas entradas al blog para que los usuarios puedan
		leerlas y disfrutar de nuestro contenido.
	</p>
	<br/>
	<form action="<?=base_url?>entrada/guardar_entrada" method="POST">
		<label for="titulo">Titulo:</label>
		<input type="text" name="titulo" />
		<?php echo isset($_SESSION['errores_entrada']) ? Utils::mostrarError($_SESSION['errores_entrada'], 'titulo') : ''; ?>
		
		<label for="descripcion">Descripción:</label>
		<textarea name="descripcion"></textarea>
		<?php echo isset($_SESSION['errores_entrada']) ? Utils::mostrarError($_SESSION['errores_entrada'], 'descripcion') : ''; ?>
		
		<label for="categoria">Categoría</label>
		<select name="categoria">
      <?php while($contenido = $categorias->fetch_object()):?>
				<option value="<?=$contenido->id?>">
					<?=$contenido->nombre?>
				</option>
			<?php
				endwhile;
				
			?>
		</select>
		<?php echo isset($_SESSION['errores']) ? Utils::mostrarError($_SESSION['errores'], 'categoria') : ''; ?>
		
		<input type="submit" value="Guardar" />
	</form>
  <?php if (isset($_SESSION['errores'])) {
    echo "". $_SESSION['errores'];
  }?>
	<?php Utils::borrarErrores(); ?>