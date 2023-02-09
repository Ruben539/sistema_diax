<?php

require_once "../Modelos/conexion.php";
	

	$id=$_POST['id'];

	$estado = 'Atendido';
	
	

	$sql = "UPDATE historial set 
                estado = '$estado'
                    WHERE id = '$id'";
    echo $resultado = mysqli_query($conection,$sql);

 ?>