<?php
session_start();
if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2){
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
          <h1><i class="fa fa-user-times"></i> Ordenes para Cancelar  
        </h1>
          <p>Registro Web en Desarrollo</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-book fa-lg"></i></li>
          <li class="breadcrumb-item active"><a href="#" onclick="excel()">Excel</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
              <div class="table-responsive">
                 <table id="tabla_Usuario" class="table table-striped table-bordered table-condensed" style="width:100%">
                  <thead>
                    <tr class="text-center">
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Estudio</th>
                            <th>Doctor</th>                              
                            <th>Cancelado</th>                                
                            <th>Fecha</th>                                
                            <th>Aprobar</th>                                
                              
                        </tr>
                  </thead>

                  <tbody>
                      <?php 
                      //$usuario = $_SESSION['nombre'];
                     // echo $usuario;
                        $hoy = date('m-Y');
                        
                         $sql = mysqli_query($conection, "SELECT h.id,h.Cedula,c.nombre,c.apellido,h.estudio,h.atendedor,h.cancelado,h.fecha 
                         FROM historial h INNER JOIN clientes c on c.cedula = h.cedula
                         WHERE Fecha like '%".$hoy."%' AND h.estatus = 2 ");
                       

                         $resultado = mysqli_num_rows($sql);

                         if($resultado > 0){ 
                            while ($data = mysqli_fetch_array($sql)){ 
                      ?>
                        <tr class="text-center">
                             <td><?php echo $data['id'];?></td>
                             <td><?php echo $data['nombre'].' '.$data['apellido'];?></td>
                             <td><?php echo $data['estudio']; ?></td>
                             <td><?php echo $data['atendedor']?></td>
                             <td><?php echo $data['cancelado'];?></td>
                             <td><?php echo $data['fecha']?></td>
 					        
                             <td>
                                <button class = "btn btn-outline-success" onclick="aprobarCancelacion('<?php echo $data['id']; ?>')"><i class="fa fa-check" aria-hidden="true"></i></button>
                   
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
<script src="../js/cancelacion.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
   
        $('#btnEditarPass').click(function() {
            /* Act on the event */
            aprobarCancelacion();
        });
    });
</script>
<script type="text/javascript">

    $(document).ready(function(){
    tablaHerreria = $("#tabla_Usuario").DataTable({
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
		'No posee el Permiso para Eliminar un Medico',
		'error'
		)
}
</script>

<script>
  function excel(){
	Swal.fire(
		'Lo Siento',
		'No puede imprimir la lista de Medicos, es informacion privada',
		'error'
		)
}
</script>