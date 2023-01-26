<?php
session_start();
require_once("../Modelos/conexion.php");

$salida = '';
$vista = '<span>Ingrese su numero de Cedula, Nombre o id del Paciente</span>';


if (isset($_POST['consulta'])) {
    $res = $conection->real_escape_string($_POST['consulta']);

    $query = "SELECT h.id,h.Cedula,c.Nombre,c.Apellido,h.Estudio,h.Atendedor,h.Seguro,h.Monto,h.Descuento,h.Comentario,h.Montos,h.Fecha
    FROM historial h  inner join clientes c on c.cedula = h.cedula WHERE h.id LIKE '%".$res."%' OR h.Cedula LIKE '%".$res."%' OR C.Nombre LIKE 
    '%".$res."%' ";




$resultado =  $conection->query($query);

if ($resultado->num_rows > 0) {
    while ($datos = $resultado->fetch_assoc()) {
       
      $salida.= '<section class="invoice">
      <div class="row mb-4">

        <div class="col-6">
          <h2 class="page-header"><i class="fa fa-user"></i> DATOS DEL PACIENTE :</h2>
        </div>
        <div class="col-6">
          <h5 class="text-right">Fecha de Ingreso :</b>'.' '.$datos['Fecha'].'</h5>
        </div>
      </div>
      <hr>
      <div class="col-4"><b>Nro de Cedula :</b>'.' '.$datos['Cedula'].'.</div>
    <br>
    <div class="col-4"><b>Nombre del Paciente :</b>'.' '.$datos['Nombre'].' '.$datos['Apellido'].'.</div>
    <br>
    <div class="col-4"><b>Nombre del Doctor :</b>'.' '.$datos['Atendedor'].'.</div>
    <hr>
      <div class="row">
        <div class="col-12 table-responsive">
          <table class="table table-striped text-center">
            <thead>
              <tr>
                <th>Estudio</th>
                <th>Costo</th>
                <th>Descuento</th>
                <th>Observación</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>'.$datos['Estudio'].'</td>
                <td>'.$datos['Monto'].'</td>
                <td>'.$datos['Descuento'].'</td>
                <td>'.$datos['Comentario'].'</td>
                <td>
                    <a href="../Helpers/asignar_informante.php?id='. $datos['id'].' " class="btn btn-outline-primary" target="_blank"><i class="fa fa-user-md"></i> Asignar</a></td>
                </td>
              </tr>
             
            </tbody>
          </table>
        </div>
      </div>
      <br>
    </section>
    <hr>';
     }
   

    }
}else {
    echo $vista;
}

echo $salida;

?>