<?php
session_start();
if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
    if (empty($_SESSION['active'])) {
        header('location: salir.php');
    }
} else {
    header('location: salir.php');
}


require_once("../body/header_admin.php");
?>

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-list-ol"></i> Reportes de los Medicos por Fecha
            </h1>
            <p>Registro Web en Desarrollo</p>
        </div>
    </div>




    <form class="row" method="POST" action="../Reportes/reporte_medico_pdf.php" target="_blank">
        <div class="col-md-5">
            <div class="widget-small">
                <input type="date" name="fecha_desde" id="fecha_desde" class="form-control" value="<?php echo date('d-m-Y'); ?>" required>
            </div>
        </div>

        <div class="col-md-5">
            <div class="widget-small">
                <input type="date" name="fecha_hasta" id="fecha_hasta" class="form-control" value="<?php echo date('d-m-Y'); ?>" required>
            </div>
        </div>



        <div class="col-md-10">
            
                <?php
                include "../Modelos/conexion.php";

                $query_medicos = mysqli_query($conection, "SELECT * FROM medicos");

                mysqli_close($conection); //con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php
                $resultado = mysqli_num_rows($query_medicos);

                ?>
                <select name="medico" id="medico" class="chosen form-control">
                    <?php

                    if ($resultado > 0) {
                        while ($medico = mysqli_fetch_array($query_medicos)) {

                    ?>
                            <option value="<?php echo $medico["Nombre"]; ?>"><?php echo
                                                                                $medico["Nombre"] ?></option>

                    <?php


                        }
                    }

                    ?>
                </select>
            
        </div>

        <div class="col-md-2">

            <button class="btn btn-danger" type="submit"><i class="fa fa-file-pdf-o"></i>PDF</button>

        </div>
        </div>
    </form>


    <div class="tile">

    </div>
    </div>


    <form class="row" method="POST" action="../Reportes/reporte_medico_excel.php" target="_blank">
        <div class="col-md-5">
            <div class="widget-small">
                <input type="date" name="fecha_desde" id="fecha_desde" class="form-control" value="<?php echo date('d-m-Y'); ?>" required>
            </div>
        </div>

        <div class="col-md-5">
            <div class="widget-small">
                <input type="date" name="fecha_hasta" id="fecha_hasta" class="form-control" value="<?php echo date('d-m-Y'); ?>" required>
            </div>
        </div>

        <div class="col-md-10">
           
                <?php
                include "../Modelos/conexion.php";

                $query_medicos = mysqli_query($conection, "SELECT * FROM medicos");

                mysqli_close($conection); //con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php
                $resultado = mysqli_num_rows($query_medicos);

                ?>
                <select name="medico" id="medico" class="chosen form-control">
                    <?php

                    if ($resultado > 0) {
                        while ($medico = mysqli_fetch_array($query_medicos)) {

                    ?>
                            <option value="<?php echo $medico["Nombre"]; ?>"><?php echo
                                                                                $medico["Nombre"] ?></option>

                    <?php


                        }
                    }

                    ?>
                </select>
            
        </div>

        <div class="col-md-2">
            <?php if ($_SESSION['rol'] == 1) { ?>
                <button class="btn btn-success" type="submit"><i class="fa fa-file-excel-o"></i>EXCEL</button>
            <?php } ?>
            <?php if ($_SESSION['rol'] == 2) { ?>
                <button class="btn btn-success" onclick=""><i class="fa fa-file-excel-o"></i>EXCEL</button>
            <?php } ?>
        </div>
        </div>
    </form>

</main>
<link rel="stylesheet" href="../node_modules/chosen-js/chosen.css" type="text/css" />
<script src="../node_modules/chosen-js/chosen.jquery.min.js"></script>
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../node_modules/chosen-js/chosen.jquery.js"></script>
<script>
    $(document).ready(function() {
        $(".chosen").chosen();
    });
</script>

<script>
    function permisoAuto() {
        Swal.fire(
            'No tienes Permisos',
            'Para generar una planilla excel',
            'error'
        )
    }
</script>