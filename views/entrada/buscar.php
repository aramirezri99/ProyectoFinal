<h1>Busqueda: <?=$_POST['busqueda']?></h1>
	
  <?php if (!empty($entradas) && $entradas->num_rows >= 1): ?>
	<?php while($contenido = $entradas->fetch_object()):?>
    <article class="entrada">
      <a href="<?=base_url?>entrada/ver_entrada_personal&id=<?=$contenido->id?>">
        <h2><?=$contenido->titulo ?></h2>
        <span class="fecha"><?=$contenido->categoria.' | '.$contenido->fecha ?></span>
        <p>
          <?=substr($contenido->descripcion, 0, 180)."..."?>
        </p>
      </a>
    </article>
	<?php	endwhile; ?>
	<?php else:?>
		<div class="alerta">No hay entradas en esta categoría</div>
	<?php endif; ?>