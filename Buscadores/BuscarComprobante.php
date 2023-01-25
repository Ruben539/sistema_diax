
<?php
//echo 'Hola desde el buscador';
//print_r($_POST);
session_start();
require_once("../Modelos/conexion.php");


$fecha_desde = '';
$fecha_hasta  = '';
if(empty($_POST['fecha_desde']) || empty($_POST['fecha_hasta'])) {
  
  echo '<div class="alert alert-danger" role="alert">
    Debes seleccionar las fechas a buscar
  </div>';
  exit();
  
}
#$medico=$_POST['medico'];
if (!empty($_REQUEST['fecha_desde']) && !empty($_REQUEST['fecha_hasta']) ) {
  $fecha_desde = date_create($_REQUEST['fecha_desde']);
  $desde = date_format($fecha_desde, 'd-m-Y');


  $fecha_hasta = date_create($_REQUEST['fecha_hasta']);
  $hasta = date_format($fecha_hasta, 'd-m-Y');

 

// echo $desde. ' - '. $hasta. ' - '. $medico;
// exit();

 $buscar = '';
 $where = '';

}if ($desde > $hasta) {
 echo $alert = '<p class = "alert alert-danger">La Fecha de Inicio de la busqueda debe ser mayor a la del final</p>';
  exit();
  
}else if ($desde == $hasta) {

  $where = "Fecha LIKE '%$desde%'";

  $buscar = "fecha_desde=$desde&fecha_hasta=$hasta ";
}else {
  $f_de = $desde.'-00:00:00';
  $f_a  = $hasta.'-23:00:00';
  $where = "Fecha BETWEEN '$f_de' AND '$f_a' ";
  $buscar = "fecha_desde=$desde&fecha_hasta=$hasta ";
}

$hoy = date("Y");

  $sql = mysqli_query($conection, "SELECT h.id,c.nombre,h.Estudio,h.Cedula,h.Atendedor,h.Fecha,h.Seguro,h.Monto,h.Descuento,h.MontoS,h.Comentario, h.fecha_2 
  FROM historial h inner join clientes c on c.cedula = h.cedula  where $where and Fecha like '%".$hoy."%' ORDER BY  h.id ASC");




$resultado = mysqli_num_rows($sql);


echo ' 

<thead>
      <tr class="text-center">      
        <th>Nombre</th>
        <th>Cedula</th>
        <th>Estudio</th>
        <th>Doctor</th>
        <th>Seguro</th>                                
        <th>Monto</th>                                
        <th>Descuento</th>                                
        <th>MontoS</th>                                
        <th>Fecha</th>                                
        <th>PDF</th>                                
      </tr>
    </thead>
    <tbody class="text-center">';
    $monto = 0;

  while ($data = mysqli_fetch_array($sql)){
    $monto += $data['Monto'];
    echo '<tr>
             <td>'. $data['nombre']. '</td>
             <td>'. $data['Cedula']. '</td>
             <td>'. $data['Estudio']. '</td>
             <td>'. $data['Atendedor']. '</td>
             <td>'. $data['Seguro']. '</td>
             <td>'. $data['Monto']. '</td>
             <td>'. $data['Descuento']. '</td>
             <td>'. $data['MontoS']. '</td>
             <td>'. $data['Fecha']. '</td>
             <td>
                <a href="../Reportes/reporte_paciente.php?id='. $data['id'].' " class="btn btn-outline-danger" target="_blank"><i class="fa fa-file-pdf-o"></i></a></td>
             </td>

        </tr>';
  }
  echo
  '</tbody>
  <tfoot>
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
      <td class="text-center alert alert-success">'.number_format($monto, 3, '.', '.').'.<b>GS</b></td>
      
      
    </tr>
  </tfoot>
   </table>';
?>