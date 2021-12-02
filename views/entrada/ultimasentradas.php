
  <h1>Ultimas entradas</h1>
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
    
  
  <div id="ver-todas">
	<a href="entradas.php">Ver todas las entradas</a>
	</div>
</div> <!--fin principal-->