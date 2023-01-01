<?php
session_start();
if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 3){
    if (empty($_SESSION['active'])) {
    header('location: ../Plantillas/salir.php');
}

}else{
  header('location: ../Plantillas/salir.php');  
}

require_once("../Modelos/conexion.php");

require_once("../body/header_admin.php");
?>

<main class="app-content">
      <div class="app-title">
        <div>
    
          <?php if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 3){?>
          <h1><i class="fa fa-th-list"></i> Cumplimiento Diario - Herreria  <a href="../infoHelpers/grabar_metaHerreria.php"> 
        <button id="btnNew"  class="btn btn-primary" type="button"><i class="fa fa-plus-circle" aria-hidden="true"></i>
         Nuevo</button></a>
        </h1>
         <?php }?>
          <p>Registro Web en Desarrollo</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-book fa-lg"></i></li>
          <li class="breadcrumb-item active"><a href="../VistasInfo/excelInfo_Herreria.php">Excel</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
              <div class="table-responsive">
                 <table id="tabla_Herreria" class="table table-striped table-bordered table-condensed" style="width:100%">
                  <thead>
                    <tr>
                        
                            <th>Fecha</th>
                            <th>Modelo</th>
                            <th>Nro Partida</th>
                            <th>Caballete</th>
                            <th>Manubrio</th>
                            <th>Posapie Central</th>
                            <th>Posapie Trasero IZQ. </th>
                            <th>Posapie Trasero DER.</th>
                            <th>Soporte p/Bateria</th>
                            <th>S. Adorno Posapie</th>
                            <th>Portta Bulto</th>
                            <th>Chasis</th>
                            <th>Tanque</th>
                            <th>Observacion</th>
                            <th>Usuario</th>
                            <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 3) {?>
                            <th>Editar</th>
                            <?php } ?>    
                        </tr>
                  </thead>

                  <tbody>
                      <?php 
                        $sql = mysqli_query($conection,"SELECT id_infoHerreria,fecha_add,nro_partida,modelo,diferencia_varilla,diferencia_sosten,diferencia_horquilla,
		                  	diferencia_caballete,diferencia_posapie,diferencia_manubrio,diferencia_mandil,diferencia_posapie1,diferencia_posapie2,diferencia_motor,diferencia_bateria,diferencia_cutanque,
		                  	diferencia_velocimetro,diferencia_adorno,diferencia_bulto,diferencia_chasis,diferencia_freno,diferencia_tanque,observacion,usuario from infoherreria where estatus = 1");

                         $resultado = mysqli_num_rows($sql);

                         if($resultado > 0){ 
                            while ($data = mysqli_fetch_array($sql)){ 
                      ?>
                        <tr class="text-center">
                             <td><?php echo $data['fecha_add'];?></td>
 						                 <td><?php echo $data['modelo'];?></td>
                             <td><?php echo $data['nro_partida'];?></td> 
                             <?php if (-$data['diferencia_caballete']) {?>                           
 						                 <td style="background: #f23; color:#fff;"><?php echo $data['diferencia_caballete']; ?></td>
                             <?php }else{ ?>
                              <td style="background: green; color:#fff;"><?php echo $data['diferencia_caballete']; ?></td> 
                              <?php } ?> 
                              <?php if (-$data['diferencia_posapie']) {?>                           
 						                 <td style="background: #f23; color:#fff;"><?php echo $data['diferencia_posapie']; ?></td>
                             <?php }else{ ?>
                              <td style="background: green; color:#fff;"><?php echo $data['diferencia_posapie']; ?></td> 
                              <?php } ?> 
                              <?php if (-$data['diferencia_manubrio']) {?>                           
 						                 <td style="background: #f23; color:#fff;"><?php echo$data['diferencia_manubrio']; ?></td>
                             <?php }else{ ?>
                              <td style="background: green; color:#fff;"><?php echo $data['diferencia_manubrio']; ?></td> 
                              <?php } ?> 
                               <?php if (-$data['diferencia_posapie1']) {?>                           
 						                 <td style="background: #f23; color:#fff;"><?php echo $data['diferencia_posapie1']; ?></td>
                             <?php }else{ ?>
                              <td style="background: green; color:#fff;"><?php echo  $data['diferencia_posapie1']; ?></td> 
                              <?php } ?> 
                             <?php if (-$data['diferencia_posapie2']) {?>                           
 						                 <td style="background: #f23; color:#fff;"><?php echo $data['diferencia_posapie2']; ?></td>
                             <?php }else{ ?>
                              <td style="background: green; color:#fff;"><?php echo  $data['diferencia_posapie2']; ?></td> 
                              <?php } ?> 
                              <?php if (-$data['diferencia_bateria']) {?>                           
 						                 <td style="background: #f23; color:#fff;"><?php echo  $data['diferencia_bateria']; ?></td>
                             <?php }else{ ?>
                              <td style="background: green; color:#fff;"><?php echo   $data['diferencia_bateria']; ?></td> 
                              <?php } ?> 
                              <?php if (-$data['diferencia_adorno']) {?>                           
 						                 <td style="background: #f23; color:#fff;"><?php echo  $data['diferencia_adorno']; ?></td>
                             <?php }else{ ?>
                              <td style="background: green; color:#fff;"><?php echo  $data['diferencia_adorno']; ?></td> 
                              <?php } ?> 
                              <?php if (-$data['diferencia_bulto']) {?>                           
 						                 <td style="background: #f23; color:#fff;"><?php echo  $data['diferencia_bulto']; ?></td>
                             <?php }else{ ?>
                              <td style="background: green; color:#fff;"><?php echo $data['diferencia_bulto']; ?></td> 
                              <?php } ?> 
                              <?php if (-$data['diferencia_chasis']) {?>                           
 						                 <td style="background: #f23; color:#fff;"><?php echo $data['diferencia_chasis']; ?></td>
                             <?php }else{ ?>
                              <td style="background: green; color:#fff;"><?php echo $data['diferencia_chasis']; ?></td> 
                              <?php } ?> 
                              
                            <?php if (-$data['diferencia_tanque']) {?>                           
 						                 <td style="background: #f23; color:#fff;"><?php echo $data['diferencia_tanque']; ?></td>
                             <?php }else{ ?>
                              <td style="background: green; color:#fff;"><?php echo $data['diferencia_tanque']; ?></td> 
                              <?php } ?> 
                             <td><?php echo $data['observacion']; ?></td>
                             <td><?php echo $data['usuario']; ?></td>

  <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {?>
    <td>
		<a href="../infoHelpers/grabar_totalHerreria.php?id=<?php echo $data['id_infoHerreria']; ?>"class="btn btn-outline-info" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px  rgba(0, 0, 0, 0.25);"><i class="fas fa-edit"></i></a>
    </td>
    <?php } ?>

	<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 3) {?>
    <td>
		<a href="../infoHelpers/grabar_totalHerreria.php?id=<?php echo $data['id_infoHerreria']; ?>"class="btn btn-outline-info" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px  rgba(0, 0, 0, 0.25);"><i class="fas fa-edit"></i></a>
    </td>
    <?php } ?>
                           

                          
                        </tr>
                     
                 
                  <?php }
                } ?>
                 </tbody>
                </table>
              </div>
            </div>
        </div>
      </div>
    </main>
    
<script type="text/javascript" src="../js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>
<script src="../js/sweetalert2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
    tablaHerreria = $("#tabla_Herreria").DataTable({
       "columnDefs":[{
        "target": 1,
        "data":null
       }],
        
        //Para cambiar el lenguaje a español
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
        
});
</script>

<script>
  function permisoAuto(){
	Swal.fire(
		'Lo Siento',
		'No puede crear un Registro en esta Tabla',
		'error'
		)
}
</script>


