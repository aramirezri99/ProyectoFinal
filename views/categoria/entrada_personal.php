<h1><?=$entradas->titulo?></h1>
	
	<a href="<?=base_url?>entrada/ver_entrada&id=<?=$entradas->categoria_id?>">
		<h2><?=$entradas->categoria?></h2>
	</a>
	<h4><?=$entradas->fecha?> | <?=$entradas->usuario ?></h4>
	<p>
		<?=$entradas->descripcion?>
	</p>
	
	<?php if(isset($_SESSION["usuario"]) && $_SESSION['usuario']->id == $entradas->usuario_id): ?>
		<br/>	
		<a href="<?=base_url?>entrada/ver_edit_entrada&id=<?=$entradas->id?>" class="boton boton-verde">Editar entrada</a>
		<a href="<?=base_url?>entrada/eliminar&id=<?=$entradas->id?>" class="boton">Eliminar entrada</a>
	<?php endif; ?>
