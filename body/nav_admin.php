<?php 

require_once("../Modelos/conexion.php");
//$id_usuario = $_SESSION['idUser'];
?>

<!-- $query_foto = mysqli_query($conection,"SELECT nombre,usuario,foto FROM usuarios where id_usuario = '$id_usuario' AND estatus = 1");
//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php
$resultado = mysqli_num_rows($query_foto);
if ($resultado > 0) {
  while ($data = mysqli_fetch_array($query_foto)) {
     if ($data['foto'] != 'user.png') {
      $foto = '..//images/usuarios/'.$data['foto'];
       }else{
        $foto = '../images/'.$data['foto'];
      } 

 ?> -->
   <!-- Sidebar menu-->
      <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
      <aside class="app-sidebar">
      <a href="../Plantillas/perfil.php">
        <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="../images/user.png">
          <div>
            <p class="app-sidebar__user-name">Sistema Diax</p>
            <p class="app-sidebar__user-designation">En desarrollo</p>
          </div>
        </div>
        </a>
   
    <ul class="app-menu">  
    <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Usuarios</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <!--Menu Principal del Usuario-->
            <li><a class="treeview-item" href="../Plantillas/usuarios.php"><i class="icon fa fa-users"></i> Usuarios Activos</a></li>
            <li><a class="treeview-item" href="../Plantillas/usuario_trash.php"><i class="icon fa fa-users"></i> Usuarios Inactivos</a></li>
            <!--Menu Principal del Rol-->
            
          </ul>
        </li>
        
        <?php  } ?>  
        <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Pacientes</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <!--Menu Principal del Usuario-->
            <li><a class="treeview-item" href="../Plantillas/pacientes.php"><i class="icon fa fa-users"></i> Lista de Pacientes</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-users"></i> Historial Pacientes</a></li>
            <!--Menu Principal del Rol-->
            
          </ul>
        </li>
        
        <?php  } ?> 
        <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-md"></i><span class="app-menu__label">Medicos</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <!--Menu Principal del Usuario-->
            <li><a class="treeview-item" href="../Plantillas/pacientes.php"><i class="icon fa fa-user-md"></i> Lista de Medicos</a></li>
            <li><a class="treeview-item" href="#"><i class="icon fa fa-user-md"></i> Historial de Medicos</a></li>
            <!--Menu Principal del Rol-->
            
          </ul>
        </li>
        
        <?php  } ?> 
    

<!--Menu Principal del Cierre de Sesión-->
<a class="app-menu__item" href="../Plantillas/salir.php"><i class="app-menu__icon fa fa-sign-out-alt"></i><span class="app-menu__label">Cerrar Sesión</span></a></li>

</ul>
</aside>
<?php
  require_once("footer_admin.php");
?>

<script src="../js/sweetalert2.min.js"></script>
<script>
  function alerta(){
	Swal.fire(
		'Lo Siento',
		'Pagina No Disponible',
		'error',
  
		)
}
</script>