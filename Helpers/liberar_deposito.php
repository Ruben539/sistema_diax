<?php 
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
	}

 //Codigo que se ejecuta cuando le damos Aceptar para eliminar

 include "../Modelos/conexion.php";
 if (!empty($_POST)) {
    $fecha = date('d-m-y H:i:s');
	$_POST['usuario'] = $_SESSION['user'];
	$_POST['fecha_fin'] = $fecha;
	$_POST['estado'] ="LIBERADO";


$id_deposito = $_POST['id_deposito'];
$usuario     = $_POST['usuario'];
$fecha_fin   = $_POST['fecha_fin'];
$estado      = $_POST['estado'];


$query_delete = mysqli_query($conection,"UPDATE deposito SET usuario = '$usuario', fecha_fin = '$fecha_fin',estado = '$estado', estatus = 0 WHERE id_deposito = $id_deposito ");
//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

if ($query_delete) {
	header('location: ../Plantillas/deposito.php');
}else{
	echo "Error al Liberar";
}
}


	//Codigo que Verifica los campos a eliminar

if (!empty($_REQUEST['id'])) {
		
	$id_deposito = $_REQUEST['id'];

	$query = mysqli_query($conection,"SELECT * FROM deposito  WHERE id_deposito = $id_deposito AND estatus = 1");

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

	$resultado = mysqli_num_rows($query);

	if ( $resultado > 0) {
		
		while ($data = mysqli_fetch_array($query)) {
			$modelo          = $data['modelo'];
			$nro_vehiculo    = $data['nro_vehiculo'];
			$falla_detectada = $data['falla_detectada'];
		}
	}else{
		header('location: ../Plantillas/deposito.php');
	}

}

require_once("../body/header_admin.php");
?>
<main class="app-content">
        <!-- Dialogs-->
      <div class="container">
    <div class="jumbotron">
      <h1 class="text-center"><?php echo $modelo?></h1>
      <h2 class="text-center">Nro Vehiculo: <span class="badge badge-success"><?php echo $nro_vehiculo;?></span></h2>    
      <h2 class="text-center">Falla: <span class="form-group"><?php echo $falla_detectada;?></span></h2>    
      <p class="lead text-center">Sistema web de Control de la División Industrial.</p>
      <hr class="my-4">          

			<form method="POST" action="">
				<input type="hidden" name="id_deposito" value="<?php echo $id_deposito; ?>">
				<button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Si,Liberar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" 
				href="../Plantillas/deposito.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>No,Cancelar</a>
			</form>
   </div>   
  </div>
</main>