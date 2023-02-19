<?php 

session_start();

require_once("../Modelos/conexion.php");
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
	}


	if (!empty($_POST)) {
		$alert = '';
	
		if (empty( $_POST['Estudio']) || empty($_POST['SinSeguro']) || empty($_POST['SEMEI']) || empty($_POST['SemeiPref']) ||empty($_POST['Seguros'])) {
	
			$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';
	
		}else{
	
			$id              = $_POST['id'];
			$Estudio         = $_POST['Estudio'];
			$SinSeguro       = $_POST['SinSeguro'];
			$SEMEI           = $_POST['SEMEI'];
			$SemeiPref       = $_POST['SemeiPref '];
			$Seguros         = $_POST['Seguros'];
			$SegurosPref     = $_POST['SegurosPref'];
			$Hospitalar      = $_POST['Hospitalar'];
			
	
	
	//echo "SELECT * FROM usuario
	
			//WHERE(usuario = '$user' AND idusuario != $iduser) or (correo = '$email' AND idusuario != $iduser";
	//exit; sirve para ejectuar la consulta en mysql
			$query = mysqli_query($conection,"SELECT * FROM tarifas
				WHERE  id != id"
			);
	
			$resultado = mysqli_fetch_array($query);
	
	
		}
	
		if ($resultado > 0) {
			$alert = '<p class = "msg_error">El Registro ya existe,ingrese otro</p>';
	
		}else{
	
			$sql_update = mysqli_query($conection,"UPDATE tarifas SET Estudio = '$Estudio',SinSeguro = '$SinSeguro', SEMEI = '$SEMEI',
            SemeiPref = '$SemeiPref',Seguros = '$Seguros', SegurosPref = '$SegurosPref', Hospitalar = '$Hospitalar'
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
	header('location: ../Plantillas/estudios.php');

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

}

$id = $_REQUEST['id'];

$sql = mysqli_query($conection,"SELECT * FROM tarifas  WHERE id = $id");   

//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php


$resultado = mysqli_num_rows($sql);

if ($resultado == 0) {
	header("location: ../Plantillas/estudios.php");
}else{
	$option = '';
	while ($data = mysqli_fetch_array($sql)) {
		
		$id           = $data['id'];
		$Estudio      = $data['Estudio'];
		$SinSeguro    = $data['SinSeguro'];
		$SEMEI        = $data['SEMEI'];
		$SemeiPref    = $data['SemeiPref'];
		$Seguros      = $data['Seguros'];
		$SegurosPref  = $data['SegurosPref'];
		$Hospitalar   = $data['Hospitalar'];

	}
}

require_once("../body/header_admin.php");
?>
<main class="app-content">

      <div class="row" style="justify-content: center;">
        <div class="col-md-5">
          <div class="tile">
            <h3 class="tile-title">Modificar de Estudios</h3>
            <div class="tile-body">
              <form action="" method="POST">
                  <input type="hidden" name="id" id="id" value="<?php echo $_REQUEST['id']; ?>">
                <div class="form-group">
                  <input class="form-control" type="hidden" name="Estudio" id="Estudio" placeholder="Ingrese el Estudio" 
                   value="<?php echo $Estudio; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label"> Estudio</label>
                  <input class="form-control" type="text" name="Estudio" id="Estudio" placeholder="Ingrese el monto" required
                  value="<?php echo $Estudio; ?>">
                </div>
                
                <div class="form-group">
                  <label class="control-label">Sin Seguro</label>
                  <input class="form-control" type="text" name="SinSeguro" id="SinSeguro" placeholder="Ingrese el monto" required 
                  value="<?php echo $SinSeguro; ?>">
                </div>

                <div class="form-group">
                  <label class="control-label">Semei</label>
                  <input class="form-control" type="text" name="SEMEI" id="SEMEI" placeholder="Ingrese el monto" required
                  value="<?php echo $SEMEI; ?>">
                </div>

                <div class="form-group">
                  <label class="control-label">Semei Preferencial</label>
                  <input class="form-control" type="text" name="SemeiPref" id="SemeiPref" placeholder="Ingrese el monto" required
                  value="<?php echo $SemeiPref; ?>">
                </div>

                <div class="form-group">
                  <label class="control-label">Seguros</label>
                  <input class="form-control" type="text" name="Seguros" id="Seguros" placeholder="Ingrese el monto" required 
                  value="<?php echo $Seguros; ?>">
                </div>

                <div class="form-group">
                  <label class="control-label">Seguros Preferencial</label>
                  <input class="form-control" type="text" name="SegurosPref" id="SegurosPref" placeholder="Ingrese el monto" required 
                  value="<?php echo $SegurosPref; ?>">
                </div>

                <div class="form-group">
                  <label class="control-label">Hospitalarios</label>
                  <input class="form-control" type="text" name="Hospitalar" id="Hospitalar" placeholder="Ingrese el monto"
                  value="<?php echo $Hospitalar; ?>">
                </div>
                                  
                 <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Plantillas/estudios.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
              
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