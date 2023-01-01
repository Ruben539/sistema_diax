<?php 
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
	}

 //Codigo que se ejecuta cuando le damos Aceptar para eliminar

 include "../Modelos/conexion.php";
 if (!empty($_POST)) {

if ($_POST['id_usuario'] == 1) {//si el post que se envia es 1 se detiene el codigo
	header('location: ../Plantillas/usuarios.php');
	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php
	exit;
}

$id_usuario = $_POST['id_usuario'];

	//$query_delete = mysqli_query($conection,"DELETE FROM usuario WHERE idusuario = $idusuario");

$query_delete = mysqli_query($conection,"UPDATE usuario SET estatus = 1 WHERE id_usuario = $id_usuario ");
//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

if ($query_delete) {
	header('location: ../Plantillas/usuarios.php');
}else{
	echo "Error al Eliminar";
}
}


	//Codigo que Verifica los campos a eliminar

if (empty($_REQUEST['id']) || $_REQUEST['id'] == 1) {
	
	header('location: ../Plantillas/usuarios.php');
	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

}else{
	

	$iduser = $_REQUEST['id'];

	$query = mysqli_query($conection,"SELECT * FROM usuario WHERE id_usuario = $iduser AND estatus = 0");

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

	$resultado = mysqli_num_rows($query);

	if ( $resultado > 0) {
		
		while ($data = mysqli_fetch_array($query)) {
			$nombre  = $data['nombre'];
			$user    = $data['usuario'];
			$puesto  = $data['puesto'];
		}
	}else{
		header('location: ../Plantillas/usuarios.php');
	}

}

require_once("../body/header_admin.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/estiloLista.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<title>División Industrial</title>
</head>
<body>
	
<main class="app-content">
  <div class="container">
    <div class="jumbotron">
        <form action="" method="POST">
      <h1 class="display-4 text-center">Desea Reestablecer el Usuario!</h1>
      <h2 class="text-center">Usuario: <span class="form-group"><?php echo $nombre;?></span></h2>    
      <h2 class="text-center">Sector: <span class="form-group"><?php echo $puesto;?></span></h2>    
      <p class="lead text-center">Sistema web de Control de la División Industrial.</p>
      <hr class="my-4">          

			
				<input type="hidden" name="id_usuario" value="<?php echo $iduser; ?>">
				<button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Si,Generar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" 
				href="../Plantillas/usuario_trash.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>No,Cancelar</a>
			</form>
   </div>   
  </div>


</main>	
</body>
</html>