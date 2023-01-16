<?php
session_start();
if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
  if (empty($_SESSION['active'])) {
    header('location: salir.php');
  }
} else {
  header('location: salir.php');
}
require_once("../Modelos/conexion.php");
ob_start();
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

  <H2 class="text-center">Listado de Comprobantes del Dia</H2>
  <table class="table table-striped table-bordered table-condensed">

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
      $fecha =  date('d-m-Y');
      //  echo $fecha1." ".$fecha2;
      //  exit;
      $sql = mysqli_query($conection, "SELECT h.id,h.Estudio,h.Cedula,h.Atendedor,h.Fecha,h.Seguro,h.Monto,h.Comentario, h.fecha_2 FROM historial h 
                        where  Fecha like '%$fecha%'   ORDER BY  h.id DESC");

      $resultado = mysqli_num_rows($sql);

      if ($resultado > 0) {
        $monto = 0;
        while ($data = mysqli_fetch_array($sql)) {
          $monto = $data['Monto'];

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
      <tfoot>
        
        <tr>
          <td><b>Total A Rendir : </b></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td class="alert alert-success text-center">
            <?php echo $monto;?>
          </td>
          <td></td>
      <td></td>
      <td></td>
        </tr>
  </table>
</body>

</html>
<?php
$html = ob_get_clean();
//echo $html;

require_once "../Library/dompdf/autoload.inc.php";

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);

//$dompdf->setPaper('letter');
$dompdf->setPaper('A4', 'landscape');

$dompdf->render();
$dompdf->stream('reporte-Comprobante.pdf', array('Attachment' => false));

?>