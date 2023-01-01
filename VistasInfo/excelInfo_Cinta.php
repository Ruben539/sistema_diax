<?php 
$planillas = "Informe Cinta.xls";
header("content-Type: application/vnd.ms-excel");
header("content-Disposition: attachment; filename=".$planillas);
header("Pragma: no-cache");
header("Expires: 0");
?>

<table id="tabla_Cinta" class="table table-striped table-bordered table-condensed" style="width:100%">
                  <thead>
                    <tr>
                            <th>Fecha</th>
                            <th>Modelo</th>
                            <th>Nro Partida</th>                              
                            <th>Turno</th>  
                            <th>Tiempo Trabajado</th>    
                            <th>Cant. Producida</th>
                            <th>No-Conforme</th>
                            <th>Hora Arranque</th>
                            <th>Hora Paro</th>
                            <th>Observacion</th>
                              
                        </tr>
                  </thead>

                  <tbody>
                      <?php 
                      session_start();
                      require_once("../Modelos/conexion.php");
                        $sql = mysqli_query($conection,"SELECT id_infoCinta,fecha_add,modelo,nro_partida,turno,tiempo_encendido,cant_producida,no_conformes,hora_arranque,hora_final,observacion
                         from informecinta where estatus = 1");

                         $resultado = mysqli_num_rows($sql);

                         if($resultado > 0){ 
                            while ($data = mysqli_fetch_array($sql)){ 
                      ?>
                        <tr>
                             <td><?php echo $data['fecha_add'];?></td>
 						     <td><?php echo $data['modelo'];?></td>
                             <td><?php echo $data['nro_partida']; ?></td>
                             <td><?php echo $data['turno']?></td>
 					         <td><?php echo $data['tiempo_encendido']; ?></td>
 					         <td><?php echo $data['cant_producida']; ?></td>
                             <td><?php echo $data['no_conformes']; ?></td>
 					         <td><?php echo $data['hora_arranque']; ?></td>
                             <td><?php echo $data['hora_final']; ?></td>  
                             <td><?php echo $data['observacion']; ?></td>                                 
                        </tr>
                     
                 
                  <?php }
                } ?>
                 </tbody>
                </table>
