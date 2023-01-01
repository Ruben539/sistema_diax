<?php
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
	}

require_once("../Modelos/conexion.php");

if (!empty($_POST)) {
	$alert = '';

	if (empty( $_POST['modelo']) || empty($_POST['nro_partida']) || empty($_POST['descripcion']) ||empty($_POST['proveedor'])) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{

        $codproducto = $_POST['id'];
       	$modelo      = $_POST['modelo'];
        $nro_caja    = $_POST['nro_caja']; 
        $nro_partida = $_POST['nro_partida'];
        $descripcion = $_POST['descripcion'];
        $estado      = $_POST['estado'];
        $proveedor   = $_POST['proveedor'];
        $existencia  = $_POST['existencia'];
        $observacion = $data['observacion'];
      
        

     
//echo "SELECT * FROM usuario

		//WHERE(usuario = '$user' AND idusuario != $iduser) or (correo = '$email' AND idusuario != $iduser";
//exit; sirve para ejectuar la consulta en mysql
		$query = mysqli_query($conection,"SELECT * FROM producto
			WHERE  codproducto != codproducto"
		);

		$resultado = mysqli_fetch_array($query);


	}

	if ($resultado > 0) {
		$alert = '<p class = "msg_error">El Registro ya existe,ingrese otro</p>';

	}else{

		$sql_update = mysqli_query($conection,"UPDATE producto SET modelo = '$modelo',nro_caja = '$nro_caja',nro_partida = '$nro_partida', descripcion = '$descripcion',estado = '$estado',proveedor = '$proveedor'
    ,existencia = '$existencia',observacion = '$observacion', estatus = 1 WHERE codproducto = $codproducto");

		if ($sql_update) {

			header('location: ../Plantillas/reclamos.php');

		}else{
			$alert = '<p class = "msg_error">Error al Actualizar el Registro</p>';
		}
	}
}

//Recuperacion de datos para mostrar al seleccionar Actualizar

if (empty($_REQUEST['id'])) {
	header('location: ../Plantillas/reclamos.php');

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

}

$codproducto = $_REQUEST['id'];

$sql = mysqli_query($conection,"SELECT * FROM producto WHERE codproducto = $codproducto AND estatus= 1");

$resultado = mysqli_num_rows($sql);

if ($resultado == 0) {
	header("location:../Plantillas/reclamos.php");
}else{

	while ($data = mysqli_fetch_array($sql)) {
 
	     	$modelo      = $data['modelo'];
        $nro_caja    = $data['nro_caja']; 
        $nro_partida = $data['nro_partida'];
        $descripcion = $data['descripcion'];
        $estado      = $data['estado'];
        $proveedor   = $data['proveedor'];
        $existencia  = $data['existencia'];
        $observacion = $data['observacion'];
		

	}
//print_r($data);
//exit;
}

require_once("../body/header_admin.php");
?>
 <main class="app-content">
    
      <div class="row" style="justify-content: center;">
        <div class="col-md-5">
          <div class="tile">
            <h3 class="tile-title">Modficar Reclamo</h3>
            <div class="tile-body">
              <form action="" method="POST">
                <div class="form-group">
                    <input type="hidden" name="id" id="id" value="<?php echo $codproducto; ?>">
                  <label class="control-label">Modelo</label>
                  <input class="form-control" type="text" name="modelo" id="modelo" placeholder="Ingrese el Modelo" required 
                  value="<?php echo $modelo; ?>"autofocus>
                </div>
                <div class="form-group">
                  <label class="control-label">Nro de Caja</label>
                  <input class="form-control" type="number" name="nro_caja" id="nro_caja" placeholder="Ingrese el Nro de Caja"
                  value="<?php echo $nro_caja;?>" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Nro de Partida</label>
                  <input class="form-control" type="text" name="nro_partida" id="nro_partida" placeholder="Ingrese el Nro de Patida"
                  value="<?php echo $nro_partida;?>" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Descripcion</label>
                  <input class="form-control" type="text" name="descripcion" id="descripcion" placeholder="Ingrese el Color"
                  value="<?php echo $descripcion; ?>" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Estado</label>
                  <select name="estado" id="estado" class="form-control" >
                    <option value="<?php echo $estado?>" selected><?php echo $estado;?></option>
                    <option value="Faltante">Faltante</option>
                    <option value="Averiado">Averiado</option>
                    <option value="No Conforme">No Conforme</option>
                    <option value="Sobrante">Sobrante</option>
                  </select>
                </div>
                <div class="form-group">
                <label for="proveedor">Proveedor:</label>
                <select class="form-control" id="proveedor" name="proveedor" value="<?php echo $proveedor; ?>" required>
                <option value="SENKE">SENKE</option>
                <option value="KINGTON">KINGTON</option>
                <option value="SHINERAY">SHINERAY</option>
               </select> 
               </div>
                <div class="form-group">
                  <label class="control-label">Existencia</label>
                  <input class="form-control" type="text" name="existencia" id="existencia" value="<?php echo $existencia; ?>"
                   placeholder="Ingrese la Pieza" required>
                </div>
                 <div class="form-group">
                  <label class="control-label">Observacion</label>
                  <textarea class="form-control" rows="4" name="observacion" id="observacion"  placeholder="Ingrese la Falla Observacion" required><?php echo $observacion;?></textarea>
             </div>
               
                 <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Plantillas/reclamos.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
              
            </div>
              </form>
              <br>
              
            </div>
            
          </div>
        </div>
      </div>
    </main>
<script src="../js/jquery-3.3.1.min.js"></script>
<script >
    $(document).ready(function(){

    $("#foto").on("change",function(){
    	var uploadFoto = document.getElementById("foto").value;
        var foto       = document.getElementById("foto").files;
        var nav = window.URL || window.webkitURL;
        var contactAlert = document.getElementById('form_alert');
        
        if(uploadFoto !='')
        {
            var type = foto[0].type;
            var name = foto[0].name;
            if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png')
            {
                contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';                        
                $("#img").remove();
                $(".delPhoto").addClass('notBlock');
                $('#foto').val('');
                return false;
            }else{  
                contactAlert.innerHTML='';
                $("#img").remove();
                $(".delPhoto").removeClass('notBlock');
                var objeto_url = nav.createObjectURL(this.files[0]);
                $(".prevPhoto").append("<img id='img' src="+objeto_url+">");
                $(".upimg label").remove();

            }
        }else{
         alert("No selecciono foto");
         $("#img").remove();
     }              
 });

    $('.delPhoto').click(function(){
    	$('#foto').val('');
    	$(".delPhoto").addClass('notBlock');
    	$("#img").remove();
        if ($("#foto_actual") && $("#foto_remove") ){
            $("#foto_remove").val('img_producto.jpg');
        }

    });
    
});
</script>