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
          <h1><i class="fa fa-th-list"></i> Buscador de Clientes
        </h1>
          <p>Registro Web en Desarrollo</p>
        </div>
   
      </div>
        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                <form method="POST" action="">
                    <div class="mb-3">
                    <label class="form-label">Bucador de Clientes</label>
                    <input type="text" class="form-control" id="buscar" name="buscar" >
                    </div>
                    <button type="text" class="btn btn-primary">Buscar</button>
                </form>
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
      $filtro = "WHERE Cedula LIKE LOWER('%".$aKeyword[0]."%') OR Nombre LIKE LOWER('%".$aKeyword[0]."%' OR Apellido LIKE LOWER('%".$aKeyword[0]."%')";
      $query ="SELECT c.id,c.Cedula,c.Nombre,c.Apellido,c.Celular,c.Sexo,c.Nacimiento FROM clientes c WHERE Cedula LIKE LOWER('%".$aKeyword[0]."%') OR Nombre LIKE LOWER('%".$aKeyword[0]."%') OR Apellido LIKE LOWER('%".$aKeyword[0]."%')";
  

     for($i = 1; $i < count($aKeyword); $i++) {
        if(!empty($aKeyword[$i])) {
            $query .= " OR Cedula LIKE '%" . $aKeyword[$i] . "%' OR Nombre LIKE '%" . $aKeyword[$i] . "%' OR Apellido LIKE '%" . $aKeyword[$i] . "%'";
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
            echo "<tr><td>".$row_count." </td><td>". resaltar_frase($row['Cedula'] ,$_POST['buscar']) . "</td><td>". resaltar_frase($row['Nombre'] ,$_POST['buscar']) . "</td>".
             "<td>"." </td><td>". resaltar_frase($row['Apellido'] ,$_POST['buscar']) . "</td><td>". resaltar_frase($row['Celular'] ,$_POST['buscar']) . "</td><td>". resaltar_frase($row['Sexo'] ,$_POST['buscar']) .
              "</td><td>". resaltar_frase($row['Nacimiento'] ,$_POST['buscar']) . 
              "</td><td>". '<a href="../Helpers/modificar_paciente.php?id='. $row['id'].' " class="btn btn-outline-primary" ><i class="fa fa-user-edit"></i> Editar</a>' .  "</td></tr>";
        }
        echo "</table>";
	
    }
    else {
      //mostramos todos los resultados
      if( $_REQUEST["mostrar_todo"] == 'ok') {
        $row_count=0;
        echo "<br>Resultados encontrados:<b> ".$numero."</b>";
        echo "<br><br><table class='table table-striped'>";
        While($row = $result->fetch_assoc()) {   
            $row_count++;   
            echo "<tr><td>".$row_count." </td><td>". resaltar_frase($row['Nombre'] ,$_POST['buscar']) . "</td><td>". resaltar_frase($row['Apellido'] ,$_POST['buscar']) . "</td></tr>";
        }
        echo "</table>";
	
    }
    }
}
?>


</div>
</div>
              </div>
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