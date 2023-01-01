<?php
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
}

require_once("../body/header_admin.php");


if (!empty($_POST)) {
	$alert = '';

	if (empty($_POST['modelo']) || empty($_POST['nro_vehiculo']) || empty($_POST['color']) || empty($_POST['nro_chapa'])) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{

        $modelo         = $_POST['modelo'];
		$nro_vehiculo   = $_POST['nro_vehiculo'];
        $color          = $_POST['color'];
		$nro_chapa      = $_POST['nro_chapa'];
		$observacion    = $_POST['observacion'];
		$combu          = $_POST['combu'];
    $usuario        = $_POST['usuario'];
		

		$resultado = 0;

		$query = mysqli_query($conection,"SELECT * FROM cinta WHERE nro_vehiculo = '$nro_vehiculo' ");

		$resultado = mysqli_fetch_array($query);



			$query_insert = mysqli_query($conection,"INSERT INTO activaciones(nro_vehiculo,modelo,nro_chapa,color,observacion,combu,usuario)
				VALUES('$nro_vehiculo','$modelo','$nro_chapa','$color','$observacion','$combu','$usuario')");

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
            <h3 class="tile-title">Registro de Activaciones</h3>
            <div class="tile-body">
              <form action="" method="POST">
                <div class="form-group">
                  <label class="control-label">Modelo</label>
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
                <div class="form-group">
                  <label class="control-label">Nro de Vehiculo</label>
                  <input class="form-control" type="text" name="nro_vehiculo" id="nro_vehiculo" placeholder="Ingrese el Nro de Vehiculo" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Color</label>
                  <input class="form-control" type="text" name="color" id="color" placeholder="Ingrese el Color" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Nro de Chapa</label>
                  <input class="form-control" type="text" name="nro_chapa" id="nro_chapa" placeholder="Ingrese la Chapa" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Falla Detectada</label>
                  <textarea class="form-control" rows="4" name="observacion" id="observacion"  placeholder="Ingrese la Falla Detectada"></textarea>
                </div>
                 <div class="form-group">
                  <label class="control-label">Litros Utilizados</label>
                  <input class="form-control" type="number" name="combu" id="combu" placeholder="Ingrese la Cantidad" required>
                </div>
                
                 <input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION['user'];?>">
                 <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Plantillas/activaciones.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
              
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