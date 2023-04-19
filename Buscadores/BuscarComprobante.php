
<?php
//echo 'Hola desde el buscador';
//print_r($_POST);
session_start();
require_once("../Modelos/conexion.php");


$anio = date_create($_REQUEST['fecha_desde']);
$fecha = date_format($anio, 'm-Y');

$fecha_desde = date_create($_REQUEST['fecha_desde']);
$fecha_hasta = date_create($_REQUEST['fecha_hasta']);

$desde = date_format($fecha_desde, 'd-m-Y 00:00:00');
$hasta  = date_format($fecha_hasta, 'd-m-Y 23:00:00');

$hoy = date('d-m-Y');

//echo $fecha;
//exit();

if (empty($desde) && empty($hasta)) {
  $sql = mysqli_query($conection, "SELECT h.id,c.nombre,c.apellido,h.Estudio,h.Cedula,h.Atendedor,h.Fecha,h.Seguro,h.Monto,h.Descuento,h.MontoS,h.Comentario, h.fecha_2 
  FROM historial h inner join clientes c on c.cedula = h.cedula  where   Fecha LIKE '%".$hoy."%'");

}else{

  $sql = mysqli_query($conection, "SELECT h.id,c.nombre,c.apellido,h.Estudio,h.Cedula,h.Atendedor,h.Fecha,h.Seguro,h.Monto,h.Descuento,h.MontoS,h.Comentario, h.fecha_2 
  FROM historial h inner join clientes c on c.cedula = h.cedula  where Fecha BETWEEN '{$desde}' AND '{$hasta}'AND  Fecha LIKE '%".$fecha."%'");

}






$resultado = mysqli_num_rows($sql);


echo ' 
<table id="tablaComprobante" class="table table-striped table-bordered table-condensed table-hover" style="width:100%">
<thead>
      <tr class="text-center">      
        <th>Nro.</th>
        <th>Nombre</th>
        <th>Cedula</th>
        <th>Estudio</th>
        <th>Doctor</th>
        <th>Seguro</th>                                
        <th>Monto</th>                                
        <th>Descuento</th>                                
        <th>MontoS</th>                                
        <th>Fecha</th>                                
        <th>PDF</th>                                
      </tr>
    </thead>
    <tbody class="text-center">';
    $monto = 0;
    $row = 0;
  while ($data = mysqli_fetch_array($sql)){
    $monto += $data['Monto'];
    $row++;
    echo '<tr>
             <td>'. $row.'</td>
             <td>'. $data['nombre'].' '. $data['apellido'].'</td>
             <td>'. $data['Cedula']. '</td>
             <td>'. $data['Estudio']. '</td>
             <td>'. $data['Atendedor']. '</td>
             <td>'. $data['Seguro']. '</td>
             <td>'. $data['Monto']. '</td>
             <td>'. $data['Descuento']. '</td>
             <td>'. $data['MontoS']. '</td>
             <td>'. $data['Fecha']. '</td>
             <td>
                <a href="../Reportes/reporte_paciente.php?id='. $data['id'].' " class="btn btn-outline-danger" target="_blank"><i class="fa fa-file-pdf-o"></i></a></td>
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
      <td></td>
      <td></td>
      <td class="text-center alert alert-success">'.number_format($monto, 3, '.', '.').'.<b>GS</b></td>
      
      
    </tr>
  </tfoot>
   </table>';
?>

<script type="text/javascript" src="../js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    tablaHerreria = $("#tablaComprobante").DataTable({
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