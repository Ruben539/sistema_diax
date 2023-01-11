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

  <table class="table table-striped table-bordered table-condensed">
    <caption>Listado de Comprobantes del Dia</caption>

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
        <th>Fecha</th>

      </tr>
    </thead>

    <tbody>
      <?php
      require_once("../Modelos/conexion.php");
      $fecha =  date('d-m-Y');
      //  echo $fecha1." ".$fecha2;
      //  exit;
      $sql = mysqli_query($conection, "SELECT h.id,h.Estudio,h.Cedula,h.Atendedor,h.Fecha,h.Seguro,h.Monto,h.Comentario, h.fecha_2 FROM historial h 
                        where  Fecha like '%$fecha%'   ORDER BY  h.id DESC");

      $resultado = mysqli_num_rows($sql);

      if ($resultado > 0) {
        while ($data = mysqli_fetch_array($sql)) {
      ?>
          <tr class="text-center">
            <td><?php echo $data['id']; ?></td>
            <td><?php echo $data['Estudio']; ?></td>
            <td><?php echo $data['Cedula']; ?></td>
            <td><?php echo $data['Atendedor']; ?></td>
            <td><?php echo $data['Fecha']; ?></td>
            <td><?php echo $data['Seguro'] ?></td>
            <td><?php echo $data['Monto'] ?></td>
            <td><?php echo $data['Comentario'] ?></td>
            <td><?php echo $data['fecha_2'] ?></td>

          </tr>


      <?php }
      } ?>
    </tbody>
  </table>
</body>

</html>