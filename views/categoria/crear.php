<h1>Crear categorias</h1>
	<p>
		Añade nuevas categorias al blog para que los usuarios puedan
		usarlas al crear sus entradas.
	</p>
	<br/>
	<form action="<?=base_url?>categoria/crearcategoria" method="POST">
		<label for="nombre">Nombre de la categoría:</label>
		<input type="text" name="nombre" />
		
		<input type="submit" value="Guardar" />
	</form>