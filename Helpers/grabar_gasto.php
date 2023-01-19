<?php
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
}

require_once("../body/header_admin.php");


if (!empty($_POST)) {
	$alert = '';

	if (empty($_POST['descripcion']) || empty($_POST['monto']) ) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{

		$descripcion   = $_POST['descripcion'];
		$monto         = $_POST['monto'];
		$estatus       = $_POST['estatus'];
  		
		

		$resultado = 0;

		$query = mysqli_query($conection,"SELECT * FROM gastos WHERE descripcion = '$descripcion' ");

		$resultado = mysqli_fetch_array($query);



			$query_insert = mysqli_query($conection,"INSERT INTO gastos(descripcion,monto,estatus
				VALUES('$descripcion','$monto','$estatus')");


			if ($query_insert) {
        
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
            <h3 class="tile-title">Registro de  Gastos</h3>
            <div class="tile-body">
              <form action="" method="POST">
              <div class="form-group">
                  <label class="control-label">Descripción</label>
                  <input class="form-control" type="text" name="descripcion" id="descripcion" placeholder="Ingrese el gasto" required>
                </div>

                 <div class="form-group">
                    <label class="control-label">Monto</label>
                    <input class="form-control" type="text" name="monto" id="monto" placeholder="Ingrese el monto" required>
                  </div>

                 <input type="hidden" name="estatus" id="estatus" value="1">
                               
                 <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar
            </button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Plantillas/gastos.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
              
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