<?php
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
}

require_once("../body/header_admin.php");


if (!empty($_POST)) {
	$alert = '';

	if (empty($_POST['modelo']) || empty($_POST['nro_partida']) || empty($_POST['puesto1']) || empty($_POST['puesto2'])) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{

		$modelo         = $_POST['modelo'];
		$nro_partida    = $_POST['nro_partida'];
		$puesto1        = $_POST['puesto1'];
		$puesto2        = $_POST['puesto2'];
		$puesto3        = $_POST['puesto3'];
		$puesto4        = $_POST['puesto4'];
		$puesto5        = $_POST['puesto5'];
		$puesto6        = $_POST['puesto6'];
        $puesto7        = $_POST['puesto7'];
		$puesto8        = $_POST['puesto8'];
		$puesto9        = $_POST['puesto9'];
		$puesto10       = $_POST['puesto10'];
        $puesto11       = $_POST['puesto11'];
		$observacion    = $_POST['observacion'];
		$usuario        = $_POST['usuario'];
	
		$resultado = 0;

		$query = mysqli_query($conection,"SELECT * FROM preensamble WHERE nro_partida = '$nro_partida' ");

		$resultado = mysqli_fetch_array($query);



			$query_insert = mysqli_query($conection,"INSERT INTO preensamble(nro_partida,modelo,puesto1,puesto2,puesto3,puesto4,puesto5,puesto6,puesto7,puesto8,puesto9,puesto10,puesto11,observacion,usuario)
				VALUES('$nro_partida','$modelo','$puesto1','$puesto2','$puesto3','$puesto4','$puesto5','$puesto6','$puesto7','$puesto8','$puesto9','$puesto10','$puesto11','$observacion','$usuario')");

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
        <h5 class="modal-title" id="titleModal">Nuevo registro</h5>
      </div>
      <div class="modal-body">
 
		<form action="" method="POST">
       <div  class="formulario" id="formulario">
           	<!--Grupo de Formulario del Modelo-->
		<div class="form-group">
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Nro de Patida</span></div>
          	<input type="text" class="form-control" name="nro_partida" id="nro_partida" placeholder="Ingrese el Nro de Partida" require autofocus>
        </div>
		</div>
      	<!--Grupo de Formulario del Modelo-->
		<div class="form-group" ">
			<div class="input-group">
        
          <input type="hidden">
        </div>
		</div>
      	<!--Grupo de Formulario del Modelo-->
		<div class="form-group" ">
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
		<div class="form-group" id="grupo-solicitante">
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Puesto 1</span></div>
          	<select class="form-control" name="puesto1" id="puesto1" >
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
              <option value="Logrado">Logrado</option>
              <option value="No-Logrado">No-Logrado</option>
            </select>
        </div>
	    </div>

      			<!--Grupo de Formulario del Modelo-->
		<div class="form-group" id="grupo-solicitante">
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Puesto 3</span></div>
          	<select class="form-control" name="puesto9" id="puesto9" >
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
              <option value="Logrado">Logrado</option>
              <option value="No-Logrado">No-Logrado</option>
            </select>
        </div>
	    </div>
</div>
    	<!--Grupo de Formulario de Puesto 1-->
    
        <textarea type="text" name="observacion" id="observacion" class="input-100" placeholder="Ingrese su Observación"></textarea>
		<input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION['user'];?>">
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