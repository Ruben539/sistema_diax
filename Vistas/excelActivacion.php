<?php 
$planillas = "Activaciones.xls";
header("content-Type: application/vnd.ms-excel");
header("content-Disposition: attachment; filename=".$planillas);
header("Pragma: no-cache");
header("Expires: 0");
?>

             <table id="tabla_Activacion" class="table table-striped table-bordered table-condensed" style="width:100%">
                  <thead>
                    <tr class="text-center">
                            <th>Fecha</th>
                            <th>Modelo</th>
                            <th>Nro Vehiculo</th>
                            <th>Color</th>                                
                            <th>Nro de Chapa</th>  
                            <th>Falla Detectada</th>    
                            <th>Usuario</th>   
                        </tr>
                  </thead>

                  <tbody>
                      <?php 
                      session_start();
                      require_once("../Modelos/conexion.php");
                        $sql = mysqli_query($conection,"SELECT id_activacion,fecha_add,modelo,nro_vehiculo,color,nro_chapa,observacion,usuario,combu
                         from activaciones where estatus = 1");

                         $resultado = mysqli_num_rows($sql);

                         if($resultado > 0){ 
                            while ($data = mysqli_fetch_array($sql)){ 
                      ?>
                        <tr class="text-center">
                             <td><?php echo $data['fecha_add'];?></td>
 						                 <td><?php echo $data['modelo'];?></td>
 						                 <td><?php echo $data['nro_vehiculo']; ?></td>
                             <td><?php echo $data['color']?></td>
 					                   <td><?php echo $data['nro_chapa']; ?></td>
 					                   <td><?php echo $data['observacion']; ?></td>
                             <td><?php echo $data['combu']; ?></td>
 					                   <td><?php echo $data['usuario']; ?></td> 
                          
                         
                        </tr>
                     
                 
                  <?php }
                } ?>
                 </tbody>
                </table>