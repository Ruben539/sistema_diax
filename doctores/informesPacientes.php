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
      <h1><i class="fa fa-list-ol"></i> Informe de Pacientes por Fecha
      </h1>
      <p>Registro Web en Desarrollo</p>
    </div>
  </div>




  <form class="row" method="POST" id='formInformesDoctores' name='formInformesDoctores'>
    <div class="col-md-5">
      <div class="widget-small">
        <input type="date" name="fecha_desde" id="fecha_desde" class="form-control" >
      </div>
    </div>

    <div class="col-md-5">
      <div class="widget-small">
        <input type="date" name="fecha_hasta" id="fecha_hasta" class="form-control" >
      </div>
    </div>

    <div class="col-md-2">

      <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-search"></i>Filtrar

    </div>
    </div>
  </form>

  <div class="row">
    <div class="col-md-12">
      <div class="tile">
        <div class="table-responsive">
          <table id="tablaResultado" class="table table-striped table-bordered table-condensed table-hover" style="width:100%">

          </table>
        </div>
      </div>
    </div>
  </div>

</main>




<script type="text/javascript">
  $('#formInformesDoctores').submit(function(e) {
    e.preventDefault();

    var form = $(this);
    var url = form.attr('action');

    $.ajax({
      type: "POST",
      url: '../Buscadores/BuscarPacienteDoctores.php',
      data: form.serialize(),
      success: function(data) {
        $('#tablaResultado').html('');
        $('#tablaResultado').append(data);
      }

    });

  });
</script>
