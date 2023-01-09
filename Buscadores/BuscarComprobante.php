<?php 
 session_start();
 if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2 ){
  if (empty($_SESSION['active'])) {
  header('location: salir.php');
}

}else{
  header('location: salir.php');
}
$busqueda = '';
 $fecha_de = '';
 $fecha_a  = '';


 //La linea de Codigo es la validacion del parametro a buscar por fecha en el buscador por fecha
if (!empty($_REQUEST['fecha_de']) && !empty($_REQUEST['fecha_a'])) {
	$fecha_de = $_REQUEST['fecha_de'];
	$fecha_a = $_REQUEST['fecha_a'];

	$buscar = '';
}if ($fecha_de > $fecha_a) {
	header("location: ../Plantillas/comprobantes.php");
}else if ($fecha_de == $fecha_a) {

	$where = "Fecha LIKE '%$fecha_de%'";
	$buscar = "fecha_de=$fecha_de&fecha_a=$fecha_a";
}else {
	$f_de = $fecha_de.'00:00:00';
	$f_a  = $fecha_a.'23:00:00';
	$where = "Fecha BETWEEN '$f_de' AND '$f_a'";
	$buscar = "fecha_de=$fecha_de&fecha_a=$fecha_a";
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
      </div>
      
  

    
      <form  class="row" method="GET" action = "../Buscadores/BuscarComprobante.php" id="buscar">
        <div class="col-md-5">
            <div class="widget-small">   
            <input type="date" name="fecha_de" id="fecha_de"class="form-control" value="<?php echo $fecha_de; ?>" required>
            </div>
        </div>

        <div class="col-md-5">
            <div class="widget-small">   
            <input type="date" name="fecha_de" id="fecha_de"class="form-control" value="<?php echo $fecha_de; ?>" required>
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
                 <table id="tabla_Usuario" class="table table-striped table-bordered table-condensed" style="width:100%">
                  <thead>
                    <tr class="text-center">
                            <th>ID</th>
                            <th>Estudio</th>
                            <th>Sin Seguro</th>
                            <th>Semei</th>
                            <th>Semei Preferencial</th>                                
                            <th>Seguros</th>                                
                            <th>Seguros Preferencial</th>                                
                            <th>Hospitalario</th>                                
                            <th>Fecha</th>                                
                   
                        </tr>
                  </thead>

                  <tbody>
                      <?php 
                      #$fecha= date("d-m-Y");
                      #$nuevafecha = date("d-m-Y", strtotime($fecha));
                                          
                        $sql = mysqli_query($conection,"SELECT h.id,h.Estudio,h.Cedula,h.Atendedor,h.Fecha,h.Seguro,h.Monto,h.Comentario, h.fecha_2 FROM historial h 
                        where $where   ORDER BY  h.id DESC");

                         $resultado = mysqli_num_rows($sql);

                         if($resultado > 0){ 
                            while ($data = mysqli_fetch_array($sql)){ 
                      ?>
                        <tr class="text-center">
                             <td><?php echo $data['id'];?></td>
                             <td><?php echo $data['Estudio'];?></td>
 						     <td><?php echo $data['Cedula'];?></td>
 						     <td><?php echo $data['Atendedor'];?></td>
 						     <td><?php echo $data['Fecha']; ?></td>
                             <td><?php echo $data['Seguro']?></td>
                             <td><?php echo $data['Monto']?></td>
                             <td><?php echo $data['Comentario']?></td>
                             <td><?php echo $data['fecha_2']?></td>
 					        
                           
                           
                        </tr>
                     
                 
                  <?php }
                } ?>
                 </tbody>
                </table>
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
