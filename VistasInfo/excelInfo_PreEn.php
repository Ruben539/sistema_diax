<?php 
$planillas = "Informe Pre-Ensamble.xls";
header("content-Type: application/vnd.ms-excel");
header("content-Disposition: attachment; filename=".$planillas);
header("Pragma: no-cache");
header("Expires: 0");
?>

 <table id="tabla_Ensamble" class="table table-striped table-bordered table-condensed" style="width:100%">
                  <thead>
                    <tr>
                            <th>Fecha</th>
                            <th>Modelo</th>
                            <th>Nro Partida</th>
                            <th>P1</th>
                            <th>P2</th>
                            <th>P3</th>
                            <th>P4</th>
                            <th>P5</th>
                            <th>P6</th>
                            <th>P7</th>
                            <th>P8</th>
                            <th>P9</th>
                            <th>P10</th>
                            <th>P11</th>
                            <th>Observacion</th>
                            <th>Usuario</th>
                              
                        </tr>
                  </thead>

                  <tbody>
                      <?php 
                      session_start();
                      require_once("../Modelos/conexion.php");
                        $sql = mysqli_query($conection,"SELECT id_ensamble,fecha_add,modelo,nro_partida,puesto1,puesto2,puesto3,puesto4,puesto5,puesto6,puesto7,puesto8
                        ,puesto9,puesto10,puesto11,observacion,usuario from preensamble where estatus = 1");

                         $resultado = mysqli_num_rows($sql);

                         if($resultado > 0){ 
                            while ($data = mysqli_fetch_array($sql)){ 
                      ?>
                        <tr>
                             <td><?php echo $data['fecha_add'];?></td>
 						     <td><?php echo $data['modelo'];?></td>
                             <td><?php echo $data['nro_partida'];?></td> 
 						     <td><?php echo $data['puesto1']; ?></td>
                             <td><?php echo $data['puesto2']; ?></td>
                             <td><?php echo $data['puesto3']; ?></td>
                             <td><?php echo $data['puesto4']; ?></td>
                             <td><?php echo $data['puesto5']; ?></td>
                             <td><?php echo $data['puesto6']; ?></td>
                             <td><?php echo $data['puesto7']; ?></td>
                             <td><?php echo $data['puesto8']; ?></td>
                             <td><?php echo $data['puesto9']; ?></td>
                             <td><?php echo $data['puesto10']; ?></td>
                             <td><?php echo $data['puesto11']; ?></td>
                             <td><?php echo $data['observacion']; ?></td>   
                             <td><?php echo $data['usuario']; ?></td>            

                          
                        </tr>
                     
                 
                  <?php }
                } ?>
                 </tbody>
                </table>