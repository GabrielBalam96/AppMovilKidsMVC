<?php 

require_once "conexion.php";


class ModeloFormularios{


	/*Registro*/

	static public function modeloRegistro($tabla, $datos){

			#statement: declaracion

			#prepare() prepara una sentencia SQL para ser ejecutada por el metodo PDOStatement::execute(). la sentencia SQL puede contener cero o mas marcadores de parametros con nombre (:name) o signos de interrogacion (?) por los cuales los valores reales seran sustituidos, cuando la sentencia sea ejecutado.

		$stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla(token, nombre, email, password) VALUES 
			(:token, :nombre, :email, :password)");

		#bindParam() vincula una variable de php a un parametro de sustitucion con nombre o signo de interrogacion corresponiente de la sentencia sql 

		$stmt -> bindParam(":token", $datos["token"], PDO::PARAM_STR);
		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			
			return "ok";
		}else{

			print_r(Conexion::conectar()->errorInfo());
		}
		
		$stmt->close();
		$stmt = null;
	}


	#seleccionar Registros 

	static public function modeloSeccionarRegistros($tabla, $item, $valor){

		if ($item == null && $valor == null) {
			

			$stmt = Conexion::conectar()->prepare("SELECT *,DATE_FORMAT(fecha,'%d/%m/%Y') AS fecha FROM 
			$tabla ORDER BY id DESC ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT *, DATE_FORMAT(fecha,'%d/%m/%Y') AS fecha FROM 
			$tabla WHERE $item = :$item ORDER BY id DESC ");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			


			$stmt -> execute();

			return $stmt -> fetch();

		}

		$stmt->close();
		$stmt = null;
	 }

	/* Actualizar registro*/

	static public function modeloActualizarRegistro($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET token=:token, nombre=:nombre, email=:email, 
			password=:password WHERE id = :id"); 


		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":token", $datos["token"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);


		if ($stmt->execute()) {
			
			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}
		$stmt->close();
		$stmt = null;
	}

	/* Eliminar Registro*/

	static public function modeloEliminarRegistro($tabla, $valor){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE token =:token");

		$stmt->bindParam(":token", $valor, PDO::PARAM_STR);


		if ($stmt->execute()) {
			
			return "ok";

		}else{

			print_r(Conexion::conectar()->errorInfo());

		}
		$stmt->close();
		$stmt = null;

	}

	//Actualizar intentos fallidos 

	static public function modeloActualizarIntentosFallidos($tabla, $valor, $token){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET intentos_fallidos=:intentos_fallidos WHERE token =:token");

		$stmt->bindParam(":intentos_fallidos", $valor, PDO::PARAM_INT);
		$stmt->bindParam(":token", $token, PDO::PARAM_STR);

		if ($stmt->execute()) {
			
			return "ok"; 

		}else{

			print_r(Conexion::conectar()->errorInfo());
		}

		$stmt->close();
		$stmt = null;

	}
		
}



