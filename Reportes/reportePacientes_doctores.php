<?php 

session_start();

require_once("../Modelos/conexion.php");
if (empty($_SESSION['active'])) {
	header('location: ../Plantillas/salir.php');
}


	

//Recuperacion de datos para mostrar al seleccionar Actualizar
//echo $_REQUEST['id'];
//exit();


if (empty($_REQUEST['id'])) {
	header('location: ../doctores/comprobantes.php');

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

}

$id = $_REQUEST['id'];

$sql = mysqli_query($conection,"SELECT * FROM historial  WHERE id = $id");   

//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

//echo 'paso el sql';
//exit();


$resultado = mysqli_num_rows($sql);

if ($resultado == 0) {
     
	header("location: ../doctores/comprobantes.php");
}else{
	$option = 0;
	while ($data = mysqli_fetch_array($sql)) {
		
		$id          = $data['id'];
		$Cedula      = $data['Cedula'];
		$Estudio     = $data['Estudio'];
		$Atendedor   = $data['Atendedor'];
		$Seguro      = $data['Seguro'];
		$Monto       = $data['Monto'];
		$Fecha       = $data['Fecha'];

	}
}
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

  <main class="app-content">
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <h5 class="text-center">Datos Pacientes</h5>
          <div class="table-responsive">
            <table id="tabla_Usuario" class="table table-striped table-bordered table-condensed" style=" font-size: 10px;">
              <thead>
                <tr class="text-center">

                <th>Fecha</th>
                <th>Cedula</th>
                <th>Estudio</th>
                <th>Doctor/a</th>
                <th>Seguro</th>
                <th>Monto</th>
                
                

                </tr>
              </thead>

              <tbody>
                
                    <tr class="text-center">

                    <td><?php echo $Fecha; ?></td>
                    <td><?php echo $Cedula; ?></td>
                    <td><?php echo $Estudio; ?></td>
                    <td><?php echo $Atendedor; ?></td>
                    <td><?php echo $Seguro; ?></td>
                    <td><?php echo $Monto; ?></td>
                    
                
                    </tr>

              </tbody>  
              <tfoot>
    <tr>
      <td><b>Total A Rendir : </b></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <?php if($Monto == ''){?>
     
      <td class="text-center alert alert-success"><?php echo number_format(0, 3, '.', '.');?><b>GS</b></td>
      <?php }else{?>
        <td class="text-center alert alert-success"><?php echo number_format($Monto, 3, '.', '.');?><b>GS</b></td>
        <?php }?>
    </tr>
  </tfoot>
           </table>
          </div>
        </div>
      </div>
    </div>


  </main>
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
$dompdf->setPaper('a4', 'portrait');



$dompdf->render();
$dompdf->stream('reporte-pacientes-medicos.pdf', array('Attachment' => false));

?>
