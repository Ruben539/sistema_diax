<?php 
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
	}

 //Codigo que se ejecuta cuando le damos Aceptar para eliminar

 include "../Modelos/conexion.php";
 if (!empty($_POST)) {

if ($_POST['id'] == 0) {//si el post que se envia es 1 se detiene el codigo
	header('location: ../Plantillas/pacientes.php');
	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php
	exit;
}

$id = $_POST['id'];

	//$query_delete = mysqli_query($conection,"DELETE FROM usuario WHERE idusuario = $idusuario");

$query_delete = mysqli_query($conection,"UPDATE clientes SET estatus = 0 WHERE id = $id AND estatus = 1 ");
//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

if ($query_delete) {
	header('location: ../Plantillas/pacientes.php');
}else{
	echo "Error al Eliminar";
}
}


	//Codigo que Verifica los campos a eliminar

if (empty($_REQUEST['id']) || $_REQUEST['id'] == 1) {
	
	header('location: ../Plantillas/pacientes.php');
	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

}else{
	

	$id = $_REQUEST['id'];

	$query = mysqli_query($conection,"SELECT * FROM clientes WHERE id = $id");

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

	$resultado = mysqli_num_rows($query);

	if ( $resultado > 0) {
		
		while ($data = mysqli_fetch_array($query)) {
			$Nombre    = $data['Nombre'];
			$Apellido  = $data['Apellido'];
			$Sexo      = $data['Sexo'];
		}
	}else{
		header('location: ../Plantillas/pacientes.php');
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
	<title>Clinica Diax</title>
</head>
<body>
	
<main class="app-content">
  <div class="container">
    <div class="jumbotron">
        <form action="" method="POST">
      <h1 class="text-center"> Eliminar Paciente N° <?php echo $id;?></h1>
      <h2 class="text-center">Paciente: <span class="form-group"><?php echo $Nombre;?></span></h2>    
      <h2 class="text-center">Sexo: <span class="form-group"><?php echo $Sexo;?></span></h2>    
      <p class="lead text-center">Sistema Medico en Desarrollo de la Clinica Diax.</p>
      <hr class="my-4">          

			
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Si,Eliminar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" 
				href="../Plantillas/pacientes.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>No,Cancelar</a>
			</form>
   </div>   
  </div>

</main>	
</body>
</html>