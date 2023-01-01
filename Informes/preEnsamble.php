<?php
session_start();
if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 10){
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
         <?php if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 10){?>
          <h1><i class="fa fa-th-list"></i> Cumplimiento Diario - Pre-Ensamble  <a href="../infoHelpers/grabar_preEnsamble.php"> 
        <button id="btnNew"  class="btn btn-primary" type="button"><i class="fa fa-plus-circle" aria-hidden="true"></i>
         Nuevo</button></a>
        </h1>
         <?php }?>
          <?php if($_SESSION['rol'] == 2){?>
          <h1><i class="fa fa-th-list"></i> Cumplimiento Diario - Pre-Ensamble 
        <button id="btnNew"  class="btn btn-primary" type="button" onclick="permisoAuto();"><i class="fa fa-plus-circle" aria-hidden="true"></i>
         Nuevo</button>
        </h1>
         <?php }?>
          <p>Registro Web en Desarrollo</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-book fa-lg"></i></li>
          <li class="breadcrumb-item active"><a href="../VistasInfo/excelInfo_PreEn.php">Excel</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
              <div class="table-responsive">
                 <table id="tabla_Ensamble" class="table table-striped table-bordered table-condensed" style="width:100%">
                  <thead>
                    <tr>
                            <th>Fecha</th>
                            <th>Modelo</th>
                            <th>Nro Partida</th>
                            <th>P1</th>
                            <th>P2</th>
                            <th>P3</th>
                            <th>P4</th>
                            <th>P5</th>
                            <th>P6</th>
                            <th>P7</th>
                            <th>P8</th>
                            <th>P9</th>
                            <th>P10</th>
                            <th>P11</th>
                            <th>Observacion</th>
                            <?php if ($_SESSION['rol'] == 2) {?>
                            <th>Usuario</th>
                            <?php } ?>  
                            <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 10) {?>
                            <th>Editar</th>
                            <?php } ?>    
                        </tr>
                  </thead>

                  <tbody>
                      <?php 
                        $sql = mysqli_query($conection,"SELECT id_ensamble,fecha_add,modelo,nro_partida,puesto1,puesto2,puesto3,puesto4,puesto5,puesto6,puesto7,puesto8
                        ,puesto9,puesto10,puesto11,observacion,usuario from preensamble where estatus = 1");

                         $resultado = mysqli_num_rows($sql);

                         if($resultado > 0){ 
                            while ($data = mysqli_fetch_array($sql)){ 
                      ?>
                        <tr>
                             <td><?php echo $data['fecha_add'];?></td>
 						                 <td><?php echo $data['modelo'];?></td>
                             <td><?php echo $data['nro_partida'];?></td> 
 						                 <td><?php echo $data['puesto1']; ?></td>
                             <td><?php echo $data['puesto2']; ?></td>
                             <td><?php echo $data['puesto3']; ?></td>
                             <td><?php echo $data['puesto4']; ?></td>
                             <td><?php echo $data['puesto5']; ?></td>
                             <td><?php echo $data['puesto6']; ?></td>
                             <td><?php echo $data['puesto7']; ?></td>
                             <td><?php echo $data['puesto8']; ?></td>
                             <td><?php echo $data['puesto9']; ?></td>
                             <td><?php echo $data['puesto10']; ?></td>
                             <td><?php echo $data['puesto11']; ?></td>
                             <td><?php echo $data['observacion']; ?></td>
  	<?php if ($_SESSION['rol'] == 2) {?>
       <td><?php echo $data['usuario']; ?></td>
    <?php } ?>
                            
                           
	<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 10) {?>
    <td>
		<a href="../infoHelpers/modificar_ensamble.php?id=<?php echo $data['id_ensamble']; ?>"class="btn btn-outline-info" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px  rgba(0, 0, 0, 0.25);"><i class="fas fa-edit"></i></a>
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
    tablaHerreria = $("#tabla_Ensamble").DataTable({
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