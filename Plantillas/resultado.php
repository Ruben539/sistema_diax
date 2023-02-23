<?php

if (!session_start()){ 
  session_start();
if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2){
    if (empty($_SESSION['active'])) {
    header('location: salir.php');
}

}else{
  header('location: salir.php');  
}
}
require_once("../Modelos/conexion.php");

require_once("../body/header_admin.php");
?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-user"></i> Registro de Paciente  <a href="../Helpers/grabar_paciente.php"> 
        <button id="btnNew"  class="btn btn-primary" type="button"><i class="fa fa-plus" aria-hidden="true"></i>
         Nuevo</button></a>
        </h1>
          <p>Registro Web en Desarrollo</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
          <li class="breadcrumb-item"><i class="fa fa-book fa-lg"></i></li>
          <li class="breadcrumb-item active"><a href="#" onclick="excel()">Excel</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
             <h3 class='card-header text-center alert alert-success'>Detalles de la Orden Cargada</h3>
<?php


$id=$_POST['id'];
$ci=$_POST['identificacion'];
$seguro=$_POST['seguro'];
$segurot=$_POST['texto'];
$medico=$_POST['medico'];
$descuento=$_POST['descuento'];
$comentario=$_POST['comentario'];
$ecografias=$_POST['ecografias'];
$rayosx=$_POST['rayosx'];
$nacimiento=$_POST['nacimiento'];
#$pago=$_POST['pago'];
$total=0;
echo "<form action='pdf.php' method='post'>";
echo "<b class=''>Nombre: </b>". $id. "<br>";
if(!isset($segurot)){
  echo "<b>Seguro: </b>". $segurot. "<br>";
}
echo "<b>Seguro: </b>". 'Sin Seguro'. "<br>";
echo "<b>Medico Tratante : </b>". $medico. "<br>";
echo "<b>Cedula de Identidad : </b>". $ci. "<br>";
echo "<br><table border='1' align='center'>";
echo "<input type='hidden' name='seguro' value=".$seguro.">";
echo "<input type='hidden' name='segurot' value='".$segurot."'>";
echo "<input type='hidden' name='ci' value=".$ci.">";
echo "<input type='hidden' name='nombre' value='".$id."'>";
echo "<input type='hidden' name='medico' value='".$medico."'>";
echo "<input type='hidden' name='descuento' value='".$descuento."'>";
echo "<input type='hidden' name='comentario' value='".$comentario."'>";


$estudio = '';
$results[$seguro] = 0;
for ($i=0;$i<count($ecografias);$i++)
{
$estudio=trim($estudio.$ecografias[$i]).".";
$e2=trim($ecografias[$i]);
echo"<table class='table'>";
echo"<tbody>";
echo "<tr><td>Estudios a Realizar:". $ecografias[$i]. "</td><td align='right'>";
$raw_results2 = mysqli_query($conection,"select ". $seguro. " from tarifas where Estudio='".trim($ecografias[$i])."';") or die(mysqli_error($conection));
while($results = mysqli_fetch_array($raw_results2))
{
    echo $results[$seguro]. "</td></tr>";
             if ($e2 == 'Radiografias')
             {
             $results[$seguro]=$results[$seguro]*$rayosx;
             }
     $total=((int)$total + (int)$results[$seguro]);
     }

}

$total=$total-$descuento;
$total= number_format($total, 3, '.', '.');
if ($rayosx>0)
{

echo "<tr><td>Rayos X Numero de Posiciones:</td><td align='right'>". $rayosx. "</td></tr>";
#$estudio=$estudio." Numero de Posiciones Rayos X: ". $rayosx. ".";
}
echo "<tr><td><b><i>Descuento:</td><td align='right'><b><i>". $descuento. "</td></tr>";
echo "<tr><td><b><i>Total a Cobrar:</td><td align='right'><b><i>". $total. "</td></tr>";
echo"</tbody>";
echo"</table>";
echo "<input type='hidden' name='estudio' value='".$estudio."'>";
echo "<input type='hidden' name='monto' value=".$total.">";
echo "<input type='hidden' name='nacimiento' value=".$nacimiento.">";
echo "<table class='table'><tr><td><input class='btn btn-primary' type='submit' value='Guardar'>&nbsp;&nbsp;&nbsp;<a class='btn btn-secondary' href='../Plantillas/registro_pacientes.php'><i class='fa fa-fw fa-lg fa-times-circle'></i>Cancelar</a></td></tr></table>";
echo "</form>";
?>
</html>

        </div>
      </div>
    </main>
    
<script type="text/javascript" src="../js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
    tablaHerreria = $("#tabla_Usuario").DataTable({
       "columnDefs":[{
        "target": 1,
        "data":null
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
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });

      
    
});
</script>

<script>
  function permisoAuto(){
	Swal.fire(
		'Lo Siento',
		'No posee el Permiso para Eliminar un Registro',
		'error'
		)
}
</script>

<script>
  function excel(){
	Swal.fire(
		'Lo Siento',
		'No puede imprimir los usuarios, es informacion privada',
		'error'
		)
}
</script>