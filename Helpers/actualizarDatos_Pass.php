<?php

require_once "../Modelos/conexion.php";
	

	$id_usuario=$_POST['id_usuario'];

	$pass=md5($_POST['pass']);
	
	

	$sql = "UPDATE usuario set 
                                 pass = '$pass'
                                 
                                
                WHERE id_usuario = '$id_usuario'";
    echo $resultado = mysqli_query($conection,$sql);

 ?>