<?php 
$planillas = "Verificación de Herreria.xls";
header("content-Type: application/vnd.ms-excel");
header("content-Disposition: attachment; filename=".$planillas);
header("Pragma: no-cache");
header("Expires: 0");
?>

 <table id="tabla_Verificacion" class="table table-striped table-bordered table-condensed" style="width:100%">
                  <thead>
                    <tr>
                            <th>Fecha</th>
                            <th>Modelo</th>
                            <th>Nro Partida</th>
                            <th>Sin Soportes</th>
                            <th>Soporte mal Soldados</th>
                            <th>Soporte Motor Mal Soldado</th>
                            <th>Mala Soldadura</th>
                            <th>Exceso de Escoria</th>
                            <th>Desalineado</th>
                            <th>Fisura</th>
                            <th>Rotura</th>
                            <th>Observacion</th>
                            <th>Usuario</th>
                            
                        </tr>
                  </thead>

                  <tbody>
                      <?php 
                      session_start();
                      require_once("../Modelos/conexion.php");
                        $sql = mysqli_query($conection,"SELECT id_verHerreria,fecha_add,modelo,nro_partida,sin_soporte,soporte_1,soporte_2,mala_soldadura,exceso_escoria,
                        desalineado,fisura,rotura,observacion,usuario from verificacion_herreria where estatus = 1");

                         $resultado = mysqli_num_rows($sql);

                         if($resultado > 0){ 
                            while ($data = mysqli_fetch_array($sql)){ 
                      ?>
                        <tr>
                             <td><?php echo $data['fecha_add'];?></td>
 						     <td><?php echo $data['modelo'];?></td>
                             <td><?php echo $data['nro_partida'];?></td> 
                             <td><?php echo $data['sin_soporte'];?></td> 
 						     <td><?php echo $data['soporte_1']; ?></td>
                             <td><?php echo $data['soporte_2']; ?></td>
                             <td><?php echo $data['mala_soldadura']; ?></td>
                             <td><?php echo $data['exceso_escoria']; ?></td>
                             <td><?php echo $data['desalineado']; ?></td>
                             <td><?php echo $data['fisura']; ?></td>
                             <td><?php echo $data['rotura']; ?></td>
                             <td><?php echo $data['observacion']; ?></td>
                             <td><?php echo $data['usuario']; ?></td>                        

                          
                        </tr>
                     
                 
                  <?php }
                } ?>
                 </tbody>
                </table>