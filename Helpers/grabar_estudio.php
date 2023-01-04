<?php
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
}

require_once("../body/header_admin.php");


if (!empty($_POST)) {
	$alert = '';

	if (empty($_POST['Estudio']) || empty($_POST['SinSeguro']) || empty($_POST['SEMEI']) || empty($_POST['SemeiPref']) || empty($_POST['Seguros']) || empty($_POST['SegurosPref'])) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{

		$Estudio       = $_POST['Estudio'];
		$SinSeguro     = $_POST['SinSeguro'];
		$SEMEI         = $_POST['SEMEI'];
		$SemeiPref     = $_POST['SemeiPref'];
		$Seguros       = $_POST['Seguros'];
		$SegurosPref   = $_POST['SegurosPref'];
		$Hospitalar    = $_POST['Hospitalar'];
		

		$resultado = 0;

		$query = mysqli_query($conection,"SELECT * FROM tarifas WHERE Estudio = '$Estudio' ");

		$resultado = mysqli_fetch_array($query);



			$query_insert = mysqli_query($conection,"INSERT INTO tarifas(Estudio,SEMEI,SinSeguro,SegurosPref,SemeiPref,Seguros,Hospitalar)
				VALUES('$Estudio','$SEMEI','$SinSeguro','$SegurosPref','$SemeiPref','$Seguros','$Hospitalar')");

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
                    <label class="control-label">Semei</label>
                    <input class="form-control" type="text" name="SEMEI" id="SEMEI" placeholder="Ingrese el monto" required>
                </div>


                <div class="form-group">
                  <label class="control-label">Semei Preferencial</label>
                  <input class="form-control" type="text" name="SemeiPref" id="SemeiPref" placeholder="Ingrese el monto" required>
                </div>
               
                <div class="form-group">
                  <label class="control-label">Seguros</label>
                  <input class="form-control" type="text" name="Seguros" id="Seguros"  placeholder="Ingrese el monto" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Seguros Preferencial</label>
                  <input class="form-control" type="text"  name="SegurosPref" id="SegurosPref"  placeholder="Ingrese el monto" required>
                </div>

                <div class="form-group">
                  <label class="control-label">Seguros Hospitalarios</label>
                  <input class="form-control" type="text"  name=" Hospitalar" id=" Hospitalar"  placeholder="Ingrese el monto">
                </div>
                 
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