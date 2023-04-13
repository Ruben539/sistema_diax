<?php 

require_once("../Modelos/conexion.php");
if($_SESSION['rol'] == 4){
  $nombre = $_SESSION['Nombre'];
  $especialidad = $_SESSION['Especialidad'];
}else{
  $nombre = $_SESSION['nombre'];
}


?>


   <!-- Sidebar menu-->
      <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
      <aside class="app-sidebar">
      <a href="#" onclick="alerta();">
        <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="../images/user.png">
          <div>
              <p class="app-sidebar__user-name" style="font-size: 14px;"><?php echo $nombre; ?></p>
            <?php if($_SESSION['rol'] == 4){ ?>
              <p class="app-sidebar__user-designation"><?php echo $especialidad; ?></p>
            <?php }?>
          </div>
        </div>
        </a>
   
    <ul class="app-menu">  
    <?php if ($_SESSION['rol'] == 1) {?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Usuarios</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <!--Menu Principal del Usuario-->
            <li><a class="treeview-item" href="../Plantillas/usuarios.php"><i class="icon fa fa-users"></i> Usuarios Activos</a></li>
            <li><a class="treeview-item" href="../Plantillas/usuario_trash.php"><i class="icon fa fa-users"></i> Usuarios Inactivos</a></li>
            <!--Menu Principal del Usuario-->
            
          </ul>
        </li>
        
        <?php  } ?>  
        <?php if ($_SESSION['rol'] == 1) {?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Clientes</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <!--Menu Principal del Usuario-->
            <li><a class="treeview-item" href="../Plantillas/Clientes.php"><i class="icon fa fa-users"></i> Buscar Cliente</a></li>
            <!--Menu Principal del Usuario-->
            
          </ul>
        </li>
        
        <?php  } ?> 

        <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-plus"></i><span class="app-menu__label">Pacientes</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <!--Menu Principal del los Pacientes-->
            <li><a class="treeview-item" href="../Plantillas/registro_pacientes.php"><i class="icon fa fa-user-plus"></i> Registro de Pacientes</a></li>
            <li><a class="treeview-item" href="../Plantillas/pacientes.php"><i class="icon fa fa-user-plus"></i> Lista de Pacientes</a></li>
            <li><a class="treeview-item" href="../Historial/historialPaciente.php"><i class="icon fa fa-user-plus"></i> Historial Pacientes</a></li>
            <!--Menu Principal del Pacientes-->
            
          </ul>
        </li>
        <?php  } ?> 

        <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 ) {?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-address-book-o"></i><span class="app-menu__label">Comprobantes</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <!--Menu Principal de la lista de Comprobantes-->
            <li><a class="treeview-item" href="../Plantillas/comprobantes.php"><i class="icon fa fa-list"></i>Comprobantes</a></li>
            <li><a class="treeview-item" href="../Plantillas/reporte_comprobante.php"><i class="icon fa fa-file-pdf-o"></i>Reporte de Comprobantes</a></li>
            <li><a class="treeview-item" href="../Plantillas/reporte_diarios.php"><i class="icon fa fa-file-pdf-o"></i>Reporte de Diarios</a></li>
            <!--Menu Principal de la lista de Comprobantes-->
            
          </ul>
        </li>
        
        <?php  } ?>

        <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 ) {?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-times"></i><span class="app-menu__label">Cancelaciones</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <!--Menu Principal de la lista de Comprobantes-->
            <li><a class="treeview-item" href="../Historial/CancelarOrden.php"><i class="icon fa fa-user-times"></i>Buscar Orden</a></li>
            <li><a class="treeview-item" href="../Historial/Ordenes_canceladas.php"><i class="icon fa fa-user-times"></i>Ordenes Canceladas</a></li>
            <li><a class="treeview-item" href="../Historial/Pedidos_Cancelacion.php"><i class="icon fa fa-user-times"></i>Pedidos de Cancelación</a></li>
            <!--Menu Principal de la lista de Comprobantes-->
            
          </ul>
        </li>
        
        <?php  } ?>

        <?php if ($_SESSION['rol'] == 1 ) {?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-md"></i><span class="app-menu__label">Medicos</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <!--Menu Principal de los Medicos-->
            
            <li><a class="treeview-item" href="../Plantillas/medicos.php"><i class="icon fa fa-user-md"></i> Lista de Medicos</a></li>
            <li><a class="treeview-item" href="../Historial/historialMedico.php"><i class="icon fa fa-user-md"></i> Historial de Medicos</a></li>
            <li><a class="treeview-item" href="../Plantillas/reporte_medicos.php"><i class="icon fa fa-user-md"></i> Ingresos de Medicos</a></li>
            <li><a class="treeview-item" href="../Plantillas/eliminacion_medicos.php"><i class="icon fa fa-user-md"></i> Pedidos de Eliminación</a></li>
            <!--Menu Principal de los Medicos-->
          </ul>
        </li>
        <?php  } ?> 

        <?php if ($_SESSION['rol'] == 2) {?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-md"></i><span class="app-menu__label">Medicos</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <!--Menu Principal de los Medicos-->
            
             <li><a class="treeview-item" href="../Plantillas/medicos.php"><i class="icon fa fa-user-md"></i> Lista de Medicos</a></li>
            <li><a class="treeview-item" href="../Historial/historialMedico.php"><i class="icon fa fa-user-md"></i> Historial de Medicos</a></li>
            <!--Menu Principal de los Medicos-->
          </ul>
        </li>
        <?php  } ?>

        <?php if ($_SESSION['rol'] == 5 || $_SESSION['rol'] == 6) {?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-md"></i><span class="app-menu__label">Medicos</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <!--Menu Principal de los Medicos-->
            <li><a class="treeview-item" href="../Plantillas/medicos.php"><i class="icon fa fa-user-md"></i> Lista de Medicos</a></li>
            <!--Menu Principal de los Medicos-->
          </ul>
        </li>
        <?php  } ?> 

        <?php if ( $_SESSION['rol'] == 4) {?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Pacientes</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <!--Menu Principal del Doctores-->
            <li><a class="treeview-item" href="../doctores/lista_pacientes.php"><i class="icon fa fa-users"></i>Pacientes en  Atendidos</a></li>
            <li><a class="treeview-item" href="../doctores/historialPacientes.php"><i class="icon fa fa-users"></i> Historial de Pacientes</a></li>
            <li><a class="treeview-item" href="../doctores/informesPacientes.php"><i class="icon fa fa-users"></i> Informe de Pacientes</a></li>
            <!--Menu Principal del Doctores-->
            
          </ul>
        </li>
        
        <?php  } ?>

        <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 5 ) {?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-plus"></i><span class="app-menu__label">Informantes Fabiola</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <!--Menu Principal del Informantes-->
            <li><a class="treeview-item" href="../Historial/AsignarInformante_fabiola.php"><i class="icon fa fa-user-plus"></i> Buscar Paciente</a></li>
            <li><a class="treeview-item" href="../Historial/PendientesAsignacionFabiola.php"><i class="icon fa fa-user-plus"></i> Pendientes</a></li>
            <!--Menu Principal del Informantes-->
            <?php if ($_SESSION['rol'] == 1) {?>
              <li><a class="treeview-item" href="../Historial/HistorialInformante.php"><i class="icon fa fa-money"></i> Rendicion Informante Fabiola</a></li>
              <?php  } ?>
            
          </ul>
        </li>
        
        <?php  } ?>
        <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 6) {?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-plus"></i><span class="app-menu__label">Informantes Elena</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <!--Menu Principal del Informantes-->
            <li><a class="treeview-item" href="../Historial/AsignarInformante_elena.php"><i class="icon fa fa-user-plus"></i> Buscar Paciente</a></li>
            <li><a class="treeview-item" href="../Historial/PendientesAsignacionElena.php"><i class="icon fa fa-user-plus"></i> Pendientes</a></li>
            <!--Menu Principal del Informantes-->
            <?php if ($_SESSION['rol'] == 1) {?>
              <li><a class="treeview-item" href="../Historial/HistorialInformante.php"><i class="icon fa fa-money"></i> Rendicion Informante</a></li>
              <?php  } ?>
            
          </ul>
        </li>
        
        <?php  } ?>

        <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-money"></i><span class="app-menu__label">Administración </span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <!--Menu Principal de los Gastos-->
           
            <li><a class="treeview-item" href="../Plantillas/ingreso.php"><i class="icon fa fa-money"></i> Movimientos de Ingreso</a></li>
            <li><a class="treeview-item" href="../Plantillas/egresos.php"><i class="icon fa fa-money"></i> Movimientos de Egreso</a></li>
            <li><a class="treeview-item" href="../Plantillas/deposito.php"><i class="icon fa fa-money"></i> Movimientos de Depositos</a></li>
            <!--Menu Principal de los Gastos-->
          </ul>
        </li>
        
        <?php  } ?>

        <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-money"></i><span class="app-menu__label">Gastos Recepción </span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <!--Menu Principal de los Gastos-->
            <li><a class="treeview-item" href="../Plantillas/gastos.php"><i class="icon fa fa-money"></i> Lista de Gastos</a></li>
            <?php if ($_SESSION['rol'] == 1 ) {?>
            <li><a class="treeview-item" href="../Historial/Pedidos_Gastos.php"><i class="icon fa fa-money"></i>Pedidos de Cancelación</a></li>
            <li><a class="treeview-item" href="../Plantillas/gastos_cancelados.php"><i class="icon fa fa-money"></i>Gastos Cancelados</a></li>
            <!--Menu Principal de los Gastos-->
            <?php }?>
          </ul>
        </li>
        
        <?php  } ?>

        <?php if ($_SESSION['rol'] == 1) {?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-md"></i><span class="app-menu__label">Estudios</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <!--Menu Principal de la lista de Estudios-->
            <li><a class="treeview-item" href="../Plantillas/estudios.php"><i class="icon fa fa-user-md"></i> Lista de Estudios</a></li>
            <li><a class="treeview-item" href="../Plantillas/estudio_inactivos.php"><i class="icon fa fa-user-md"></i> Estudios Inactivos</a></li>
            <li><a class="treeview-item" href="../Informes/cantidad_estudios.php"><i class="icon fa fa-user-md"></i> Cantidad de Estudios</a></li>
            <!--Menu Principal de la lista de Estudios-->
            
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