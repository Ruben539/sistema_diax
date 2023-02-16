<?php
//echo 'Hola desde el buscador';
//print_r($_POST);
session_start();
require_once("../Modelos/conexion.php");

$medico = '';
$fecha_desde = '';
$fecha_hasta  = '';
if(empty($_POST['fecha_desde']) || empty($_POST['fecha_hasta']) || empty($_POST['medico'])) {
  
  echo '<div class="alert alert-danger" role="alert">
    Debes seleccionar los parametros a buscar

  </div>';
  exit();
  
}

if (!empty($_REQUEST['fecha_desde']) && !empty($_REQUEST['fecha_hasta'])|| !empty($_REQUEST['medico'])) {
  $fecha_desde = date_create($_REQUEST['fecha_desde']);
  $desde = date_format($fecha_desde, 'd-m-Y');


  $fecha_hasta = date_create($_REQUEST['fecha_hasta']);
  $hasta = date_format($fecha_hasta, 'd-m-Y');

  $medico = trim($_POST['medico']);

 $buscar = '';
 $where = '';

}if ($desde > $hasta) {
 echo $alert = '<p class = "alert alert-danger">La Fecha de Inicio de la busqueda debe ser mayor a la del final</p>';
  exit();
  
}else if ($desde == $hasta) {

  $where = "Fecha LIKE '%$desde%' AND Atendedor LIKE '%$medico%'";

  $buscar = "fecha_desde=$desde&fecha_hasta=$hasta AND Atendedor LIKE '%$medico%' ";
}else {
  $f_de = $desde.'-00:00:00';
  $f_a  = $hasta.'-23:00:00';
  $where = "Fecha BETWEEN '$f_de' AND '$f_a' AND Atendedor LIKE '%$medico%' ";
  $buscar = "fecha_desde=$desde&fecha_hasta=$hasta AND Atendedor LIKE '%$medico%'";
}

$anio = date_create($_REQUEST['fecha_desde']);
$fecha = date_format($anio, 'm-Y');

  $sql = mysqli_query($conection, "SELECT h.id,c.nombre,c.apellido,h.Estudio,h.Cedula,h.Atendedor,h.Fecha,h.Seguro,h.Monto,h.Descuento,h.MontoS,h.Comentario, h.fecha_2 
  FROM historial h inner join clientes c on c.cedula = h.cedula  where $where and Fecha like '%".$fecha."%' ORDER BY  h.id ASC");
              




$resultado = mysqli_num_rows($sql);
  
if ($resultado > 0) {
  echo ' 
  <table id="tablaMedico" class="table table-striped table-bordered table-condensed" style="width:100%">
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
      $monto += (int)$data['Monto'];

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
<script type="text/javascript" src="../js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    tablaHerreria = $("#tablaMedico").DataTable({
      "columnDefs": [{
        "target": 1,
        "data": null
      }],

      //Para cambiar el lenguaje a español
      "language": {
        "lengthMenu": "Mostrar _MENU_ registros",
        "zeroRecords": "No se encontraron resultados",
        "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sSearch": "Buscar:",
        "oPaginate": {
          "sFirst": "Primero",
          "sLast": "Último",
          "sNext": "Siguiente",
          "sPrevious": "Anterior"
        },
        "sProcessing": "Procesando...",
      }
    });



  });
</script>