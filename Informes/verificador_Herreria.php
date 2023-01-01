<?php
session_start();
if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 11){
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
         <?php if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 11){?>
          <h1><i class="fa fa-th-list"></i> Informe Diario - Verificación Herreria  <a href="../infoHelpers/grabar_verHerreria.php"> 
        <button id="btnNew"  class="btn btn-primary" type="button"><i class="fa fa-plus-circle" aria-hidden="true"></i>
         Nuevo</button></a>
        </h1>
         <?php }?>
          <?php if($_SESSION['rol'] == 2){?>
          <h1><i class="fa fa-th-list"></i> Informe Diario - Verificación Herreria
        <button id="btnNew"  class="btn btn-primary" type="button" onclick="permisoAuto();"><i class="fa fa-plus-circle" aria-hidden="true"></i>
         Nuevo</button>
        </h1>
         <?php }?>
          <p>Registro Web en Desarrollo</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-book fa-lg"></i></li>
          <li class="breadcrumb-item active"><a href="../VistasInfo/excelVer_Herreria.php">Excel</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
              <div class="table-responsive">
                 <table id="tabla_Verificacion" class="table table-striped table-bordered table-condensed" style="width:100%">
                  <thead>
                    <tr>
                            <th>Fecha</th>
                            <th>Modelo</th>
                            <th>Nro Partida</th>
                            <th>Sin Soportes</th>
                            <th>Soporte mal Soldados</th>
                            <th>Soporte Motor Mal Soldado</th>
                            <th>Mala Soldadura</th>
                            <th>Exceso de Escoria</th>
                            <th>Desalineado</th>
                            <th>Fisura</th>
                            <th>Rotura</th>
                            <th>Observacion</th>
                            <th>Usuario</th>
                            <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 11) {?>
                            <th>Editar</th>
                            <?php } ?>    
                        </tr>
                  </thead>

                  <tbody>
                      <?php 
                        $sql = mysqli_query($conection,"SELECT id_verHerreria,fecha_add,modelo,nro_partida,sin_soporte,soporte_1,soporte_2,mala_soldadura,exceso_escoria,
                        desalineado,fisura,rotura,observacion,usuario from verificacion_herreria where estatus = 1");

                         $resultado = mysqli_num_rows($sql);

                         if($resultado > 0){ 
                            while ($data = mysqli_fetch_array($sql)){ 
                      ?>
                        <tr>
                             <td><?php echo $data['fecha_add'];?></td>
 						     <td><?php echo $data['modelo'];?></td>
                             <td><?php echo $data['nro_partida'];?></td> 
                             <td><?php echo $data['sin_soporte'];?></td> 
 						     <td><?php echo $data['soporte_1']; ?></td>
                             <td><?php echo $data['soporte_2']; ?></td>
                             <td><?php echo $data['mala_soldadura']; ?></td>
                             <td><?php echo $data['exceso_escoria']; ?></td>
                             <td><?php echo $data['desalineado']; ?></td>
                             <td><?php echo $data['fisura']; ?></td>
                             <td><?php echo $data['rotura']; ?></td>
                             <td><?php echo $data['observacion']; ?></td>
                             <td><?php echo $data['usuario']; ?></td>

                            
                           
	<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 11) {?>
    <td>
		<a href="../infoHelpers/modificar_verHerreria.php?id=<?php echo $data['id_verHerreria']; ?>"class="btn btn-outline-info" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px  rgba(0, 0, 0, 0.25);"><i class="fas fa-edit"></i></a>
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
    tablaHerreria = $("#tabla_Verificacion").DataTable({
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