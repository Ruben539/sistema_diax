<?php 
$planillas = "Reporte de Pintura.xls";
header("content-Type: application/vnd.ms-excel");
header("content-Disposition: attachment; filename=".$planillas);
header("Pragma: no-cache");
header("Expires: 0");
?>

<table id="tabla_Pintura" class="table table-striped table-bordered table-condensed" style="width:100%">
                  <thead>
                    <tr>
                            <th>Fecha</th>
                            <th>Modelo</th>
                            <th>Nro Vehiculo</th>
                            <th>Color</th>                                
                            <th>Pieza Averiada</th>  
                            <th>Falla Detectada</th>  
                            <th>Sector</th>
                            <th>Estado</th>  
                            <th>Usuario</th>
                            <th>Fecha Fin</th> 
                        </tr>
                  </thead>

                  <tbody>
                      <?php 
                      session_start();
                      require_once("../Modelos/conexion.php");
                        $sql = mysqli_query($conection,"SELECT id_pintura,fecha_add,modelo,nro_vehiculo,color,pieza,falla_detectada,usuario,sector,estado,fecha_fin
                         from pintura ");

                         $resultado = mysqli_num_rows($sql);

                         if($resultado > 0){ 
                            while ($data = mysqli_fetch_array($sql)){ 
                      ?>
                        <tr>
                             <td><?php echo $data['fecha_add'];?></td>
 						     <td><?php echo $data['modelo'];?></td>
 						     <td><?php echo $data['nro_vehiculo']; ?></td>
                             <td><?php echo $data['color']?></td>
 					         <td><?php echo $data['pieza']; ?></td>
 					         <td><?php echo $data['falla_detectada']; ?></td>
                             <td><?php echo $data['sector']; ?></td> 
                             <td><?php echo $data['estado']; ?></td> 
 					         <td><?php echo $data['usuario']; ?></td> 
                             <td><?php echo $data['fecha_fin']?></td>
                            
                        </tr>
                     
                 
                  <?php }
                } ?>
                 </tbody>
                </table>
