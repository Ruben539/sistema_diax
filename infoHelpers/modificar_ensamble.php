<?php
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
	}

include "../Modelos/conexion.php";

if (!empty($_POST)) {
	$alert = '';

	if (empty( $_POST['nro_partida']) || empty($_POST['puesto1']) || empty($_POST['puesto2']) ||empty($_POST['modelo'])) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{

		$id_ensamble    = $_POST['id'];
		$modelo         = $_POST['modelo'];
		$nro_partida    = $_POST['nro_partida'];
		$puesto1        = $_POST['puesto1'];
		$puesto2        = $_POST['puesto2'];
		$puesto3        = $_POST['puesto3'];
		$puesto4        = $_POST['puesto4'];
		$puesto5        = $_POST['puesto5'];
		$puesto6        = $_POST['puesto6'];
        $puesto7        = $_POST['puesto3'];
		$puesto8        = $_POST['puesto4'];
		$puesto9        = $_POST['puesto5'];
		$puesto10       = $_POST['puesto6'];
        $puesto11       = $_POST['puesto3'];
		$observacion    = $_POST['observacion'];
		


//echo "SELECT * FROM usuario

		//WHERE(usuario = '$user' AND idusuario != $iduser) or (correo = '$email' AND idusuario != $iduser";
//exit; sirve para ejectuar la consulta en mysql
		$query = mysqli_query($conection,"SELECT * FROM preensamble
			WHERE  id_ensamble != id_ensamble"
		);

		$resultado = mysqli_fetch_array($query);


	}

	if ($resultado > 0) {
		$alert = '<p class = "msg_error">El Registro ya existe,ingrese otro</p>';

	}else{

		$sql_update = mysqli_query($conection,"UPDATE preensamble SET modelo = '$modelo',nro_partida = '$nro_partida', puesto1 = '$puesto1',puesto2 = '$puesto2', puesto3 = '$puesto3',puesto4 = '$puesto4'
        , puesto5 = '$puesto5',puesto6 = '$puesto6', puesto7 = '$puesto7',puesto8 = '$puesto8', puesto9 = '$puesto9',puesto10 = '$puesto10', puesto11 = '$puesto11',observacion = '$observacion', estatus = 1
			WHERE id_ensamble = $id_ensamble");

		if ($sql_update) {

			header('location: ../Informes/preensamble.php');

		}else{
			$alert = '<p class = "msg_error">Error al Actualizar el Registro</p>';
		}
	}
}

//Recuperacion de datos para mostrar al seleccionar Actualizar

if (empty($_REQUEST['id'])) {
	header('location: ../Informes/preensamble.php');

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

}

$id_ensamble = $_REQUEST['id'];

$sql = mysqli_query($conection,"SELECT * FROM preensamble WHERE id_ensamble = $id_ensamble AND estatus= 1");

//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php


$resultado = mysqli_num_rows($sql);

if ($resultado == 0) {
	header("location:../Informes/preensamble.php");
}else{

	while ($data = mysqli_fetch_array($sql)) {
 
		$id_ensamble    = $data['id_ensamble'];
		$modelo         = $data['modelo'];
		$nro_partida    = $data['nro_partida'];
        $puesto1        = $data['puesto1'];
		$puesto2        = $data['puesto2'];
		$puesto3        = $data['puesto3'];
		$puesto4        = $data['puesto4'];
		$puesto5        = $data['puesto5'];
		$puesto6        = $data['puesto6'];
        $puesto7        = $data['puesto3'];
		$puesto8        = $data['puesto4'];
		$puesto9        = $data['puesto5'];
		$puesto10       = $data['puesto6'];
        $puesto11       = $data['puesto3'];
		$observacion    = $data['observacion'];
		
		
		

	}
}

require_once("../body/header_admin.php");
?>
<main class="app-content">

  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Modificar registro</h5>
      </div>
      <div class="modal-body">
 
		<form action="" method="POST">
       <div  class="formulario" id="formulario">
           <input type="hidden" name="id" id="id"  value="<?php echo $id_ensamble;?>">
           	<!--Grupo de Formulario del Modelo-->
		<div class="form-group" ">
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Nro de Patida</span></div>
          	<input type="text" class="form-control" name="nro_partida" id="nro_partida" placeholder="Ingrese el Nro de Partida" 
             value="<?php echo $nro_partida;?>" require autofocus>
        </div>
		</div>
      	<!--Grupo de Formulario del Modelo-->
		<div class="form-group" ">
			<div class="input-group">
        
          <input type="hidden">
        </div>
		</div>
      	<!--Grupo de Formulario del Modelo-->
		<div class="form-group">
		<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Modelo</span></div>
          	<select class="form-control" name="modelo" id="modelo" >
                    <option value="<?php echo $modelo?>" selected><?php echo $modelo;?></option>
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
		<div class="form-group" id="grupo-solicitante">
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Puesto 1</span></div>
          	<select class="form-control" name="puesto1" id="puesto1" >
               <option value="<?php echo $puesto1?>" selected><?php echo $puesto1;?></option>
              <option value="Logrado">Logrado</option>
              <option value="No-Logrado">No-Logrado</option>
            </select>
        </div>
		</div>

		<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Puesto 2</span></div>
          	<select class="form-control" name="puesto2" id="puesto2" >
              <option value="<?php echo $puesto2?>" selected><?php echo $puesto2;?></option>
              <option value="Logrado">Logrado</option>
              <option value="No-Logrado">No-Logrado</option>
            </select>
        </div>
	    </div>
		
  			<!--Grupo de Formulario del Modelo-->
		<div class="form-group" id="grupo-solicitante">
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Puesto 3</span></div>
          	<select class="form-control" name="puesto3" id="puesto3" >
              <option value="<?php echo $puesto3?>" selected><?php echo $puesto3;?></option>
              <option value="Logrado">Logrado</option>
              <option value="No-Logrado">No-Logrado</option>
            </select>
        </div>
		</div>

		<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Puesto 4</span></div>
          	<select class="form-control" name="puesto4" id="puesto4" >
               <option value="<?php echo $puesto4?>" selected><?php echo $puesto4;?></option>
              <option value="Logrado">Logrado</option>
              <option value="No-Logrado">No-Logrado</option>
            </select>
        </div>
	    </div>

      			<!--Grupo de Formulario del Modelo-->
		<div class="form-group" id="grupo-solicitante">
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Puesto 5</span></div>
          	<select class="form-control" name="puesto5" id="puesto5" >
              <option value="<?php echo $puesto5?>" selected><?php echo $puesto5;?></option>
              <option value="Logrado">Logrado</option>
              <option value="No-Logrado">No-Logrado</option>
            </select>
        </div>
		</div>

		<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Puesto 6</span></div>
          	<select class="form-control" name="puesto6" id="puesto6" >
            <option value="<?php echo $puesto6?>" selected><?php echo $puesto6;?></option>
              <option value="Logrado">Logrado</option>
              <option value="No-Logrado">No-Logrado</option>
            </select>
        </div>
	    </div>

      			<!--Grupo de Formulario del Modelo-->
		<div class="form-group" id="grupo-solicitante">
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Puesto 7</span></div>
          	<select class="form-control" name="puesto7" id="puesto7" >
              <option value="<?php echo $puesto7?>" selected><?php echo $puesto7;?></option>
              <option value="Logrado">Logrado</option>
              <option value="No-Logrado">No-Logrado</option>
            </select>
        </div>
		</div>

		<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Puesto 8</span></div>
          	<select class="form-control" name="puesto8" id="puesto8" >
               <option value="<?php echo $puesto8?>" selected><?php echo $puesto8;?></option>
              <option value="Logrado">Logrado</option>
              <option value="No-Logrado">No-Logrado</option>
            </select>
        </div>
	    </div>

      			<!--Grupo de Formulario del Modelo-->
		<div class="form-group" id="grupo-solicitante">
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Puesto 9</span></div>
          	<select class="form-control" name="puesto9" id="puesto9" >
               <option value="<?php echo $puesto9?>" selected><?php echo $puesto9;?></option>
              <option value="Logrado">Logrado</option>
              <option value="No-Logrado">No-Logrado</option>
            </select>
        </div>
		</div>

		<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Puesto 10</span></div>
          	<select class="form-control" name="puesto10" id="puesto10" >
               <option value="<?php echo $puesto10?>" selected><?php echo $puesto10;?></option>
              <option value="Logrado">Logrado</option>
              <option value="No-Logrado">No-Logrado</option>
            </select>
        </div>
	    </div>

      	<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Puesto 11</span></div>
          	<select class="form-control" name="puesto11" id="puesto11" >
              <option value="<?php echo $puesto11?>" selected><?php echo $puesto11;?></option>
              <option value="Logrado">Logrado</option>
              <option value="No-Logrado">No-Logrado</option>
            </select>
        </div>
	    </div>
</div>
    	<!--Grupo de Formulario de Puesto 1-->
		  <div class="form-group">
                  <label class="control-label">Observacion</label>
                  <textarea class="form-control" rows="4" name="observacion" id="observacion" 
                   placeholder="Ingrese la Observacion" required><?php echo $observacion; ?></textarea>
                </div>
          <br>
		<div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Informes/preEnsamble.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
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
