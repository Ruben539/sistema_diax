<?php
//echo 'Hola desde el buscador';
//print_r($_POST);
session_start();
require_once("../Modelos/conexion.php");

$anio = date_create($_POST['fecha_desde']);
$fecha = date_format($anio, 'm-Y');

$fecha_desde = date_create($_POST['fecha_desde']);
$fecha_hasta = date_create($_POST['fecha_hasta']);

$desde = date_format($fecha_desde, 'd-m-Y');
$hasta  = date_format($fecha_hasta, 'd-m-Y');

$hoy = date('d-m-Y');
$doctor = $_POST['medico'];


//echo $desde.' '.$hasta.' '.$fecha.''.$doctor;
//exit();

if (empty($desde) && empty($hasta)) {
  $sql = mysqli_query($conection, "SELECT h.id,c.nombre,c.apellido,h.Estudio,h.Cedula,h.Atendedor,h.Fecha,h.Seguro,h.Monto,h.Descuento,h.MontoS,h.Comentario, h.fecha_2 
  FROM historial h inner join clientes c on c.cedula = h.cedula  
  where Fecha LIKE '%".$hoy."%' AND  Atendedor LIKE '%".$doctor."%'  ");

}else{

  $sql = mysqli_query($conection, "SELECT h.id,c.nombre,c.apellido,h.Estudio,h.Cedula,h.Atendedor,h.Fecha,h.Seguro,h.Monto,h.Descuento,h.MontoS,h.Comentario, h.fecha_2 
  FROM historial h inner join clientes c on c.cedula = h.cedula  where Fecha BETWEEN '{$desde}' AND '{$hasta}' AND Atendedor LIKE '%".$doctor."%' AND Fecha LIKE '%".$fecha."%' ");
}




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
          <th>MontoS</th>                                
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
      <td>'. $data['MontoS']. '</td>
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