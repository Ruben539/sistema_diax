<?php
session_start();
if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 7){
  if (empty($_SESSION['active'])) {
    header('location: salir.php');
}

}else{
  header('location: salir.php');
}



require_once("../Modelos/conexion.php");

require_once("../body/header_admin.php");
?>

<main class="app-content">
      <div class="app-title">
        <div>
          <?php if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 7){?>
          <h1><i class="fa fa-th-list"></i> Orden de Trabajo - Probado <a href="../OT/grabar_otProbado.php"> 
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
                            <th>Pieza</th>
                            <th>Color</th>     
                            <th>Cantidad</th>   
                            <th>Observación</th>
                            <th>Sector</th>
                            <th>Liberar</th>
                             
                        </tr>
                  </thead>

                  <tbody>
                      <?php 
                                   
                        $sql = mysqli_query($conection,"SELECT id_orden,fecha_add,modelo,nro_partida,pieza,color,cantidad,observacion,usuario_1,sector_1
                         from orden_trabajo where estatus = 7 ");

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
                             <td><?php echo $data['pieza']; ?></td>  
                             <td><?php echo $data['color']; ?></td> 
                             <td><?php echo $data['cantidad']; ?></td> 
                             <td><?php echo $data['observacion']; ?></td> 
                             <td><?php echo $data['sector_1']; ?></td> 

     <td>
		<a href="../OT/liberar_otProbado.php?id=<?php echo $data['id_orden']; ?>"class="btn btn-outline-success" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px  rgba(0, 0, 0, 0.25);"><i class="fas fa-check"></i></a>
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
  function permisoAuto(){
	Swal.fire(
		'Lo Siento',
		'No puede crear un Registro en esta Tabla',
		'error'
		)
}
</script>
