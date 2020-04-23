<?php 

session_start();

 ?>

<!DOCTYPE html>
<html lang="en">
<head>

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<title>App Movil Kids</title>

<!-- plugins de css-->

	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<!-- plugins de javascritp-->

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<!-- ultima versionde fontawesome-->

<script src="https://kit.fontawesome.com/6a5df23310.js"></script>


</head>
<body>
		

	<div class="container-fluid">

		<h3 class="text-center py-3">Movil Kids</h3>
		
	</div>

	<div class="container-fluid bg-light">
		<div class="container">
			<ul class="nav nav-justified py-2 nav-pills">
				
			<!--Pintar botes  de las rutas -->

			<?php if (isset($_GET["pagina"])): ?>

				
				<?php if ($_GET["pagina"] == "inicio"): ?>

					<li class="nav-item">
						<a class="nav-link active" href="inicio"><i class="fas fa-home"></i> Inicio</a>	
					</li>
				<?php else: ?>

					<li class="nav-item">
						<a class="nav-link" href="inicio">Inicio</a>	
					</li>
					
				<?php endif ?>


				<?php if ($_GET["pagina"] == "login"): ?>

					<li class="nav-item">
						<a class="nav-link active" href="login"><i class="fas fa-user"></i> Ingresar</a>	
					</li>
				<?php else: ?>

					<li class="nav-item">
						<a class="nav-link" href="login">Ingresar</a>	
					</li>
					
				<?php endif ?>


				<?php if ($_GET["pagina"] == "registro"): ?>

					<li class="nav-item">
						<a class="nav-link active" href="registro"><i class="fas fa-user"></i> Registro</a>	
					</li>
				<?php else: ?>

					<li class="nav-item">
						<a class="nav-link" href="registro">Registro</a>	
					</li>
					
				<?php endif ?>


				<?php if ($_GET["pagina"] == "salir"): ?>

					<li class="nav-item">
						<a class="nav-link active" href="salir"><i class="fas fa-sign-out-alt"></i> Salir</a>	
					</li>
				<?php else: ?>

					<li class="nav-item">
						<a class="nav-link" href="salir">Salir</a>	
					</li>
					
				<?php endif ?>

				<?php else: ?>
				
			<!--rutas de las paginas  href="index.php?pagina=inicio" -->	
			
			<li class="nav-item">
				<a class="nav-link" href="inicio">Inicio</a>	
			</li>
			<li class="nav-item">
				<a class="nav-link" href="login"> Ingresar</a>
			</li>
			<li class="nav-item">
				<a class="nav-link active" href="registro"> Registro</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="salir">Salir</a>
			</li>

			<?php endif ?>

			</ul>

		</div>
		
	</div>
	
	<div class="container-fluid">
		<div class="container py-5">

			<?php 

			#Rutas de las paginas
			#ISSET: isset() determina si una variable esta definida y no es NULL


				if(isset($_GET["pagina"])){

					if ($_GET["pagina"] == "registro" ||
						$_GET["pagina"] == "login" ||
						$_GET["pagina"] == "inicio" ||
						$_GET["pagina"] == "editar" ||
						$_GET["pagina"] == "salir"){

						include "paginas/".$_GET["pagina"].".php";
						
					}else{

					include "paginas/error404.php";

					}
				}else{

					include "paginas/login.php";
				}
				
				

			?>

		</div>
	</div>
	<script src="vistas/js/JScript.js"></script>
</body>
</html>