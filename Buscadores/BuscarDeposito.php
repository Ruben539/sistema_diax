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
$desposito ='Depositos';


//echo $desde.' '.$hasta.' '.$desposito;
//exit();

if (empty($_POST['fecha_desde']) && empty($_POST['fecha_hasta'])) {

 
  $sql = mysqli_query($conection, "SELECT i.id,i.Tipo,i.SubTipo,i.Monto,i.Factura,i.Concepto,i.Fmovimiento,i.Estado
  FROM historialie i where Fecha LIKE '%".$hoy."%' AND Tipo LIKE '%".$desposito."%' AND Fecha LIKE '%".$fecha."%'");

}else{ 

   $sql = mysqli_query($conection, "SELECT i.id,i.Tipo,i.SubTipo,i.Monto,i.Factura,i.Concepto,i.Fmovimiento,i.Estado
   FROM historialie i where Fecha BETWEEN '{$desde}' AND '{$hasta}' AND Tipo LIKE '%".$desposito."%' AND Fecha LIKE '%".$fecha."%' ");

}


$resultado = mysqli_num_rows($sql);
if($resultado == 0){
    echo '<div class="alert alert-danger" role="alert">No se encontraron Datos</div>';
    exit();
    

}


echo ' 

<thead>
      <tr class="text-center">      
        <th>Tipo</th>
        <th>SubTipo</th>                               
        <th>Monto</th>                                
        <th>Nro Factura</th>                                
        <th>Concepto</th>     
        <th>Estado</th>      
        <th>Fecha</th>                     
        <th>Editar</th>                     
      </tr>
    </thead>
    <tbody class="text-center">';
    $monto = 0;

  while ($data = mysqli_fetch_array($sql)){
    $monto += $data['Monto'];
    echo '<tr>
             <td>'. $data['Tipo']. '</td>
             <td>'. $data['SubTipo']. '</td>
             <td>'. $data['Monto']. '</td>
             <td>'. $data['Factura']. '</td>
             <td>'. $data['Concepto']. '</td>
             <td>'. $data['Estado']. '</td>
             <td>'. $data['Fmovimiento']. '</td>
             <td>
                <a href="../Helpers/modificar_movimiento.php?id='. $data['id'].' " class="btn btn-outline-info"><i class="fas fa-edit"></i></a></td>
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
      <td class="text-center alert alert-success">'.number_format($monto, 0, '.', '.').'.<b>GS</b></td>
      
      
    </tr>
  </tfoot>
   </table>';
?>