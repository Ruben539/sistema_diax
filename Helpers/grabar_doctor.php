<?php
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
}

require_once("../body/header_admin.php");


if (!empty($_POST)) {
	$alert = '';

	if (empty($_POST['Especialidad']) || empty($_POST['Nombre'])) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{

		$Nombre        = $_POST['Nombre'];
		$Especialidad  = $_POST['Especialidad'];
		$Dia           = $_POST['Dia'];
		$Hora          = $_POST['Hora'];
		$Tcobro        = $_POST['Tcobro'];
		

		$resultado = 0;

		$query = mysqli_query($conection,"SELECT * FROM medicos WHERE Nombre = '$Nombre' ");

		$resultado = mysqli_fetch_array($query);



			$query_insert = mysqli_query($conection,"INSERT INTO medicos(Especialidad,Nombre,Tcobro,Dia,Hora)
				VALUES('$Especialidad','$Nombre','$Tcobro','$Dia','$Hora')");

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
            <h3 class="tile-title">Registro de Doctor</h3>
            <div class="tile-body">
            <form action="" method="POST">
                    <div class="form-group">
                        <label class="control-label">Nombre</label>
                        <input class="form-control" type="text" name="Nombre" id="Nombre" placeholder="Ingrese el nombre" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Especialidad</label>
                        <input class="form-control" type="text" name="Especialidad" id="Especialidad" placeholder="Ingrese la Especialidad" required>
                    </div>


                    <div class="form-group">
                    <label class="control-label">Dia</label>
                    <input class="form-control" type="text" name="Dia" id="Dia"  placeholder="Ingrese el dia de Asistencia">

                    </div>
                
                    <div class="form-group">
                    <label class="control-label">Hora</label>
                    <input class="form-control" type="text" name="Hora" id="Hora"  placeholder="Ingrese la hora de Asistencia">
                    </div>
                    <div class="form-group">
                    <label class="control-label">Cantidad de Cobro</label>
                    <input class="form-control" type="text"  name="Tcobro" id="Tcobro"  placeholder="Ingrese el parametro" required>
                    </div>
                    
                    <div class="tile-footer">
                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Plantillas/medicos.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                
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