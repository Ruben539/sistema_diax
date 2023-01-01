<?php
session_start();
  if (empty($_SESSION['active'])) {
    header('location: salir.php');
}




require_once("../Modelos/conexion.php");

require_once("../body/header_admin.php");
?>

<main class="app-content">
      <div class="app-title">
        <div>
      <?php if($_SESSION['rol'] == 9){?>
          <h1><i class="fa fa-th-list"></i> Orden de Trabajos <a href="../OT/grabar_OtDesembalado.php"> 
        <button id="btnNew"  class="btn btn-primary" type="button"><i class="fa fa-plus-circle" aria-hidden="true"></i>
         Nuevo</button></a>
        </h1>
       <?php }?>
       <?php if( $_SESSION['rol'] == 3){?>
          <h1><i class="fa fa-th-list"></i> Orden de Trabajos <a href="../OT/grabar_otHerreria.php"> 
        <button id="btnNew"  class="btn btn-primary" type="button"><i class="fa fa-plus-circle" aria-hidden="true"></i>
         Nuevo</button></a>
        </h1>
       <?php }?>
       <?php if($_SESSION['rol'] == 4){?>
          <h1><i class="fa fa-th-list"></i> Orden de Trabajos <a href="../OT/grabar_otPintura.php"> 
        <button id="btnNew"  class="btn btn-primary" type="button"><i class="fa fa-plus-circle" aria-hidden="true"></i>
         Nuevo</button></a>
        </h1>
       <?php }?>
       <?php if($_SESSION['rol'] == 5){?>
          <h1><i class="fa fa-th-list"></i> Orden de Trabajos <a href="../OT/grabar_otRuedas.php"> 
        <button id="btnNew"  class="btn btn-primary" type="button"><i class="fa fa-plus-circle" aria-hidden="true"></i>
         Nuevo</button></a>
        </h1>
       <?php }?>
       <?php if($_SESSION['rol'] == 6){?>
          <h1><i class="fa fa-th-list"></i> Orden de Trabajos <a href="../OT/grabar_otCinta.php"> 
        <button id="btnNew"  class="btn btn-primary" type="button"><i class="fa fa-plus-circle" aria-hidden="true"></i>
         Nuevo</button></a>
        </h1>
       <?php }?>
       <?php if($_SESSION['rol'] == 7){?>
          <h1><i class="fa fa-th-list"></i> Orden de Trabajos <a href="../OT/grabar_otProbado.php"> 
        <button id="btnNew"  class="btn btn-primary" type="button"><i class="fa fa-plus-circle" aria-hidden="true"></i>
         Nuevo</button></a>
        </h1>
       <?php }?>
       <?php if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2){?>
          <h1><i class="fa fa-th-list"></i> Orden de Trabajos <a href="../OT/grabar_otSupervision.php"> 
        <button id="btnNew"  class="btn btn-primary" type="button"><i class="fa fa-plus-circle" aria-hidden="true"></i>
         Nuevo</button></a>
        </h1>
       <?php }?>

          <p>Registro Web en Desarrollo</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-book fa-lg"></i></li>
          <li class="breadcrumb-item active"><a href="../VistasInfo/excelOt_Pendientes.php">Excel</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
              <div class="table-responsive">
                 <table id="tabla_Cinta" class="table table-striped table-bordered table-condensed" style="width:100%">
                  <thead>
                    <tr>
                            <th>N° de Orden</th>
                            <th>Fecha</th>
                            <th>Generado Por</th>
                            <th>Modelo</th>
                            <th>Nro Partida</th>                              
                            <th>Observacion</th>
                            <th>Sector</th>  
                            <th>Herreria</th>    
                            <th>Pintura</th>
                            <th>Probado</th>
                            <th>Garantia</th>
                            <th>Editar</th>
                             
                        </tr>
                  </thead>

                  <tbody>
                      <?php 
                                   
                        $sql = mysqli_query($conection,"SELECT id_orden,fecha_add,modelo,nro_partida,observacion,usuario_1,sector_1,sector_2
                         from orden_trabajo WHERE estatus != 0");

                         $resultado = mysqli_num_rows($sql);
                    
                         if($resultado > 0){ 
                            while ($data = mysqli_fetch_array($sql)){ 
                      ?>
                        <tr>
                             <td><?php echo $data['id_orden'];?></td>
                             <td><?php echo $data['fecha_add'];?></td>
                             <td><?php echo $data['usuario_1']; ?></td>
 						                 <td><?php echo $data['modelo'];?></td>
 						                 <td><?php echo $data['nro_partida']; ?></td>  
                             <td><?php echo $data['observacion']; ?></td> 
                             <td><?php echo $data['sector_1']; ?></td> 


                           
  <?php if($data['sector_2'] != "HERRERIA"){?>
    <td>
		<a href="../OT/modificar_Herreria.php?id=<?php echo $data['id_orden']; ?>"class="btn btn-outline-danger" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px  rgba(0, 0, 0, 0.25);"><i class="fas fa-bolt"></i></a>
    </td>
  <?php }else{?>
    <td>
		<a href="#" onclick="errorAuto();" class="btn btn-outline-danger" style="color: #ccc; border:none;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px  rgba(0, 0, 0, 0.25);"><i class="fas fa-bolt"></i></a>
    </td>
    <?php }?>

    <?php if($data['sector_2'] != "PINTURA"){?>
    <td>
		<a href="../OT/modificar_Pintura.php?id=<?php echo $data['id_orden']; ?>"class="btn btn-outline-info" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px  rgba(0, 0, 0, 0.25);"><i class="fas fa-paint-brush"></i></a>
    </td>
  <?php }else{?>
    <td>
    <a href="#" onclick="errorAuto();" class="btn btn-outline-info" style="color:#ccc; border:none;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px  rgba(0, 0, 0, 0.25);"><i class="fas fa-paint-brush"></i></a>
    </td>
    <?php }?>

    <?php if($data['sector_2'] != "PROBADO"){?>
    <td>
		<a href="../OT/modificar_Probado.php?id=<?php echo $data['id_orden']; ?>"class="btn btn-outline-info" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px  rgba(0, 0, 0, 0.25);"><i class="fas fa-motorcycle"></i></a>
    </td>
  <?php }else{?>
    <td>
    <a href="#" onclick="errorAuto();" class="btn btn-outline-info" style="color:#ccc; border:none;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px  rgba(0, 0, 0, 0.25);"><i class="fas fa-motorcycle"></i></a>
    </td>
    <?php }?>

    <?php if($data['sector_2'] != "TALLER LEVANTE"){?>
    <td>
		<a href="../OT/modificar_otDeposito.php?id=<?php echo $data['id_orden']; ?>"class="btn btn-outline-info" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px  rgba(0, 0, 0, 0.25);"><i class="fas fa-motorcycle"></i></a>
    </td>
  <?php }else{?>
    <td>
    <a href="#" onclick="errorAuto();" class="btn btn-outline-info" style="color:#ccc; border:none;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px  rgba(0, 0, 0, 0.25);"><i class="fas fa-motorcycle"></i></a>
    </td>
    <?php }?>

     <td>
		<a href="../infoHelpers/modificar_Pintura.php?id=<?php echo $data['id_orden']; ?>"class="btn btn-outline-info" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px  rgba(0, 0, 0, 0.25);"><i class="fas fa-pencil"></i></a>
    </td>
 
                                                     
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
    tablaHerreria = $("#tabla_Cinta").DataTable({
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
  function errorAuto(){
	Swal.fire(
		'Error',
		'El sector ya posee un trabajo Pendiente con este ID',
		'error'
		)
}
</script>