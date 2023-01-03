<?php
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
	}

include "../Modelos/conexion.php";

if (!empty($_POST)) {
	$alert = '';

	if (empty( $_POST['Nombre']) || empty($_POST['Especialidad'])) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{

		$id                = $_POST['id'];
		$Nombre            = $_POST['Nombre'];
		$Especialidad      = $_POST['Especialidad'];
		$Hora              = $_POST['Hora'];
		$Dia               = $_POST['Dia'];
		$Tcobro            = $_POST['Tcobro'];
		
		


//echo "SELECT * FROM usuario

		//WHERE(usuario = '$user' AND idusuario != $iduser) or (correo = '$email' AND idusuario != $iduser";
//exit; sirve para ejectuar la consulta en mysql
		$query = mysqli_query($conection,"SELECT * FROM medicos
			WHERE  id != id"
		);

		$resultado = mysqli_fetch_array($query);


	}

	if ($resultado > 0) {
		$alert = '<p class = "msg_error">El Registro ya existe,ingrese otro</p>';

	}else{

		$sql_update = mysqli_query($conection,"UPDATE medicos SET Hora = '$Hora',Nombre = '$Nombre', Especialidad = '$Especialidad',Dia = '$Dia',Tcobro = '$Tcobro'
			WHERE id = $id");

		if ($sql_update) {

			header('location: ../Plantillas/medicos.php');

		}else{
			$alert = '<p class = "msg_error">Error al Actualizar el Registro</p>';
		}
	}
}

//Recuperacion de datos para mostrar al seleccionar Actualizar

if (empty($_REQUEST['id'])) {
	header('location: ../Plantillas/medicos.php');

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

}

$id = $_REQUEST['id'];

$sql = mysqli_query($conection,"SELECT * FROM medicos m WHERE id = $id");

//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php


$resultado = mysqli_num_rows($sql);

if ($resultado == 0) {
	header("location:../Plantillas/medicos.php");
}else{

	while ($data = mysqli_fetch_array($sql)) {

		$id             = $data['id'];
		$Nombre         = $data['Nombre'];
		$Especialidad   = $data['Especialidad'];
		$Dia            = $data['Dia'];
		$Hora           = $data['Hora'];
		$Tcobro         = $data['Tcobro'];
       
		

	}
}

require_once("../body/header_admin.php");
?>
<main class="app-content">

      <div class="row" style="justify-content: center;">
        <div class="col-md-5">
          <div class="tile">
            <h3 class="tile-title">Actualizar Medico</h3>
            <div class="tile-body">
              <form action="" method="POST">
                  <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
        
                <div class="form-group">
                  <label class="control-label">Nombre</label>
                  <input class="form-control" type="text" name="Nombre" id="Nombre" placeholder="Ingrese el Nro de Vehiculo" required
                  value="<?php echo $Nombre; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Especialidad</label>
                  <input class="form-control" type="text" name="Especialidad" id="Especialidad" placeholder="Ingrese el Especialidad" required 
                  value="<?php echo $Especialidad; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Dia</label>
                  <input class="form-control" type="text" name="Dia" id="Dia" placeholder="Ingrese el Dia" 
                  value="<?php echo $Dia; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Hora</label>
                  <input class="form-control" type="text" name="Hora" id="Hora" placeholder="Ingrese la Hora" 
                  value="<?php echo $Hora; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Cantidad de Cobro</label>
                  <input class="form-control" type="text" name="Tcobro" id="Tcobro" placeholder="Ingrese la Tcobro" 
                  value="<?php echo $Tcobro; ?>">
                </div>
                                  
                 <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar
            </button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Plantillas/medicos.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
              
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