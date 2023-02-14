
<?php
//echo 'Hola desde el buscador';
//print_r($_POST);
session_start();
require_once("../Modelos/conexion.php");


$anio = date_create($_REQUEST['fecha_desde']);
$fecha = date_format($anio, 'Y');

$fecha_desde = date_create($_REQUEST['fecha_desde']);
$fecha_hasta = date_create($_REQUEST['fecha_hasta']);

$desde = date_format($fecha_desde, 'd-m-Y 00:00:00');
$hasta  = date_format($fecha_hasta, 'd-m-Y 23:00:00');

$hoy = date('d-m-Y');
$medico = trim($_SESSION['Nombre']);

//echo $fecha;
//exit();

if (empty($desde) && empty($hasta)) {
  $sql = mysqli_query($conection, "SELECT h.id,c.nombre,c.apellido,h.Estudio,h.Cedula,h.Atendedor,h.Fecha,h.Seguro,h.Monto,h.Descuento,h.MontoS,h.Comentario, h.fecha_2 
  FROM historial h inner join clientes c on c.cedula = h.cedula  where Fecha LIKE '%".$hoy."%' AND Atendedor LIKE '%".$medico."%' ORDER BY  h.id ASC");

}else{

  $sql = mysqli_query($conection, "SELECT h.id,c.nombre,c.apellido,h.Estudio,h.Cedula,h.Atendedor,h.Fecha,h.Seguro,h.Monto,h.Descuento,h.MontoS,h.Comentario, h.fecha_2 
  FROM historial h inner join clientes c on c.cedula = h.cedula  where Fecha BETWEEN '{$desde}' AND '{$hasta}' AND Atendedor LIKE '%".$medico."%' AND  Fecha LIKE '%".$fecha."%' ORDER BY  h.id ASC");

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
        <th>PDF</th>                                
      </tr>
    </thead>
    <tbody class="text-center">';
    $monto = 0;

  while ($data = mysqli_fetch_array($sql)){
    $monto += $data['Monto'];
    echo '<tr>
             <td>'. $data['nombre'].' '. $data['apellido'].'</td>
             <td>'. $data['Cedula']. '</td>
             <td>'. $data['Estudio']. '</td>
             <td>'. $data['Atendedor']. '</td>
             <td>'. $data['Seguro']. '</td>
             <td>'. $data['Monto']. '</td>
             <td>'. $data['Fecha']. '</td>
             <td>
                <a href="../Reportes/reportePacientes_doctores.php?id='. $data['id'].' " class="btn btn-outline-danger" target="_blank"><i class="fa fa-file-pdf-o"></i></a></td>
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
     
      <td class="text-center alert alert-success">'.number_format($monto, 3, '.', '.').'.<b>GS</b></td>
      
      
    </tr>
  </tfoot>
   </table>';
?>