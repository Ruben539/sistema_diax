<?php
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
	}

include "../Modelos/conexion.php";

if (!empty($_POST)) {
	$alert = '';

	if (empty( $_POST['nro_partida']) || empty($_POST['pieza']) || empty($_POST['observacion']) ||empty($_POST['modelo'])) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{

		$id_reclamo      = $_POST['id'];
		$modelo          = $_POST['modelo'];
		$nro_partida     = $_POST['nro_partida'];
		$pieza           = $_POST['pieza'];
		$cantidad        = $_POST['cantidad'];
		$observacion     = $_POST['observacion'];
		


//echo "SELECT * FROM usuario

		//WHERE(usuario = '$user' AND idusuario != $iduser) or (correo = '$email' AND idusuario != $iduser";
//exit; sirve para ejectuar la consulta en mysql
		$query = mysqli_query($conection,"SELECT * FROM reclamos
			WHERE  id_reclamo != id_reclamo"
		);

		$resultado = mysqli_fetch_array($query);


	}

	if ($resultado > 0) {
		$alert = '<p class = "msg_error">El Registro ya existe,ingrese otro</p>';

	}else{

		$sql_update = mysqli_query($conection,"UPDATE reclamos SET modelo = '$modelo',nro_partida = '$nro_partida', pieza = '$pieza',cantidad = '$cantidad',observacion = '$observacion', estatus = 1
			WHERE id_reclamo = $id_reclamo");

		if ($sql_update) {

			header('location: ../Plantillas/garantia.php');

		}else{
			$alert = '<p class = "msg_error">Error al Actualizar el Registro</p>';
		}
	}
}

//Recuperacion de datos para mostrar al seleccionar Actualizar

if (empty($_REQUEST['id'])) {
	header('location: ../Plantillas/garantia.php');

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

}

$id_reclamo = $_REQUEST['id'];

$sql = mysqli_query($conection,"SELECT * FROM reclamos WHERE id_reclamo = $id_reclamo AND estatus= 1");

//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php


$resultado = mysqli_num_rows($sql);

if ($resultado == 0) {
	header("location:../Plantillas/reclamos.php");
}else{

	while ($data = mysqli_fetch_array($sql)) {
 
		$id_reclamo         = $data['id_reclamo'];
		$modelo             = $data['modelo'];
		$nro_partida        = $data['nro_partida'];
		$pieza              = $data['pieza'];
		$cantidad           = $data['cantidad'];
        $destino            = $data['destino'];
		$observacion        = $data['observacion'];
		

	}
}

require_once("../body/header_admin.php");
?>
<main class="app-content">

      <div class="row" style="justify-content: center;">
        <div class="col-md-5">
          <div class="tile">
            <h3 class="tile-title">Registro de Reclamos</h3>
            <div class="tile-body">
              <form action="" method="POST">
                  <input type="hidden" name="id" id="id" value="<?php echo $id_reclamo; ?>">
                <div class="form-group">
                  <input class="form-control" type="hidden" name="" id="" placeholder="Ingrese el Modelo" 
                   value="<?php echo $modelo; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label"> Modelo</label>
                  <input class="form-control" type="text" name="modelo" id="modelo" placeholder="Ingrese el Modelo" required
                  value="<?php echo $modelo; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Nro de Vehiculo</label>
                  <input class="form-control" type="text" name="nro_partida" id="nro_partida" placeholder="Ingrese el Nro de Vehiculo" required
                  value="<?php echo $nro_partida; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Pieza</label>
                  <input class="form-control" type="text" name="pieza" id="pieza" placeholder="Ingrese el pieza" required 
                  value="<?php echo $pieza; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Cantidad</label>
                  <input class="form-control" type="text" name="cantidad" id="cantidad" placeholder="Ingrese la Cantidad" required
                  value="<?php echo $cantidad; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Destino</label>
                  <input class="form-control" type="text" name="destino" id="destino" placeholder="Ingrese el Destino" required
                  value="<?php echo $destino; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Observacion del Pedido</label>
                  <textarea class="form-control" rows="4" name="observacion" id="observacion" 
                   placeholder="Ingrese la Falla Detectada" required><?php echo $observacion; ?></textarea>
                </div>
                                  
                 <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Plantillas/reclamos.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
              
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