<?php 

class ControladorFormularios{

	/* Registro*/

	static public function controlRegistro(){

		if(isset($_POST["registroNombre"])){

			if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["registroNombre"]) &&	
				preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][
					a-zA-Z]{2,4}$/', $_POST["registroEmail"])&&
				preg_match('/^[0-9a-zA-Z]+$/', $_POST["registroPassword"])) {
				
			//este sirve para comprobar si manda datos return $_POST["registroNombre"]."<br>".$_POST["registroEmail"]."<br>".$_POST["registroPassword"]."<br>";

			$tabla = "registros";

			$token = md5($_POST["registroNombre"]."+".$_POST["registroEmail"]);

			$encriptarPassword = crypt($_POST["registroPassword"],'$2a$07$asxx54AltsoftWare87a5a4dDDGsystemdev$');

			$datos =array("token" => $token,
						  "nombre" => $_POST["registroNombre"],  
						  "email" => $_POST["registroEmail"],
						  "password" => $encriptarPassword );

			$respuesta = ModeloFormularios::modeloRegistro($tabla, $datos);
			return $respuesta;

			}else{

			$respuesta = "error";
			return $respuesta;

			}

		}
	}

	#seleccionar Registros 

	static public function controlSeleccionarRegistros($item, $valor){

		$tabla = "registros";

		$respuesta = ModeloFormularios::modeloSeccionarRegistros($tabla, $item, $valor);

		return $respuesta;
	}

	/*Login*/

	public function controlLogin(){

		if (isset($_POST["loginEmail"])) {

			$tabla = "registros";
			$item = "email";
			$valor = $_POST["loginEmail"];

			$respuesta = ModeloFormularios::modeloSeccionarRegistros($tabla, $item, $valor);

			$encriptarPassword = crypt($_POST["loginPassword"],'$2a$07$asxx54AltsoftWare87a5a4dDDGsystemdev$');

			if($respuesta["email"] == $_POST["loginEmail"] && $respuesta["password"] == $encriptarPassword){

				$actualizarIntentosFallidos = ModeloFormularios::modeloActualizarIntentosFallidos($tabla, 0 , $respuesta["token"]);

				$_SESSION["validarLogin"] = "ok";
				

				//echo "Ingreso exitoso";

				echo '<script>

				if(window.history.replaceState){

					window.history.replaceState( null, null, window.location.href);
				}
				window.location = "inicio";

				</script>';

			}else{

				if ($respuesta["intentos_fallidos"] < 3) {
					$tabla = "registros";
					$intentos_fallidos = $respuesta["intentos_fallidos"]+1;

					$actualizarIntentosFallidos = ModeloFormularios::modeloActualizarIntentosFallidos($tabla, $intentos_fallidos, $respuesta["token"]);
					//echo '<pre>'; print_r($intentos_fallidos); echo '</pre>';
				}else{

					echo '<div class="alert alert-warning">RECAPTCHA Debes validar que no eres un robot</div>';

				}

				echo '<script>

				if(window.history.replaceState){

					window.history.replaceState( null, null, window.location.href);
				}

				</script>';

				echo '<div class="alert alert-danger">Error al ingresar al sistema, el email o la contraseña no coinciden</div>';

			}

			//echo '<pre>'; print_r($respuesta); echo '</pre>';


		}

	}


	//Actualizar registros

	static public function controlActualizarRegistro(){


		if (isset($_POST["actualizarNombre"])) {

			if (preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["actualizarNombre"]) &&	
				preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][
					a-zA-Z]{2,4}$/', $_POST["actualizarEmail"])) {

				$usuario = ModeloFormularios::modeloSeccionarRegistros("registros", "token", $_POST["tokenUsuario"]);
				$compararToken = md5($usuario["nombre"]."+".$usuario["email"]);

				if ($compararToken == $_POST["tokenUsuario"] && $_POST["idUsuario"] == $usuario["id"]) {
					

						if ($_POST["actualizarPassword"] != " ") {

							if (preg_match('/^[0-9a-zA-Z]+$/', $_POST["actualizarPassword"])) {
								
								$password =crypt($_POST["actualizarPassword"],'$2a$07$asxx54AltsoftWare87a5a4dDDGsystemdev$');
							}
							
						}else{

							$password = $_POST["passwordActual"];

						}

						$tabla = "registros";
						$actualizarToken = md5($_POST["actualizarNombre"]."+".$_POST["actualizarEmail"]);

						$datos = array(
										"id" => $_POST["idUsuario"],
									   "token" => $actualizarToken,
									   "nombre" => $_POST["actualizarNombre"],
									   "email"  => $_POST["actualizarEmail"], 
									   "password" => $password);

						$respuesta = ModeloFormularios::modeloActualizarRegistro($tabla, $datos);

						return $respuesta;
				}else{

					$respuesta = "error";
					return $respuesta;
				}

			}else{

				$respuesta = "error";
				return $respuesta;
			}
		}

	}

	/*Eliminar Registro*/

	public function controlEliminarRegistro(){

			if (isset($_POST["eliminarRegistro"])) {

				$usuario = ModeloFormularios::modeloSeccionarRegistros("registros", "token", $_POST["eliminarRegistro"]);

				$compararToken = md5($usuario["nombre"]."+".$usuario["email"]);

				if ($compararToken == $_POST["eliminarRegistro"]) {

					$tabla = "registros";
					$valor = $_POST["eliminarRegistro"];

					$respuesta = ModeloFormularios::modeloEliminarRegistro($tabla, $valor);

					if ($respuesta == "ok") {
						
						echo '<script>

						if(window.history.replaceState){

							window.history.replaceState( null, null, window.location.href);
						}
						window.location = "inicio";

						</script>';

					}
					
				}		
			}

	}
 }


 