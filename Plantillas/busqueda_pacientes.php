<?php
session_start();
if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2) {
    if (empty($_SESSION['active'])) {
        header('location: salir.php');
    }
} else {
    header('location: salir.php');
}

require_once("../Modelos/conexion.php");

require_once("../body/header_admin.php");
?>

<head>
    <title>Sistema Diax</title>
    <link rel="stylesheet" href="../node_modules/chosen-js/chosen.css" type="text/css" />
    <script src="../node_modules/chosen-js/chosen.jquery.min.js"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../node_modules/chosen-js/chosen.jquery.js"></script>
    <script>
        $(document).ready(function() {
            $(".chosen").chosen();
        });
    </script>
</head>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-laptop"></i> Cargar Orden
            </h1>
            <p>Registro Web en Desarrollo</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-book fa-lg"></i></li>
            <li class="breadcrumb-item active"><a href="#" onclick="excel()">Excel</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <?php
                $query = $_POST['Cedula'];
                $min_length = 3;
                if (strlen($query) >= $min_length) { // if query length is more or equal minimum length then
                    $query = htmlspecialchars($query);
                    // $query = mysqli_real_escape_string($query);
                    $raw_results = mysqli_query($conection, "SELECT * FROM clientes WHERE Cedula = $query") or die(mysqli_error($conection));
                    #WHERE (`Cedula` LIKE '%".$query."%')") or die(mysql_error());
                    echo "<div class='bs-component'>";
                    echo "<div class='card'>";
                    echo "<h3 class='card-header text-center alert alert-success'>Registro de Orden</h3>";
                    echo "<legend >Datos del Paciente :</legend>";
                    if (mysqli_num_rows($raw_results) > 0) { // if one or more rows are returned do following

                        while ($results = mysqli_fetch_array($raw_results)) {
                           
                            echo "<p><h4>CI: " . $results['Cedula'] . "</h4></p>";
                            echo "<p><h4>Nombre: " . $results['Nombre'] . " " . $results['Apellido'] . "</h4></p>";
                            echo "<p><h4>Celular: " . $results['Celular'] . "</h4></p>";
                            $nombre = $results['Nombre'] . " " . $results['Apellido'];
                            $nacimiento = $results['Nacimiento'];
                            echo "</div>";
                            echo "</div>";
                        }
                    } else { // if there is no matching rows do following
                        echo "No results";
                    }
                } else { // if query length is less than minimum
                    echo "Minimum length is " . $min_length;
                }
                ?>
            </div>
            <div class="row">
                <div class="col-md-12">
                     <div class="tile">
                         <h3 class="tile-title alert alert-success">Datos de la Orden del Paciente</h3>
                        <div class="tile-body">
                            <form action="resultado.php" method="POST">
                                
                                    <input type="hidden" name="identificacion" value="<?php echo $query; ?>">
                                    <input type="hidden" name="id" value="<?php echo $nombre; ?>">
                                    <input type="hidden" name="nacimiento" value="<?php echo $nacimiento; ?>">
                                    <hr>
                                    
                                    <div class="form-group">
                                    <label class="control-label" style="font-size: 20px;">Estudios a Realizar :</label>
                                    <select name="ecografias[]" class="chosen form-control" data-placeholder="Elige uno o varios estudios" multiple>
                                        <option value=""></option>
                                        <?php
                                        $raw_results3 = mysqli_query($conection, "select * from tarifas where Estudio not like '%TAC%';") or die(mysqli_error($conection));
                                        while ($results = mysqli_fetch_array($raw_results3)) {
                                        ?>
                                            <option value=" <?php echo $results['Estudio'] ?> ">
                                                <?php echo $results['Estudio']; ?>
                                            </option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                    </div>
                                    <hr>
                                    <p>
                                        <legend>Rayos X por Posicion</legend>
                                    </p>
                                    <div class="form-group">
                                        <label class="control-label" style="font-size: 20px;">Numero de Posiciones :</label>
                                        <input name="rayosx" type="number" style='width:10%' value="0" class="form-control">
                                    </div>
                                    <hr>
                                   
                                    <div class="form-group">
                                    <label class="control-label" style="font-size: 20px;">Medico Tratante :</label>
                                        <select class="chosen form-control" name="medico" required data-placeholder="Seleccione un Medico">
                                            <option value=""></option>
                                            <?php
                                            $raw_results4 = mysqli_query($conection, "select * from medicos;") or die(mysqli_error($conection));
                                            while ($results = mysqli_fetch_array($raw_results4)) {
                                            ?>

                                                <option value=" <?php echo $results['Nombre'] ?> ">
                                                    <?php echo $results['Nombre']; ?>
                                                </option>

                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <hr>
                                    
                                    <div class="form-group">
                                    <label class="control-label" style="font-size: 20px;">Tipo de Seguro :</label>
                                        <select class="form-control" name="seguro" required data-placeholder="Seleccione un Seguro" id="test" onchange="document.getElementById('text_content').value=this.options[this.selectedIndex].text">
                                            <option value="SinSeguro">Sin Seguro</option>
                                            <option value="SEMEI">SEMEI Cobertura Total</option>
                                            <option value="SemeiPref">SEMEI Preferencial</option>
                                            <option value="Seguros">Prosalud Total</option>
                                            <option value="Seguros">IMS Total</option>
                                            <option value="Seguros">Fleming Seguros Total</option>
                                            <option value="Seguros">SPS Total</option>
                                            <option value="Seguros">Medilife Total</option>
                                            <option value="Seguros">OAMI Total</option>
                                            <option value="Seguros">MCI Total</option>
                                            <option value="SegurosPref">MCI Preferencial</option>
                                            <option value="SegurosPref">Prosalud Preferencial</option>
                                            <option value="SegurosPref">Medilife Preferencial</option>
                                            <option value="SegurosPref">IMS Preferencial</option>
                                            <option value="SegurosPref">Fleming Preferencial</option>
                                            <option value="SegurosPref">SPS Preferencial</option>
                                            <option value="SegurosPref">OAMI Preferencial</option>
                                            <option value="SegurosPref">OAMI COPAGO</option>
                                            <option value="Hospitalar">Hospitalar</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="texto" id="text_content" value=" " />

                                    </table>
                                    
                                    <div class="form-group">
                                    <label class="control-label" style="font-size: 20px;">Descuento a Aplicar :</label>
                                        <input  class="form-control" type="number" name="descuento" value="0" style='width:30%'>
                                    </div>
                                    
                                    <div class="form-group">
                                    <label class="control-label" style="font-size: 20px;">Ingrese una Observación sobre el Paciente :</label>
                                        <textarea class="form-control" name="comentario" style='width:100%;padding: 16px'></textarea>
                                    </div>
                               
                                <div class="tile-footer">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Plantillas/dashboard.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                                </div>
                            </form>
                         </div>
                    </div>
                </div>
           </div>
</main>

<script type="text/javascript" src="../js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        tablaHerreria = $("#tabla_Usuario").DataTable({
            "columnDefs": [{
                "target": 1,
                "data": null
            }],

            //Para cambiar el lenguaje a español
            "language": {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "sProcessing": "Procesando...",
            }
        });



    });
</script>

<script>
    function permisoAuto() {
        Swal.fire(
            'Lo Siento',
            'No posee el Permiso para Eliminar un Registro',
            'error'
        )
    }
</script>

<script>
    function excel() {
        Swal.fire(
            'Lo Siento',
            'No puede imprimir los usuarios, es informacion privada',
            'error'
        )
    }
</script>