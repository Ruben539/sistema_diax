<?php 
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
	}

 //Codigo que se ejecuta cuando le damos Aceptar para eliminar

 include "../Modelos/conexion.php";
 if (!empty($_POST)) {
    $fecha = date('d-m-y H:i:s');
	$_POST['fecha_fin'] = $fecha;
	


$codproducto  = $_POST['codproducto'];
$fecha_fin    = $_POST['fecha_fin'];



$query_delete = mysqli_query($conection,"UPDATE producto SET   estatus = 1 WHERE codproducto = $codproducto ");
//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

if ($query_delete) {
	header('location: ../Plantillas/reclamos.php');
}else{
	echo "Error al Liberar";
}
}


	//Codigo que Verifica los campos a eliminar

if (!empty($_REQUEST['id'])) {
		
	$codproducto = $_REQUEST['id'];

	$query = mysqli_query($conection,"SELECT * FROM producto  WHERE codproducto = $codproducto AND estatus = 0");

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

	$resultado = mysqli_num_rows($query);

	if ( $resultado > 0) {
		
		while ($data = mysqli_fetch_array($query)) {
			$codproducto    = $data['codproducto'];
			$modelo         = $data['modelo'];
			$nro_partida    = $data['nro_partida'];
            $descripcion    = $data['descripcion'];
			$proveedor      = $data['proveedor'];
		}
	}else{
		header('location: ../Plantillas/reclamos_lib.php');
	}

}

require_once("../body/header_admin.php");
?>

<main class="app-content">
        <!-- Dialogs-->
    <div class="container">
    
    <div class="jumbotron">
	 <h1 class="text-center">Habilitar Reclamo N° <?php echo $codproducto; ?>?</h1>
	 <hr class="my-4">
      <h2 class="text-center"><?php echo $modelo?></h2>
      <h2 class="text-center">Nro Partida: <span class="badge badge-success"><?php echo $nro_partida;?></span></h2>    
      <h2 class="text-center">Descripcion: <span class="form-group"><?php echo $descripcion;?></span></h2> 
      <h2 class="text-center">Proveedor: <span class="form-group"><?php echo $proveedor;?></span></h2>   
      <p class="lead text-center">Sistema web de Control de la División Industrial.</p>
      <hr class="my-4">          

			<form method="POST" action="">
				<input type="hidden" name="codproducto" value="<?php echo $codproducto; ?>">
				<button class="btn btn-primary" type="submit" ><i class="fa fa-fw fa-lg fa-check-circle"></i>Si,Deseo</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" 
				href="../Plantillas/habilitar_reclamos.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>No,Cancelar</a>
			</form>
   </div>   
  </div>
</main>