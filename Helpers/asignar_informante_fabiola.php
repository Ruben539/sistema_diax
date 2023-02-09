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
            <h3 class="tile-title text-center">Asignar Informante <i class="fa fa-user-md"></i></h3>
            <div class="tile-body">
              <form action="" method="POST">
              <div class="form-group">
                  <input class="form-control" type="hidden" name="id" id="id" 
                   value="<?php echo $_REQUEST['id']; ?>">
                </div>
                <div class="form-group">
                  <input class="form-control" type="hidden" name="Informa" id="Informa" placeholder="Ingrese el Informa" 
                   value="<?php echo $Informa; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Medico Informante</label>
                  <?php
                include "../Modelos/conexion.php";

                $query_medicos = mysqli_query($conection, "SELECT * FROM medicos where Especialidad like '%Informante%'");

                mysqli_close($conection); //con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php
                $resultado = mysqli_num_rows($query_medicos);

                ?>
                <select name="Informa" id="Informa" class="chosen form-control">
                    <?php

                    if ($resultado > 0) {
                        while ($medico = mysqli_fetch_array($query_medicos)) {

                    ?>
                            <option value="<?php echo $medico["Nombre"]; ?>"><?php echo
                                    $medico["Nombre"] ?></option>

                    <?php


                        }
                    }

                    ?>
                </select>
                </div>
                <div class="form-group">
                  <label class="control-label">Numero de Placas</label>
                  <input class="form-control" type="number" name="Placas" id="Placas" placeholder="Ingrese el numero de Placas" >
                </div>
            
                                  
                 <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Asignar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Buscadores/BuscarPaciente_fabiola.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
              
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
<link rel="stylesheet" href="../node_modules/chosen-js/chosen.css" type="text/css" />
<script src="../node_modules/chosen-js/chosen.jquery.min.js"></script>
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../node_modules/chosen-js/chosen.jquery.js"></script>
<script>
    $(document).ready(function() {
        $(".chosen").chosen();
    });
</script>