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
          <h1><i class="fa fa-list-ol"></i> Listado de Estudios Inactivos
        </h1>
          <p>Registro Web en Desarrollo</p>
        </div>
       
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
              <div class="table-responsive">
                 <table id="tabla_Usuario" class="table table-striped table-bordered table-condensed" style="width:100%">
                  <thead>
                    <tr class="text-center">
                            <th>ID</th>
                            <th>Estudio</th>
                            <th>Sin Seguro</th>
                            <th>Semei</th>
                            <th>Semei Preferencial</th>                                
                            <th>Seguros</th>                                
                            <th>Seguros Preferencial</th>                                
                            <th>Hospitalario</th>                                
                             
                        </tr>
                  </thead>

                  <tbody>
                      <?php 
                        $sql = mysqli_query($conection,"SELECT t.id,t.Estudio,t.SinSeguro,t.SEMEI,t.SemeiPref,t.Seguros,t.SegurosPref,t.Hospitalar 
                        FROM tarifas t where estatus = 0 ORDER BY  t.id DESC");

                         $resultado = mysqli_num_rows($sql);

                         if ($resultado > 0) {
                          while ($ver= mysqli_fetch_array($sql)) {
                            $datos = $ver[0];
                             $ver[1];
                             $ver[2];
                             $ver[3];
                             $ver[4];
                             $ver[5];
                             $ver[6];
                             $ver[7];
                        ?>
                            <tr class="text-center">
          
                            <td><?= $ver[0]; ?></td>
                            <td><?= $ver[1]; ?></td>
                            <td><?= $ver[2]; ?></td>
                            <td><?= $ver[3]; ?></td>
                            <td><?= $ver[4]; ?></td>
                            <td><?= $ver[5]; ?></td>
                            <td><?= $ver[6]; ?></td>
                            <td><?= $ver[7]; ?></td>
                            
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
  <script src="../js/estudios.js"></script>
<script type="text/javascript" src="../js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
   
        $('#btnEditarPass').click(function() {
            /* Act on the event */
            liberarDatos();
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
		'No posee el Permiso para Eliminar un Registro',
		'error'
		)
}
</script>

<script>
  function excel(){
	Swal.fire(
		'Lo Siento',
		'No puede imprimir los Estudios, es informacion privada',
		'error'
		)
}
</script>