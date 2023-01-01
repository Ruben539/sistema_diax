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
          <?php if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 3){?>
          <h1><i class="fa fa-th-list"></i> Motos Pendientes - Herreria <a href="../Helpers/grabar_herreria.php"> 
        <button id="btnNew"  class="btn btn-primary" type="button"><i class="fa fa-plus-circle" aria-hidden="true"></i>
         Nuevo</button></a>
        </h1>
        <?php }?>
         <?php if($_SESSION['rol'] == 2){?>
          <h1><i class="fa fa-th-list"></i> Motos Pendientes - Herreria 
        <button id="btnNew"  class="btn btn-primary" type="button" onclick="permisoAuto();"><i class="fa fa-plus-circle" aria-hidden="true"></i>
         Nuevo</button>
        </h1>
        <?php }?>
          <p>Registro Web en Desarrollo</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><a href="../Reportes/reporte_herreria.php"><i class="fa fa-book fa-lg"></i> Reporte</a></li>
          <li class="breadcrumb-item active"><a href="../Vistas/excelHerreria.php">Excel</a></li>
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
                            <th>Nro Vehiculo</th>
                            <th>Color</th>                                
                            <th>Pieza Averiada</th>  
                            <th>Falla Detectada</th>   
                            <th>Estado</th> 
                            <th>Usuario</th>
                            <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 3) {?>
                            <th>Editar</th>
                            <th>Liberar</th> 
                            <?php } ?>    
                        </tr>
                  </thead>

                  <tbody>
                      <?php 
                        $sql = mysqli_query($conection,"SELECT id_herreria,fecha_add,modelo,nro_vehiculo,color,pieza,falla_detectada,estado,usuario
                         from herreria where estatus = 1");

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
                             <td><?php echo $data['estado']; ?></td> 
 					                   <td><?php echo $data['usuario']; ?></td> 
                           
	<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 3) {?>
    <td>
		<a href="../Helpers/modificar_herreria.php?id=<?php echo $data['id_herreria']; ?>"class="btn btn-outline-info" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px  rgba(0, 0, 0, 0.25);"><i class="fas fa-edit"></i></a>
    </td>
    <?php } ?>
                            
                            
	<?php if($_SESSION['rol'] == 1  || $_SESSION['rol'] == 3){ ?>
    <td>
		<a href="../Helpers/liberar_herreria.php?id=<?php echo $data['id_herreria']; ?>"class="btn btn-outline-success" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px  rgba(0, 0, 0, 0.25);"><i class="fas fa-check"></i></a>
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