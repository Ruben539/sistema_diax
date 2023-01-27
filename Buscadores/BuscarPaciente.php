<?php
session_start();
if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 5) {
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
            <h1><i class="fa fa-laptop"></i> Resultado de la Busqueda
            </h1>
            <p>Registro Web en Desarrollo</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <?php
                $query = $_POST['id'];
                $min_length = 1;
                if (strlen($query) >= $min_length) { // if query length is more or equal minimum length then
                    $query = htmlspecialchars($query);
                    // $query = mysqli_real_escape_string($query);
                    $raw_results = mysqli_query($conection, "SELECT h.id,h.Cedula,c.Nombre,c.Apellido,c.Celular,c.Nacimiento FROM historial h INNER JOIN clientes c on c.cedula = h.cedula
                     WHERE h.id = $query") or die(mysqli_error($conection));
                    #WHERE (`Cedula` LIKE '%".$query."%')") or die(mysql_error());
                    echo "<div class='bs-component'>";
                    echo "<div class='card'>";
                    echo "<h3 class='card-header text-center alert alert-success'>Datos del Paciente <i class='fa fa-user'></i></h3>";
                    echo "<legend >Datos del Paciente :</legend>";
                    if (mysqli_num_rows($raw_results) > 0) { // if one or more rows are returned do following

                        while ($results = mysqli_fetch_array($raw_results)) {
                           
                            echo "<p><h4>CI: " . $results['Cedula'] . "</h4></p>";
                            echo "<p><h4>Nombre: " . $results['Nombre'] . " " . $results['Apellido'] . "</h4></p>";
                            echo "<p><h4>Celular: " . $results['Celular'] . "</h4></p>";
                            $nombre = $results['Nombre'] . " " . $results['Apellido'];
                            $nacimiento = $results['Nacimiento'];
                            echo "</div>";
                            echo'<p>
                                <td>
                                     <a href="../Helpers/asignar_informante.php?id='. $results['id'].' " class="btn btn-outline-primary" target="_blank"><i class="fa fa-user-md"></i> Asingar Informante</a></td>
                                </td></p>';
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