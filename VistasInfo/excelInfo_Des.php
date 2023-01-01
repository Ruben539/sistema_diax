<?php 
$planillas = "Informe Desembalado.xls";
header("content-Type: application/vnd.ms-excel");
header("content-Disposition: attachment; filename=".$planillas);
header("Pragma: no-cache");
header("Expires: 0");
?>

            <table id="tabla_Deposito" class="table table-striped table-bordered table-condensed" style="width:100%">
                  <thead>
                    <tr>
                            <th>Fecha</th>
                            <th>Modelo</th>
                            <th>Nro Partida</th>
                            <th>Meta Diaria</th>                                
                            <th>Atraso</th>  
                            <th>Total a Producir</th> 
                            <th>Total Producido</th>   
                            <th>Diferencia</th>
                            <th>Observación</th>
                            <th>Usuario</th>
                             
                        </tr>
                  </thead>

                  <tbody>
                      <?php 
                      session_start();
                      require_once("../Modelos/conexion.php");
                        $sql = mysqli_query($conection,"SELECT id_infoDes,fecha_add,modelo,nro_partida,plan_diario,atraso,total_meta,cantidad,diferencia,observacion,usuario
                         from infoDesembalado where estatus = 1");

                         $resultado = mysqli_num_rows($sql);

                         if($resultado > 0){ 
                            while ($data = mysqli_fetch_array($sql)){ 
                      ?>
                        <tr>
                             <td><?php echo $data['fecha_add'];?></td>
 						                 <td><?php echo $data['modelo'];?></td>
 						                 <td><?php echo $data['nro_partida']; ?></td>
                             <td><?php echo $data['plan_diario']?></td>
 					                   <td><?php echo $data['atraso']; ?></td>
 					                   <td><?php echo $data['total_meta']; ?></td>
                             <td><?php echo $data['cantidad']; ?></td> 
 					                   <td><?php echo $data['diferencia']; ?></td> 
                             <td><?php echo $data['observacion']; ?></td> 
                             <td><?php echo $data['usuario']; ?></td> 
                                
                          
                        </tr>
                     
                 
                  <?php }
                } ?>
                 </tbody>
                </table>