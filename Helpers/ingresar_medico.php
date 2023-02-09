<?php
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
	}

include "../Modelos/conexion.php";

if (!empty($_POST)) {
	$alert = '';

	if (empty( $_POST['usuario']) || empty($_POST['pass'])) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{

		$id        = $_POST['id'];
		$usuario   = md5($_POST['usuario']);
		$pass      = $_POST['pass'];
		
		
		


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

		$sql_update = mysqli_query($conection,"UPDATE medicos SET rol = '$rol',usuario = '$usuario', pass = '$pass'
			WHERE id = $id");

		if ($sql_update) {

			$alert = '<p class = "msg_success">Registrado Correctamente</p>';

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

$sql = mysqli_query($conection,"SELECT * FROM medicos  WHERE id = $id");

//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php


$resultado = mysqli_num_rows($sql);

if ($resultado == 0) {
	header("location:../Plantillas/medicos.php");
}else{

	while ($data = mysqli_fetch_array($sql)) {

		$id        = $data['id'];
		$usuario   = $data['usuario'];
		$pass      = $data['pass'];
		$rol       = $data['rol'];




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
                  <input type="hidden" name="id" id="id" value="<?php echo $_REQUEST['id']; ?>">
        
                <div class="form-group">
                  <label class="control-label">Usuario</label>
                  <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Ingrese el usuario" required
                  value="<?php echo $usuario; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Contraseña</label>
                  <input class="form-control" type="text" name="pass" id="pass" placeholder="Ingrese el pass" required 
                  value="<?php echo $pass; ?>">
                </div>
    
                <div class="form-group">
                  <label class="control-label">Rol del Medico</label>
                  <select name="rol" id="rol" class="form-control">
                    <option value="4">Medico</option>
                  </select>
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