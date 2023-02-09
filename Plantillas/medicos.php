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
          <h1><i class="fa fa-user-md"></i> Listado de Medicos  <a href="../Helpers/grabar_doctor.php"> 
        <button id="btnNew"  class="btn btn-primary" type="button"><i class="fa fa-user-plus" aria-hidden="true"></i>
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
                            <th>Nombre</th>
                            <th>Especialidad</th>
                            <th>Dia</th>
                            <th>Hora</th>                                
                            <th>Tcobro</th>                                
                            <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {?>
                            <th>Editar</th>
                            <th>Agregar</th> 
                            <?php } ?>    
                        </tr>
                  </thead>

                  <tbody>
                      <?php 
                        $sql = mysqli_query($conection,"SELECT m.id,m.Nombre,m.Especialidad,m.Dia,m.Hora,m.Tcobro FROM medicos m 
                        ORDER BY  m.id DESC");

                         $resultado = mysqli_num_rows($sql);

                         if($resultado > 0){ 
                            while ($data = mysqli_fetch_array($sql)){ 
                      ?>
                        <tr class="text-center">
                             <td><?php echo $data['id'];?></td>
                             <td><?php echo $data['Nombre'];?></td>
 						     <td><?php echo $data['Especialidad'];?></td>
 						     <td><?php echo $data['Dia']; ?></td>
                             <td><?php echo $data['Hora']?></td>
                             <td><?php echo $data['Tcobro']?></td>
 					        
                           
	<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {?>
    <td>
	  <a href="../Helpers/modificar_medico.php?id=<?php echo $data['id']; ?>"class="btn btn-outline-info" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px  rgba(0, 0, 0, 0.25);"><i class="fas fa-edit"></i></a>
    </td>
    <?php } ?>
                          
                            
	<?php if($_SESSION['rol'] == 1 ){ ?>
    <td>
		<a href="../Helpers/ingresar_medico.php?id=<?php echo $data['id']; ?>"class="btn btn-outline-danger" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px  rgba(0, 0, 0, 0.25);"><i class="fa fa-address-card-o" aria-hidden="true"></i>
</a>
    </td>
	<?php } ?>

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