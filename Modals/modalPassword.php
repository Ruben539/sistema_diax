<?php 

require_once("../Modelos/conexion.php");

$id_usuario = $_SESSION['idUser'];

$query_foto = mysqli_query($conection,"SELECT nombre,usuario,foto FROM usuario where id_usuario = '$id_usuario' AND estatus = 1");
//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php
$resultado = mysqli_num_rows($query_foto);

$foto = '';
$classRemove = 'notBlock';
if ($resultado > 0) {
  while ($data = mysqli_fetch_array($query_foto)) {
     if ($data['foto'] != 'user.png') {
       $classRemove = '';
      $foto = '../images/usuarios/'.$data['foto'].'';
       }else{
        $foto = '../images/'.$data['foto'];
      } 

 ?>
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Editar Contraseña</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <form method="POST" name="formUsuario" id="formUsuario" class="form-horizontal">
            <input type="hidden" name="id_usuario" id="id_usuario">
            <div class="info text-center"><img class="user-avatar" src="<?php echo $foto; ?>" alt= "<?php echo $data['usuario']; ?>">
            <h4><?php echo $_SESSION['nombre']; ?></h4>
            <p><?php echo $_SESSION['puesto']; ?></p>
          </div> 

           
            <div class="form-group">
              <label class="control-label">Contraseña :</label>
              <input class="form-control" type="password" id="pass" name="pass" placeholder="Ingreser la Contraseña" required>
            </div>
<?php
    }
}
?>

            <div class="tile-footer">
              <button id="btnEditarPass" class="btn btn-primary" type="button"><i class="fa fa-fw fa-lg fa-check-circle"></i><span id="btnText">Actualizar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn btn-danger" href="../Plantillas/perfil.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
            </div>
          </form>
    </div>
  </div>
</div>
</div>