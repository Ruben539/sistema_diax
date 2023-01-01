<?php 
$planillas = "Verificación de Probado.xls";
header("content-Type: application/vnd.ms-excel");
header("content-Disposition: attachment; filename=".$planillas);
header("Pragma: no-cache");
header("Expires: 0");
?>

 <table id="tabla_Probado" class="table table-striped table-bordered table-condensed" style="width:100%">
                  <thead>
                    <tr>
                            <th>Fecha</th>
                            <th>Modelo</th>
                            <th>Nro Partida</th>                              
                            <th>Falla detectada</th>      
                            <th>Cantidad</th>
                            <th>Observacion</th>
                            <th>Usuario</th>
                            
                        </tr>
                  </thead>

                  <tbody>
                      <?php 
                      session_start();
                      require_once("../Modelos/conexion.php");
                        $sql = mysqli_query($conection,"SELECT id_verProbado,fecha_add,modelo,nro_partida,falla_detectada,observacion,cantidad,usuario
                         from verificacion_probado where estatus = 1");

                         $resultado = mysqli_num_rows($sql);

                         if($resultado > 0){ 
                            while ($data = mysqli_fetch_array($sql)){ 
                      ?>
                        <tr>
                <td><?php echo $data['fecha_add'];?></td>
 						     <td><?php echo $data['modelo'];?></td>
 						     <td><?php echo $data['nro_partida']; ?></td>
                <td><?php echo $data['falla_detectada']?></td>
                <td><?php echo $data['cantidad']; ?></td>
 					       <td><?php echo $data['observacion']; ?></td>
                <td><?php echo $data['usuario']; ?></td> 
                           
                                      
                        </tr>
                     
                 
                  <?php }
                } ?>
                 </tbody>
                </table>