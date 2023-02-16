<?php
session_start();
if ($_SESSION['rol'] == 4) {
  if (empty($_SESSION['active'])) {
    header('location: salir.php');
  }
} else {
  header('location: salir.php');
}


require_once("../body/header_admin.php");
?>

<main class="app-content">
  <div class="app-title">
    <div>
      <h1>Sistema Diax</h1>
      <p>Registro web de Pacientes en Desarrollo</p>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="#">Pagina de Inicio</a></li>
    </ul>
  </div>

  <br>
  <div class="tile">
    <div class="tile-body"><B>CANTIDAD DE PACIENTES DEL MES</B></div>

  </div>

  <div class="row">
    <!--widgets de Pacientes de Paz-->
    <div class="col-md-6">
      <div class="widget-small danger"><i class="icon fa fa-user-md fa-3x"></i>
        <div class="info">
          <h4 class="text-center"><a class="link" href="../doctores/lista_pacientes.php">En Espera</a></h4>

          <p id="idPacienteEspera" class="text-center" style="font-size: 50px;"><b>0</b></p>

        </div>
      </div>
    </div>

    <div class="col-md-6">
      <div class="widget-small primary"><i class="icon fa fa-user-md fa-3x"></i>
        <div class="info">
          <h4 class="text-center"><a class="link" href="../doctores/lista_pacientes.php">Atendidos</a></h4>
          <p id="idPacienteAtendido" class="text-center" style="font-size: 50px;"><b>0</b></p>
        </div>
      </div>
    </div>

   
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
                <th>Atendido</th>

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
              FROM historial h inner join clientes c on c.cedula = h.cedula  WHERE  Atendedor LIKE '%".$medico."%' AND Fecha LIKE '%".$fecha."%' AND estado LIKE '%En Espera%'
");

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
                  <td style="color: red;"><?= $ver[10]; ?></td>

                    <td>
                    <button class = "btn btn-outline-success" onclick="liberarDatos('<?php echo $ver[0] ?>')"><i class="fa fa-check" aria-hidden="true"></i></button>
                   
                    </td>


                  </tr>


              <?php }
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  <div id="idTabla">
      <div id="idGrafica"></div>
  </div>

  <!-- <div>
      <canvas id="myChart"></canvas>
      <button onclick="cargarDatosGrafica();"></button>
  </div> -->




</main>

<script src="../js/funciones.js"></script>
<script src="../js/usuario.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
   
        $('#btnEditarPass').click(function() {
            /* Act on the event */
            liberarDatos();
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Votes',
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });

  function cargarDatosGrafica(){
    $.ajax({
      url: 'grafica.php',
      type: 'POST',

    }).done(function(resp){
      alert(JSON.stringify(resp));

    })
  }
</script>
<script type="text/javascript" src="../js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    tablaHerreria = $("#tabla_Paz").DataTable({
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
