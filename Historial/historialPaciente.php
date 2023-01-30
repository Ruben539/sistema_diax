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
          <h1>Historial del Paciente</h1>
          <p>Registro web  de Pacientes en Desarrollo</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Pagina de Inicio</a></li>
        </ul>
      </div>
      
      <label for="buscar" class="form-label">Buscar Paciente</label> 
        <div class="col-md-10">
            <div class="widget-small">  
                 <input type="text" name="buscar" id="buscar" class="form-control" placeholder="Ingrese la Busqueda">
            </div>
        </div>

       

        <div class="cold-md-12" id="buscar_paciente">

        </div>
         

</main>
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
  $(buscarDatos());

  async function  buscarDatos(consulta) {
    await $.ajax({
      url: '../Buscadores/BuscarClientes.php',
      type: 'POST',
      dataType: 'html',
      data:{ consulta: consulta }
    }).done(function (respuesta) {
      console.log('success');
      $('#buscar_paciente').html(respuesta);

      
    }).fail(function (respuesta) {
      console.log('error');
   })
  }

  $(document).on('keyup', '#buscar', function () {
      var valor = $(this).val();
      if (valor != "") {
        buscarDatos(valor);
      
    }else {
      buscarDatos();

    }
  }
)
</script>