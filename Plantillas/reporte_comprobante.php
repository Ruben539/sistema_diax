<?php
session_start();
if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
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
      <h1><i class="fa fa-list-ol"></i> Reportes de los comprobantes por Fecha
      </h1>
      <p>Registro Web en Desarrollo</p>
    </div>
  </div>




  <form class="row" method="POST" action="../Reportes/reporte_comprobantes_pdf.php" target="_blank">
    <div class="col-md-5">
      <div class="widget-small">
        <input type="date" name="fecha_desde" id="fecha_desde" class="form-control" value="<?php echo date('d-m-Y');?>" required>
      </div>
    </div>

    <div class="col-md-5">
      <div class="widget-small">
        <input type="date" name="fecha_hasta" id="fecha_hasta" class="form-control" value="<?php echo date('d-m-Y');?>" required>
      </div>
    </div>

    <div class="col-md-2">

      <button class="btn btn-danger" type="submit"><i class="fa fa-file-pdf-o"></i>PDF</button>

    </div>
    </div>
  </form>


      <div class="tile">
           
        </div>
      </div>
   

  <form class="row" method="POST" action="../Reportes/reporte_comprobante_excel.php" target="_blank">
    <div class="col-md-5">
      <div class="widget-small">
        <input type="date" name="fecha_desde" id="fecha_desde" class="form-control" value="<?php echo date('d-m-Y');?>" required>
      </div>
    </div>

    <div class="col-md-5">
      <div class="widget-small">
        <input type="date" name="fecha_hasta" id="fecha_hasta" class="form-control" value="<?php echo date('d-m-Y');?>" required>
      </div>
    </div>

    <div class="col-md-2">
    <?php if ($_SESSION['rol'] == 1 ) {?>
      <button class="btn btn-success" type="submit"><i class="fa fa-file-excel-o"></i>EXCEL</button>
    <?php } ?>
    <?php if ($_SESSION['rol'] == 2 ) {?>
    <button class="btn btn-success" onclick=""><i class="fa fa-file-excel-o"></i>EXCEL</button>
    <?php } ?>
    </div>
    </div>
  </form>

</main>


<
<script>
  function permisoAuto() {
    Swal.fire(
      'No tienes Permisos',
      'Para generar una planilla excel',
      'error'
    )
  }
</script>

