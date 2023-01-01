<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: salir.php');
}

require_once("../Modelos/conexion.php");

require_once("../body/header_admin.php");

?>

<main class="app-content">
  <div class="app-title">
    <div>

      <h1><i class="fa fa-server" aria-hidden="true"></i> Reclamos de Origen - Cerrados</h1>
        <p>Sistema web de Registros</p>
   </div>
   <ul class="app-breadcrumb breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-book fa-lg"></i></li>
     <li class="breadcrumb-item active"><a href="../Vistas/excelReclamos_Lib.php">Excel</a></li>
 </ul>
</div>
<div class="row">
        <div class="col-md-12">
          <div class="tile">
              <div class="table-responsive">        
                <table id="Tabla_Reclamos" class="table table-striped table-bordered table-condensed" style="width:100%">
                    <thead>
            <tr>
                <th>Fecha</th>
                <th>Modelo</th>
                <th>Nro de Caja</th>
                <th>Nro Partida</th>
                <th>Descripcion</th>
                <th>Estado</th>
                <th>Proveedor</th>
                <th>Cantidad</th>
                <th>Observacion</th>
                 <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {?>
                <th>Editar</th>
                <th>Habilitar</th>
                <?php } ?>   
            </tr>
            </thead>
            <?php 



            $query = mysqli_query($conection,"SELECT p.codproducto,p.fecha_add, p.modelo,p.nro_caja,p.nro_partida,
             p.descripcion,p.estado, p.existencia,p.proveedor,p.observacion,p.usuario
             FROM producto p  WHERE p.estatus = 0 ORDER BY p.codproducto DESC ");


            $resultado = mysqli_num_rows($query);

            if ($resultado > 0) {

                while ($data = mysqli_fetch_array($query)) {
                   
                    ?>
            <tbody class="text-center">
            <tr class="row<?php echo $data['codproducto']; ?>">
                        <td><?php echo $data['fecha_add']; ?></td>
                        <td><?php echo $data['modelo']; ?></td>
                        <td><?php echo $data['nro_caja']; ?></td>
                        <td><?php echo $data['nro_partida']; ?></td>
                        <td><?php echo $data['descripcion']; ?></td>
                        <td><?php echo $data['estado']; ?></td>
                        <td><?php echo $data['proveedor']; ?></td>
                        <td><?php echo $data['existencia']; ?></td>
                        <td><?php echo $data['observacion'];?></td>
                        
    <?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {?>
        <td>
		<a href="../Helpers/modificar_reclamosLib.php?id=<?php echo $data['codproducto']; ?>"class="btn btn-outline-danger" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px  rgba(0, 0, 0, 0.25);"><i class="fas fa-edit"></i></a>
        </td>
        <td>
		<a href="../Helpers/habilitar_reclamos.php?id=<?php echo $data['codproducto']; ?>"class="btn btn-outline-success" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.3), 0 6px 20px  rgba(0, 0, 0, 0.25);"><i class="fas fa-arrow-left"></i></a>
        </td>
    <?php } ?>
                
      </tr>
            </tbody>
                    <?php 

                }

            }
            ?>

        </table>           
            </div>
            <br>
        </div>
    </div>  
</div>  
</main>

<script type="text/javascript" src="../js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
    tablaHerreria = $("#Tabla_Reclamos").DataTable({
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

