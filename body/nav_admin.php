<?php 

require_once("../Modelos/conexion.php");

$id_usuario = $_SESSION['idUser'];

$query_foto = mysqli_query($conection,"SELECT nombre,usuario,foto FROM usuario where id_usuario = '$id_usuario' AND estatus = 1");
//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php
$resultado = mysqli_num_rows($query_foto);
if ($resultado > 0) {
  while ($data = mysqli_fetch_array($query_foto)) {
     if ($data['foto'] != 'user.png') {
      $foto = '..//images/usuarios/'.$data['foto'];
       }else{
        $foto = '../images/'.$data['foto'];
      } 

 ?>
   <!-- Sidebar menu-->
      <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
      <aside class="app-sidebar">
      <a href="../Plantillas/perfil.php">
        <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?php echo $foto; ?>" alt= "<?php echo $data['usuario']; ?>">
          <div>
            <p class="app-sidebar__user-name"><?php echo $_SESSION['nombre']; ?></p>
            <p class="app-sidebar__user-designation"><?php echo $_SESSION['puesto']; ?></p>
          </div>
        </div>
        </a>
   <?php   }
} ?> 
    <ul class="app-menu">  
    <?php if ($_SESSION['rol'] == 1) {?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Usuarios</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <!--Menu Principal del Usuario-->
            <li><a class="treeview-item" href="../Plantillas/usuarios.php"><i class="icon fa fa-users"></i> Usuarios Activos</a></li>
            <li><a class="treeview-item" href="../Plantillas/usuario_trash.php"><i class="icon fa fa-users"></i> Usuarios Inactivos</a></li>
            <!--Menu Principal del Rol-->
            
          </ul>
        </li>
        

        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-book"></i><span class="app-menu__label">Pacientes</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <!--Menu Principal del Usuario-->
            <li><a class="treeview-item" href="../Plantillas/pacientes.php"><i class="icon fa fa-book"></i>Lista de Pacientes</a></li>
            <li><a class="treeview-item" href="../Plantillas/ot_Liberados.php"><i class="icon fa fa-book"></i> Historial de Pacientes</a></li>
            
          </ul>
        </li>
     
        <?php  } ?>  
  
      <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 11) {?>
        
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-thumbs-o-down"></i><span class="app-menu__label">Informes Diarios</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <!--Menu Principal del Usuario-->
            <li><a class="treeview-item" href="../Informes/verificador_Herreria.php"><i class="icon fa fa-thumbs-o-down"></i> Informe de Doctores</a></li>
            <li><a class="treeview-item" href="../Informes/verificador_Pintura.php"><i class="icon fa fa-thumbs-o-down"></i> Informe de Paciente</a></li>
          </ul>
        </li>
      <?php  } ?>
       <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 9) {?>
        
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-md"></i><span class="app-menu__label">Doctores</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <!--Menu Principal del Desembalado-->
            <li><a class="treeview-item" href="../Plantillas/medicos.php" ><i class="icon fa fa-medkit"></i> Lista de Doctores</a></li>
            <li><a class="treeview-item" href="../Plantillas/reclamos.php" ><i class="icon fa fa-medkit"></i> Pacientes por Doctor</a></li>
          </ul>
        </li>
      <?php  } ?>

      <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 3 ) {?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-bolt"></i><span class="app-menu__label">Herreria</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <!--Menu Principal del Rol>
            <li><a class="treeview-item" href="../Plantillas/introHerreria.php"><i class="icon fa fa-file-pdf"></i> Gestión SGS</a></li-->
            <!--Menu Principal del Herreria-->
             <li><a class="treeview-item" href="../Informes/informeHerreria.php"><i class="icon fa fa-bolt"></i> Informe Diario</a></li>
              <li><a class="treeview-item" href="../Plantillas/orden_Herreria.php"><i class="icon fa fa-book"></i> Trabajo Pendiente</a></li>
            <li><a class="treeview-item" href="../Plantillas/herreria.php"><i class="icon fa fa-bolt"></i> Motos Pendientes</a></li>
            <li><a class="treeview-item" href="../Plantillas/herreria_lib.php"><i class="icon fa fa-bolt"></i> Motos Liberadas</a></li>
          </ul>
        </li>
      <?php } ?>

      <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 4) {?>

       <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-paint-brush"></i><span class="app-menu__label">Pintura</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <!--Menu Principal del Pintura-->
          
          <li><a class="treeview-item" href="../Informes/info_Pintura.php"><i class="icon fa fa-paint-brush"></i> Informe Diario</a></li>
          <li><a class="treeview-item" href="../Plantillas/orden_Pintura.php"><i class="icon fa fa-file-pdf"></i> Trabajos Pendientes</a></li>
          <li><a class="treeview-item" href="../Plantillas/pintura.php"><i class="icon fa fa-paint-brush"></i> Motos Pendientes</a></li>
          <!--Menu Principal del Rol-->
          <li><a class="treeview-item" href="../Plantillas/pintura_lib.php"><i class="icon fa fa-paint-brush"></i> Motos Liberadas</a></li>
        </ul>
      </li>
    <?php } ?>

    <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 5) {?>
      <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-dot-circle"></i><span class="app-menu__label">Ruedas</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <!--Menu Principal del Ruedas>
           <li><a class="treeview-item" href="../Plantillas/introRuedas.php"><i class="icon fa fa-file-pdf"></i> Gestión SGS</a></li-->
          <li><a class="treeview-item" href="../Informes/info_Ruedas.php"><i class="icon fa fa-dot-circle"></i> Informe de Produccion</a></li>
          <!--Menu Principal del Ruedas-->
          <li><a class="treeview-item" href="../Informes/info_Funcionario.php"><i class="icon fa fa-dot-circle"></i> Informe por Puesto</a></li>
          <!--Menu Principal del Ruedas-->
          <li><a class="treeview-item" href="../Plantillas/ruedas.php"><i class="icon fa fa-dot-circle"></i> Motos Pendientes</a></li>
          <!--Menu Principal del -->
          <li><a class="treeview-item" href="../Plantillas/ruedas_lib.php"><i class="icon fa fa-dot-circle"></i> Motos Liberadas</a></li>
        </ul>
      </li>
    <?php } ?>

    <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 6) {?>
      <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cogs"></i><span class="app-menu__label">Cinta de Ensamble</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <!--Menu Principal del Cinta de Ensamble>
          <li><a class="treeview-item" href="../Plantillas/introCinta.php"><i class="icon fa fa-file-pdf"></i> Gestión SGS</a></li-->
          <!--Menu Principal del Rol-->
          <li><a class="treeview-item" href="../Informes/info_Cinta.php"><i class="icon fa fa-cogs"></i> Informe Diario</a></li>
          <li><a class="treeview-item" href="../Plantillas/cinta.php"><i class="icon fa fa-cogs"></i> Motos Pendientes</a></li>
          <!--Menu Principal del Rol-->
          <li><a class="treeview-item" href="../Plantillas/cinta_lib.php"><i class="icon fa fa-cogs"></i> Motos Liberadas</a></li>
        </ul>
      </li>
    <?php } ?>
       <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 10) {?>
      <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cogs"></i><span class="app-menu__label">Pre Ensamble/Cinta</span><i class="treeview-indicator fa fa-angle-right"></i></a>
        <ul class="treeview-menu">
          <!--Menu Principal del Cinta de Ensamble>
          <li><a class="treeview-item" href="../Plantillas/introCinta.php"><i class="icon fa fa-file-pdf"></i> Gestión SGS</a></li-->
          <li><a class="treeview-item" href="../Informes/preEnsamble.php"><i class="icon fa fa-cogs"></i> Informe Pre-Ensamble</a></li>
          <!--Menu Principal del Rol-->
          <li><a class="treeview-item" href="../Informes/infoPreCinta.php"><i class="icon fa fa-cogs"></i> Informe Pre-Cinta</a></li>
        </ul>
      </li>
    <?php } ?>
    

    <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 7) {?>
     <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-motorcycle"></i><span class="app-menu__label">Inspección y Control</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
       <!--Menu Principal del Inspección y Control>
       <li><a class="treeview-item" href="../Plantillas/introProbado"><i class="icon fa fa-file-pdf"></i> Presentacion SGC</a></li--->
       <!--Menu Principal del Inspección y Control-->
       <li><a class="treeview-item" href="../Plantillas/orden_Probado.php"><i class="icon fa fa-file-pdf"></i> Trabajos Pendientes</a></li-->
       <li><a class="treeview-item" href="../Plantillas/probado.php"><i class="icon fa fa-motorcycle"></i> Motos Pendientes</a></li>
       <!--Menu Principal de Liberadas-->
       <li><a class="treeview-item" href="../Plantillas/probado_lib.php"><i class="icon fa fa-motorcycle"></i> Motos Liberadas</a></li>
       <!--Menu Principal del Inspección y Control-->
       <li><a class="treeview-item" href="../Plantillas/chapas.php"><i class="icon fa fa-motorcycle"></i> Chapas Utilizadas</a></li>
     </ul>
   </li>
   <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-motorcycle"></i><span class="app-menu__label">Taller de Levante</span><i class="treeview-indicator fa fa-angle-right"></i></a>
    <ul class="treeview-menu">
      
      <li><a class="treeview-item" href="../Plantillas/orden_Deposito.php"><i class="icon fa fa-file-pdf"></i> Trabajos Pendientes</a></li>
      <li><a class="treeview-item" href="../Plantillas/deposito.php"><i class="icon fa fa-motorcycle"></i> Deposito 9 Pendientes</a></li>
      <!--Menu Principal Liberadas-->
      <li><a class="treeview-item" href="../Plantillas/deposito_lib.php"><i class="icon fa fa-motorcycle"></i>Deposito 9 Liberadas</a></li>
      <!--Menu Principal Liberadas-->
      <li><a class="treeview-item" href="../Plantillas/activaciones.php"><i class="icon fa fa-motorcycle"></i> Motos Activadas</a></li>
    </ul>
  </li>
<?php } ?>

<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 8) {?>
  <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-bus"></i><span class="app-menu__label">Cuatro Ruedas</span><i class="treeview-indicator fa fa-angle-right"></i></a>
    <ul class="treeview-menu">
      <!--Menu Principal del Inspección y Control>
      <li><a class="treeview-item" href="../Plantillas/introCuatro_Ruedas"><i class="icon fa fa-file-pdf"></i> Gestión SGS</a></li-->
      <li><a class="treeview-item" href="#" onclick="alerta();"><i class="icon fa fa-bus"></i>Control de Pintura</a></li>
    </ul>
  </li>
<?php  } ?>
<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 9) {?>
<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-box-open"></i><span class="app-menu__label"> Pedidos Externos</span><i class="treeview-indicator fa fa-angle-right"></i></a>
  <ul class="treeview-menu">
    <!--Menu Principal del Inspección y Control-->
    <li><a class="treeview-item" href="../Plantillas/garantia.php"><i class="icon fa fa-people-carry"></i> Pendientes de  Garantia</a></li>
    <li><a class="treeview-item" href="../Plantillas/garantia_Lib.php"><i class="icon fa fa-people-carry"></i> Autorizados de  Garantia</a></li>
    
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