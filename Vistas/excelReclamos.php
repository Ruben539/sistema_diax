<?php 
$planillas = "Reclamos Pendientes.xls";
header("content-Type: application/vnd.ms-excel");
header("content-Disposition: attachment; filename=".$planillas);
header("Pragma: no-cache");
header("Expires: 0");
?>

 <table id="tablaReclamos" class="table table-striped table-bordered table-condensed" style="width:100%">
                    <thead>
            <tr>
                <th>Modelo</th>
                <th>Nro Partida</th>
                <th>Descripcion</th>
                <th>Proveedor</th>
                <th>Cantidad</th>
                <th>Observacion</th>
                <th>Usuario</th>
            </tr>
            </thead>
            <?php 
            session_start();
            require_once("../Modelos/conexion.php");

            $query = mysqli_query($conection,"SELECT p.codproducto, p.modelo,p.nro_partida, p.descripcion, p.existencia,p.proveedor,p.observacion,p.usuario FROM producto p  WHERE p.estatus = 1 ORDER BY p.codproducto DESC ");
            $resultado = mysqli_num_rows($query);

            if ($resultado > 0) {

                while ($data = mysqli_fetch_array($query)) {
                    if ($data['foto'] != 'img_producto.jpg') {
                        $foto = '../images/uploads/'.$data['foto'];
                    }else{
                        $foto = '../images/'.$data['foto'];
                    }

                    ?>
            <tbody>
                    <tr class="row<?php echo $data['codproducto']; ?>">
                        <td><?php echo $data['modelo']; ?></td>
                        <td><?php echo $data['nro_partida']; ?></td>
                        <td><?php echo $data['descripcion']; ?></td>
                        <td><?php echo $data['proveedor']; ?></td>
                        <td><?php echo $data['existencia']; ?></td>
                        <td><?php echo $data['observacion']; ?></td>
                        <td><?php echo $data['usuario']; ?></td>
                       
                    </tr>
            </tbody>
                    <?php 

                }

            }
            ?>

        </table>        