<?php

require_once "../Modelos/conexion.php";
	

	$id=$_POST['id'];

	$estatus = 2;
	
	

	$sql = "UPDATE medicos set 
                estatus = '$estatus'
                    WHERE id = '$id'";
    echo $resultado = mysqli_query($conection,$sql);

 ?>