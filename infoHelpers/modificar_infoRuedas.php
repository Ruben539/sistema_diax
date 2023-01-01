<?php
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
	}

include "../Modelos/conexion.php";

if (!empty($_POST)) {
	$alert = '';

	if (empty( $_POST['nro_partida']) || empty($_POST['meta_diaria']) || empty($_POST['diferencia']) ||empty($_POST['modelo'])) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{

		$id_infoRuedas      = $_POST['id'];
		$modelo             = $_POST['modelo'];
		$nro_partida        = $_POST['nro_partida'];
		$meta_diaria        = $_POST['meta_diaria'];
		$total_meta         = $_POST['total_meta'];
		$diferencia         = $_POST['diferencia'];
        $observacion        = $_POST['observacion'];
		


//echo "SELECT * FROM usuario

		//WHERE(usuario = '$user' AND idusuario != $iduser) or (correo = '$email' AND idusuario != $iduser";
//exit; sirve para ejectuar la consulta en mysql
		$query = mysqli_query($conection,"SELECT * FROM informeruedas
			WHERE  id_infoRuedas != id_infoRuedas"
		);

		$resultado = mysqli_fetch_array($query);


	}

	if ($resultado > 0) {
		$alert = '<p class = "msg_error">El Registro ya existe,ingrese otro</p>';

	}else{

		$sql_update = mysqli_query($conection,"UPDATE informeruedas SET modelo = '$modelo',nro_partida = '$nro_partida',
         meta_diaria = '$meta_diaria',total_meta = '$total_meta',diferencia = '$diferencia', observacion = '$observacion', estatus = 1
			WHERE id_infoRuedas = '$id_infoRuedas'");

		if ($sql_update) {

			header('location: ../Informes/info_Ruedas.php');

		}else{
			$alert = '<p class = "msg_error">Error al Actualizar el Registro</p>';
		}
	}
}

//Recuperacion de datos para mostrar al seleccionar Actualizar

if (empty($_REQUEST['id'])) {
	header('location: ../Informes/info_Ruedas.php');

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

}

$id_infoRuedas = $_REQUEST['id'];

$sql = mysqli_query($conection,"SELECT * FROM informeruedas WHERE id_infoRuedas = $id_infoRuedas AND estatus= 1");

//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php


$resultado = mysqli_num_rows($sql);

if ($resultado == 0) {
	header("location:../Informes/info_Ruedas.php");
}else{

	while ($data = mysqli_fetch_array($sql)) {
 
		$id_infoRuedas         = $data['id_infoRuedas'];
		$modelo                = $data['modelo'];
		$nro_partida           = $data['nro_partida'];
		$meta_diaria           = $data['meta_diaria'];
		$total_meta            = $data['total_meta'];
		$diferencia            = $data['diferencia'];
    $observacion           = $data['observacion'];
		

	}
}

require_once("../body/header_admin.php");
?>

 <main class="app-content">
    
      <div class="row" style="justify-content: center;">
        <div class="col-md-5">
          <div class="tile">
            <h3 class="tile-title">Registro de Ruedas</h3>
            <div class="tile-body">
              <form action="" method="POST">
                <input type="hidden" id="id" name="id" value="<?php echo $id_infoRuedas;?>">
                <div class="form-group">
                  <label class="control-label">Modelo</label>
                  <select class="form-control" name="modelo" id="modelo" >
                    <option value="<?php echo $modelo?>" selected><?php echo $modelo;?></option>
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
                  <input class="form-control" type="number" name="nro_partida" id="nro_partida" placeholder="Ingrese el Nro de Vehiculo"
                  value="<?php echo $nro_partida?>" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Meta Diaria</label>
                  <input class="form-control" type="number" name="meta_diaria" id="meta_diaria" placeholder="Ingrese el meta_diaria"
                  oninput="restar()" required value="<?php echo $meta_diaria?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Total Producido</label>
                  <input class="form-control" type="number" name="total_meta" id="total_meta" placeholder="Ingrese la total_meta"
                  oninput="restar()" required value="<?php echo $total_meta?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Diferencia</label>
                  <input class="form-control" type="number" name="diferencia" id="diferencia" placeholder="Ingrese la total_meta" required value="<?php echo $diferencia?>">
                </div>
                  <div class="form-group">
                  <label class="control-label">Observacion</label>
                  <textarea class="form-control" rows="4" name="observacion" id="observacion" 
                   placeholder="Ingrese la Observacion" required><?php echo $observacion; ?></textarea>
                </div>
            
                 <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Informes/infoinformeruedas.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
              
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
<script>
    function restar(){
        try{ 
        var numero1 = parseInt(document.getElementById('total_meta').value);
        var numero2 = parseInt(document.getElementById('meta_diaria').value);
        var resultado;
        resultado = numero1-numero2;
        document.getElementById('diferencia').value = resultado;
       }catch(e){
           alert("Revise los Parametros Cargados");
       }
    }
</script>