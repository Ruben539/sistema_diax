<?php
require_once("../Modelos/conexion.php");
date_default_timezone_set('America/Asuncion');
// include autoloader
require_once "../Library/dompdf/autoload.inc.php";
// reference the Dompdf namespace
use Dompdf\Dompdf;
$ci=$_POST['ci'];
$nombre=$_POST['nombre'];
$seguro=$_POST['seguro'];
$segurot=$_POST['segurot'];
$estudio=$_POST['estudio'];
$medico=$_POST['medico'];
$descuento=$_POST['descuento'];
$Fecha=date('d-m-Y H:i:s');
$monto=$_POST['monto'];
$comentario=$_POST['comentario'];
$nacimiento=$_POST['nacimiento'];
$estado='En Espera';


if ( $seguro == "SEMEI" or $seguro == "Seguros")
{
$sql = "INSERT INTO historial (Cedula,Seguro,Atendedor,MontoS,Estudio,Descuento,Comentario,Fecha,estado) VALUES ('$ci','$segurot','$medico','$monto','$estudio','$descuento','$comentario','$Fecha','$estado');";}else
    {
$sql = "INSERT INTO historial (Cedula,Seguro,Atendedor,Monto,Estudio,Descuento,Comentario,Fecha,estado) VALUES ('$ci','$segurot','$medico','$monto','$estudio','$descuento','$comentario','$Fecha','$estado');";
}
$result = mysqli_query($conection,$sql);
$sql2 = "select ID from historial where Fecha='$Fecha';";
$result2= mysqli_query($conection,$sql2);
$identificador= mysqli_fetch_array($result2);
header('location: registro_pacientes.php');

