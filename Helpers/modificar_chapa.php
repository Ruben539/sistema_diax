<?php
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
	}

require_once("../Modelos/conexion.php");

if (!empty($_POST)) {
	$alert = '';

	if (empty( $_POST['desde']) || empty($_POST['hasta']) || empty($_POST['serie'])) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{

		$id_chapa            = $_POST['id'];
		$serie               = $_POST['serie'];
		$desde               = $_POST['desde'];
		$hasta               = $_POST['hasta'];
		$observacion         = $_POST['observacion'];
		
		


//echo "SELECT * FROM usuario

		//WHERE(usuario = '$user' AND idusuario != $iduser) or (correo = '$email' AND idusuario != $iduser";
//exit; sirve para ejectuar la consulta en mysql
		$query = mysqli_query($conection,"SELECT * FROM chapas
			WHERE  id_chapa != id_chapa"
		);

		$resultado = mysqli_fetch_array($query);


	}

	if ($resultado > 0) {
		$alert = '<p class = "msg_error">El Registro ya existe,ingrese otro</p>';

	}else{

		$sql_update = mysqli_query($conection,"UPDATE chapas SET serie = '$serie',desde = '$desde', hasta = '$hasta',observacion = '$observacion', estatus = 1
			WHERE id_chapa = $id_chapa");

		if ($sql_update) {

			header('location: ../Plantillas/chapas.php');

		}else{
			$alert = '<p class = "msg_error">Error al Actualizar el Registro</p>';
		}
	}
}

//Recuperacion de datos para mostrar al seleccionar Actualizar

if (empty($_REQUEST['id'])) {
	header('location: ../Plantillas/chapas.php');

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

}

$id_chapa = $_REQUEST['id'];

$sql = mysqli_query($conection,"SELECT * FROM chapas WHERE id_chapa = $id_chapa AND estatus= 1");

//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php


$resultado = mysqli_num_rows($sql);

if ($resultado == 0) {
	header("location:../Plantillas/chapas.php");
}else{

	while ($data = mysqli_fetch_array($sql)) {
 
		$id_chapas       = $data['id_chapa'];
		$serie           = $data['serie'];
		$desde           = $data['desde'];
		$hasta           = $data['hasta'];
		$observacion     = $data['observacion'];
		
		

	}
}

require_once("../body/header_admin.php");
?>
<main class="app-content">

      <div class="row" style="justify-content: center;">
        <div class="col-md-5">
          <div class="tile">
            <h3 class="tile-title">Registro de Chapas</h3>
            <div class="tile-body">
              <form action="" method="POST">
                  <input type="hidden" name="id" id="id" value="<?php echo $id_chapa; ?>">
                <div class="form-group">
                  <input class="form-control" type="hidden" name="" id="" placeholder="Ingrese el serie" 
                   value="<?php echo $serie; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label"> Serie</label>
                  <input class="form-control" type="text" name="serie" id="serie" placeholder="Ingrese la Serie" required
                  value="<?php echo $serie; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Desde</label>
                  <input class="form-control" type="text" name="desde" id="desde" placeholder="Ingrese el Numero" required
                  value="<?php echo $desde; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Hasta</label>
                  <input class="form-control" type="text" name="hasta" id="hasta" placeholder="Ingrese el Numero" required 
                  value="<?php echo $hasta; ?>">
                </div>
                
                <div class="form-group">
                  <label class="control-label">Observación</label>
                  <textarea class="form-control" rows="4" name="observacion" id="observacion" 
                   placeholder="Ingrese la Falla Detectada" required><?php echo $observacion; ?></textarea>
                </div>
                                  
                 <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Plantillas/chapas.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
              
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