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
  
  $sql =  mysqli_query($conection,"SELECT h.id,h.Estudio,h.Cedula,h.Atendedor,h.Fecha,h.Seguro,h.Monto,h.Descuento,h.MontoS, h.fecha_2 FROM historial h 
    where h.Atendedor like '%$medico%' AND h.Fecha like '%$hoy%' ORDER BY  h.id DESC");
} else{

  $sql = mysqli_query($conection,"SELECT h.id,h.Estudio,h.Cedula,h.Atendedor,h.Fecha,h.Seguro,h.Monto,h.Descuento,h.MontoS, h.fecha_2 FROM historial h 
    where h.Atendedor like '%$medico%' AND h.Fecha BETWEEN '{$desde}' AND '{$hasta}' ORDER BY  h.id DESC");

}


$resultado = mysqli_num_rows($sql);



echo ' 

<thead>
      <tr class="text-center">      
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
  while ($data = mysqli_fetch_array($sql)){
    $total += $data['Monto'];
    $monto += $data['MontoS'];
    echo '<tr>

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
      <td class="text-center">'.$total.'</td>
      <td></td>
      <td class="text-center">'.$monto.'</td>
      <td></td>
     
    </tr>
  </tfoot>
   </table>';

?>