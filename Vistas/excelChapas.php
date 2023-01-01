<?php 
$planillas = "Chapas.xls";
header("content-Type: application/vnd.ms-excel");
header("content-Disposition: attachment; filename=".$planillas);
header("Pragma: no-cache");
header("Expires: 0");
?>

<div class="table-responsive">
                 <table id="tabla_Chapas" class="table table-striped table-bordered table-condensed" style="width:100%">
                  <thead>
                    <tr>
                            <th>Fecha</th>
                            <th>Serie</th>
                            <th>Desde</th>
                            <th>Hasta</th>  
                            <th>Observación</th>  
                            <th>Usuario</th>                        
                              
                        </tr>
                  </thead>

                  <tbody>
                      <?php 
                      session_start();
                      require_once("../Modelos/conexion.php");
                        $sql = mysqli_query($conection,"SELECT id_chapa,fecha_add,serie,desde,hasta,observacion,usuario
                         from chapas where estatus = 1");

                         $resultado = mysqli_num_rows($sql);

                         if($resultado > 0){ 
                            while ($data = mysqli_fetch_array($sql)){ 
                      ?>
                        <tr>
                             <td><?php echo $data['fecha_add'];?></td>
 						     <td><?php echo $data['serie'];?></td>
 						     <td><?php echo $data['desde']; ?></td>
                             <td><?php echo $data['hasta']?></td>
                             <td><?php echo $data['observacion']?></td>
                             <td><?php echo $data['usuario']?></td>
 					        
                        </tr>
                     
                 
                  <?php }
                } ?>
                 </tbody>
                </table>