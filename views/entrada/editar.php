<h1>Editar entrada</h1>
	<p>
		Edita tu entrada <?=$entrada_actual->titulo?>
	</p>
	<br/>
	<form action="<?=base_url?>entrada/editar&id=<?=$entrada_actual->id?>" method="POST">
		<label for="titulo">Titulo:</label>
		<input type="text" name="titulo" value="<?=$entrada_actual->titulo?>"/>
		<?php echo isset($_SESSION['errores_entrada']) ? Utils::mostrarError($_SESSION['errores_entrada'], 'titulo') : ''; ?>
		
		<label for="descripcion">Descripción:</label>
		<textarea name="descripcion"><?=$entrada_actual->descripcion?></textarea>
		<?php echo isset($_SESSION['errores_entrada']) ? Utils::mostrarError($_SESSION['errores_entrada'], 'descripcion') : ''; ?>
		
		<label for="categoria">Categoría</label>
		<select name="categoria">

			<?php while($contenido = $categorias->fetch_object()):?>
				<option value="<?=$contenido->id?> " <?=($contenido->id == $entrada_actual->categoria_id) ? 'selected="selected"' : '' ?>>
					<?=$contenido->nombre?>
				</option>
			<?php
				endwhile;
				
			?>
		</select>
		<?php echo isset($_SESSION['errores_entrada']) ? Utils::mostrarError($_SESSION['errores_entrada'], 'categoria') : ''; ?>
		
		<input type="submit" value="Guardar" />
	</form>
	<?php Utils::borrarErrores(); ?>