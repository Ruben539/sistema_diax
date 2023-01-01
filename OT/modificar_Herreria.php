<?php 
session_start();
if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 3){
    if (empty($_SESSION['active'])) {
    header('location: ../Plantillas/salir.php');
}

}else{
	header('location: ../Plantillas/salir.php');
  }

 //Codigo que se ejecuta cuando le damos Aceptar para eliminar

 include "../Modelos/conexion.php";
 if (!empty($_POST)) {
	$_POST['sector_1'] ="HERRERIA";
 
	$id_orden   = $_POST['id_orden'];
	$sector_2   = $_POST['sector_2'];



$query_delete = mysqli_query($conection,"UPDATE orden_trabajo SET sector_2 = '$sector_2', estatus = 3 WHERE id_orden = $id_orden ");
//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

if ($query_delete) {
	header('location: ../Plantillas/orden_Trabajo.php');
}else{ 
	echo "Error al Generar la Orden";
}
}


	//Codigo que Verifica los campos a eliminar

if (!empty($_REQUEST['id'])) {
		
	$id_orden = $_REQUEST['id'];

	$query = mysqli_query($conection,"SELECT * FROM orden_trabajo  WHERE id_orden = $id_orden AND estatus != 0");

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

	$resultado = mysqli_num_rows($query);

	if ( $resultado > 0) {
		
		while ($data = mysqli_fetch_array($query)) {
			$modelo         = $data['modelo'];
			$nro_partida    = $data['nro_partida'];
			$observacion    = $data['observacion'];
		}
	}else{
		header('location: ../Plantillas/orden_Trabajo.php');
	}

}

require_once("../body/header_admin.php");
?>
<main class="app-content">
        <!-- Dialogs-->
      <div class="container">
          
    <div class="jumbotron">
	  <h1 class="text-center">Generar OT N° <?php echo $id_orden;?>?</h1>
	  <hr class="my-4">
      <h2 class="text-center"><?php echo $modelo?></h2>
      <h2 class="text-center">Nro Vehiculo: <span class="badge badge-success"><?php echo $nro_partida;?></span></h2>    
      <h2 class="text-center">Falla: <span class="form-group"><?php echo $observacion;?></span></h2>    
      <p class="lead text-center">Sistema web de Control de la División Industrial.</p>
      <hr class="my-4">          

			<form method="POST" action="">
				<input type="hidden" name="id_orden" value="<?php echo $id_orden; ?>">
				<button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Si,Generar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" 
				href="../Plantillas/orden_Trabajo.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>No,Cancelar</a>
			</form>
   </div>   
  </div>
</main>