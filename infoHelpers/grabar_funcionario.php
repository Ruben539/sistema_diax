<?php
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
}

require_once("../body/header_admin.php");


if (!empty($_POST)) {
	$alert = '';

	if (empty($_POST['puesto']) || empty($_POST['nombre']) || empty($_POST['cantidad'])) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{

		$nombre      = $_POST['nombre'];
		$puesto      = $_POST['puesto'];
		$cantidad    = $_POST['cantidad'];
		$usuario     = $_POST['usuario'];
	

		$resultado = 0;

		$query = mysqli_query($conection,"SELECT * FROM funcionarioruedas WHERE nombre = '$nombre' ");

		$resultado = mysqli_fetch_array($query);



			$query_insert = mysqli_query($conection,"INSERT INTO funcionarioruedas(nombre,puesto,cantidad,usuario)
				VALUES('$nombre','$puesto','$cantidad','$usuario')");

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
            <h3 class="tile-title">Registro de Ruedas</h3>
            <div class="tile-body">
              <form action="" method="POST">            
               
                <div class="form-group">
                  <label class="control-label">Nombre</label>
                  <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Ingrese el Nombre" required>
                </div>

                 <div class="form-group">
                  <label class="control-label">Puesto</label>
                  	<select class="form-control" name="puesto" id="puesto" >
				        <option value="RAYADO">RAYADO</option>
                        <option value="CENTRADO">CENTRADO</option>
                     </select>
                </div>

                <div class="form-group">
                  <label class="control-label">Cantidad</label>
                  <input class="form-control" type="number" name="cantidad" id="cantidad" placeholder="Ingrese la cantidad"  required>
                </div>
                <input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION['user'];?>"> 
                 <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Informes/info_Funcionario.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
              
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
