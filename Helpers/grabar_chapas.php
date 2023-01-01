<?php
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
}

require_once("../body/header_admin.php");


if (!empty($_POST)) {
	$alert = '';

	if (empty($_POST['serie']) || empty($_POST['desde']) || empty($_POST['hasta'])) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{

		$serie          = $_POST['serie'];
		$desde          = $_POST['desde'];
		$hasta          = $_POST['hasta'];
		$observacion    = $_POST['observacion'];
		$usuario        = $_POST['usuario'];
		

		$resultado = 0;

		$query = mysqli_query($conection,"SELECT * FROM chapas WHERE serie = '$serie' ");

		$resultado = mysqli_fetch_array($query);



			$query_insert = mysqli_query($conection,"INSERT INTO chapas(serie,desde,hasta,observacion,usuario)
				VALUES('$serie','$desde','$hasta','$observacion','$usuario')");

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
            <h3 class="tile-title">Registro de Chapas</h3>
            <div class="tile-body">
              <form action="" method="POST">
                <div class="form-group">
                  <label class="control-label">Serie</label>
                  <input class="form-control" type="text" name="serie" id="serie" placeholder="Ingrese la Serie" required autofocus>
                </div>
                <div class="form-group">
                  <label class="control-label">Desde</label>
                  <input class="form-control" type="text" name="desde" id="desde" placeholder="Ingrese el Numero" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Hasta</label>
                  <input class="form-control" type="text" name="hasta" id="hasta" placeholder="Ingrese el Numero" required>
                </div>
               
                <div class="form-group">
                  <label class="control-label">Observación</label>
                  <textarea class="form-control" rows="4" name="observacion" id="observacion"  placeholder="Ingrese la Observación" required></textarea>
                </div>
                
                 <input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION['user'];?>">
                 <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Plantillas/chapas.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
              
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