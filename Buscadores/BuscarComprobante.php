
<?php
//echo 'Hola desde el buscador';
//print_r($_POST);
session_start();
require_once("../Modelos/conexion.php");

$fecha_desde = $_POST['fecha_desde'];
$desde = date("d-m-Y", strtotime($fecha_desde));

$fecha_hasta = $_POST['fecha_hasta'];
$hasta = date("d-m-Y", strtotime($fecha_hasta));

 //echo $desde.$hasta;
 //exit;


$hoy = date("d-m-Y");
//echo $hoy;
//exit;
if (empty($fecha_desde) || empty($fecha_hasta))  {
  $sql = mysqli_query($conection, "SELECT h.id,c.nombre,h.Estudio,h.Cedula,h.Atendedor,h.Fecha,h.Seguro,h.Monto,h.Descuento,h.MontoS,h.Comentario, h.fecha_2 
    FROM historial h inner join clientes c on c.cedula = h.cedula where  h.Fecha like '%$hoy%'   ORDER BY  h.id ASC");

} else{

  $sql = mysqli_query($conection, "SELECT h.id,c.nombre,h.Estudio,h.Cedula,h.Atendedor,h.Fecha,h.Seguro,h.Monto,h.Descuento,h.MontoS,h.Comentario, h.fecha_2 
  FROM historial h inner join clientes c on c.cedula = h.cedula  where h.Fecha BETWEEN '{$desde}' AND '{$hasta}' ORDER BY  h.id ASC");

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
      <td class="alert alert-success text-center">'.$monto.'.000GS</td>
      
      
    </tr>
  </tfoot>
   </table>';
?>