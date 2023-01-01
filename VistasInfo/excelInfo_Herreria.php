<?php 
$planillas = "Informe Herreria.xls";
header("content-Type: application/vnd.ms-excel");
header("content-Disposition: attachment; filename=".$planillas);
header("Pragma: no-cache");
header("Expires: 0");
?>


<table id="tabla_Herreria" class="table table-striped table-bordered table-condensed" style="width:100%">
                  <thead>
                    <tr>
                        
                            <th>Fecha</th>
                            <th>Modelo</th>
                            <th>Nro Partida</th>
                            <th>Meta Varilla</th>
                            <th>Meta Sosten</th>
                            <th>Meta Caballete</th>
                            <th>Meta Horquilla</th>
                            <th>Meta Posapie</th>
                            <th>Meta Manubrio</th>
                            <th>Meta sop. Mandil</th>
                            <th>Meta Posapie Tras 1</th>
                            <th>Meta Posapie Tras 2</th>
                            <th>Meta Sop. Motor</th>
                            <th>Meta Sop. Bateria</th>
                            <th>Meta Sop. Cub. Tanque</th>
                            <th>Meta Sop. Velocimetro</th>  
                            <th>Meta Adorno Posapie</th>
                            <th>Meta Porta Bulto</th>
                            <th>Meta Chasis</th>
                            <th>Meta Sop. Freno</th>
                            <th>Meta Tanque</th>
                            <th>Produc. Varilla</th>
                            <th>Produc. Sosten</th>
                            <th>Produc. Caballete</th>
                            <th>Produc. Horquilla</th>
                            <th>Produc. Posapie</th>
                            <th>Produc. Manubrio</th>
                            <th>Produc. sop. Mandil</th>
                            <th>Produc. Posapie Tras 1</th>
                            <th>Produc. Posapie Tras 2</th>
                            <th>Produc. Sop. Motor</th>
                            <th>Produc. Sop. Bateria</th>
                            <th>Produc. Sop. Cub. Tanque</th>
                            <th>Produc. Sop. Velocimetro</th>  
                            <th>Produc. Adorno Posapie</th>
                            <th>Produc. Porta Bulto</th>
                            <th>Produc. Chasis</th>
                            <th>Produc. Sop. Freno</th>
                            <th>Produc. Tanque</th>
                            <th>Difer. Varilla</th>
                            <th>Difer. Sosten</th>
                            <th>Difer. Caballete</th>
                            <th>Difer. Horquilla</th>
                            <th>Difer. Posapie</th>
                            <th>Difer. Manubrio</th>
                            <th>Difer. sop. Mandil</th>
                            <th>Difer. Posapie Tras 1</th>
                            <th>Difer. Posapie Tras 2</th>
                            <th>Difer. Sop. Motor</th>
                            <th>Difer. Sop. Bateria</th>
                            <th>Difer. Sop. Cub. Tanque</th>
                            <th>Difer. Sop. Velocimetro</th>  
                            <th>Difer. Adorno Posapie</th>
                            <th>Difer. Porta Bulto</th>
                            <th>Difer. Chasis</th>
                            <th>Difer. Sop. Freno</th>
                            <th>Difer. Tanque</th>                            
                            <th>Observacion</th>
                            <th>Usuario</th>
                              
                        </tr>
                  </thead>

                  <tbody>
                      <?php 

                      session_start();
                      require_once("../Modelos/conexion.php");

                       $sql = mysqli_query($conection,"SELECT id_infoHerreria,fecha_add,nro_partida,modelo,meta_varilla,meta_sosten,meta_horquilla,
			                meta_caballete,meta_posapie,meta_manubrio,meta_mandil,meta_posapie1,meta_posapie2,meta_motor,meta_bateria,meta_cutanque,
		                	meta_velocimetro,meta_adorno,meta_bulto,meta_chasis,meta_freno,meta_tanque,total_varilla,total_sosten,total_horquilla,
		                	total_caballete,total_posapie,total_manubrio,total_mandil,total_posapie1,total_posapie2,total_motor,total_bateria,total_cutanque,
		                	total_velocimetro,total_adorno,total_bulto,total_chasis,total_freno,total_tanque,diferencia_varilla,diferencia_sosten,diferencia_horquilla,
		                  	diferencia_caballete,diferencia_posapie,diferencia_manubrio,diferencia_mandil,diferencia_posapie1,diferencia_posapie2,diferencia_motor,diferencia_bateria,diferencia_cutanque,
		                  	diferencia_velocimetro,diferencia_adorno,diferencia_bulto,diferencia_chasis,diferencia_freno,diferencia_tanque,observacion,usuario from infoherreria where estatus = 1");
                       

                         $resultado = mysqli_num_rows($sql);

                         if($resultado > 0){ 
                            while ($data = mysqli_fetch_array($sql)){ 
                      ?>
                        <tr class="text-center">
                             <td><?php echo $data['fecha_add'];?></td>
 						     <td><?php echo $data['modelo'];?></td>
                             <td><?php echo $data['nro_partida'];?></td> 
                             <td><?php echo $data['meta_varilla']; ?></td> 
                             <td><?php echo $data['meta_sosten']; ?></td>
                             <td><?php echo $data['meta_caballete']; ?></td> 
                             <td><?php echo $data['meta_horquilla']; ?></td>
                             <td><?php echo $data['meta_posapie']; ?></td>                           
 						     <td><?php echo $data['meta_manubrio']; ?></td>
                             <td><?php echo $data['meta_mandil']; ?></td>                           
 						     <td><?php echo $data['meta_posapie1']; ?></td>
                             <td><?php echo $data['meta_posapie2']; ?></td> 
                             <td><?php echo $data['meta_motor']; ?></td>
                             <td><?php echo $data['meta_bateria']; ?></td> 
                             <td><?php echo $data['meta_cutanque']; ?></td>
                             <td><?php echo $data['meta_velocimetro']; ?></td> 
                             <td><?php echo $data['meta_adorno']; ?></td>
                             <td><?php echo $data['meta_bulto']; ?></td> 
                             <td><?php echo $data['meta_chasis']; ?></td>
                             <td><?php echo $data['meta_freno']; ?></td> 
                             <td><?php echo $data['meta_tanque']; ?></td>                     
                             <td><?php echo $data['total_varilla']; ?></td> 
                             <td><?php echo $data['total_sosten']; ?></td>
                             <td><?php echo $data['total_caballete']; ?></td> 
                             <td><?php echo $data['total_horquilla']; ?></td>
                             <td><?php echo $data['total_posapie']; ?></td>                           
 						     <td><?php echo $data['total_manubrio']; ?></td>
                             <td><?php echo $data['total_mandil']; ?></td>                           
 						     <td><?php echo $data['total_posapie1']; ?></td>
                             <td><?php echo $data['total_posapie2']; ?></td> 
                             <td><?php echo $data['total_motor']; ?></td>
                             <td><?php echo $data['total_bateria']; ?></td> 
                             <td><?php echo $data['total_cutanque']; ?></td>
                             <td><?php echo $data['total_velocimetro']; ?></td> 
                             <td><?php echo $data['total_adorno']; ?></td>
                             <td><?php echo $data['total_bulto']; ?></td> 
                             <td><?php echo $data['total_chasis']; ?></td>
                             <td><?php echo $data['total_freno']; ?></td> 
                             <td><?php echo $data['total_tanque']; ?></td> 
                             <td><?php echo $data['diferencia_varilla']; ?></td> 
                             <td><?php echo $data['diferencia_sosten']; ?></td>
                             <td><?php echo $data['diferencia_caballete']; ?></td> 
                             <td><?php echo $data['diferencia_horquilla']; ?></td>
                             <td><?php echo $data['diferencia_posapie']; ?></td>                           
 						     <td><?php echo $data['diferencia_manubrio']; ?></td>
                             <td><?php echo $data['diferencia_mandil']; ?></td>                           
 						     <td><?php echo $data['diferencia_posapie1']; ?></td>
                             <td><?php echo $data['diferencia_posapie2']; ?></td> 
                             <td><?php echo $data['diferencia_motor']; ?></td>
                             <td><?php echo $data['diferencia_bateria']; ?></td> 
                             <td><?php echo $data['diferencia_cutanque']; ?></td>
                             <td><?php echo $data['diferencia_velocimetro']; ?></td> 
                             <td><?php echo $data['diferencia_adorno']; ?></td>
                             <td><?php echo $data['diferencia_bulto']; ?></td> 
                             <td><?php echo $data['diferencia_chasis']; ?></td>
                             <td><?php echo $data['diferencia_freno']; ?></td> 
                             <td><?php echo $data['diferencia_tanque']; ?></td> 
                             <td><?php echo $data['observacion']; ?></td>
                             <td><?php echo $data['usuario']; ?></td>
          

                          
                        </tr>
                     
                 
                  <?php }
                } ?>
                 </tbody>
                </table>