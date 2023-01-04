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
          <h1>Ssitema web Diax</h1>
          <p>Registro de Pacientes</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Pagina de Inicio</a></li>
        </ul>
      </div>
      
          <div class="tile">
            <div class="tile-body"><B>CANTIDAD DE PACIENTES DEL MES</B></div>
          </div>

          <div class="row">
            <!--widgets de Desembalado-->
        <div class="col-md-3">
          <div class="widget-small danger"><i class="icon fa fa-cube fa-3x"></i>
            <div class="info">
            <h4><a class="link" href="../Plantillas/pacientes.php">Pacientes</a></h4>
            
              <p id="idPaciente" class="text-center" style="font-size: 50px;"><b>0</b></p>
             
              
            </div>
          </div>
        </div>

        
      </div>
     

       <div class="tile">
            <div class="tile-body"><B>CANTIDAD DE PACIENTES DEL AÑO</B></div>
        </div>
      <!--widgets de Desembalado-->
      <div class="row">
        <div class="col-md-3">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-cube fa-3x"></i>
            <div class="info">
              <h4>Pacientes</h4>
              <p id="idPaciente" class="text-center" style="font-size: 50px;"><b>0</b></p>
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
