

<div class="d-flex justify-content-center ">

	<form class="p-5 bg-light" method="post">
		<div class="form-group">
			<label for="nombre">Nombre:</label>
			
			<div class="input-group">
			
				<div class="input-group-prepend">
		      		<span class="input-group-text">
		      			<i class="fas fa-user"></i>
		      		</span>
		    	</div>
				<input type="text" class="form-control" id="nombre" name="registroNombre" required>
			</div>
		</div>

		<div class="form-group">
			<label for="email">Correo electrónico:</label>

			<div class="input-group">

				<div class="input-group-prepend">
		      		<span class="input-group-text">
		      			<i class="fas fa-envelope"></i>
		      		</span>
		    	</div>
				<input type="email" class="form-control" id="email" name="registroEmail" required>
			</div>
		</div>

		<div class="form-group">
			 <label for="pwd">Contraseña:</label>

			<div class="input-group">

				<div class="input-group-prepend">
		      		<span class="input-group-text">
		      			<i class="fas fa-lock"></i>
		      		</span>
		    	</div>
				<input type="password" class="form-control" id="pwd" name="registroPassword" required>
			</div>
		</div>

		<?php 

		/* Forma en que se instancia la clase de un metodo no estatico*/

			//$registro = new ControladorFormularios();
			//$registro -> controlRegistro();

		/* Forma en que se instancia la clase de un metodo estatico*/

			$registro = ControladorFormularios::controlRegistro();

			if ($registro == "ok") {

				echo '<script> 
				
				if(window.history.replaceState){

					window.history.replaceState(null, null, window.location.href);
					
				}


				</script>';

				echo '<div class="alert alert-success">El usuario ha sido registrado correctamente</div>';
			}
			if ($registro == "error"){

				echo '<script> 
				
				if(window.history.replaceState){

					window.history.replaceState(null, null, window.location.href);
					
				}


				</script>';

				echo '<div class="alert alert-danger">Error, no se permiten caracteres especiales</div>';


			}

		 ?>
		
			<button type="submit" class="btn btn-primary">Registrar</button>
	</form>
</div>