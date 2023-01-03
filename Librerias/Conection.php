<?php 
	class Conection {
function conexion(){
	$servidor = "localhost";
	$usuario = "root";
	$pass = "";
	$bd = "laspalmas";

	$conection = mysqli_connect($servidor,$usuario,$pass,$bd);

	return $conection;
 }
}

 ?>