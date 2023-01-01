<?php 
$planillas = "Herreria Liberados.xls";
header("content-Type: application/vnd.ms-excel");
header("content-Disposition: attachment; filename=".$planillas);
header("Pragma: no-cache");
header("Expires: 0");
?>

<table class="table table-hover table-bordered" id="tabla_Herreria">
                  <thead>
                    <tr>
                      <th>Fecha</th>
                      <th>Modelo</th>
                      <th>Nro Vehiculo</th>
                      <th>Color</th>
                      <th>Pieza</th>
                      <th>Falla Detectada</th>
                      <th>Sector</th>
                      <th>Estado</th>
                      <th>Fecha Fin</th>
                      <th>Usuario</th>
                    </tr>
                  </thead>
                  <tbody>
                       <?php 
                       session_start();
                       require_once("../Modelos/conexion.php");
                        $sql = mysqli_query($conection,"SELECT id_herreria,fecha_add,modelo,nro_vehiculo,color,pieza,falla_detectada,sector,estado,usuario,fecha_fin
                         from herreria where estatus = 0");

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
                            <td><?php echo $data['fecha_fin']; ?></td>
                            <td><?php echo $data['usuario']; ?></td>
 					    	                            
                        </tr>
                     
                 
                  <?php }
                } ?>
                  </tbody>
                </table>