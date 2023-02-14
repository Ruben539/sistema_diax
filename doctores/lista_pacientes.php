<?php
session_start();
if (empty($_SESSION['active'])){

header('location: salir.php');  
}

 


require_once("../body/header_admin.php");

?>

<main class="app-content">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-list-ol"></i> Listado de Pacientes Atendidos
      </h1>
      <p>Registro Web en Desarrollo</p>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="table-responsive">
          <table id="tabla_Usuario" class="table table-striped table-bordered table-condensed" style="width:100%">
            <thead>
              <tr class="text-center">
                <th>ID</th>
                <th>Nombre</th>
                <th>Estudio</th>
                <th>Cedula</th>
                <th>Doctor</th>
                <th>Fecha</th>
                <th>Seguros</th>
                <th>Monto</th>
                <th>Comentario</th>
                <th>Estado</th>
               

              </tr>
            </thead>

            <tbody>
              <?php
              require_once("../Modelos/conexion.php");

             // $iduser = $_SESSION['idUser'];
              //print_r($iduser);
              //exit();
              
              $fecha  =  date('m-Y');
              $medico = trim($_SESSION['Nombre']);
             // print_r($medico.' '.$fecha);

              $sql = mysqli_query($conection, "SELECT h.id,c.nombre,c.apellido,h.Estudio,h.Cedula,h.Atendedor,h.Fecha,h.Seguro,h.Monto,h.Comentario,h.estado
              FROM historial h inner join clientes c on c.cedula = h.cedula  WHERE  Atendedor LIKE '%".$medico."%' AND Fecha LIKE '%".$fecha."%' AND estado LIKE '%Atendido%'");

              $resultado = mysqli_num_rows($sql);

              if ($resultado > 0) {
                while ($ver= mysqli_fetch_array($sql)) {
                  $datos = $ver[0]."||".
                   $ver[1]."||".
                   $ver[2]."||".
                   $ver[3]."||".
                   $ver[4]."||".
                   $ver[5]."||".
                   $ver[6]."||".
                   $ver[7]."||".
                   $ver[8]."||".
                   $ver[9]."||".
                   $ver[10]."||";
              ?>
                  <tr class="text-center">

                  <td><?= $ver[1]; ?></td>
                  <td><?= $ver[2]; ?></td>
                  <td><?= $ver[3]; ?></td>
                  <td><?= $ver[4]; ?></td>
                  <td><?= $ver[5]; ?></td>
                  <td><?= $ver[6]; ?></td>
                  <td><?= $ver[7]; ?></td>
                  <td><?= $ver[8]; ?></td>
                  <td><?= $ver[9]; ?></td>
                  <td style="color: green;"><?= $ver[10]; ?></td>
                  </tr>


              
            </tbody>
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
                <?php if($ver[7] == ''){ ?>
                  <td class="text-center" style="color: #00000;"><b><?= number_format(0, 3, '.', '.');?></b></td>
                  <?php }else{?>
                  <td class="text-center"  style="color: #00000;"><b><?= number_format(+$ver[7], 3, '.', '.');?></b></td>
                  <?php }?>
              </tr>
            </tfoot>
          </table>
          <?php }
              } ?>
        </div>
      </div>
    </div>
  </div>

<script type="text/javascript" src="../js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>
<script src="../js/usuario.js"></script>

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

  <script src="../js/funciones.js"></script>
  <script>
    function permisoAuto() {
      Swal.fire(
        'Lo Siento',
        'Pagina web no Disponible',
        'error'
      )
    }
  </script>