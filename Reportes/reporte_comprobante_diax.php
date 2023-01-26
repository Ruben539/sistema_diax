<?php
$planillas = "Reporte de Comprobantes.xls";
header("content-Type: application/vnd.ms-excel");
header("content-Disposition: attachment; filename=" . $planillas);
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/sistema_diax/bootstrap/dist/css/bootstrap.min.css">
  <title>Reporte de Comprobantes</title>
</head>

<body>

  <main class="app-content">
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h5 class="text-center">Lista de Pacientes Diax</h5>
          <div class="table-responsive">
            <table id="tabla_Usuario" class="table table-striped table-bordered table-condensed" style=" font-size: 10px;">
              <thead>
                <tr class="text-center">

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
                require_once("../Modelos/conexion.php");
                // $fecha1 = "05-01-2023";
                $fecha =  date('d-m-Y');
                //  echo $fecha1." ".$fecha2;
                //  exit;
                $sql = mysqli_query($conection, "SELECT h.id,c.nombre,c.apellido,h.Estudio,h.Cedula,h.Atendedor,h.Fecha,h.Seguro,h.Monto,h.Descuento,h.MontoS,h.Comentario, h.fecha_2 
                FROM historial h inner join clientes c on c.cedula = h.cedula where  h.Fecha like '%$fecha%' AND h.Atendedor like '%DIAX%'  ORDER BY  h.id ASC");

                $resultado = mysqli_num_rows($sql);
                $monto = 0;

                if ($resultado > 0) {
                  while ($data = mysqli_fetch_array($sql)) {
                    $monto += (int)$data['Monto'];

                ?>
                    <tr class="text-center">

                      <td><?php echo $data['Fecha'] ?></td>
                      <td><?php echo $data['nombre'].' '.$data['apellido']; ?></td>
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
                  <?php echo number_format($monto, 3, '.', '.'); ?>.<b>G</b>
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
                where  g.created_at like '%$fecha%'   ORDER BY  g.id ASC");

                $resultado = mysqli_num_rows($sql);
                $gasto = 0;

                if ($resultado > 0) {
                  while ($data = mysqli_fetch_array($sql)) {
                    $gasto += (int)$data['monto'];

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
              <p><b>Rendicion Final</b></p>
              <p style="text-align: right;" class="alert alert-danger"> <?php echo number_format($rendicion, 3, '.', '.'); ?>.<b>GS</b></p>
            </section>


          </div>
        </div>
      </div>
    </div>


  </main>
</body>

</html>