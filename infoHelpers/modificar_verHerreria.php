<?php
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
	}

include "../Modelos/conexion.php";

if (!empty($_POST)) {
	$alert = '';

	if (empty( $_POST['nro_partida']) || empty($_POST['sin_soporte']) || empty($_POST['soporte_2']) ||empty($_POST['modelo'])) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{

		$id_verHerreria     = $_POST['id'];
		$modelo             = $_POST['modelo'];
		$nro_partida        = $_POST['nro_partida'];
		$sin_soporte        = $_POST['sin_soporte'];
		$soporte_1          = $_POST['soporte_1'];
		$soporte_2          = $_POST['soporte_2'];
        $mala_soldadura     = $_POST['mala_soldadura'];
		$exceso_escoria     = $_POST['exceso_escoria'];
		$desalineado        = $_POST['desalineado'];
		$fisura             = $_POST['fisura'];
        $rotura             = $_POST['rotura'];
		$observacion        = $_POST['observacion'];
        $usuario            = $_POST['usuario'];
		


//echo "SELECT * FROM usuario

		//WHERE(usuario = '$user' AND idusuario != $iduser) or (correo = '$email' AND idusuario != $iduser";
//exit; sirve para ejectuar la consulta en mysql
		$query = mysqli_query($conection,"SELECT * FROM verificacion_herreria
			WHERE  id_verHerreria != id_verHerreria"
		);

		$resultado = mysqli_fetch_array($query);


	}

	if ($resultado > 0) {
		$alert = '<p class = "msg_error">El Registro ya existe,ingrese otro</p>';

	}else{

		$sql_update = mysqli_query($conection,"UPDATE verificacion_herreria SET modelo = '$modelo',nro_partida = '$nro_partida', sin_soporte = '$sin_soporte',soporte_1 = '$soporte_1',soporte_2 = '$soporte_2',
        mala_soldadura = '$mala_soldadura',exceso_escoria = '$exceso_escoria', desalineado = '$desalineado',fisura = '$fisura', rotura = '$rotura',observacion = '$observacion',usuario = '$usuario', estatus = 1
			WHERE id_verHerreria = $id_verHerreria");

		if ($sql_update) {

			header('location: ../Informes/verificador_Herreria.php');

		}else{
			$alert = '<p class = "msg_error">Error al Actualizar el Registro</p>';
		}
	}
}

//Recuperacion de datos para mostrar al seleccionar Actualizar

if (empty($_REQUEST['id'])) {
	header('location: ../Informes/verificador_Herreria.php');

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

}

$id_verHerreria = $_REQUEST['id'];

$sql = mysqli_query($conection,"SELECT * FROM verificacion_herreria WHERE id_verHerreria = $id_verHerreria AND estatus= 1");

//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php


$resultado = mysqli_num_rows($sql);

if ($resultado == 0) {
	header("location:../Informes/verificador_Herreria.php");
}else{

	while ($data = mysqli_fetch_array($sql)) {
 
		$id_verHerreria        = $data['id_verHerreria'];
		$modelo                = $data['modelo'];
		$nro_partida           = $data['nro_partida'];
		$sin_soporte           = $data['sin_soporte'];
		$soporte_1             = $data['soporte_1'];
		$soporte_2             = $data['soporte_2'];
        $mala_soldadura        = $data['mala_soldadura'];
		$exceso_escoria        = $data['exceso_escoria'];
		$desalineado           = $data['desalineado'];
		$fisura                = $data['fisura'];
        $rotura                = $data['rotura'];
		$observacion           = $data['observacion'];
        $usuario               = $data['usuario'];
		

	}
}

require_once("../body/header_admin.php");
?>

<main class="app-content">

  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Registro de Verificación de Herreria</h5>
      </div>
      <div class="modal-body">
 
		<form action="" method="POST">
       <div  class="formulario" id="formulario">  
        <input type="hidden" name="id" id="id"  value="<?php echo $id_verHerreria;?>">   
      	<!--Grupo de Formulario del Modelo-->
		<div class="form-group" >   
		<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Modelo</span></div>
          	<select class="form-control" name="modelo" id="modelo" >
                <option  value="<?php echo $modelo;?>"><?php echo $modelo;?></option>
				<option value="SK110-DAX-CKD">SK110-DAX-CKD</option>
                <option value="SK110DAX-A-CKD">SK110DAX-A-CKD</option>
                <option value="SK125GENIUS-CKD">SK125GENIUS-CKD</option>
                <option value="SK125-MAGIC-CKD">SK125-MAGIC-CKD</option>
                <option value="SK125-5-CKD">SK125-5-CKD</option>
                <option value="SK150-CG-CKD">SK150-CG-CKD</option>
                <option value="SK150-X-CKD">SK150-X-CKD</option>
                <option value="SK150NT-A-CKD">SK150NT-A-CKD</option>
                <option value="SK150XPRO-R-CKD">SK150XPRO-R-CKD</option>
                <option value="SK150GY-5-CKD">SK150GY-5-CKD</option>
                <option value="SK150-RX4-CKD">SK150-RX4-CKD</option>
                <option value="SK150-FXZ-CKD">SK150-FXZ-CKD</option>
                <option value="SK150BR-NEW-CKD">SK150BR-NEW-CKD</option>
                <option value="SK150-SMX-CKD">SK150-SMX-CKD</option>
                <option value="SKSTAR-200">SK200-STAR</option>
                <option value="SK200XPRO-R-CKD">SK200XPRO-R-CKD</option>
                <option value="SK200-BR-CKD">SK200-BR-CKD</option>
                <option value="SK200GY-5-CKD">SK200GY-5-CKD</option>
                <option value="SKCARGA200-CKD">SKCARGA200-CKD</option>
                <option value="SKCARGA200-C-CKD">SKCARGA200-C-CKD</option>
            </select>
        </div>
		</div>
              	<!--Grupo de Formulario del Modelo-->
		<div class="form-group" ">
		<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Nro de Patida</span></div>
          	<input type="text" class="form-control" name="nro_partida" id="nro_partida"  value="<?php echo $nro_partida;?>" require>
        </div>
        </div>
        
		<!--Grupo de Formulario del Modelo-->
		<div class="form-group" id="grupo-solicitante">
		<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Sin Soporte</span></div>
          	<input type="number" class="form-control" name="sin_soporte" id="sin_soporte" class="form-control"
               value="<?php echo $sin_soporte;?>" required>
        </div>
		</div>

		<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Sop. mal Soldados</span></div>
          <input type="number" id="soporte_1" name="soporte_1" class="form-control"  value="<?php echo $soporte_1;?>" required >
        </div>
	    </div>
		
  			<!--Grupo de Formulario del Modelo-->
		<div class="form-group" id="grupo-solicitante">
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Soporte motor</span></div>
          	<input type="number" id="soporte_2" name="soporte_2" class="form-control"  value="<?php echo $soporte_2;?>" required>
        </div>
		</div>

		<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Mala Soladura</span></div>
          <input type="text" class="form-control" id="mala_soldadura" name="mala_soldadura"  value="<?php echo $mala_soldadura;?>" required>
        </div>
	    </div>

        	<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Exceso de Escoria</span></div>
          <input type="number" id="exceso_escoria" name="exceso_escoria" class="form-control"  value="<?php echo $exceso_escoria;?>" required>
        </div>
	    </div>
		
  			<!--Grupo de Formulario del Modelo-->
		<div class="form-group" id="grupo-solicitante">
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Desalineado</span></div>
          	<input type="number" id="desalineado" name="desalineado" class="form-control"  value="<?php echo $exceso_escoria;?>" required>
        </div>
		</div>
	

		<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Fisura</span></div>
        <input type="number" class="form-control" id="fisura" name="fisura"  value="<?php echo $fisura;?>" required>
        </div>
	    </div>

        <!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Rotura</span></div>
        <input type="number" class="form-control" id="rotura" name="rotura"  value="<?php echo $rotura;?>" required>
        </div>
	    </div>

</div>
    	<!--Grupo de Formulario de Puesto 1-->
    
        <textarea type="text" name="observacion" id="observacion" class="input-100" placeholder="Ingrese su Observación"><?php echo $observacion;?></textarea>
   
		<input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION['user'];?>">
          <br> <br>
		<div class="tile-footer text-center" >
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Informes/verificador_Herreria.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
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
</div>

</main>

