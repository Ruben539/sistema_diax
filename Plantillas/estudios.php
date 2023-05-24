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
          <h1><i class="fa fa-list-ol"></i> Listado de Estudios de la Cinica  <a href="../Helpers/grabar_estudio.php"> 
        <button id="btnNew"  class="btn btn-primary" type="button"><i class="fa fa-plus" aria-hidden="true"></i>
         Nuevo</button></a>
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
                            <th>Estudio</th>
                            <th>Sin Seguro</th>
                            <th>Semei Preferencial</th>                                                             
                            <th>Hospitalario</th>                                
                            <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {?>
                            <th>Editar</th>
                            <th>Eliminar</th> 
                            <?php } ?>    
                        </tr>
                  </thead>

                  <tbody>
                      <?php 
                        $sql = mysqli_query($conection,"SELECT t.id,t.Estudio,t.SinSeguro,t.SemeiPref,t.Hospitalar
                        FROM tarifas t where t.estatus = 1 ORDER BY  t.id DESC");

                         $resultado = mysqli_num_rows($sql);

                         if ($resultado > 0) {
                          while ($ver= mysqli_fetch_array($sql)) {
                            $datos = $ver[0];
                             $ver[1];
                             $ver[2];
                             $ver[3];
                             $ver[4];
                            
                        ?>
                            <tr class="text-center">
          
                            <td><?= $ver[0]; ?></td>
                            <td><?= $ver[1]; ?></td>
                            <td><?= $ver[2]; ?></td>
                            <td><?= $ver[3]; ?></td>
                            <td><?= $ver[4]; ?></td>
                            
                            <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {?>
                            <td>
                            <a href="../Helpers/modificar_estudios.php?id=<?php echo $ver[0]; ?>"class="btn btn-outline-info" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px  rgba(0, 0, 0, 0.25);"><i class="fas fa-edit"></i></a>
                            </td>
                            <?php } ?>
                                  
                              <td>
                              <button class = "btn btn-outline-danger" onclick="liberarDatos('<?php echo $ver[0] ?>')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                             
                              </td>


  <?php if($_SESSION['rol'] == 2 ){ ?>
  <td>
		<a href="#" onclick="permisoAuto()" class="btn btn-outline-danger" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px  rgba(0, 0, 0, 0.25);"><i class="fas fa-user-times"></i></a>
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