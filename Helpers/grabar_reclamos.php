<?php 
session_start();
if (empty($_SESSION['active'])) {
    header('location: salir');
}
require_once("../Modelos/conexion.php");

if (!empty($_POST)) {

    //print_r($_POST);
    //print_r($_FILES);
    //exit;

    if (empty($_POST['proveedor']) ||empty($_POST['descripcion'])  || ($_POST['existencia'] <= 0)) {



    }else{

        $modelo      = $_POST['modelo'];
        $nro_caja    = $_POST['nro_caja'];
        $nro_partida = $_POST['nro_partida'];
        $descripcion = $_POST['descripcion'];
        $estado      = $_POST['estado'];
        $proveedor   = $_POST['proveedor'];
        $existencia  = $_POST['existencia'];
        $observacion = $_POST['observacion'];
        $usuario     = $_POST['usuario'];

        $query_insert = mysqli_query($conection,"INSERT INTO producto(modelo,nro_caja,nro_partida,descripcion,estado,proveedor,existencia,usuario,observacion)
            VALUES('$modelo','$nro_caja','$nro_partida','$descripcion','$estado','$proveedor','$existencia','$usuario','$observacion')");

        if ($query_insert ) {
            if ($nombrefoto != '') {
                move_uploaded_file($url_temp, $scr);
            }
            header('location: ../Plantillas/reclamos.php');

        }else{

        }
    }

}

require_once("../body/header_admin.php");
?>
<main class="app-content">
     <div class="app-title">
      <h1><i class="fa fa-server" aria-hidden="true"></i>  Registro de Reclamos</h1>   
</div>
   <div  tabindex="-1" role="dialog"  aria-hidden="true">
   <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">

        <div class="modal-productos" style="width: 450px;">
            <form action="" method="POST" enctype="multipart/form-data" id="uploadForm">
               <div class="form-group">
                  <label for="modelo">Modelo :</label>
                     <select class="form-control" name="modelo" id="modelo" >
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
                  <label for="nro_partida">Nro de Caja :</label>
                  <input type="number" name="nro_caja" id="nro_caja" class="form-control input-sm">
              </div>
              <div class="form-group">
                  <label for="nro_partida">Nro de Partida :</label>
                  <input type="text" name="nro_partida" id="nro_partida" class="form-control input-sm">
              </div>
              <div class="form-group">
                  <label for="descripcion">Descripción :</label>
                  <input type="text" name="descripcion" id="descripcion" class="form-control input-sm">
              </div>
              <div class="form-group">
                  <label class="control-label">Estado</label>
                  <select name="estado" id="estado" class="form-control">
                    <option value="Faltante">Faltante</option>
                    <option value="Averiado">Averiado</option>
                    <option value="No Conforme">No Conforme</option>
                    <option value="Sobrante">Sobrante</option>
                  </select>
                </div>
              <div class="form-group">
                  <label for="proveedor">Proveedor:</label>
                   <select class="form-control" id="proveedor" name="proveedor" required>
                <option value="SENKE">SENKE</option>
                <option value="KINGTON">KINGTON</option>
                <option value="SHINERAY">SHINERAY</option>
              </select> 
           </div>
              <div class="form-group">
                  <label for="existencia">Cantidad :</label>
                  <input type="number" name="existencia" id="existencia" class="form-control input-sm">
              </div>
             <div class="form-group">
                  <label class="control-label">Observacion</label>
                  <textarea class="form-control" rows="4" name="observacion" id="observacion"  placeholder="Ingrese la Falla Observacion" required></textarea>
             </div>
            <input type="hidden" name="usuario" id="usuario" class="form-control input-sm" value="<?php echo $_SESSION['user']; ?>">
            <br>
            <div class="tile-footer">
             <button type="submit" class="btn btn-primary" ><i class="fa fa-fw fa-lg fa-check-circle"></i>Grabar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger" href="../Plantillas/reclamos.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
         </div>
     </form>
 </div>
</div>
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
