<div class="d-flex justify-content-center ">

	<form class="p-5 bg-light" method="post">
		
		<div class="form-group">
			<label for="email">Correo electrónico:</label>

			<div class="input-group">

				<div class="input-group-prepend">
		      		<span class="input-group-text">
		      			<i class="fas fa-envelope"></i>
		      		</span>
		    	</div>
				<input type="email" class="form-control" id="email"  name="loginEmail" required>
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
				<input type="password" class="form-control" id="pwd" name="loginPassword" required>
			</div>
		</div>

		<?php 

		/* Forma en que se instancia la clase de un metodo no estatico*/

			//$registro = new ControladorFormularios();
			//$registro -> controlRegistro();

		/* Forma en que se instancia la clase de un metodo estatico*/

			$ingreso = new ControladorFormularios(); 
			$ingreso -> controlLogin();

			
		 ?>
		
			<button type="submit" class="btn btn-primary">Entrar</button>
	</form>
</div>