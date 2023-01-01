<?php
session_start();
if (empty($_SESSION['active'])){

header('location: salir.php');  
}
require_once("../Modelos/conexion.php");

$iduser = $_SESSION['idUser'];

$query_foto = mysqli_query($conection,"SELECT id_usuario,nombre,pass,usuario,foto FROM usuario where id_usuario = '$iduser' AND estatus = 1");
$resultado = mysqli_num_rows($query_foto);
if ($resultado > 0) {
  while ($data = mysqli_fetch_array($query_foto)) {
   if ($data['foto'] != 'user.png') {
    $foto = 'images/usuarios/'.$data['foto'];
    $pass     =md5($data['pass']);
  }else{
    $foto = '../images/'.$data['foto'];
    $pass     =md5($data['pass']);
  } 

  require_once("../body/header_admin.php");
  require_once("../Modals/modalPassword.php");
  ?>

  <main class="app-content">
    <div class="row user">
      <div class="col-md-12">
        <div class="profile">
          <div class="info"><img class="user-avatar" src="<?php echo $foto; ?>" alt= "<?php echo $data['usuario']; ?>">
            <h4><?php echo $_SESSION['nombre']; ?></h4>
            <p><?php echo $_SESSION['puesto']; ?></p>
          </div>
          <div class="cover-image"></div>
        </div>
      </div>
    <?php   }
  } ?>
  <div class="col-md-3">
    <div class="tile p-0">
      <ul class="nav flex-column nav-tabs user-tabs">
        <li class="nav-item"><a class="nav-link active" href="#user-timeline" data-toggle="tab">Cambiar Contraseña</a></li>
      </ul>
    </div>
  </div>
  <div class="col-md-9">
    <div class="tab-content">
      <div class="tab-pane active" id="user-timeline">
        <div class="timeline-post">
          <table>
            <thead>
              <th>Contraseña</th>
            </thead>
            <?php

            if(isset($_SESSION['idUser'])){
              if($_SESSION['idUser'] > 0){
                $id_usuario = $_SESSION['idUser'];

                $sql = "SELECT id_usuario,pass FROM usuario where id_usuario = '$id_usuario' AND estatus = 1";
              }else{
                $sql = "SELECT id_usuario,pass FROM usuario where id_usuario = '$id_usuario' AND estatus = 1";
              }
            }else{

              $sql = "SELECT id_usuario,pass FROM usuario where id_usuario = '$id_usuario' AND estatus = 1";
            }
            $resultado = mysqli_query($conection,$sql);

            while ($ver = mysqli_fetch_row($resultado)) {

              $datos = $ver[0]."||".
              $ver[1];

              ?>
              <tbody>
                <tr>
                  <td><?= $ver[1]; ?></td>
                  <td>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalEditar" onclick="editarDatosPass('<?php echo $datos ?>')"><i class="fa fa-edit" aria-hidden="true"></i> Actualizar</button>
                  </td>
                </tr>
              <?php } ?>   
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
</div>
</main>

<script src="../js/usuario.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#btnNuevoUsu').click(function() {
            /* Act on the event */
            nombre = $('#nombre').val();
            correo = $('#correo').val();
            usuario = $('#usuario').val();
            password = $('#password').val();
            rol = $('#rol').val();
            puesto = $('#puesto').val();

            
            agregarDatoUsu(nombre,correo,usuario,password,rol,puesto);
        });

        $('#btnEditarUsu').click(function() {
            /* Act on the event */
            actualizarDatoUsu();
        });

        $('#btnEditarPass').click(function() {
            /* Act on the event */
            actualizarDatoPass();
        });
    });
</script>