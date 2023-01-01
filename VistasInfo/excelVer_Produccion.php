<?php 
$planillas = "Informe de Produccion.xls";
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
                            <th>Nro Partida</th>
                            <th>Sector Responsable</th>
                            <th>Pieza No-Conforme</th>
                            <th>Falla Detectada</th>
                            <th>Solucion</th>
                            <th>Cantidad</th>
                            <th>Usuario</th>
                               
                        </tr>
                  </thead>

                  <tbody>
                      <?php 
                      session_start();
                      require_once("../Modelos/conexion.php");
                        $sql = mysqli_query($conection,"SELECT id_verProduccion,fecha_add,nro_partida,modelo,sector,pieza,falla_detectada,
		                  	solucion,cantidad,usuario from verificacion_produccion where estatus = 1");

                         $resultado = mysqli_num_rows($sql);

                         if($resultado > 0){ 
                            while ($data = mysqli_fetch_array($sql)){ 
                      ?>
                        <tr class="text-center">
                             <td><?php echo $data['fecha_add'];?></td>
 					         <td><?php echo $data['modelo'];?></td>
                             <td><?php echo $data['nro_partida'];?></td> 
                             <td><?php echo $data['sector'];?></td>
 					         <td><?php echo $data['pieza'];?></td>
                             <td><?php echo $data['falla_detectada'];?></td> 
                             <td><?php echo $data['solucion'];?></td>
 						     <td><?php echo $data['cantidad'];?></td>
                             <td><?php echo $data['usuario']; ?></td>

                           
</tr>
                     
                 
                  <?php }
                } ?>
                 </tbody>
                </table>