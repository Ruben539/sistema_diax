<?php
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
	}

require_once("../Modelos/conexion.php");

if (!empty($_POST)) {
	$alert = '';

	if (empty( $_POST['puesto']) || empty($_POST['cantidad']) || empty($_POST['nombre'])) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{

		$id_funcionario      = $_POST['id'];
		$nombre              = $_POST['nombre'];
		$puesto              = $_POST['puesto'];
		$cantidad            = $_POST['cantidad'];
        
		
		


//echo "SELECT * FROM usuario

		//WHERE(usuario = '$user' AND idusuario != $iduser) or (correo = '$email' AND idusuario != $iduser";
//exit; sirve para ejectuar la consulta en mysql
		$query = mysqli_query($conection,"SELECT * FROM funcionarioruedas
			WHERE  id_funcionario != id_funcionario"
		);

		$resultado = mysqli_fetch_array($query);


	}

	if ($resultado > 0) {
		$alert = '<p class = "msg_error">El Registro ya existe,ingrese otro</p>';

	}else{

		$sql_update = mysqli_query($conection,"UPDATE funcionarioruedas SET nombre = '$nombre',puesto = '$puesto', cantidad = '$cantidad', estatus = 1
			WHERE id_funcionario = $id_funcionario");

		if ($sql_update) {

			header('location: ../Informes/info_Funcionario.php');

		}else{
			$alert = '<p class = "msg_error">Error al Actualizar el Registro</p>';
		}
	}
}

//Recuperacion de datos para mostrar al seleccionar Actualizar

if (empty($_REQUEST['id'])) {
	header('location: ../Informes/info_Funcionario.php');

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

}

$id_funcionario = $_REQUEST['id'];

$sql = mysqli_query($conection,"SELECT * FROM funcionarioruedas WHERE id_funcionario = $id_funcionario AND estatus= 1");

//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php


$resultado = mysqli_num_rows($sql);

if ($resultado == 0) {
	header("location:../Informes/info_Funcionario.php");
}else{

	while ($data = mysqli_fetch_array($sql)) {
 
		$id_funcionario   = $data['id_funcionario'];
		$nombre           = $data['nombre'];
		$puesto           = $data['puesto'];
		$cantidad         = $data['cantidad'];
		   
		
		

	}
}

require_once("../body/header_admin.php");
?>
<main class="app-content">

      <div class="row" style="justify-content: center;">
        <div class="col-md-5">
          <div class="tile">
            <h3 class="tile-title text-center">Modificar Registro</h3>
            <div class="tile-body">
              <form action="" method="POST">
                  <input type="hidden" name="id" id="id" value="<?php echo $id_funcionario; ?>">
                <div class="form-group">
                  <input class="form-control" type="hidden" name="" id="" placeholder="Ingrese el nombre" 
                   value="<?php echo $nombre; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label"> nombre</label>
                  <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Ingrese la nombre" required
                  value="<?php echo $nombre; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">puesto</label>
                  <input class="form-control" type="text" name="puesto" id="puesto" placeholder="Ingrese el Numero" required
                  value="<?php echo $puesto; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">cantidad</label>
                  <input class="form-control" type="text" name="cantidad" id="cantidad" placeholder="Ingrese el Numero" required 
                  value="<?php echo $cantidad; ?>">
                </div>
                                   
                 <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Informes/info_Funcionario.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
              
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