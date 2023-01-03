<?php 

session_start();

require_once("../Modelos/conexion.php");
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
	}


if (!empty($_POST)) {
	$alert = '';

	if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) ||empty($_POST['pass']) ||empty($_POST['rol'])) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{
				
		$iduser  = $_POST['id'];
		$nombre  = $_POST['nombre'];
		$correo  = $_POST['correo'];
		$usuario = $_POST['usuario'];
		$pass    = md5($_POST['pass']);
		$rol     = $_POST['rol'];

//echo "SELECT * FROM usuario 

		//WHERE(usuario = '$user' AND idusuario != $iduser) or (correo = '$email' AND idusuario != $iduser";
//exit; sirve para ejectuar la consulta en mysql

		$query = mysqli_query($conection,"SELECT * FROM usuarios WHERE
		 	(usuario = '$usuario' AND idusuario != $iduser) or (correo = '$correo' AND idusuario != $iduser) AND estatus = 1");

		$resultado = mysqli_fetch_array($query);
		if (is_countable($resultado)) {
			# es mejor usar una condicional que verifique la variable.Usar is_iterable()para PHP> = 7.1 o is_countable()para> = 7.3 en este escenario. Fragmento de arriba $resultado
		}

		if ($resultado > 0) {
			$alert = '<p class = "msg_error">El correo o Usuario ya existe</p>';

		}else{

			if ($_POST['pass']) {
				
				$sql_update = mysqli_query($conection,"UPDATE usuarios SET 
					 nombre = '$nombre',correo = '$correo', usuario = '$usuario',rol = '$rol', pass = '$pass'
					 WHERE idusuario = $iduser");
			}else{

				$sql_update = mysqli_query($conection,"UPDATE usuarios SET 
					 nombre = '$nombre',correo = '$correo', usuario = '$usuario',pass = '$pass', rol = '$rol'
					 WHERE idusuario = $iduser");
			}

			if ($sql_update) {
				$alert = '<p class = "alert alert-success">Usuario Actualizado</p>';
				
			}else{
				$alert = '<p class = "msg_error">Error al Actualizar el Usuario</p>';
			}
		}
	}

 }

//Recuperacion de datos para mostrar al seleccionar Actualizar

if (empty($_REQUEST['id'])) {
	header('location: ../Plantillas/usuarios.php');

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

}

$iduser = $_REQUEST['id'];

$sql = mysqli_query($conection,"SELECT * FROM usuarios  WHERE idusuario = $iduser AND estatus = 1");   

//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php


$resultado = mysqli_num_rows($sql);

if ($resultado == 0) {
	header("location: ../Plantillas/usuarios.php");
}else{
	$option = '';
	while ($data = mysqli_fetch_array($sql)) {
		
		$iduser   = $data['idusuario'];
		$nombre   = $data['nombre'];
		$correo   = $data['correo'];
		$usuario  = $data['usuario'];
		$pass     =md5($data['pass']);
		$rol      = $data['rol'];

		if ($rol == 1) {
			$option = '<option value="'.$rol.'" select>'.$rol.'</option>';
		}else if ($rol == 2) {
			$option = '<option value="'.$rol.'" select>'.$rol.'</option>';
		}else if ($rol == 3) {
			$option = '<option value="'.$rol.'" select>'.$rol.'</option>';
		}else if ($rol == 4) {
			$option = '<option value="'.$rol.'" select>'.$rol.'</option>';
		}
	}
}

require_once("../body/header_admin.php");
?>
<main class="app-content">

      <div class="row" style="justify-content: center;">
        <div class="col-md-5">
          <div class="tile">
            <h3 class="tile-title">Modificar de Usuario</h3>
            <div class="tile-body">
              <form action="" method="POST">
                  <input type="hidden" name="id" id="id" value="<?php echo $iduser; ?>">
                <div class="form-group">
                  <input class="form-control" type="hidden" name="" id="" placeholder="Ingrese el nombre" 
                   value="<?php echo $nombre; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label"> Nombre</label>
                  <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Ingrese el nombre" required
                  value="<?php echo $nombre; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Correo</label>
                  <input class="form-control" type="email" name="correo" id="correo" placeholder="Ingrese el Nro de Vehiculo" required
                  value="<?php echo $correo; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Usuario</label>
                  <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Ingrese el usuario" required 
                  value="<?php echo $usuario; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Contraseña</label>
                  <input class="form-control" type="password" name="pass" id="pass" placeholder="Ingrese la contraseña" required
                  value="<?php echo $pass; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Sector</label>
                  <select class="form-control" id="rol" name="rol" required>
                   <?php if ($_SESSION['rol'] == 1) {?>
                    <option value="1">Administrador</option>
                   <?php } ?>
                   <option value="2">Administrador</option>
                   <option value="9">Recepcionista</option>
                   <option value="3">Doctor</option>
                   <option value="4">Paciente</option>
                   <
                 </select>
                </div>
                                  
                 <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Plantillas/usuarios.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
              
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