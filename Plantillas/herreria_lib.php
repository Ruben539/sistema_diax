<?php
session_start();
if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 3){
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
          <h1><i class="fa fa-th-list"></i>Motos Liberadas - Herreria</h1>
          <p>Registro Web en Desarrollo</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item active"><a href="../Vistas/excelHerreria_Lib.php">Excel</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <div class="table-responsive">
                <table class="table table-hover table-bordered" id="tabla_Herreria">
                  <thead>
                    <tr>
                      <th>Fecha</th>
                      <th>Modelo</th>
                      <th>Nro Vehiculo</th>
                      <th>Color</th>
                      <th>Pieza</th>
                      <th>Falla Detectada</th>
                      <th>Fecha Fin</th>
                      <th>Usuario</th>
                    </tr>
                  </thead>
                  <tbody>
                       <?php 
                        $sql = mysqli_query($conection,"SELECT id_herreria,fecha_add,modelo,nro_vehiculo,color,pieza,falla_detectada,usuario,fecha_fin
                         from herreria where estatus = 0");

                         $resultado = mysqli_num_rows($sql);

                         if($resultado > 0){ 
                            while ($data = mysqli_fetch_array($sql)){ 
                      ?>
                        <tr>
                            <td><?php echo $data['fecha_add'];?></td>
 						    <td><?php echo $data['modelo'];?></td>
 						    <td><?php echo $data['nro_vehiculo']; ?></td>
                            <td><?php echo $data['color']?></td>
 					    	<td><?php echo $data['pieza']; ?></td>
 					    	<td><?php echo $data['falla_detectada']; ?></td>
                            <td><?php echo $data['fecha_fin']; ?></td>
                            <td><?php echo $data['usuario']; ?></td>
 					    	                            
                        </tr>
                     
                 
                  <?php }
                } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
    <!-- Essential javascripts for application to work-->
   
    <script type="text/javascript" src="../js/plugins/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>
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
    <!-- Google analytics script-->
