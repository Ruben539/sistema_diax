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
	


$id_reclamo  = $_POST['id_reclamo'];
$usuario     = $_POST['usuario'];
$fecha_fin   = $_POST['fecha_fin'];



$query_delete = mysqli_query($conection,"UPDATE reclamos SET usuario = '$usuario', fecha_fin = '$fecha_fin', estatus = 0 WHERE id_reclamo = $id_reclamo ");
//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

if ($query_delete) {
	header('location: ../Plantillas/garantia.php');
}else{
	echo "Error al Liberar";
}
}


	//Codigo que Verifica los campos a eliminar

if (!empty($_REQUEST['id'])) {
		
	$id_reclamo = $_REQUEST['id'];

	$query = mysqli_query($conection,"SELECT * FROM reclamos  WHERE id_reclamo = $id_reclamo AND estatus = 1");

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

	$resultado = mysqli_num_rows($query);

	if ( $resultado > 0) {
		
		while ($data = mysqli_fetch_array($query)) {
			$modelo         = $data['modelo'];
			$nro_partida    = $data['nro_partida'];
            $pieza          = $data['pieza'];
			$destino        = $data['destino'];
		}
	}else{
		header('location: ../Plantillas/garantia.php');
	}

}

require_once("../body/header_admin.php");
?>
<main class="app-content">
        <!-- Dialogs-->
      <div class="container">
    <div class="jumbotron">
      <h1 class="text-center"><?php echo $modelo?></h1>
      <h2 class="text-center">Nro Partida: <span class="badge badge-success"><?php echo $nro_partida;?></span></h2>    
      <h2 class="text-center">Pieza: <span class="form-group"><?php echo $pieza;?></span></h2> 
      <h2 class="text-center">Destino: <span class="form-group"><?php echo $destino;?></span></h2>   
      <p class="lead text-center">Sistema web de Control de la División Industrial.</p>
      <hr class="my-4">          

			<form method="POST" action="">
				<input type="hidden" name="id_reclamo" value="<?php echo $id_reclamo; ?>">
				<button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Si,Liberar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" 
				href="../Plantillas/garantia.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>No,Cancelar</a>
			</form>
   </div>   
  </div>
</main>