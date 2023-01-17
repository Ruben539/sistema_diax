<?php
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
}

require_once("../body/header_admin.php");


if (!empty($_POST)) {
	$alert = '';

	if (empty($_POST['Cedula']) || empty($_POST['Nombre']) || empty($_POST['Apellido']) || empty($_POST['Sexo']) || empty($_POST['Celular']) || empty($_POST['Nacimiento'])) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{

		$Cedula        = $_POST['Cedula'];
		$Nombre        = $_POST['Nombre'];
		$Apellido      = $_POST['Apellido'];
		$Sexo          = $_POST['Sexo'];
		$Celular       = $_POST['Celular'];
		$Nacimiento    = $_POST['Nacimiento'];
		

		$resultado = 0;

		$query = mysqli_query($conection,"SELECT * FROM clientes WHERE Apellido = '$Apellido' ");

		$resultado = mysqli_fetch_array($query);



			$query_insert = mysqli_query($conection,"INSERT INTO clientes(Cedula,Apellido,Nombre,Nacimiento,Sexo,Celular)
				VALUES('$Cedula','$Apellido','$Nombre','$Nacimiento','$Sexo','$Celular')");

			if ($query_insert ) {
        
				header("Location: ../Plantillas/registro_pacientes.php");


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
            <h3 class="tile-title">Registro de Paciente</h3>
            <div class="tile-body">
              <form action="" method="POST">
              <div class="form-group">
                  <label class="control-label">Cedula</label>
                  <input class="form-control" type="text" name="Cedula" id="Cedula" placeholder="Ingrese la cedula" required>
                </div>

                 <div class="form-group">
                    <label class="control-label">Nombre</label>
                    <input class="form-control" type="text" name="Nombre" id="Nombre" placeholder="Ingrese el nombre" required>
                  </div>

                 <div class="form-group">
                    <label class="control-label">Apellido</label>
                    <input class="form-control" type="text" name="Apellido" id="Apellido" placeholder="Ingrese el apellido" required>
                </div>


                <div class="form-group">
                  <label class="control-label">Sexo</label>
                  <select class="form-control" type="text" name="Sexo" id="Sexo"  required>
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                  </select>
                </div>
               
                <div class="form-group">
                  <label class="control-label">Celular</label>
                  <input class="form-control" type="text" name="Celular" id="Celular"  placeholder="Ingrese el nro de Telefono" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Fecha de Nacimiento</label>
                  <input class="form-control" type="date"  name="Nacimiento" id="Nacimiento"  placeholder="Ingrese la fecha" required>
                </div>
                 
                 <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar
            </button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Plantillas/pacientes.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
              
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