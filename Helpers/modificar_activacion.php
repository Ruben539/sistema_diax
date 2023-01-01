<?php
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
	}

include "../Modelos/conexion.php";

if (!empty($_POST)) {
	$alert = '';

	if (empty( $_POST['nro_vehiculo']) || empty($_POST['color']) || empty($_POST['nro_chapa']) ||empty($_POST['modelo'])) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{

		$id_activacion       = $_POST['id'];
		$modelo              = $_POST['modelo'];
		$nro_vehiculo        = $_POST['nro_vehiculo'];
		$color               = $_POST['color'];
		$nro_chapa           = $_POST['nro_chapa'];
		$observacion         = $_POST['observacion'];
    $combu               = $_POST['combu'];
		


//echo "SELECT * FROM usuario

		//WHERE(usuario = '$user' AND idusuario != $iduser) or (correo = '$email' AND idusuario != $iduser";
//exit; sirve para ejectuar la consulta en mysql
		$query = mysqli_query($conection,"SELECT * FROM cinta
			WHERE  id_cinta != id_cinta"
		);

		$resultado = mysqli_fetch_array($query);


	}

	if ($resultado > 0) {
		$alert = '<p class = "msg_error">El Registro ya existe,ingrese otro</p>';

	}else{

		$sql_update = mysqli_query($conection,"UPDATE activaciones SET modelo = '$modelo',nro_vehiculo = '$nro_vehiculo', color = '$color',nro_chapa = '$nro_chapa',observacion = '$observacion',combu = '$combu', estatus = 1
			WHERE id_activacion = $id_activacion");

		if ($sql_update) {

			header('location: ../Plantillas/activaciones.php');

		}else{
			$alert = '<p class = "msg_error">uError al Actualizar el Registro</p>';
		}
	}
}

//Recuperacion de datos para mostrar al seleccionar Actualizar

if (empty($_REQUEST['id'])) {
	header('location: ../Plantillas/activaciones.php');

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

}

$id_activacion = $_REQUEST['id'];

$sql = mysqli_query($conection,"SELECT * FROM activaciones WHERE id_activacion = $id_activacion AND estatus= 1");

//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php


$resultado = mysqli_num_rows($sql);

if ($resultado == 0) {
	header("location:../Plantillas/activaciones.php");
}else{

	while ($data = mysqli_fetch_array($sql)) {
 
		$id_activacion          = $data['id_activacion'];
		$modelo                 = $data['modelo'];
		$nro_vehiculo           = $data['nro_vehiculo'];
		$color                  = $data['color'];
		$nro_chapa              = $data['nro_chapa'];
		$observacion            = $data['observacion'];
    $combu                  = $data['combu'];
		

	}
}

require_once("../body/header_admin.php");
?>
<main class="app-content">

      <div class="row" style="justify-content: center;">
        <div class="col-md-5">
          <div class="tile">
            <h3 class="tile-title">Registro de Activacion</h3>
            <div class="tile-body">
              <form action="" method="POST">
                  <input type="hidden" name="id" id="id" value="<?php echo $id_activacion; ?>">
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
                  <label class="control-label">Nro de Chapa</label>
                  <input class="form-control" type="text" name="nro_chapa" id="nro_chapa" placeholder="Ingrese la Chapa" required
                  value="<?php echo $nro_chapa; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Falla Detectada</label>
                  <textarea class="form-control" rows="4" name="observacion" id="observacion" 
                   placeholder="Ingrese la Falla Detectada"><?php echo $observacion; ?></textarea>
                </div>
                 <div class="form-group">
                  <label class="control-label">Litros Utilizados</label>
                  <input class="form-control" type="number" name="combu" id="combu" placeholder="Ingrese la Cantidads" required
                  value="<?php echo $combu; ?>">
                </div>
                                  
                 <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Plantillas/activaciones.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
              
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