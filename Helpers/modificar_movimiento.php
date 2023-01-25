<?php 

session_start();

require_once("../Modelos/conexion.php");
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
	}


	if (!empty($_POST)) {
		$alert = '';
	
		if (empty( $_POST['Tipo']) || empty($_POST['SubTipo']) || empty($_POST['Monto']) || empty($_POST['Factura']) || empty($_POST['Estado'])) {
	
			$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';
	
		}else{
	
			$id            = $_POST['id'];
			$Tipo          = $_POST['Tipo'];
			$SubTipo       = $_POST['SubTipo'];
			$Monto         = $_POST['Monto'];
			$Factura       = $_POST['Factura'];
			$Estado        = $_POST['Estado'];
			$Concepto      = $_POST['Concepto'];
			
	
	
	//echo "SELECT * FROM usuario
	
			//WHERE(usuario = '$user' AND idusuario != $iduser) or (correo = '$email' AND idusuario != $iduser";
	//exit; sirve para ejectuar la consulta en mysql
			$query = mysqli_query($conection,"SELECT * FROM historialie
				WHERE  id != id"
			);
	
			$resultado = mysqli_fetch_array($query);
	
	
		}
	
		if ($resultado > 0) {
			$alert = '<p class = "msg_error">El Registro ya existe,ingrese otro</p>';
	
		}else{
	
			$sql_update = mysqli_query($conection,"UPDATE historialie SET Tipo = '$Tipo',SubTipo = '$SubTipo', Monto = '$Monto',
            Factura = '$Factura',Estado = '$Estado', Concepto = '$Concepto'
				WHERE id = $id");
	
			if ($sql_update) {
	
				$alert = '<p class = "msg_success">Actualizado Correctamente</p>';
	
			}else{
				$alert = '<p class = "msg_error">Error al Actualizar el Registro</p>';
			}
		}
	}

//Recuperacion de datos para mostrar al seleccionar Actualizar

if (empty($_REQUEST['id'])) {
	header('location: ../Plantillas/ingreso.php');

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

}

$id = $_REQUEST['id'];

$sql = mysqli_query($conection,"SELECT * FROM historialie  WHERE id = $id");   

//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php


$resultado = mysqli_num_rows($sql);

if ($resultado == 0) {
	header("location: ../Plantillas/ingreso.php");
}else{
	$option = '';
	while ($data = mysqli_fetch_array($sql)) {
		
		$id           = $data['ID'];
		$Tipo         = $data['Tipo'];
		$SubTipo      = $data['SubTipo'];
		$Monto        = $data['Monto'];
		$Factura      = $data['Factura'];
		$Estado       = $data['Estado'];
		$Concepto     = $data['Concepto'];

	}
}

require_once("../body/header_admin.php");
?>
<main class="app-content">

      <div class="row" style="justify-content: center;">
        <div class="col-md-5">
          <div class="tile">
            <h3 class="tile-title">Modificar de Movimiento</h3>
            <div class="tile-body">
              <form action="" method="POST">
                  <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                <div class="form-group">
                  <input class="form-control" type="hidden" name="Tipo" id="Tipo" placeholder="Ingrese el Tipo" 
                   value="<?php echo $Tipo; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label"> Tipo</label>
                  <input class="form-control" type="text" name="Tipo" id="Tipo" placeholder="Ingrese el monto" required
                  value="<?php echo $Tipo; ?>">
                </div>
                
                <div class="form-group">
                  <label class="control-label">Subb Tipo</label>
                  <input class="form-control" type="text" name="SubTipo" id="SubTipo" placeholder="Ingrese el monto" required 
                  value="<?php echo $SubTipo; ?>">
                </div>

                <div class="form-group">
                  <label class="control-label">Monto</label>
                  <input class="form-control" type="text" name="Monto" id="Monto" placeholder="Ingrese el monto" required
                  value="<?php echo $Monto; ?>">
                </div>

                <div class="form-group">
                  <label class="control-label">Nro de Factura</label>
                  <input class="form-control" type="text" name="Factura" id="Factura" placeholder="Ingrese el monto" required
                  value="<?php echo $Factura; ?>">
                </div>
                
                <div class="form-group">
                  <label class="control-label">Estado</label>
                  <input class="form-control" type="text" name="Estado" id="Estado" placeholder="Ingrese el monto" required 
                  value="<?php echo $Estado; ?>">
                </div>

                <div class="form-group">
                  <label class="control-label">Concepto</label>
                  <input class="form-control" type="text" name="Concepto" id="Concepto" placeholder="Ingrese el monto" required 
                  value="<?php echo $Concepto; ?>">
                </div>

             

               
                                  
                 <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Plantillas/ingreso.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
              
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