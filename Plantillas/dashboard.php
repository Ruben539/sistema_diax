<?php 
 session_start();
 if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 ){
  if (empty($_SESSION['active'])) {
  header('location: salir.php');
}

}else{
  header('location: salir.php');
}


require_once("../body/header_admin.php");
 ?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><img src="../images/alexlogo.png" alt=""></h1>
          <p>Registro de Fallas en Desarrollo</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Pagina de Inicio</a></li>
        </ul>
      </div>
      
          <div class="tile">
            <div class="tile-body">CANTIDAD DE MOTOS PENDIENTES POR SECTOR</B></div>
          </div>

          <div class="row">
            <!--widgets de Desembalado-->
        <div class="col-md-3">
          <div class="widget-small danger"><i class="icon fa fa-cube fa-3x"></i>
            <div class="info">
            <h4><a class="link" href="../Plantillas/reclamos.php">Desembalado</a></h4>
            
              <p id="idDesembalado" class="text-center" style="font-size: 50px;"><b>0</b></p>
             
              
            </div>
          </div>
        </div>
         <!--widgets de Herreria-->
        <div class="col-md-3">
          <div class="widget-small danger"><i class="icon fa fa-bolt fa-3x"></i>
            <div class="info">
              <h4><a class="link" href="../Plantillas/herreria.php">Herreria</a></h4>
              <p id="idHerreria" class="text-center" style="font-size: 50px;"><b>0</b></p>
            </div>
          </div>
        </div>
         <!--widgets de Pintura-->
        <div class="col-md-3">
          <div class="widget-small danger"><i class="icon fa fa-paint-brush fa-3x"></i>
            <div class="info">
              <h4><a class="link" href="../Plantillas/pintura.php">Pintura</a></h4>
              <p id="idPintura" class="text-center" style="font-size: 50px;"><b>0</b></p>
            </div>
          </div>
        </div>
         <!--widgets de Ruedas-->
        <div class="col-md-3">
          <div class="widget-small danger"><i class="icon fa fa-dot-circle fa-3x"></i>
            <div class="info">
              <h4><a class="link" href="../Plantillas/ruedas.php">Ruedas</a></h4>
              <p id="idRuedas" class="text-center" style="font-size: 50px;"><b>0</b></p>
            </div>
          </div>
        </div>
      </div>
       <!--Fin del Primer widgets-->
        <!--widgets de Inicio-->
      <div class="row">
         <!--widgets de Cinta-->
        <div class="col-md-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-user-cog fa-3x"></i>
            <div class="info">
              <h4><a class="link_1" href="../Plantillas/cinta.php">C. Ensamble</a></h4>
              <p id="idCinta" class="text-center" style="font-size: 50px;"><b>0</b></p>
            </div>
          </div>
        </div>
         <!--widgets de Inspeccion-->
        <div class="col-md-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-motorcycle fa-3x"></i>
            <div class="info">
              <h4><a class="link_1" href="../Plantillas/probado.php">Insp y Control</a></h4>
              <p id="idProbado" class="text-center" style="font-size: 50px;"><b>0</b></p>
            </div>
          </div>
        </div>
         <!--widgets de Taller de Levante-->
        <div class="col-md-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-motorcycle fa-3x"></i>
            <div class="info">
              <h4><a class="link_1" href="../Plantillas/deposito.php">T. de Levante</a></h4>
              <p id="idDeposito" class="text-center" style="font-size: 50px;"><b>0</b></p>
            </div>
          </div>
        </div>
         <!--widgets de 4Ruedas-->
        <div class="col-md-3">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-bus fa-3x"></i>
            <div class="info">
              <h4><a class="link_1"  href="#" onclick="permisoAuto();">Cuatro Ruedas</a></h4>
              <p id="idCuatroR" class="text-center" style="font-size: 50px;"><b>0</b></p>
            </div>
          </div>
        </div>
      </div>

       <div class="tile">
            <div class="tile-body"><B>CANTIDAD DE MOTOS LIBERADAS POR SECTOR</B></div>
        </div>
      <!--widgets de Desembalado-->
      <div class="row">
        <div class="col-md-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-cube fa-3x"></i>
            <div class="info">
              <h4>Desembalado</h4>
              <p id="idDesembalado_lib" class="text-center" style="font-size: 50px;"><b>0</b></p>
            </div>
          </div>
        </div>
         <!--widgets de Herreria-->
        <div class="col-md-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-bolt fa-3x"></i>
            <div class="info">
              <h4><a class="link_1" href="../Plantillas/herreria_lib.php">Herreria</a></h4>
              <p id="idHerreria_lib" class="text-center" style="font-size: 50px;"><b>0</b></p>
            </div>
          </div>
        </div>
         <!--widgets de Pintura-->
        <div class="col-md-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-paint-brush fa-3x"></i>
            <div class="info">
              <h4><a class="link_1" href="../Plantillas/pintura_lib.php">Pintura</a></h4>
              <p id="idPintura_lib" class="text-center" style="font-size: 50px;"><b>0</b></p>
            </div>
          </div>
        </div>
         <!--widgets de Ruedas-->
        <div class="col-md-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-dot-circle fa-3x"></i>
            <div class="info">
              <h4><a class="link_1" href="../Plantillas/ruedas_lib.php">Ruedas</a></h4>
              <p id="idRuedas_lib" class="text-center" style="font-size: 50px;"><b>0</b></p>
            </div>
          </div>
        </div>
      </div>
       <!--Fin del Primer widgets-->
        <!--widgets de Inicio-->
      <div class="row">
         <!--widgets de Cinta-->
        <div class="col-md-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-cogs fa-3x"></i>
            <div class="info">
              <h4><a class="link_1" href="../Plantillas/cinta_lib.php">C. Ensamble</a></h4>
              <p id="idCinta_lib" class="text-center" style="font-size: 50px;"><b>0</b></p>
            </div>
          </div>
        </div>
         <!--widgets de Inspeccion-->
        <div class="col-md-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-motorcycle fa-3x"></i>
            <div class="info">
              <h4><a class="link_1" href="../Plantillas/probado_lib.php">Insp y Control</a></h4>
              <p id="idProbado_lib" class="text-center" style="font-size: 50px;"><b>0</b></p>
            </div>
          </div>
        </div>
         <!--widgets de Taller de Levante-->
        <div class="col-md-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-motorcycle fa-3x"></i>
            <div class="info">
              <h4><a class="link_1" href="../Plantillas/deposito_lib.php">T. de Levante</a></h4>
              <p name="rq" id="idDeposito_lib" class="text-center" style="font-size: 50px;"><b>0</b></p>
            </div>
          </div>
        </div>
         <!--widgets de 4Ruedas-->
        <div class="col-md-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-bus fa-3x"></i>
            <div class="info">
              <h4><a class="link_1" href="#" onclick="permisoAuto();">Cuatro Ruedas</a></h4>
              <p id="idCuatroR_lib" class="text-center" style="font-size: 50px;"><b>0</b></p>
            </div>
          </div>
        </div>
      </div>

      <script src="../js/funciones.js"></script>
      <script>
  function permisoAuto(){
	Swal.fire(
		'Lo Siento',
		'Pagina web no Disponible',
		'error'
		)
}
</script>
