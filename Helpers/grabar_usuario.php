<?php
session_start();
if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2){
    if (empty($_SESSION['active'])) {
    header('location: ../Plantillas/salir.php');
}
require_once("../Modelos/conexion.php");
$alert = '';

//print_r($_POST);
//print_r($_FILES);
//exit;
if (!empty($_POST)) {
    if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['usuario']) || empty($_POST['pass']) ||empty($_POST['rol'])) {

        $alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

        }else{

            
            $nombre   = $_POST['nombre'];
            $correo   = $_POST['correo'];
            $usuario  = $_POST['usuario'];
            $pass     = md5($_POST['pass']);
            $rol      = $_POST['rol'];
            $puesto   = $_POST['puesto'];

            $foto = $_FILES['foto'] ['name'];
            $nombrefoto = $_FILES['foto'] ['name'];
            $tipo = $_FILES['foto'] ['type'] ;
            $url_temp = $_FILES['foto'] ['tmp_name'];


            $imgProducto = 'user.png';

            if ($nombrefoto != '') {

                $destino ='../images/usuarios/';

            $img_nombre   = 'image_'.md5(date('d-m Y H-m-s'));#Estamos encriptando la fecha y hora para el nombre de la foto 
            $imgProducto  = $img_nombre.'.jpg';
            $scr          =  $destino.$imgProducto;     
            
        }

        /*$query = mysqli_query($conexion,"SELECT * FROM usuario WHERE usuario = '$usuario' or correo = '$correo'");

        $resultado = mysqli_fetch_array($query);

        if ($resultado > 0) {
            $alert = '<p class = "msg_error">El correo o Usuario ya existe</p>';
        }else{*/

            $query_insert = mysqli_query($conection,"INSERT INTO usuario(nombre,correo,usuario,pass,rol,puesto,foto)
                VALUES('$nombre','$correo','$usuario','$pass','$rol','$puesto','$imgProducto')");
            if ($query_insert ) {
               if ($nombrefoto != '') {
                    move_uploaded_file($url_temp, $scr);
                }
                
                header('location: ../Plantillas/usuarios.php');

            }else{
              
             $alert = 'Error al Grabar'; 
         }

       }
    }
}
require_once("../body/header_admin.php");
?>

<main class="app-content">

  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
      </div>
      <div class="modal-body">
 
		<form action="" method="POST" enctype="multipart/form-data">
       <div  class="formulario" id="formulario">
           	<!--Grupo de Formulario del Modelo-->
		<div class="form-group">
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Nombre</span></div>
          	<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese el Nombre" require autofocus>
        </div>
		</div>


      	<!--Grupo de Formulario del Modelo-->
          <div class="form-group">
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Correo</span></div>
          	<input type="email" class="form-control" name="correo" id="correo" placeholder="Ingrese el Correo" require >
        </div>
		</div>
			<!--Grupo de Formulario del Modelo-->
            <div class="form-group">
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Usuario</span></div>
          	<input type="text" class="form-control" name="usuario" id="usuario" placeholder="Ingrese el Usuario" require >
        </div>
		</div>

		<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group">
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Contraseña</span></div>
          	<input type="password" class="form-control" name="pass" id="pass" placeholder="Ingrese la Contraseña" require >
        </div>
		</div>
  
		<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Sector</span></div>
         <select class="form-control" id="rol" name="rol" required>
            <?php if ($_SESSION['rol'] == 1) {?>
             <option value="1">Administrador</option>
            <?php } ?>
            <option value="2">Supervisor</option>
            <option value="9">Desembalado</option>
            <option value="3">Herreria</option>
            <option value="4">Pintura</option>
            <option value="5">Ruedas</option>
            <option value="10">Pre-Cinta</option>
            <option value="6">Cinta</option>
            <option value="7">Probado</option>
            <option value="8">Cuatro Ruedas</option>
            <option value="11">Verificador</option>
        </select>
        </div>
	    </div>

        <div class="form-group">
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Puesto</span></div>
          	<input type="text" class="form-control" name="puesto" id="puesto" placeholder="Ingrese el Puesto" require>
        </div>
		</div>
</div>
    	<!--Grupo de Formulario de Puesto 1-->
    
        <div class="container-fluid  text-center">
            <div class="photo" >
              <label for="foto">Foto</label>
              <div class="prevPhoto">
                <span class="delPhoto notBlock">X</span>
                <label for="foto"></label>
            </div>
            <div class="upimg">
                <input type="file" name="foto" id="foto"  class="input-48">
            </div>
            <div id="form_alert"></div>
        </div>
            </div>
		
  <br>
		<div class="tile-footer text-center">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Plantillas/usuarios.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
          </div>
		</form>
      <br>
      <?php if($alert != ""){  ?>
    <div style="color:#ccc;"><?php echo $alert; ?></div>
      <?php } ?> 
            </div>
      </div>
    </div>
  </div>
</div>

</main>
