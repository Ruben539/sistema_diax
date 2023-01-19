<?php
//echo 'Hola desde el buscador';
//print_r($_POST);
session_start();
require_once("../Modelos/conexion.php");
$estudio = '';
$fecha_desde = '';
$fecha_hasta  = '';
if(empty($_POST['fecha_desde']) || empty($_POST['fecha_hasta'])) {
  
  echo '<div class="alert alert-danger" role="alert">
    Debes seleccionar las fechas
  </div>';
  exit();
  
}

if (!empty($_REQUEST['fecha_desde']) && !empty($_REQUEST['fecha_hasta']) && !empty($_REQUEST['estudio'])) {
  $fecha_desde = date_create($_REQUEST['fecha_desde']);
  $desde = date_format($fecha_desde, 'd-m-Y');


  $fecha_hasta = date_create($_REQUEST['fecha_hasta']);
  $hasta = date_format($fecha_hasta, 'd-m-Y');

  $estudio = trim($_POST['estudio']);

// echo $desde. ' - '. $hasta. ' - '. $estudio;
// exit();

 $buscar = '';
 $where = '';

}if ($desde > $hasta) {
 echo $alert = '<p class = "alert alert-danger">La Fecha de Inicio de la busqueda debe ser mayor a la del final</p>';
  exit();
  
}else if ($desde == $hasta) {

  $where = "Fecha LIKE '%$desde%' AND h.Estudio LIKE '%$estudio%'";

  $buscar = "fecha_desde=$desde&fecha_hasta=$hasta AND h.Estudio LIKE '%$estudio%'";
}else {
  $f_de = $desde.'-00:00:00';
  $f_a  = $hasta.'-23:00:00';
  $where = "Fecha BETWEEN '$f_de' AND '$f_a' AND h.Estudio LIKE '%$estudio%'";
  $buscar = "fecha_desde=$desde&fecha_hasta=$hasta h.AND Estudio LIKE '%$estudio%'";
}


// $fecha_desde = $_POST['fecha_desde'];
// $desde = date("d-m-Y", strtotime($fecha_desde));

// $fecha_hasta = $_POST['fecha_hasta'];
// $hasta = date("d-m-Y", strtotime($fecha_hasta));

//  echo $where;
//  exit;


$hoy = date("Y");
//echo $hoy;
//exit;


  $sql = mysqli_query($conection,"SELECT h.Estudio, count(*) as cantidad
  FROM historial h where  $where GROUP BY h.Estudio;");


$resultado = mysqli_num_rows($sql);
  $total = 0;
if ($resultado > 0) {
  echo ' 

  <thead>
        <tr class="text-center">      
      
          <th>Estudio</th>
          <th>Cantidad</th>
                                
        </tr>
      </thead>
      <tbody class="text-center">';
    
    while ($data = mysqli_fetch_array($sql)){
     $total = $data['cantidad'];


  
      echo '<tr>

      <td>'. $data['Estudio']. '</td>
      <td>'. $data['cantidad']. '</td>
      
  
          </tr>';
    }
    echo
    '</tbody>
    <setion>
    <p>Cantidad Total</p>
    <p style="text-align: right;" class="alert alert-danger">'.$total.'</p>
    </setion>


     </table>';

}else{
  echo $alert = '<p class = "alert alert-danger">No hay Registros</p>';
  exit();
}


?>