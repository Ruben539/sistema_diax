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
          <h1><i class="fa fa-user-times"></i> Ordenes Canceladas del Mes  
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
                            <th>Solicitante</th>
                            <th>F. de Solic.</th>
                            <th>Nombre</th>
                            <th>Estudio</th>
                            <th>Doctor</th>                              
                            <th>Cancelado</th>                                
                            <th>Aprobado por</th>                                
                            <th>F. de Aprob.</th>                                
                              
                        </tr>
                  </thead>

                  <tbody>
                      <?php 
                        $hoy = date('m-Y');
                        
                         $sql = mysqli_query($conection, "SELECT h.id,h.Cedula,c.nombre,c.apellido,h.estudio,h.atendedor,h.cancelado,h.fecha,h.usuario_1,usuario_2,fecha_1
                         FROM historial h INNER JOIN clientes c on c.cedula = h.cedula
                         WHERE h.cancelado != ' ' AND fecha like '%".$hoy."%' AND h.estatus = 0 ORDER BY ID ASC ");
                       

                         $resultado = mysqli_num_rows($sql);

                         if($resultado > 0){ 
                            while ($data = mysqli_fetch_array($sql)){ 
                      ?>
                        <tr class="text-center">
                             <td><?php echo $data['id'];?></td>
                             <td><?php echo $data['usuario_1'];?></td>
                             <td><?php echo $data['fecha']?></td>
                             <td><?php echo $data['nombre'].' '.$data['apellido'];?></td>
                             <td><?php echo $data['estudio']; ?></td>
                             <td><?php echo $data['atendedor']?></td>
                             <td><?php echo $data['cancelado'];?></td>
                             <td><?php echo $data['usuario_2']?></td>
                             <td><?php echo $data['fecha_1']?></td>
 					        
                           

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