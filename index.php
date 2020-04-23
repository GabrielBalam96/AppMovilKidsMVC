<?php 

#index sirve para mostrar la salida de las vistas al usuario y tambien para enviar informacion al controlador 
#require() sirve para llamar el archivo que tiene el funcionamiento del programa.

require_once "Controladores/plantilla.controlador.php";
require_once "Controladores/formularios.controlador.php";
require_once "Modelos/formularios.modelo.php";


$plantilla = new ControladorPlantilla();
$plantilla -> traerPlantilla();








