
<?php
//echo 'Hola desde el buscador';
//print_r($_POST);
session_start();
require_once("../Modelos/conexion.php");


$fecha_desde = '';
$fecha_hasta  = '';
$hoy = date("Y-m-d");


if (empty($_POST['fecha_desde']) && empty($_POST['fecha_hasta']) ) {

 
    $sql = mysqli_query($conection, "SELECT g.id,g.descripcion,g.monto,g.created_at
    FROM gastos g  where created_at like '%".$hoy."%' ");

}else{ 

    $fecha_desde = $_POST['fecha_desde'].
    $fecha_hasta  = $_POST['fecha_hasta'];
   // exit();

    $sql = mysqli_query($conection, "SELECT g.id,g.descripcion,g.monto,g.created_at
  FROM gastos g  where created_at BETWEEN '.$fecha_desde.' AND '.$fecha_hasta.' ORDER BY  h.id ASC");
}



$resultado = mysqli_num_rows($sql);


echo ' 

<thead>
      <tr class="text-center">      
        <th>Descripcion</th>
        <th>Monto</th>                               
        <th>Fecha</th>                                
      </tr>
    </thead>
    <tbody class="text-center">';
    $monto = 0;

  while ($data = mysqli_fetch_array($sql)){
    $monto += $data['monto'];
    echo '<tr>
             <td>'. $data['descripcion']. '</td>
             <td>'. $data['monto']. '</td>
             <td>'. $data['created_at']. '</td>

        </tr>';
  }
  echo
  '</tbody>
  <tfoot>
    <tr>
      <td><b>Total A Rendir : </b></td>
      <td></td>
    
      <td class="text-center alert alert-success">'.number_format($monto, 3, '.', '.').'.<b>GS</b></td>
      
      
    </tr>
  </tfoot>
   </table>';
?>