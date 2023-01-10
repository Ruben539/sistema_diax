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
          <h1>Sistema Diax</h1>
          <p>Registro web  de Pacientes en Desarrollo</p>
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
          <div class="widget-small primary"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
            <h4><a class="link" href="../Plantillas/pacientes.php">Pacientes</a></h4>
            
              <p id="idPaciente" class="text-center" style="font-size: 50px;"><b>0</b></p>
             
              
            </div>
          </div>
        </div>

        
      </div>
    

      <div class="tile">
            <div class="tile-body"><B>LISTA DE PACIENTES DEL DIA-PAZ</B></div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
              <div class="table-responsive">
                 <table id="tabla_Usuario" class="table table-striped table-bordered table-condensed" style="width:100%">
                  <thead>
                    <tr class="text-center">
                            
                            <th>Estudio</th>
                            <th>Cedula</th>
                            <th>Doctor</th>
                            <th>Fecha</th>
                            <th>Seguro</th>                                
                            <th>Monto</th>                                
                            <th>Descuento</th>                                
                            <th>MontoS</th>                                
                            <th>Fceha 2</th>                                
                   
                        </tr>
                  </thead>

                  <tbody>
                      <?php 
                    // $fecha1 = "05-01-2023";
                     $fecha =  date('d-m-Y');
                    //  echo $fecha1." ".$fecha2;
                    //  exit;
                        $sql = mysqli_query($conection,"SELECT h.id,h.Estudio,h.Cedula,h.Atendedor,h.Fecha,h.Seguro,h.Monto,h.Descuento,h.MontoS, h.fecha_2 FROM historial h 
                        where h.Fecha like '%$fecha%' AND h.Atendedor like '%PAZ%'  ORDER BY  h.id DESC");

                         $resultado = mysqli_num_rows($sql);

                         if($resultado > 0){ 
                            while ($data = mysqli_fetch_array($sql)){ 
                      ?>
                        <tr class="text-center">
                             <td><?php echo $data['Estudio'];?></td>
 						                 <td><?php echo $data['Cedula'];?></td>
 						                 <td><?php echo $data['Atendedor'];?></td>
 						                 <td><?php echo $data['Fecha']; ?></td>
                             <td><?php echo $data['Seguro']?></td>
                             <td><?php echo $data['Monto']?></td>
                             <td><?php echo $data['Descuento']?></td>
                             <td><?php echo $data['MontoS']?></td>
                             <td><?php echo $data['fecha_2']?></td>
 					        
                           
                           
                        </tr>
                     
                 
                  <?php }
                } ?>
                 </tbody>
                </table>
              </div>
            </div>
        </div>
      </div>

      <div class="tile">
            <div class="tile-body"><B>LISTA DE PACIENTES DEL DIA-DIAX</B></div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
              <div class="table-responsive">
                 <table id="tabla_Usuario" class="table table-striped table-bordered table-condensed" style="width:100%">
                  <thead>
                    <tr class="text-center">
                            
                            <th>Estudio</th>
                            <th>Cedula</th>
                            <th>Doctor</th>
                            <th>Fecha</th>
                            <th>Seguro</th>                                
                            <th>Monto</th>                                
                            <th>Descuento</th>                                
                            <th>MontoS</th>                                
                            <th>Fceha 2</th>                                
                   
                        </tr>
                  </thead>

                  <tbody>
                      <?php 
                    // $fecha1 = "05-01-2023";
                     $fecha =  date('d-m-Y');
                    //  echo $fecha1." ".$fecha2;
                    //  exit;
                        $sql = mysqli_query($conection,"SELECT h.id,h.Estudio,h.Cedula,h.Atendedor,h.Fecha,h.Seguro,h.Monto,h.Descuento,h.MontoS, h.fecha_2 FROM historial h 
                        where h.Fecha like '%$fecha%' AND h.Atendedor like '%DIAX%'  ORDER BY  h.id DESC");

                         $resultado = mysqli_num_rows($sql);

                         if($resultado > 0){ 
                            while ($data = mysqli_fetch_array($sql)){ 
                      ?>
                        <tr class="text-center">
                             <td><?php echo $data['Estudio'];?></td>
 						                 <td><?php echo $data['Cedula'];?></td>
 						                 <td><?php echo $data['Atendedor'];?></td>
 						                 <td><?php echo $data['Fecha']; ?></td>
                             <td><?php echo $data['Seguro']?></td>
                             <td><?php echo $data['Monto']?></td>
                             <td><?php echo $data['Descuento']?></td>
                             <td><?php echo $data['MontoS']?></td>
                             <td><?php echo $data['fecha_2']?></td>
 					        
                           
                           
                        </tr>
                     
                 
                  <?php }
                } ?>
                 </tbody>
                </table>
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
