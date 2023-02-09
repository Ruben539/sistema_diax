<?php 

session_start();

require_once("../Modelos/conexion.php");
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
	}


	if (!empty($_POST)) {
		$alert = '';
	
		if (empty( $_POST['Informa'])) {
	
			$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';
	
		}else{
	
			$id           = $_POST['id'];
			$Informa      = $_POST['Informa'];
			$Placas       = $_POST['Placas'];
		
			
	
	
	//echo "SELECT * FROM usuario
	
			//WHERE(usuario = '$user' AND idusuario != $id) or (correo = '$email' AND idusuario != $id";
	//exit; sirve para ejectuar la consulta en mysql
			$query = mysqli_query($conection,"SELECT * FROM historial
				WHERE  id != id"
			);
	
			$resultado = mysqli_fetch_array($query);
	
	
		}
	
		if ($resultado > 0) {
			$alert = '<p class = "msg_error">El Registro ya existe,ingrese otro</p>';
	
		}else{
	
			$sql_update = mysqli_query($conection,"UPDATE historial SET Informa = '$Informa',Placas = '$Placas'
				WHERE id = $id");
	
			if ($sql_update) {
	
				$alert = '<p class = "msg_save">Asignado Correctamente</p>';
	
			}else{
				$alert = '<p class = "msg_error">Error al Actualizar el Registro</p>';
			}
		}
	}



require_once("../body/header_admin.php");
?>
<main class="app-content">

      <div class="row" style="justify-content: center;">
        <div class="col-md-5">
          <div class="tile">
            <h3 class="tile-title">Asignar Informante <i class="fa fa-user-md"></i></h3>
            <div class="tile-body">
              <form action="" method="POST">
              <div class="form-group">
                  <input class="form-control" type="text" name="id" id="id" 
                   value="<?php echo $_REQUEST['id']; ?>">
                </div>
                <div class="form-group">
                  <input class="form-control" type="hidden" name="Informa" id="Informa" placeholder="Ingrese el Informa" 
                   value="<?php echo $Informa; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label"> Informa</label>
                  <input class="form-control" type="text" name="Informa" id="Informa" placeholder="Ingrese el Informa" 
                  value="<?php echo $Informa; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Numero de Placas</label>
                  <input class="form-control" type="number" name="Placas" id="Placas" placeholder="Ingrese el coreo" 
                  value="<?php echo $Placas; ?>">
                </div>
            
                                  
                 <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Asignar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Plantillas/dashboard.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
              
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