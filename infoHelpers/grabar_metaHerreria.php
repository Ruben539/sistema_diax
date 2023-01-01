<?php
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
}

require_once("../body/header_admin.php");


if (!empty($_POST)) {
	$alert = '';

	if (empty($_POST['modelo']) || empty($_POST['nro_partida'])) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{

		$modelo          = $_POST['modelo'];
		$nro_partida     = $_POST['nro_partida'];
		$meta_varilla    = $_POST['meta_varilla'];
		$meta_sosten     = $_POST['meta_sosten'];
		$meta_horquilla  = $_POST['meta_horquilla'];
		$meta_caballete  = $_POST['meta_caballete'];
		$meta_posapie    = $_POST['meta_posapie'];
		$meta_manubrio   = $_POST['meta_manubrio'];
		$meta_mandil     = $_POST['meta_mandil'];
        $meta_posapie1   = $_POST['meta_posapie1'];
		$meta_posapie2   = $_POST['meta_posapie2'];
		$meta_motor      = $_POST['meta_motor'];
		$meta_bateria    = $_POST['meta_bateria'];
        $meta_cutanque   = $_POST['meta_cutanque'];
		$meta_velocimetro= $_POST['meta_velocimetro'];
		$meta_adorno     = $_POST['meta_adorno'];
        $meta_bulto      = $_POST['meta_bulto'];
		$meta_chasis     = $_POST['meta_chasis'];
		$meta_freno      = $_POST['meta_freno'];
		$meta_tanque     = $_POST['meta_tanque'];
        
	
		$resultado = 0;

		$query = mysqli_query($conection,"SELECT * FROM infoherreria WHERE nro_partida = '$nro_partida' ");

		$resultado = mysqli_fetch_array($query);



			$query_insert = mysqli_query($conection,"INSERT INTO infoherreria(nro_partida,modelo,meta_varilla,meta_sosten,meta_horquilla,
			meta_caballete,meta_posapie,meta_manubrio,meta_mandil,meta_posapie1,meta_posapie2,meta_motor,meta_bateria,meta_cutanque,
			meta_velocimetro,meta_adorno,meta_bulto,meta_chasis,meta_freno,meta_tanque)
				VALUES('$nro_partida','$modelo','$meta_varilla','$meta_sosten','$meta_horquilla','$meta_caballete','$meta_posapie','$meta_manubrio',
				'$meta_mandil','$meta_posapie1','$meta_posapie2','$meta_motor','$meta_bateria','$meta_cutanque','$meta_velocimetro','$meta_adorno',
				'$meta_bulto','$meta_chasis','$meta_freno','$meta_tanque')");

			if ($query_insert ) {
				$alert = '<p class = "msg_save">Registro Guardado Correctamente</p>';

			}else{
				$alert = '<p class = "msg_error">Error al Guardar el Registro</p>';
			}

	}
	mysqli_close($conection);
}

if (empty($_REQUEST['id'])) {
	header('location: ../Infomes/infoHerreria.php');

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

}



?>

