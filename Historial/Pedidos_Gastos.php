<?php
session_start();
if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 ) {
  if (empty($_SESSION['active'])) {
    header('location: ../Pantillas/salir.php');
  }
} else {
  header('location: ../Plantillas/salir.php');
}

require_once("../Modelos/conexion.php");

require_once("../body/header_admin.php");
?>

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-user-md"></i> Listado de gastos Cancelados 
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
                <th></th>
                <th></th>
                <th>Fecha</th>
                <th></th>
                <th></th>
                <th>Descripcion</th>
                <th></th>
                <th></th>
                <th></th>
                <th>Monto</th>
                <th>Eliminar</th>

              </tr>
            </thead>

            <tbody>
              <?php
              // $fecha1 = "05-01-2023";
          
              //  echo $fecha1." ".$fecha2;
              //  exit;
              $sql = mysqli_query($conection, "SELECT g.id,g.descripcion,g.monto,g.created_at  FROM gastos g 
               where g.estatus = 2");

              $resultado = mysqli_num_rows($sql);
              $gasto = 0;

              if ($resultado > 0) {
                while ($data = mysqli_fetch_array($sql)) {
                  $gasto += number_format($data['monto'], 3,'.', '.');

              ?>
                  <tr class="text-center">
                   <td></td>
                    <td></td>
                    <td><?php echo $data['created_at'] ?></td>
                    <td></td>
                    <td></td>
                    <td><?php echo $data['descripcion']; ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><?php echo $data['monto']; ?></td>
                    <td>
                      <button class="btn btn-outline-danger" onclick="EliminarGasto('<?php echo $data['id'] ?>')"><i class="fa fa-money" aria-hidden="true"></i></button>

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
<script src="../js/gastos.js"></script>
<script type="text/javascript" src="../js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

    $('#btnEditarPass').click(function() {
      /* Act on the event */
      EliminarGasto();
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {

    $('#btnEditarPass').click(function() {
      /* Act on the event */
      EliminarDoctor();
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    tablaHerreria = $("#tabla_Usuario").DataTable({
      "columnDefs": [{
        "target": 1,
        "data": null
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
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
        "sProcessing": "Procesando...",
      }
    });



  });
</script>

<script>
  function permisoAuto() {
    Swal.fire(
      'Lo Siento',
      'No posee el Permiso para Asignar un Medico',
      'error'
    )
  }
</script>

<script>
  function excel() {
    Swal.fire(
      'Lo Siento',
      'No puede imprimir la lista de Medicos, es informacion privada',
      'error'
    )
  }
</script>