<?php 
 session_start();
 if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 ){
  if (empty($_SESSION['active'])) {
  header('location: salir.php');
}

}else{
  header('location: salir.php');
}


require_once("../body/header_admin.php");
 ?>

<main class="app-content">
      <div class="app-title">
      <div>
          <h1><i class="fa fa-list-ol"></i> Listado de Comprobantes 
        </h1>
          <p>Registro Web en Desarrollo</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item">  
            <a class="btn btn-danger" href="../Reportes/reporte_comprobantes_pdf.php" target="_blank" rel="noopener noreferrer">
              <i class="fa fa-file-pdf-o"></i> Reporte
            </a>
          </li>
          <li class="breadcrumb-item">
            <a class="btn btn-success" href="../Reportes/reporte_comprobante_excel.php" target="_blank" rel="noopener noreferrer">
              <i class="fa fa-file-excel-o"></i> Reporte
            </a>
          </li>
        </ul>
     
       
      </div>
      
  

    
      <form  class="row" method="POST" id='formFechas' name='formFechas'>
        <div class="col-md-5">
            <div class="widget-small">   
            <input type="date" name="fecha_desde" id="fecha_desde"class="form-control">
            </div>
        </div>

        <div class="col-md-5">
            <div class="widget-small">   
            <input type="date" name="fecha_hasta" id="fecha_hasta"class="form-control" >
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
             <div class="table-responsive" id="tablaResultado">

              </div>
            </div>
        </div>
      </div>


      <script src="../js/funciones.js"></script>
      <script>
  function permisoAuto(){
	Swal.fire(
		'Lo Siento',
		'Pagina web no Disponible',
		'error'
		)
}
</script>

<script type="text/javascript" >
    $('#formFechas').submit(function(e){
      e.preventDefault();

      var form  = $(this);
      var url = form.attr('action');

      $.ajax({
        type: "POST",
        url:'../Buscadores/BuscarComprobante.php',
        data: form.serialize(),
        success: function(data){
          $('#tablaResultado').html('');
          $('#tablaResultado').append(data);
        }
          
      });
    });
</script>

