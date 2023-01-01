<?php
session_start();
if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 ){
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
          <h1><i class="fa fa-th-list"></i> Pedidos de Garantia - Autorizados </h1>
          <p>Registro Web en Desarrollo</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-book fa-lg"></i></li>
          <li class="breadcrumb-item active"><a href="#">Excel</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
              <div class="table-responsive">
                 <table id="tabla_Garantia" class="table table-striped table-bordered table-condensed" style="width:100%">
                  <thead>
                    <tr>
                            <th>Fecha</th>
                            <th>Solicitante</th>
                            <th>Modelo</th>
                            <th>Nro Partida</th>
                            <th>Pieza Solicitada</th>                                
                            <th>Cantidad</th>    
                            <th>Destino</th>
                            <th>Observacion</th>
                            <th>Autorizado Por</th>
                            <th>Fecha Fin</th> 
                            
                        </tr>
                  </thead>

                  <tbody>
                      <?php 
                        $sql = mysqli_query($conection,"SELECT id_reclamo,fecha_add,solicitante,modelo,nro_partida,pieza,cantidad,destino,usuario,observacion,usuario,fecha_fin
                         from reclamos where estatus = 0");

                         $resultado = mysqli_num_rows($sql);

                         if($resultado > 0){ 
                            while ($data = mysqli_fetch_array($sql)){ 
                      ?>
                        <tr>
                              <td><?php echo $data['fecha_add'];?></td>
                              <td><?php echo $data['solicitante']; ?></td>
 						      <td><?php echo $data['modelo'];?></td>
                              <td><?php echo $data['nro_partida']?></td>
 					          <td><?php echo $data['pieza']; ?></td>
 					          <td><?php echo $data['cantidad']; ?></td>
                              <td><?php echo $data['destino']; ?></td>
                              <td><?php echo $data['observacion']; ?></td>
                              <td><?php echo $data['usuario']; ?></td>
                              <td><?php echo $data['fecha_fin']; ?></td>
 					        
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
<script type="text/javascript">
    $(document).ready(function(){
    tablaHerreria = $("#tabla_Garantia").DataTable({
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