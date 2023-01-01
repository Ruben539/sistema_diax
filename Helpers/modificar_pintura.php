<?php
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
	}

include "../Modelos/conexion.php";

if (!empty($_POST)) {
	$alert = '';

	if (empty( $_POST['nro_vehiculo']) || empty($_POST['color']) || empty($_POST['falla_detectada']) ||empty($_POST['modelo'])) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{

		$id_pintura         = $_POST['id'];
		$modelo              = $_POST['modelo'];
		$nro_vehiculo        = $_POST['nro_vehiculo'];
		$color               = $_POST['color'];
		$pieza               = $_POST['pieza'];
		$falla_detectada     = $_POST['falla_detectada'];
		


//echo "SELECT * FROM usuario

		//WHERE(usuario = '$user' AND idusuario != $iduser) or (correo = '$email' AND idusuario != $iduser";
//exit; sirve para ejectuar la consulta en mysql
		$query = mysqli_query($conection,"SELECT * FROM pintura
			WHERE  id_pintura != id_pintura"
		);

		$resultado = mysqli_fetch_array($query);


	}

	if ($resultado > 0) {
		$alert = '<p class = "msg_error">El Registro ya existe,ingrese otro</p>';

	}else{

		$sql_update = mysqli_query($conection,"UPDATE pintura SET modelo = '$modelo',nro_vehiculo = '$nro_vehiculo', color = '$color',pieza = '$pieza',falla_detectada = '$falla_detectada', estatus = 1
			WHERE id_pintura = $id_pintura");

		if ($sql_update) {

			header('location: ../Plantillas/pintura.php');

		}else{
			$alert = '<p class = "msg_error">Error al Actualizar el Registro</p>';
		}
	}
}

//Recuperacion de datos para mostrar al seleccionar Actualizar

if (empty($_REQUEST['id'])) {
	header('location: ../Plantillas/pintura.php');

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

}

$id_pintura = $_REQUEST['id'];

$sql = mysqli_query($conection,"SELECT * FROM pintura WHERE id_pintura = $id_pintura AND estatus= 1");

//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php


$resultado = mysqli_num_rows($sql);

if ($resultado == 0) {
	header("location:../Plantillas/pintura.php");
}else{

	while ($data = mysqli_fetch_array($sql)) {

		$id_pintura            = $data['id_pintura'];
		$modelo                 = $data['modelo'];
		$nro_vehiculo           = $data['nro_vehiculo'];
		$color                  = $data['color'];
		$pieza                  = $data['pieza'];
		$falla_detectada        = $data['falla_detectada'];
		

	}
}

require_once("../body/header_admin.php");
?>
<main class="app-content">

      <div class="row" style="justify-content: center;">
        <div class="col-md-5">
          <div class="tile">
            <h3 class="tile-title">Registro de Pintura</h3>
            <div class="tile-body">
              <form action="" method="POST">
                  <input type="hidden" name="id" id="id" value="<?php echo $id_pintura; ?>">
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
                  <input class="form-control" type="text" name="nro_vehiculo" id="nro_vehiculo" placeholder="Ingrese el Nro de Vehiculo" required
                  value="<?php echo $nro_vehiculo; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Color</label>
                  <input class="form-control" type="text" name="color" id="color" placeholder="Ingrese el Color" required 
                  value="<?php echo $color; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Pieza</label>
                  <input class="form-control" type="text" name="pieza" id="pieza" placeholder="Ingrese la Pieza" required
                  value="<?php echo $pieza; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Falla Detectada</label>
                  <textarea class="form-control" rows="4" name="falla_detectada" id="falla_detectada" 
                   placeholder="Ingrese la Falla Detectada" required><?php echo $falla_detectada; ?></textarea>
                </div>
                                  
                 <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Plantillas/pintura.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
              
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