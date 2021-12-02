
<!DOCTYPE HTML>
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Blog de Videojuegos</title>
		<link rel="stylesheet" type="text/css" href="<?=base_url?>assets/css/style.css" />
	</head>
	<body>
		<!-- CABECERA -->
		<header id="cabecera">
			<!-- LOGO -->
      
			<div id="logo">
				<a href="<?=base_url?>">
					Blog de Videojuegos
				</a>
			</div>
			
      
			<!-- MENU -->
			<nav id="menu">
				<ul>
					<li>
						<a href="<?=base_url?>">Inicio</a>
					</li>
          <?php while($contenido = $categorias->fetch_object()):?>
            <li>
							<a href="<?=base_url?>entrada/ver_entrada&id=<?=$contenido->id?>"><?=$contenido->nombre?></a>
					  </li>
          <?php	endwhile; ?> 
					<li>
						<a href="<?=base_url?>">Sobre mí</a>
					</li>
					<li>
						<a href="<?=base_url?>">Contacto</a>
					</li>
				</ul>
			</nav>
			
			<div class="clearfix"></div>
		</header>
		
		<div id="contenedor">