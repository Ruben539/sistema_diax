<?php
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
}

require_once("../body/header_admin.php");


if (!empty($_POST)) {
	$alert = '';

	if ( empty($_POST['modelo']) || empty($_POST['nro_partida']) || empty($_POST['sin_soporte']) || empty($_POST['soporte_2'])) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{
        
        $modelo           = $_POST['modelo'];
		$nro_partida      = $_POST['nro_partida'];
		$sin_soporte      = $_POST['sin_soporte'];
        $soporte_1        = $_POST['soporte_1'];
		$soporte_2        = $_POST['soporte_2'];
		$mala_soldadura   = $_POST['mala_soldadura'];
		$exceso_escoria   = $_POST['exceso_escoria'];
        $desalineado      = $_POST['desalineado'];
		$fisura           = $_POST['fisura'];
		$rotura           = $_POST['rotura'];
        $observacion      = $_POST['observacion'];
        $usuario          = $_POST['usuario'];
		

		$resultado = 0;

		$query = mysqli_query($conection,"SELECT * FROM verificacion_herreria WHERE nro_partida = '$nro_partida' ");

		$resultado = mysqli_fetch_array($query);



			$query_insert = mysqli_query($conection,"INSERT INTO verificacion_herreria(nro_partida,modelo,soporte_1,sin_soporte,soporte_2,mala_soldadura,exceso_escoria,desalineado,fisura,rotura,observacion,usuario)
				VALUES('$nro_partida','$modelo','$soporte_1','$sin_soporte','$soporte_2','$mala_soldadura','$exceso_escoria','$desalineado','$fisura','$rotura',' $observacion','$usuario')");

			if ($query_insert ) {
				$alert = '<p class = "msg_save">Registro Guardado Correctamente</p>';

			}else{
				$alert = '<p class = "msg_error">Error al Guardar el Registro</p>';
			}

	}
	mysqli_close($conection);
}

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
      	<!--Grupo de Formulario del Modelo-->
		<div class="form-group" >   
		<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Modelo</span></div>
          	<select class="form-control" name="modelo" id="modelo" >
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
          	<input type="text" class="form-control" name="nro_partida" id="nro_partida" placeholder="Ingrese el Nro de Partida" require>
        </div>
        </div>
        
		<!--Grupo de Formulario del Modelo-->
		<div class="form-group" id="grupo-solicitante">
		<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Sin Soporte</span></div>
          	<input type="number" class="form-control" name="sin_soporte" id="sin_soporte" class="form-control" required>
        </div>
		</div>

		<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Sop. mal Soldados</span></div>
          <input type="number" id="soporte_1" name="soporte_1" class="form-control" required >
        </div>
	    </div>
		
  			<!--Grupo de Formulario del Modelo-->
		<div class="form-group" id="grupo-solicitante">
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Soporte motor</span></div>
          	<input type="number" id="soporte_2" name="soporte_2" class="form-control" required>
        </div>
		</div>

		<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Mala Soladura</span></div>
          <input type="text" class="form-control" id="mala_soldadura" name="mala_soldadura" required>
        </div>
	    </div>

        	<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Exceso de Escoria</span></div>
          <input type="number" id="exceso_escoria" name="exceso_escoria" class="form-control"required>
        </div>
	    </div>
		
  			<!--Grupo de Formulario del Modelo-->
		<div class="form-group" id="grupo-solicitante">
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Desalineado</span></div>
          	<input type="number" id="desalineado" name="desalineado" class="form-control"required>
        </div>
		</div>
	

		<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Fisura</span></div>
        <input type="number" class="form-control" id="fisura" name="fisura" required>
        </div>
	    </div>

        <!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Rotura</span></div>
        <input type="number" class="form-control" id="rotura" name="rotura" required>
        </div>
	    </div>

</div>
    	<!--Grupo de Formulario de Puesto 1-->
    
        <textarea type="text" name="observacion" id="observacion" class="input-100" placeholder="Ingrese su Observación"></textarea>
   
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

