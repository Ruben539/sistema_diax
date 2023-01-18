<?php
//echo 'Hola desde el buscador';
//print_r($_POST);
session_start();
require_once("../Modelos/conexion.php");

#$medico=$_POST['medico'];
$medico = trim($_POST['medico']);

$fecha_desde = $_POST['fecha_desde'];
$desde = date("d-m-Y", strtotime($fecha_desde));

$fecha_hasta = $_POST['fecha_hasta'];
$hasta = date("d-m-Y", strtotime($fecha_hasta));

//  echo $desde." ".$hasta." ".$medico;
//  exit;


$hoy = date("d-m-Y");
//echo $hoy;
//exit;
if (empty($fecha_desde) || empty($fecha_hasta))  {
  $sql = mysqli_query($conection, "SELECT h.id,c.nombre,h.Estudio,h.Cedula,h.Atendedor,h.Fecha,h.Seguro,h.Monto,h.Descuento,h.MontoS,h.Comentario, h.fecha_2 
    FROM historial h inner join clientes c on c.cedula = h.cedula where  h.Fecha like '%$hoy%' AND h.Atendedor like '%".$medico."%'  ORDER BY  h.id ASC");

} else{

  $sql = mysqli_query($conection, "SELECT h.id,c.nombre,h.Estudio,h.Cedula,h.Atendedor,h.Fecha,h.Seguro,h.Monto,h.Descuento,h.MontoS,h.Comentario, h.fecha_2 
  FROM historial h inner join clientes c on c.cedula = h.cedula  where h.Fecha BETWEEN '".$desde."' AND '".$hasta."' 
  AND h.Atendedor like '%".$medico."%'  ORDER BY  h.id ASC");

}


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

    <td>'. $data['nombre']. '</td>
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
      <td class="text-center alert alert-success">'.number_format($monto, 3, '.', '.').'</td>

    </tr>
  </tfoot>
   </table>';

?>