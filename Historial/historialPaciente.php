<?php
session_start();
if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2){
    if (empty($_SESSION['active'])) {
    header('location: salir.php');
}

}else{
  header('location: salir.php');  
}

require_once("../Modelos/conexion.php");

require_once("../body/header_admin.php");
?>

<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-th-list"></i> Buscador de Pacientes
        </h1>
          <p>Registro Web en Desarrollo</p>
        </div>
   
      </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                <form method="POST" action="">
                    <div class="mb-3">
                    <label class="form-label">Bucador de Pacientes :</label>
                    <input type="text" class="form-control" id="buscar" name="buscar" >
                    </div>
                    <button type="text" class="btn btn-primary">Buscar</button>
                </form>
                </div>
            </div>
        </div>
                <div class="card col-12 mt-0 border-0">
                <div class="card-body border-0">

<?php 
if(!empty($_POST))
{

        // resaltamos el resultado
        function resaltar_frase($string, $frase, $taga = '<b>', $tagb = '</b>'){
            return ($string !== '' && $frase !== '')
            ? preg_replace('/('.preg_quote($frase, '/').')/i'.('true' ? 'u' : ''), $taga.'\\1'.$tagb, $string)
            : $string;
             }
    
  
      $aKeyword = explode(" ", $_POST['buscar']);
      $query ="SELECT h.id,h.Cedula,c.Nombre,c.Celular,c.Sexo,c.Apellido,c.Nacimiento,h.Estudio,h.Atendedor,h.Seguro,h.Monto,h.Descuento,h.Comentario,h.Montos,h.Fecha
      FROM historial h  inner join clientes c on c.cedula = h.cedula WHERE h.Cedula LIKE LOWER('%".$aKeyword[0]."%') OR c.Nombre LIKE LOWER('%".$aKeyword[0]."%') ";
  

     for($i = 1; $i < count($aKeyword); $i++) {
        if(!empty($aKeyword[$i])) {
            $query .= " OR h.Cedula LIKE '%" . $aKeyword[$i] . "%' OR c.Nombre LIKE '%" . $aKeyword[$i] . "%'";
        }
      }
     
     $result = $conection->query($query);
     $numero = mysqli_num_rows($result);
     if (!isset($_POST['buscar'])){
     echo "Has buscado la palabra:<b> ". $_POST['buscar']."</b>";
     }

     if( mysqli_num_rows($result) > 0 AND $_POST['buscar'] != '') {
        $row_count=0;
        echo "<br>Resultados encontrados:<b> ".$numero."</b>";
        echo "<br><br><table class='table table-striped'>";
        While($row = $result->fetch_assoc()) {   
            $row_count++;

           echo '
           <h3 class="alert alert-success text-center">Datos del Paciente <i class="fa fa-user"></i></h3>
        <b><p>Nombre del Paciente : </b>'.resaltar_frase($row['Nombre'] ,$_POST['buscar']).' '.resaltar_frase($row['Apellido'] ,$_POST['buscar']).'</p>
        <b><p>Nro de Documento : </b>'.resaltar_frase($row['Cedula'] ,$_POST['buscar']).'</p>
        <b><p>Nro de Telefono : </b>'.resaltar_frase($row['Celular'] ,$_POST['buscar']).'</p>
  
        <table class="table table-striped table-bordered table-condensed text-center" style="width:100%">
        <thead>
        <tr>

           <th>Estudio</th>
           <th>Doctor</th>
           <th>Monto</th>
           <th>Fecha</th>
        </tr>

        </thead>
        <tbody>
          <tr>
            <td>'.resaltar_frase($row['Estudio'] ,$_POST['buscar']).'</td>
            <td>'.resaltar_frase($row['Atendedor'] ,$_POST['buscar']).'</td>
            <td>'.resaltar_frase($row['Monto'] ,$_POST['buscar']).'</td>
            <td>'.resaltar_frase($row['Fecha'] ,$_POST['buscar']).'</td>
          </tr>

        </tbody>
        <tr class="alert alert-success">
        <td>Monto Total : </td>
        <td></td>
        <td></td>
        
        <td class="alert alert-danger">'.resaltar_frase($row['Monto']++ ,$_POST['buscar']).'</td>
        </tfoot>
        <hr/>
        
        </table>
        <hr>
        
        
        <br>';
    }
   


        
	
    }
    
}
?>


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
		'No posee el Permiso para Eliminar un Paciente',
		'error'
		)
}
</script>

<script>
  function excel(){
	Swal.fire(
		'Lo Siento',
		'No puede imprimir la lista de Pacientes, es informacion privada',
		'error'
		)
}
</script>