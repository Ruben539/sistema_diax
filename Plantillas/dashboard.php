<?php
session_start();
if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 || $_SESSION['rol'] == 5 || $_SESSION['rol'] == 6) {
  if (empty($_SESSION['active'])) {
    header('location: salir.php');
  }
} else {
  header('location: salir.php');
}


require_once("../body/header_admin.php");
?>

<main class="app-content">
  <div class="app-title">
    <div>
      <h1>Sistema Diax</h1>
      <p>Registro web de Pacientes en Desarrollo</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Pagina de Inicio</a></li>
    </ul>
  </div>

  <div id="mapDiv"></div>
  <br>
  <div class="tile">
    <div class="tile-body"><B>CANTIDAD DE PACIENTES DEL MES</B></div>

  </div>

  <div class="row">
    <!--widgets de Pacientes de Paz-->
    <div class="col-md-3">
      <div class="widget-small primary"><i class="icon fa fa-user-md fa-3x"></i>
        <div class="info">
          <h4><a class="link" href="../Plantillas/pacientes.php">Pacientes PAZ</a></h4>

          <p id="idPacientePaz" class="text-center" style="font-size: 50px;"><b>0</b></p>

        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="widget-small primary"><i class="icon fa fa-user-md fa-3x"></i>
        <div class="info">
          <h4><a class="link" href="../Plantillas/pacientes.php">Pacientes DIAX</a></h4>
          <p id="idPacienteDiax" class="text-center" style="font-size: 50px;"><b>0</b></p>
        </div>
      </div>
    </div>


  </div>


  <div class="tile">
    <div class="tile-body"><B>LISTA DE PACIENTES PAZ</B></div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item">
        <a class="btn btn-danger" href="../Reportes/reporte_orden_paz.php" target="_blank" rel="noopener noreferrer">
          <i class="fa fa-file-pdf-o"></i> Reporte PDF
        </a>
      </li>
      <li class="breadcrumb-item">
        <a class="btn btn-success" href="../Reportes/reporte_comprobante_paz.php" target="_blank" rel="noopener noreferrer">
          <i class="fa fa-file-excel-o"></i> Reporte Excel
        </a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="table-responsive">
          <table id="tabla_Paz" class="table table-striped table-bordered table-condensed" style="width:100%">
            <thead>
              <tr class="text-center">


                <th>Nro.</th>
                <th>Fecha</th>
                <th>Nombre</th>
                <th>Cedula</th>
                <th>Estudio</th>
                <th>Doctor/a</th>
                <th>Seguro</th>
                <th>Monto</th>
                <th>Monto Seguro</th>
                <th>Descuento</th>
                <th>Comentario</th>

              </tr>
            </thead>

            <tbody>
              <?php
              // $fecha1 = "05-01-2023";
              $fecha =  date('d-m-Y');
              //  echo $fecha1." ".$fecha2;
              //  exit;
              $sql = mysqli_query($conection, "SELECT h.id,c.nombre,c.apellido,h.Estudio,h.Cedula,h.Atendedor,h.Fecha,h.Seguro,h.Monto,h.Descuento,h.MontoS,h.Comentario, h.fecha_2 
                       FROM historial h inner join clientes c on c.cedula = h.cedula where  h.Fecha like '%$fecha%' AND h.Atendedor like '%PAZ%'  ORDER BY  h.id ASC");

              $resultado = mysqli_num_rows($sql);
              $monto = 0;
              $nro = 0;
              if ($resultado > 0) {
                while ($data = mysqli_fetch_array($sql)) {
                  $monto += (int)$data['Monto'];
                  $nro++;
              ?>
                  <tr class="text-center">

                    <td><?php echo $nro ?></td>
                    <td><?php echo $data['Fecha']; ?></td>
                    <td><?php echo $data['nombre'].' '.$data['apellido'];  ?></td>
                    <td><?php echo $data['Cedula']; ?></td>
                    <td><?php echo $data['Estudio']; ?></td>
                    <td><?php echo $data['Atendedor']; ?></td>
                    <td><?php echo $data['Seguro']; ?></td>
                    <td><?php echo $data['Monto'] ?></td>
                    <td><?php echo $data['MontoS'] ?></td>
                    <td><?php echo $data['Descuento'] ?></td>
                    <td><?php echo $data['Comentario'] ?></td>


                  </tr>


              <?php }
              } ?>
            </tbody>
            <tr>
              <td><b>Total A Rendir : </b></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td class="alert alert-success text-center">
                <?php echo number_format($monto, 3, '.', '.'); ?>.<b>GS</b>
              </td>


            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="tile">
    <div class="tile-body"><B>LISTA DE PACIENTES DIAX</B></div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item">
        <a class="btn btn-danger" href="../Reportes/reporte_orden_diax.php" target="_blank" rel="noopener noreferrer">
          <i class="fa fa-file-pdf-o"></i> Reporte PDF
        </a>
      </li>
      <li class="breadcrumb-item">
        <a class="btn btn-success" href="../Reportes/reporte_comprobante_diax.php" target="_blank" rel="noopener noreferrer">
          <i class="fa fa-file-excel-o"></i> Reporte Excel
        </a>
      </li>
    </ul>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="table-responsive">
          <table id="tabla_Diax" class="table table-striped table-bordered table-condensed" style="width:100%">
            <thead>
              <tr class="text-center">


                <th>Nro.</th>
                <th>Fecha</th>
                <th>Nombre</th>
                <th>Cedula</th>
                <th>Estudio</th>
                <th>Doctor/a</th>
                <th>Seguro</th>
                <th>Monto</th>
                <th>Monto Seguro</th>
                <th>Descuento</th>
                <th>Comentario</th>

              </tr>
            </thead>

            <tbody>
              
              <?php
              // $fecha1 = "05-01-2023";
              $fecha =  date('d-m-Y');
              //  echo $fecha1." ".$fecha2;
              //  exit;
              $sql = mysqli_query($conection, "SELECT h.id,c.nombre,c.apellido,h.Estudio,h.Cedula,h.Atendedor,h.Fecha,h.Seguro,h.Monto,h.Descuento,h.MontoS,h.Comentario, h.fecha_2 
                       FROM historial h inner join clientes c on c.cedula = h.cedula where  h.Fecha like '%$fecha%' AND h.Atendedor like '% DIAX %' AND h.estatus = 1  ORDER BY  h.id ASC");

              $resultado = mysqli_num_rows($sql);
              $diax = 0;
              $nro = 0;

              if ($resultado > 0) {
                while ($data = mysqli_fetch_array($sql)) {
                  $diax += $data['Monto'];
                  $nro++;

              ?>
                  <tr class="text-center">

                    <td><?php echo $nro; ?></td>
                    <td><?php echo $data['Fecha']; ?></td>
                    <td><?php echo $data['nombre'].' '.$data['apellido'];  ?></td>
                    <td><?php echo $data['Cedula']; ?></td>
                    <td><?php echo $data['Estudio']; ?></td>
                    <td><?php echo $data['Atendedor']; ?></td>
                    <td><?php echo $data['Seguro']; ?></td>
                    <td><?php echo $data['Monto'] ?></td>
                    <td><?php echo $data['MontoS'] ?></td>
                    <td><?php echo $data['Descuento'] ?></td>
                    <td><?php echo $data['Comentario'] ?></td>


                  </tr>


              <?php }
              } ?>
            </tbody>
            <tr>
              <td><b>Total A Ingreso : </b></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td class="alert alert-success text-center">
                <?php echo number_format($diax, 3, '.', '.'); ?>.<b>GS</b>
              </td>


            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-condensed" style="width:100%">
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

              </tr>
            </thead>

            <tbody>
              <?php
              // $fecha1 = "05-01-2023";
              $fecha =  date('Y-m-d');
              //  echo $fecha1." ".$fecha2;
              //  exit;
              $sql = mysqli_query($conection, "SELECT g.id,g.descripcion,g.monto,g.created_at  FROM gastos g 
               where  g.created_at like '%".$fecha."%' and g.estatus = 1");

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

                  </tr>


              <?php }
              } ?>
            </tbody>
            <tr>
              <td><b>Total A Gastos : </b></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td class="alert alert-success text-center">
                <?php echo number_format($gasto, 3, '.', '.'); ?>.<b>GS</b>
              </td>


            </tr>
          </table>
        <section>
          <?php
            $rendicion = $diax - $gasto;

          ?>
          <p>Rencion Final</p>
          <p style="text-align: right;" class="alert alert-danger"> <?php echo number_format($rendicion, 3, '.', '.'); ?>.<b>GS</b></p>
        </section>
             

        </div>
      </div>
    </div>
  </div>


</main>
<script async defer 
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQjCrevR37GZ7P-dI_bCHzTMFtwsU_fNk&callback=initMap">
</script>
<script src="../js/index.js"></script>
<script src="../bootstrap//dist/js/bootstrap.min.js"></script>

<script type="text/javascript" src="../js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    tablaHerreria = $("#tabla_Paz").DataTable({
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

<script type="text/javascript" src="../js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
  $(document).ready(function() {
    tablaHerreria = $("#tabla_Diax").DataTable({
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
      'Pagina web no Disponible',
      'error'
    )
  }
</script>