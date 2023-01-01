<?php
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
}

require_once("../body/header_admin.php");


if (!empty($_POST)) {
	$alert = '';

	if (empty($_POST['modelo']) || empty($_POST['nro_partida']) || empty($_POST['plan_diario']) ) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{

    $modelo         = $_POST['modelo'];
		$nro_partida    = $_POST['nro_partida'];
		$plan_diario    = $_POST['plan_diario'];
		$atraso         = $_POST['atraso'];
		$total_meta     = $_POST['total_meta'];
    $cantidad       = $_POST['cantidad'];
		$diferencia     = $_POST['diferencia'];
		$observacion    = $_POST['observacion'];
		$usuario        = $_POST['usuario'];

		$resultado = 0;

		$query = mysqli_query($conection,"SELECT * FROM infodesembalado WHERE modelo = '$modelo' ");

		$resultado = mysqli_fetch_array($query);



			$query_insert = mysqli_query($conection,"INSERT INTO infodesembalado(modelo,nro_partida,plan_diario,atraso,total_meta,cantidad,diferencia,observacion,usuario)
				VALUES('$modelo','$nro_partida','$plan_diario','$atraso','$total_meta','$cantidad','$diferencia','$observacion','$usuario')");

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
            <h3 class="tile-title">Informe Diario</h3>
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
                  <label class="control-label">Nro de Partida</label>
                  <input class="form-control" type="text" name="nro_partida" id="nro_partida" placeholder="Ingrese el Nro de Partida" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Plan del Dia</label>
                  <input class="form-control" type="number" name="plan_diario" id="plan_diario" placeholder="Ingrese la Cantidad" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Atraso/Adelantamiento</label>
                  <input class="form-control" type="number" name="atraso" id="atraso" placeholder="Ingrese la Cantidad" >
                </div>
                 <div class="form-group">
                  <label class="control-label">Total a Desembalar</label>
                  <input class="form-control" type="number" name="total_meta" id="total_meta" placeholder="Ingrese la Cantidad" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Cantidad Desembalada</label>
                  <input class="form-control" type="number" name="cantidad" id="cantidad" placeholder="Ingrese la Cantidad" required>
                </div>
                 <div class="form-group">
                  <label class="control-label">Diferencia</label>
                  <input class="form-control" type="number" name="diferencia" id="diferencia" placeholder="Ingrese la Cantidad" >
                </div>
                <div class="form-group">
                  <label class="control-label">Observación</label>
                  <textarea class="form-control" rows="4" name="observacion" id="observacion"  placeholder="Ingrese la Observacion" required></textarea>
                </div>
         
                 <input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION['user'];?>">
                 <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Informes/informeDesembalado.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
              
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