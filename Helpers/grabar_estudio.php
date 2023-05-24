<?php
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
}

require_once("../body/header_admin.php");


if (!empty($_POST)) {
	$alert = '';

	if (empty($_POST['Estudio']) || empty($_POST['SinSeguro'])  || empty($_POST['SemeiPref'])) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{

		$Estudio       = $_POST['Estudio'];
		$SinSeguro     = $_POST['SinSeguro'];
		$SemeiPref     = $_POST['SemeiPref'];
		$Hospitalar    = $_POST['Hospitalar'];
		$estatus       = $_POST['estatus'];
		

		$resultado = 0;

		$query = mysqli_query($conection,"SELECT * FROM tarifas WHERE Estudio = '$Estudio' ");

		$resultado = mysqli_fetch_array($query);



			$query_insert = mysqli_query($conection,"INSERT INTO tarifas(Estudio,SinSeguro,SemeiPref,Hospitalar,estatus)
				VALUES('$Estudio','$SinSeguro','$SemeiPref','$Hospitalar','$estatus')");

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
    
      <div class="row" style="justify-content: center;">
        <div class="col-md-5">
          <div class="tile">
            <h3 class="tile-title">Registro de Estudio</h3>
            <div class="tile-body">
              <form action="" method="POST">
              <div class="form-group">
                  <label class="control-label">Estudio</label>
                  <input class="form-control" type="text" name="Estudio" id="Estudio" placeholder="Ingrese el Estudio" required>
                </div>

                 <div class="form-group">
                    <label class="control-label">Sin Seguro</label>
                    <input class="form-control" type="text" name="SinSeguro" id="SinSeguro" placeholder="Ingrese el monto" required>
                  </div>



                <div class="form-group">
                  <label class="control-label">Precio Preferencial</label>
                  <input class="form-control" type="text" name="SemeiPref" id="SemeiPref" placeholder="Ingrese el monto" required>
                </div>

                <div class="form-group">
                  <label class="control-label">Precio Hospitalarios</label>
                  <input class="form-control" type="text"  name=" Hospitalar" id=" Hospitalar"  placeholder="Ingrese el monto">
                </div>
                  <input type="hidden" name="estatus" id="estatus" value="1">
                 <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar
            </button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Plantillas/estudios.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
              
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