<main class="app-content">

  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Meta Diaria</h5>
      </div>
      <div class="modal-body">
 
		<form action="" method="POST">
       <div  class="formulario" id="formulario">
		   
           	<!--Grupo de Formulario del Modelo-->
		<div class="form-group" ">
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Nro de Patida</span></div>
          	<input type="text" class="form-control" name="nro_partida" id="nro_partida" placeholder="Ingrese el Nro de Partida"
             require autofocus>
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
    	<!--Grupo de Formulario del Varilla-->
		<div class="form-group" id="grupo-solicitante">
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Varilla Tensor</span></div>
          	<input type="number" class="form-control" name="meta_varilla" id="meta_varilla" placeholder="Ingrese la Cantidad">
        </div>
		</div>

			<!--Grupo de Formulario del sosten-->
		<div class="form-group" id="grupo-solicitante">
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Sosten Lateral</span></div>
          	<input type="number" class="form-control" name="meta_sosten" id="meta_sosten" placeholder="Ingrese la Cantidad">
        </div>
		</div>

		<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Caballete</span></div>
          	<input type="number" class="form-control" name="meta_caballete" id="meta_caballete" placeholder="Ingrese la Cantidad">
        </div>
	    </div>
		
  			<!--Grupo de Formulario del Modelo-->
		<div class="form-group" id="grupo-solicitante">
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Horquilla</span></div>
          	<input type="number" class="form-control" name="meta_horquilla" id="meta_horquilla" placeholder="Ingrese la Cantidad" >
        </div>
		</div>

		<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Posapie Central</span></div>
          	<input type="number" class="form-control" name="meta_posapie" id="meta_posapie" placeholder="Ingrese la Cantidad" >
        </div>
	    </div>

      			<!--Grupo de Formulario del Modelo-->
		<div class="form-group" id="grupo-solicitante">
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Manubrio</span></div>
          	<input type="number" class="form-control" name="meta_manubrio" id="meta_manubrio" placeholder="Ingrese la Cantidad" >
        </div>
		</div>

		<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Soporte Mandil</span></div>
          	<input type="number" class="form-control" name="meta_mandil" id="meta_mandil" placeholder="Ingrese la Cantidad" > 
        </div>
	    </div>

      			<!--Grupo de Formulario del Modelo-->
		<div class="form-group" id="grupo-solicitante">
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Posapie Tras.IZQ.</span></div>
          	<input type="number" class="form-control" name="meta_posapie1" id="meta_posapie1" placeholder="Ingrese la Cantidad" > 
        </div>
		</div>

		<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Posapie Tras.DER.</span></div>
          	<input type="number" class="form-control" name="meta_posapie2" id="meta_posapie2"  placeholder="Ingrese la Cantidad">
        </div>
	    </div>

      			<!--Grupo de Formulario del Modelo-->
		<div class="form-group" id="grupo-solicitante">
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text">Soporte Motor</span></div>
          	<input type="number" class="form-control" name="meta_motor" id="meta_motor" placeholder="Ingrese la Cantidad" >     
        </div>
		</div>

		<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Soporte Bateria</span></div>
          	<input type="number" class="form-control" name="meta_bateria" id="meta_bateria" placeholder="Ingrese la Cantidad" >
        </div>
	    </div>

      	<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Soporte C.Tanque</span></div>
          	<input type="number" class="form-control" name="meta_cutanque" id="meta_cutanque" placeholder="Ingrese la Cantidad" >
        </div>
	    </div>
       	<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Soporte C Veloc.</span></div>
          	<input type="number" class="form-control" name="meta_velocimetro" id="meta_velocimetro" placeholder="Ingrese la Cantidad" >
        </div>
	    </div>

       	<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Soporte A. Posapie</span></div>
          	<input type="number" class="form-control" name="meta_adorno" id="meta_adorno" placeholder="Ingrese la Cantidad" >
        </div>
	    </div>

       	<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Porta Bulto</span></div>
          	<input type="number" class="form-control" name="meta_bulto" id="meta_bulto" placeholder="Ingrese la Cantidad">
        </div>
	    </div>

       	<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Chasis</span></div>
          	<input type="number" class="form-control" name="meta_chasis" id="meta_chasis" placeholder="Ingrese la Cantidad">
        </div>
	    </div>

		 	<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Soporte C.Freno</span></div>
          	<input type="number" class="form-control" name="meta_freno" id="meta_freno" placeholder="Ingrese la Cantidad" >
        </div>
	    </div>

       	<!--Grupo de Formulario de Puesto 1-->
    	<div class="form-group" id="grupo-solicitante">
		  	<div class="input-group">
         <div class="input-group-prepend"><span class="input-group-text">Tanque</span></div>
          	<input type="number" class="form-control" name="meta_tanque" id="meta_tanque" placeholder="Ingrese la Cantidad">
        </div>
	    </div>
</div>
    	<!--Grupo de Formulario de Puesto 1-->
    
		<div class="tile-footer" >
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Informes/informeHerreria.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
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