// if ($seguro == "SEMEI" or $seguro == "Seguros")
// {
// $html =
//   '<html><body>'.
//   '<table align="center" border="10">'.
//   '<tr>'.
//   '<td><font size="4">CLINICA MEDICA PAZ-DIAX</td>'.
//   '</tr>'.
//   '</table>'.
//   '<center><u><font size="2">USO INTERNO</u><br></center>'.
//   '<font size="2">Copia Paciente'.
//   '<table border="2px">'.
//   '<tr>'.
//   '<td><b><font size="2">Solicitante</td>'.
//   '<td><b><font size="2">CI:</td>'.
//   '<td><b><font size="2">Fecha Nacimiento:</td>'.
//   '<td><b><font size="2">Fecha Carga:</td>'.
//   '<td><b><font size="2">Estudio a realizar:</td>'.
//   '<td><b><font size="2">Medico:</td>'.
//   '<td><b><font size="2">ID:</td>'.
//   '</tr>'.
//   '<tr>'.
//   '<td><font size="2">'." ". $nombre . '</td>'.
//   '<td><font size="2">'." ". $ci . '</td>'.
//   '<td><font size="2">'." ". $nacimiento . '</td>'.
//   '<td><font size="2">'." ". $Fecha . '</td>'.
//   '<td><font size="2">'." ". $estudio . '</td>'.
//   '<td><font size="2">'." ". $medico . '</td>'.
//   '<td><font size="2">'." ". $identificador . '</td>'.
//   '</tr>'.
//   '</table>'.
//   '<br><HR width=100% >'.
//   '<table align="center" border="10">'.
//   '<tr>'.
//   '<td><font size="4">CLINICA MEDICA PAZ-DIAX</td>'.
//   '</tr>'.
//   '</table>'.
//   '<center><u><font size="2">USO INTERNO</u><br></center>'.
//   '<font size="2">Copia Caja'.
//   '<table border="2px">'.
//   '<tr>'.
//   '<td><b><font size="2">Solicitante</td>'.
//   '<td><b><font size="2">CI:</td>'.
//   '<td><b><font size="2">Fecha Nacimiento:</td>'.
//   '<td><b><font size="2">Fecha Carga:</td>'.
//   '<td><b><font size="2">Estudio a realizar:</td>'.
//   '<td><b><font size="2">Medico:</td>'.
//   '<td><b><font size="2">Descuento:</td>'.
//   '<td><b><font size="2">Seguro:</td>'.
//   '<td><b><font size="2">ID:</td>'.
//   '</tr>'.
//   '<tr>'.
//   '<td><font size="2">'." ". $nombre . '</td>'.
//   '<td><font size="2">'." ". $ci . '</td>'.
//   '<td><font size="2">'." ". $nacimiento . '</td>'.
//   '<td><font size="2">'." ". $Fecha . '</td>'.
//   '<td><font size="2">'." ". $estudio . '</td>'.
//   '<td><font size="2">'." ". $medico . '</td>'.
//   '<td><font size="2">'." ". $descuento . '</td>'.
//   '<td><font size="2">'." ". $segurot . '</td>'.
//   '<td><font size="2">'." ". $identificador . '</td>'.
//   '</tr>'.
//   '</table>'.
//   '</body></html>';
// }else{
// $html =
//   '<html><body>'.
//   '<table align="center" border="10">'.
//   '<tr>'.
//   '<td><font size="4">CLINICA MEDICA PAZ-DIAX</td>'.
//   '</tr>'.
//   '</table>'.
//   '<center><u><font size="2">USO INTERNO</u><br></center>'.
//   '<font size="2">Copia Paciente'.
//   '<table border="2px">'.
//   '<tr>'.
//   '<td><b><font size="2">Solicitante</td>'.
//   '<td><b><font size="2">CI:</td>'.
//   '<td><b><font size="2">Fecha Nacimiento:</td>'.
//   '<td><b><font size="2">Fecha Carga:</td>'.
//   '<td><b><font size="2">Estudio a realizar:</td>'.
//   '<td><b><font size="2">Medico:</td>'.
//   '<td><b><font size="2">Monto:</td>'.
//   '<td><b><font size="2">ID:</td>'.
//   '</tr>'.
//   '<tr>'.
//   '<td><font size="2">'." ". $nombre . '</td>'.
//   '<td><font size="2">'." ". $ci . '</td>'.
//   '<td><font size="2">'." ". $nacimiento . '</td>'.
//   '<td><font size="2">'." ". $Fecha . '</td>'.
//   '<td><font size="2">'." ". $estudio . '</td>'.
//   '<td><font size="2">'." ". $medico . '</td>'.
//   '<td><font size="2">'." ". $monto . '</td>'.
//   '<td><font size="2">'." ". $identificador . '</td>'.
//   '</tr>'.
//   '</table>'.
//   '<br><HR width=100% >'.
//   '<table align="center" border="10">'.
//   '<tr>'.
//   '<td><font size="4">CLINICA MEDICA PAZ-DIAX</td>'.
//   '</tr>'.
//   '</table>'.
//   '<center><u><font size="2">USO INTERNO</u><br></center>'.
//   '<font size="2">Copia Caja'.
//   '<table border="2px">'.
//   '<tr>'.
//   '<td><b><font size="2">Solicitante</td>'.
//   '<td><b><font size="2">CI:</td>'.
//   '<td><b><font size="2">Fecha Nacimiento:</td>'.
//   '<td><b><font size="2">Fecha Carga:</td>'.
//   '<td><b><font size="2">Estudio a realizar:</td>'.
//   '<td><b><font size="2">Medico:</td>'.
//   '<td><b><font size="2">Monto:</td>'.
//   '<td><b><font size="2">Descuento:</td>'.
//   '<td><b><font size="2">Seguro:</td>'.
//   '<td><b><font size="2">ID:</td>'.
//   '</tr>'.
//   '<tr>'.
//   '<td><font size="2">'." ". $nombre . '</td>'.
//   '<td><font size="2">'." ". $ci . '</td>'.
//   '<td><font size="2">'." ". $nacimiento . '</td>'.
//   '<td><font size="2">'." ". $Fecha . '</td>'.
//   '<td><font size="2">'." ". $estudio . '</td>'.
//   '<td><font size="2">'." ". $medico . '</td>'.
//   '<td><font size="2">'." ". $monto . '</td>'.
//   '<td><font size="2">'." ". $descuento . '</td>'.
//   '<td><font size="2">'." ". $segurot . '</td>'.
//   '<td><font size="2">'." ". $identificador . '</td>'.
//   '</tr>'.
//   '</table>'.
//   '</body></html>';
// }

// // instantiate and use the dompdf class
// $dompdf = new Dompdf();
// $dompdf->loadHtml($html);

// // (Optional) Setup the paper size and orientation
// $dompdf->setPaper('A4', 'portrait');

// // Render the HTML as PDF
// $dompdf->render();

// // Output the generated PDF to Browser
// $dompdf->stream($ci."-".$Fecha);
// //$output = $dompdf->output();
// //file_put_contents("historial/2335673.pdf", $output);
?>
