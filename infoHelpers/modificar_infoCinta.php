<?php
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
	}

include "../Modelos/conexion.php";

if (!empty($_POST)) {
	$alert = '';

	if (empty( $_POST['nro_partida']) || empty($_POST['tiempo_encendido']) || empty($_POST['cant_producida']) ||empty($_POST['modelo'])) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{

		$id_infoCinta       = $_POST['id'];
		$modelo             = $_POST['modelo'];
		$nro_partida        = $_POST['nro_partida'];
		$tiempo_encendido   = $_POST['tiempo_encendido'];
		$turno              = $_POST['turno'];
		$cant_producida     = $_POST['cant_producida'];
        $no_conformes       = $_POST['no_conformes'];
		$diferencia         = $_POST['diferencia'];
		$hora_arranque      = $_POST['hora_arranque'];
		$hora_final         = $_POST['hora_final'];
		$observacion        = $_POST['observacion'];
		


//echo "SELECT * FROM usuario

		//WHERE(usuario = '$user' AND idusuario != $iduser) or (correo = '$email' AND idusuario != $iduser";
//exit; sirve para ejectuar la consulta en mysql
		$query = mysqli_query($conection,"SELECT * FROM informecinta
			WHERE  id_infoCinta != id_infoCinta"
		);

		$resultado = mysqli_fetch_array($query);


	}

	if ($resultado > 0) {
		$alert = '<p class = "msg_error">El Registro ya existe,ingrese otro</p>';

	}else{

		$sql_update = mysqli_query($conection,"UPDATE informecinta SET modelo = '$modelo',nro_partida = '$nro_partida', tiempo_encendido = '$tiempo_encendido',turno = '$turno',cant_producida = '$cant_producida',
        no_conformes = '$no_conformes',diferencia = '$diferencia', hora_arranque = '$hora_arranque',hora_final = '$hora_final',observacion = '$observacion', estatus = 1
			WHERE id_infoCinta = $id_infoCinta");

		if ($sql_update) {

			header('location: ../Informes/info_Cinta.php');

		}else{
			$alert = '<p class = "msg_error">Error al Actualizar el Registro</p>';
		}
	}
}

//Recuperacion de datos para mostrar al seleccionar Actualizar

if (empty($_REQUEST['id'])) {
	header('location: ../Informes/info_Cinta.php');

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

}

$id_infoCinta = $_REQUEST['id'];

$sql = mysqli_query($conection,"SELECT * FROM informecinta WHERE id_infoCinta = $id_infoCinta AND estatus= 1");

//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php


$resultado = mysqli_num_rows($sql);

if ($resultado == 0) {
	header("location:../Informes/info_Cinta.php");
}else{

	while ($data = mysqli_fetch_array($sql)) {
 
		$id_infoCinta          = $data['id_infoCinta'];
		$modelo                = $data['modelo'];
		$nro_partida           = $data['nro_partida'];
		$tiempo_encendido      = $data['tiempo_encendido'];
		$turno                 = $data['turno'];
		$cant_producida        = $data['cant_producida'];
        $no_conformes          = $data['no_conformes'];
		$diferencia            = $data['diferencia'];
		$hora_arranque         = $data['hora_arranque'];
		$hora_final            = $data['hora_final'];
		$observacion           = $data['observacion'];
		

	}
}

require_once("../body/header_admin.php");
?>

<main class="app-content">

  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Nuevo registro</h5>
      </div>
      <div class="modal-body">
 
		<form action="" method="POST">
       <div  class="formulario" id="formulario">  
           <input type="hidden" name="id" id="id"  value="<?php echo $id_infoCinta;?>">  
      	<!--Grupo de Formulario del Modelo-->
		<div class="form-group" >   
		<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Modelo</span></div>
          	<select class="form-control" name="modelo" id="modelo" >
                <option  value="<?php echo $modelo;?>" selected><?php echo $modelo?></option>  
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

        <div class="form-group" ">
			<div class="input-group">
        
          <input type="hidden">
        </div>
		</div>
              	<!--Grupo de Formulario del Modelo-->
		<div class="form-group" ">
		<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Nro de Patida</span></div>
          	<input type="text" class="form-control" name="nro_partida" id="nro_partida" placeholder="Ingrese el Nro de Partida" 
            value="<?php echo $nro_partida;?>"  require>
        </div>
        </div>
        
		<!--Grupo de Formulario del Modelo-->
		<div class="form-group" id="grupo-solicitante">
		<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Turno</span></div>
          	<select class="form-control" name="turno" id="turno" class="form-control" >
              <option  value="<?php echo $turno;?>"><?php echo $turno;?></option>
              <option value="Mañana">Mañana</option>
              <option value="Tarde">Tarde</option>
            </select>
        </div>
		</div>

		<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Hora Inicio</span></div>
          <input type="text" id="hora_arranque" name="hora_arranque" class="form-control" 
           value="<?php echo $hora_arranque;?>">
        </div>
	    </div>
		
  			<!--Grupo de Formulario del Modelo-->
		<div class="form-group" id="grupo-solicitante">
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Hora Fin</span></div>
          	<input type="text" id="hora_final" name="hora_final" class="form-control" 
               value="<?php echo $hora_final;?>" >
        </div>
		</div>

		<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">T. Trabajado</span></div>
          <input type="text" class="form-control" id="tiempo_encendido" name="tiempo_encendido"  value="<?php echo $tiempo_encendido;?>">
        </div>
	    </div>

        	<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Cant. Producida</span></div>
          <input type="number" id="cant_producida" name="cant_producida" class="form-control" oninput="restar()"
           value="<?php echo $cant_producida;?>">
        </div>
	    </div>
		
  			<!--Grupo de Formulario del Modelo-->
		<div class="form-group" id="grupo-solicitante">
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">No Conforme</span></div>
          	<input type="number" id="no_conformes" name="no_conformes" class="form-control" oninput="restar()" 
               value="<?php echo $no_conformes;?>">
        </div>
		</div>
	

		<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Diferencia</span></div>
        <input type="number" class="form-control" id="diferencia" name="diferencia"  value="<?php echo $diferencia;?>">
        </div>
	    </div>

</div>
    	<!--Grupo de Formulario de Puesto 1-->
    
        <textarea type="text" name="observacion" id="observacion" class="input-100" placeholder="Ingrese su Observación"><?php echo $observacion;?></textarea>
   
		
          <br> <br>
		<div class="tile-footer text-center" >
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Informes/info_Cinta.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
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

<script>
    function restar(){
        try{ 
        var numero1 = parseInt(document.getElementById('cant_producida').value);
        var numero2 = parseInt(document.getElementById('no_conformes').value);
        var resultado;
        resultado = numero1-numero2;
        document.getElementById('diferencia').value = resultado;
       }catch(e){
           alert("Solamente se Permiten Numeros");
       }
    }

</script>