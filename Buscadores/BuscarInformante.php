<?php
//echo 'Hola desde el buscador';
//print_r($_POST);
session_start();
require_once("../Modelos/conexion.php");
$medico = '';
$fecha_desde = '';
$fecha_hasta  = '';
if(empty($_POST['fecha_desde']) || empty($_POST['fecha_hasta'])) {
  
  echo '<div class="alert alert-danger" role="alert">
    Debes seleccionar las fechas
  </div>';
  exit();
  
}
#$medico=$_POST['medico'];
if (!empty($_REQUEST['fecha_desde']) && !empty($_REQUEST['fecha_hasta']) && !empty($_REQUEST['medico'])) {
  $fecha_desde = date_create($_REQUEST['fecha_desde']);
  $desde = date_format($fecha_desde, 'd-m-Y');


  $fecha_hasta = date_create($_REQUEST['fecha_hasta']);
  $hasta = date_format($fecha_hasta, 'd-m-Y');

  $medico = trim($_POST['medico']);

// echo $desde. ' - '. $hasta. ' - '. $medico;
// exit();

 $buscar = '';
 $where = '';

}if ($desde > $hasta) {
 echo $alert = '<p class = "alert alert-danger">La Fecha de Inicio de la busqueda debe ser mayor a la del final</p>';
  exit();
  
}else if ($desde == $hasta) {

  $where = "Fecha LIKE '%$desde%' AND Informa LIKE '%$medico%'";

  $buscar = "fecha_desde=$desde&fecha_hasta=$hasta AND Informa LIKE '%$medico%'";
}else {
  $f_de = $desde.'-00:00:00';
  $f_a  = $hasta.'-23:00:00';
  $where = "Fecha BETWEEN '$f_de' AND '$f_a' AND Informa LIKE '%$medico%'";
  $buscar = "fecha_desde=$desde&fecha_hasta=$hasta AND Informa LIKE '%$medico%'";
}


// $fecha_desde = $_POST['fecha_desde'];
// $desde = date("d-m-Y", strtotime($fecha_desde));

// $fecha_hasta = $_POST['fecha_hasta'];
// $hasta = date("d-m-Y", strtotime($fecha_hasta));

//  echo $where;
//  exit;


$anio = date_create($_REQUEST['fecha_desde']);
$fecha = date_format($anio, 'm-Y');
//echo $hoy;
//exit;


  $sql = mysqli_query($conection, "SELECT h.id,c.nombre,c.apellido,h.Estudio,h.Cedula,h.Atendedor,h.Fecha,h.Seguro,h.Monto,h.Descuento,h.Informa,h.Comentario, h.fecha_2 
  FROM historial h inner join clientes c on c.cedula = h.cedula  where $where and Fecha like '%".$fecha."%' ORDER BY  h.id ASC");




$resultado = mysqli_num_rows($sql);
  
if ($resultado > 0) {
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
          <th>Informante</th>                                
          <th>Fecha</th>                              
        </tr>
      </thead>
      <tbody>';
      $total = 0;
      $monto = 0;
      $montos = 0;
      $descuentos = 0;
    while ($data = mysqli_fetch_array($sql)){
      $monto += $data['Monto'];
      $montos += $data['MontoS'];
      $descuentos += $data['Descuento'];
      if(-$data['MontoS']){
          $total = $monto + $montos;
     }
      $total = $monto - $montos;
   
  
      echo '<tr>
  
      <td>'. $data['nombre'].' '. $data['apellido'].'</td>
      <td>'. $data['Cedula']. '</td>
      <td>'. $data['Estudio']. '</td>
      <td>'. $data['Atendedor']. '</td>
      <td>'. $data['Seguro']. '</td>
      <td>'. $data['Monto']. '</td>
      <td>'. $data['Descuento']. '</td>
      <td>'. $data['Informa']. '</td>
      <td>'. $data['Fecha']. '</td>
  
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
        <td class="text-center alert alert-success">'.number_format($monto, 3, '.', '.').'.<b>GS</b></td>
  
      </tr>
    </tfoot>
     </table>';

}else{
  echo $alert = '<p class = "alert alert-danger">No hay Registros</p>';
  exit();
}


?>