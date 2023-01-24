
<?php
//echo 'Hola desde el buscador';
//print_r($_POST);
session_start();
require_once("../Modelos/conexion.php");


$fecha_desde = '';
$fecha_hasta  = '';
$estudio  = '';

#$medico=$_POST['medico'];
if (!empty($_REQUEST['fecha_desde']) && !empty($_REQUEST['fecha_hasta']) ) {
  $fecha_desde = date_create($_REQUEST['fecha_desde']);
  $desde = date_format($fecha_desde, 'd-m-Y');


  $fecha_hasta = date_create($_REQUEST['fecha_hasta']);
  $hasta = date_format($fecha_hasta, 'd-m-Y');

  $estudio = $_REQUEST['estudio'];

}

if(empty($desde) || empty($hasta)){
    $hoy = date("d-m-Y");

    $sql = mysqli_query($conection, "SELECT Estudio,count(*) as cantidad FROM historial WHERE
     Estudio LIKE '%".$estudio."%' AND FECHA LIKE '".$hoy."' GROUP BY Estudio ORDER BY cantidad");   

 }
 //else{

// $hoy = date("Y");

//   $sql = mysqli_query($conection, "SELECT h.id,c.nombre,h.Estudio,h.Cedula,h.Atendedor,h.Fecha,h.Seguro,h.Monto,h.Descuento,h.MontoS,h.Comentario, h.fecha_2 
//   FROM historial h inner join clientes c on c.cedula = h.cedula  where $where and Fecha like '%".$hoy."%' ORDER BY  h.id ASC");
// }





$resultado = mysqli_num_rows($sql);


echo ' 

<thead>
      <tr class="text-center">      
        <th>Estudio</th>
        <th>Cantidad</th>
                                   
      </tr>
    </thead>
    <tbody>';
    $total = 0;

  while ($data = mysqli_fetch_array($sql)){
    $total += $data['cantidad'];
    echo '<tr>
             <td>'. $data['Estudio']. '</td>
             <td>'. $data['cantidad']. '</td>
             

        </tr>';
  }
  echo
  '</tbody>
  <tfoot>
    <tr>
      <td><b>Cantidad Total : </b></td>
    
      <td class="text-center alert alert-success">'.number_format($total, 3, '.', '.').'.<b>GS</b></td>
      
      
    </tr>
  </tfoot>
   </table>';
?>