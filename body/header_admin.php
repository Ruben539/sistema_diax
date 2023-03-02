<?php
$sesion = $_SESSION['rol'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="description" content="Tienda Virtual by Rubenfl">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="autor" content="RubenFl">
    <meta name="theme-color" content="#f23">
    <title>Sistema Diax</title>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" type="text/css" href="../css/estilos.css">
    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <link rel="stylesheet" href="../css/reclamos.css">
    
    <!-- Font-icon css-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
    
    
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
     crossorigin="anonymous" referrerpolicy="no-referrer" /> 
     
  </head>
  <body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header">
      <?php if ($sesion == 1 || $sesion == 2 || $sesion == 5 || $sesion == 6) {?>
        <a class="app-header__logo" href="../Plantillas/dashboard.php">Sistema Diax</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a> 
      <?php } ?>

      <?php if ($sesion == 4) {?>
        <a class="app-header__logo" href="../doctores/dashboardDoctores.php">Sistema Diax</a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a> 
      <?php } ?>
      
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
      <?php if ($sesion == 1 ) {?>
        <li class="dropdown"><a id="noti" class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i id="icono" class="fas fa-user-md fa-lg"></i></a>
       
          <ul class="app-notification dropdown-menu dropdown-menu-right">
            <div class="app-notification__content">

              <li><a class="app-notification__item"  href="../Plantillas/eliminacion_medicos.php"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i  class="fa fa-circle fa-stack-2x text-primary"></i>
              <i class="fa fa-user-md fa-stack-1x fa-inverse"></i></span></span>
                  <div>
                    
                  <p class="app-notification__message" id="idMedicos"></p>
                   
                    <p class="app-notification__meta"><?php echo date('d-m-Y'); ?></p>
                  </div></a></li>
            </div>
            <li class="app-notification__footer"><a href="#">Cerrar.</a></li>
          </ul>
        </li>
        <!--Notification Menu-->
       
         
        <li class="dropdown"><a id="noti" class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i id="icono" class="fas fa-bell fa-lg"></i></a>
       
          <ul class="app-notification dropdown-menu dropdown-menu-right">
            <div class="app-notification__content">

              <li><a class="app-notification__item"  href="../Historial/Pedidos_Cancelacion.php"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i  class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                  <div>
                    
                  <p class="app-notification__message" id="idNotificacion"></p>
                   
                    <p class="app-notification__meta"><?php echo date('d-m-Y'); ?></p>
                  </div></a></li>
            </div>
            <li class="app-notification__footer"><a href="#">Cerrar </a></li>
          </ul>
        </li>
      <?php } ?>
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <?php if ($sesion == 1 || $sesion == 2) {?>
            <li><a class="dropdown-item" href="../Plantillas/configuracion.php"><i class="fa fa-cog fa-lg"></i> Configuración</a></li>
            
            <li><a class="dropdown-item" href="../Plantillas/perfil.php"><i class="fa fa-user fa-lg"></i> Perfil</a></li>
              
            <li><a class="dropdown-item" href="../Plantillas/salir.php"><i class="fa fa-sign-out-alt"></i> Cerrar Sesión</a></li>
            <?php } ?>

            <?php if ( $sesion == 4) {?>
            <li><a class="dropdown-item" href="../doctores/salir.php"><i class="fa fa-sign-out-alt"></i> Cerrar Sesión</a></li>
          
            <?php } ?>
            
          </ul>
        </li>
      </ul>
    </header>

  <?php require_once("nav_admin.php");  ?>
  <script src="../bootstrap//dist/js/bootstrap.min.js"></script>
scr
  
    