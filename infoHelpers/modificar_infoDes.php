<?php
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
	}

include "../Modelos/conexion.php";

if (!empty($_POST)) {
	$alert = '';

	if (empty( $_POST['modelo']) || empty($_POST['nro_partida']) || empty($_POST['plan_diario']) ||empty($_POST['total_meta'])) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{
        
    $id_infoDes     = $_POST['id'];
		$modelo         = $_POST['modelo'];
		$nro_partida    = $_POST['nro_partida'];
		$plan_diario    = $_POST['plan_diario'];
		$atraso         = $_POST['atraso'];
		$total_meta     = $_POST['total_meta'];
    $cantidad       = $_POST['cantidad'];
		$diferencia     = $_POST['diferencia'];
		$observacion    = $_POST['observacion'];
		


		$sql_update = mysqli_query($conection,"UPDATE infodesembalado SET modelo = '$modelo',nro_partida = '$nro_partida', plan_diario = '$plan_diario',atraso = '$atraso',
        total_meta = '$total_meta',cantidad = '$cantidad',diferencia = '$diferencia',observacion = '$observacion', estatus = 1
			WHERE id_infoDes = $id_infoDes");

		if ($sql_update) {

			header('location: ../Informes/informeDesembalado.php');

		}else{
			$alert = '<p class = "msg_error">Error al Actualizar el Registro</p>';
		}
    }    
}

//Recuperacion de datos para mostrar al seleccionar Actualizar

if (empty($_REQUEST['id'])) {
	header('location: ../Informes/informeDesembalado.php');

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

}

$id_infoDes = $_REQUEST['id'];

$sql = mysqli_query($conection,"SELECT * FROM infodesembalado WHERE id_infoDes = $id_infoDes AND estatus= 1");

//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php


$resultado = mysqli_num_rows($sql);

if ($resultado == 0) {
	header("location:../Informes/informeDesembalado.php");
}else{

	while ($data = mysqli_fetch_array($sql)) {
 
		$modelo         = $data['modelo'];
		$nro_partida    = $data['nro_partida'];
		$plan_diario    = $data['plan_diario'];
		$atraso         = $data['atraso'];
		$total_meta     = $data['total_meta'];
    $cantidad       = $data['cantidad'];
		$diferencia     = $data['diferencia'];
		$observacion    = $data['observacion'];
		
		

	}
}

require_once("../body/header_admin.php");
?>
<main class="app-content">

      <div class="row" style="justify-content: center;">
        <div class="col-md-5">
          <div class="tile">
            <h3 class="tile-title">Modificar de Probado</h3>
            <div class="tile-body">
              <form action="" method="POST">
                  <input type="hidden" id="id" name="id" value="<?php echo $id_infoDes;?>">
                <div class="form-group">
                  <label class="control-label">Modelo</label>
                  <input class="form-control" type="text" name="modelo" id="modelo" placeholder="Ingrese el Modelo" 
                  value="<?php echo $modelo;?>"  required autofocus>
                </div>
                <div class="form-group">
                  <label class="control-label">Nro de Partida</label>
                  <input class="form-control" type="text" name="nro_partida" id="nro_partida" placeholder="Ingrese el Nro de Partida" 
                  value="<?php echo $modelo;?>" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Plan del Dia</label>
                  <input class="form-control" type="number" name="plan_diario" id="plan_diario" placeholder="Ingrese la Cantidad"
                  value="<?php echo $plan_diario;?>" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Atraso/Adelantamiento</label>
                  <input class="form-control" type="number" name="atraso" id="atraso" placeholder="Ingrese la Cantidad"
                  value="<?php echo $atraso;?>" >
                </div>
                 <div class="form-group">
                  <label class="control-label">Total a Desembalar</label>
                  <input class="form-control" type="number" name="total_meta" id="total_meta" placeholder="Ingrese la Cantidad"
                  value="<?php echo $total_meta;?>" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Cantidad Desembalada</label>
                  <input class="form-control" type="number" name="cantidad" id="cantidad" placeholder="Ingrese la Cantidad"
                  value="<?php echo $cantidad;?>" required>
                </div>
                 <div class="form-group">
                  <label class="control-label">Diferencia</label>
                  <input class="form-control" type="number" name="diferencia" id="diferencia" placeholder="Ingrese la Cantidad" 
                  value="<?php echo $diferencia;?>">
                </div>
                 <div class="form-group">
                  <label class="control-label">Observacion</label>
                  <textarea class="form-control" rows="4" name="observacion" id="observacion" 
                   placeholder="Ingrese la Observacion" required><?php echo $observacion; ?></textarea>
                </div>
                 <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Informes/informeDesembalado.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
              
            </div>
              </form>
              <br>
              <?php if(isset($alert)) {?>
               <div class="alert alert-info"><?php echo  $alert; ?></div>
               <?php } ?>
            </div>
            
          </div>
        </div>
      </div>
    </main>