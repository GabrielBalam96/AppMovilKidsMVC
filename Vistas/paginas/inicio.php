<?php 

//validar ingreso al sistema

if (!isset($_SESSION["validarLogin"])) {

		echo '<script> window.location = "login"; </script>';

		return;
 	
 	}else{

 		if ($_SESSION["validarLogin"] != "ok") {
 		
 		echo '<script> window.location = "login"; </script>';

 		return;

 	}
 } 

$usuario = ControladorFormularios::controlSeleccionarRegistros(null, null);
#echo '<pre>';print_r($usuario); echo '</pre>';



 ?>



<table class="table table-striped">
	<thead>
		<tr>
		<th>#</th>
		<th>Nombre</th>
		<th>Email</th>
		<th>Fecha</th>
		<th>Acciones</th>
		</tr>
	</thead>

	<tbody>

		<?php foreach ($usuario as $key => $value):?> 

			<tr>
				<td><?php echo ($key + 1); ?></td>
				<td><?php echo $value["nombre"]; ?></td>
				<td><?php echo $value["email"]; ?></td>
				<td><?php echo $value["fecha"]; ?></td>
				<td>
					<div class="btn-group">
						
						<div class="px-1"> 

							<a href="index.php?pagina=editar&token=<?php echo $value["token"];?>"class="btn btn-warning"><i class="fas fa-pencil-alt"></i></a>

						</div>
						
						<form method="post">

							<input type="hidden" value="<?php echo $value["token"]; ?>"; name="eliminarRegistro" >

							<button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>

							<?php 

								$eliminar = new ControladorFormularios(); 
								$eliminar -> controlEliminarRegistro(); 

							 ?>

						</form>
						
					</div>

				</td>
			</tr>

		<?php endforeach ?>

		
		
	</tbody>
</table>
