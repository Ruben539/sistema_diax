<?php 
$planillas = "Orden de Trabajo Liberados.xls";
header("content-Type: application/vnd.ms-excel");
header("content-Disposition: attachment; filename=".$planillas);
header("Pragma: no-cache");
header("Expires: 0");
?>

<table id="tabla_Cinta" class="table table-striped table-bordered table-condensed" style="width:100%">
                  <thead>
                    <tr>
                            <th>N° de Orden</th>
                            <th>Fecha</th>
                            <th>Generado Por</th>
                            <th>Sector Origen</th>
                            <th>Modelo</th>
                            <th>Nro Partida</th>                              
                            <th>Pieza</th>
                            <th>Color</th>  
                            <th>Cantidad</th>    
                            <th>Observacion</th>
                            <th>Sector Resposanble</th>
                            <th>Liberado Por</th>
                            <th>Fecha Fin</th>
                             
                        </tr>
                  </thead>

                  <tbody>
                      <?php 
                        session_start();
                        require_once("../Modelos/conexion.php");           
                        $sql = mysqli_query($conection,"SELECT id_orden,fecha_add,usuario_1,sector_1,modelo,nro_partida,pieza,color,
                        cantidad,observacion,sector_2,usuario_2,fecha_fin
                         from orden_trabajo WHERE estatus = 0");

                         $resultado = mysqli_num_rows($sql);
                    
                         if($resultado > 0){ 
                            while ($data = mysqli_fetch_array($sql)){ 
                      ?>
                        <tr>
                             <td><?php echo $data['id_orden'];?></td>
                             <td><?php echo $data['fecha_add'];?></td>
                             <td><?php echo $data['usuario_1']; ?></td>
 						     <td><?php echo $data['sector_1'];?></td>
 						     <td><?php echo $data['modelo']; ?></td>  
                             <td><?php echo $data['nro_partida']; ?></td> 
                             <td><?php echo $data['pieza']; ?></td> 
                             <td><?php echo $data['color']; ?></td> 
                             <td><?php echo $data['cantidad']; ?></td>
                             <td><?php echo $data['observacion']; ?></td> 
                             <td><?php echo $data['sector_2']; ?></td>
 						     <td><?php echo $data['usuario_2'];?></td>
                             <td><?php echo $data['fecha_fin'];?></td>
                            

                                                     
                        </tr>
                     
                 
                  <?php }
                } ?>
                 </tbody>
                </table>