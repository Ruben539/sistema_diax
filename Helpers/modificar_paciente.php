<?php
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
	}

include "../Modelos/conexion.php";

if (!empty($_POST)) {
	$alert = '';

	if (empty( $_POST['Nombre']) || empty($_POST['Apellido']) || empty($_POST['Sexo']) ||empty($_POST['Cedula'])) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{

		$id            = $_POST['id'];
		$Cedula        = $_POST['Cedula'];
		$Nombre        = $_POST['Nombre'];
		$Apellido      = $_POST['Apellido'];
		$Celular       = $_POST['Celular'];
		$Sexo          = $_POST['Sexo'];
		$Nacimiento    = $_POST['Nacimiento'];
		$FechaIngreso  = $_POST['FechaIngreso'];
		


//echo "SELECT * FROM usuario

		//WHERE(usuario = '$user' AND idusuario != $iduser) or (correo = '$email' AND idusuario != $iduser";
//exit; sirve para ejectuar la consulta en mysql
		$query = mysqli_query($conection,"SELECT * FROM clientes
			WHERE  id != id"
		);

		$resultado = mysqli_fetch_array($query);


	}

	if ($resultado > 0) {
		$alert = '<p class = "msg_error">El Registro ya existe,ingrese otro</p>';

	}else{

		$sql_update = mysqli_query($conection,"UPDATE clientes SET Cedula = '$Cedula',Nombre = '$Nombre', Apellido = '$Apellido',Celular = '$Celular',Sexo = '$Sexo',Nacimiento = '$Nacimiento',FechaIngreso = '$FechaIngreso', estatus = 1
			WHERE id = $id");

		if ($sql_update) {

			$alert = '<p class = "msg_success">Actualizado Correctamente</p>';

		}else{
			$alert = '<p class = "msg_error">Error al Actualizar el Registro</p>';
		}
	}
}

//Recuperacion de datos para mostrar al seleccionar Actualizar

if (empty($_REQUEST['id'])) {
	header('location: ../Plantillas/pacientes.php');

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

}

$id = $_REQUEST['id'];

$sql = mysqli_query($conection,"SELECT * FROM clientes  WHERE id = $id ");

//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php


$resultado = mysqli_num_rows($sql);

if ($resultado == 0) {
	header("location:../Plantillas/pacientes.php");
}else{

	while ($data = mysqli_fetch_array($sql)) {

		$id            = $data['id'];
		$Cedula        = $data['Cedula'];
		$Nombre        = $data['Nombre'];
		$Apellido      = $data['Apellido'];
		$Celular       = $data['Celular'];
		$Sexo          = $data['Sexo'];
    $Nacimiento    = $data['Nacimiento'];
		$FechaIngreso  = $data['FechaIngreso'];
		

	}
}

require_once("../body/header_admin.php");
?>
<main class="app-content">

      <div class="row" style="justify-content: center;">
        <div class="col-md-5">
          <div class="tile">
            <h3 class="tile-title">Actualizar Paciente</h3>
            <div class="tile-body">
              <form action="" method="POST">
                  <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                <div class="form-group">
                  <input class="form-control" type="hidden" name="" id="" placeholder="Ingrese la Cedula" 
                   value="<?php echo $Cedula; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label"> Cedula</label>
                  <input class="form-control" type="text" name="Cedula" id="Cedula" placeholder="Ingrese el Cedula" required
                  value="<?php echo $Cedula; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Nombre</label>
                  <input class="form-control" type="text" name="Nombre" id="Nombre" placeholder="Ingrese el Nro de Vehiculo" required
                  value="<?php echo $Nombre; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Apellido</label>
                  <input class="form-control" type="text" name="Apellido" id="Apellido" placeholder="Ingrese el Apellido" required 
                  value="<?php echo $Apellido; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Sexo</label>
                  <input class="form-control" type="text" name="Sexo" id="Sexo" placeholder="Ingrese el Sexo" required
                  value="<?php echo $Sexo; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Telefono</label>
                  <input class="form-control" type="text" name="Celular" id="Celular" placeholder="Ingrese la Celular" required
                  value="<?php echo $Celular; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Fecha de Nacimiento</label>
                  <input class="form-control" type="text" name="Nacimiento" id="Nacimiento" placeholder="Ingrese la Nacimiento" required
                  value="<?php echo $Nacimiento; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Fecha de Ingreso</label>
                  <input class="form-control" type="text" name="FechaIngreso" id="FechaIngreso" placeholder="Ingrese la Fecha de Ingreso" required
                  value="<?php echo $FechaIngreso; ?>">
                </div>
                                  
                 <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar
            </button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Plantillas/pacientes.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
              
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