<?php

session_start();

require_once("../Modelos/conexion.php");
if (empty($_SESSION['active'])) {
    header('location: ../Plantillas/salir.php');
}


if (!empty($_POST)) {
    $alert = '';

    if (empty($_POST['Informa']) || empty($_POST['Placas'])) {

        $alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';
    } else {

        $id          = $_POST['id'];
        $Informa     = $_POST['Informa'];
        $Placas      = $_POST['Placas'];



        //echo "SELECT * FROM usuario

        //WHERE(usuario = '$user' AND idusuario != $iduser) or (correo = '$email' AND idusuario != $iduser";
        //exit; sirve para ejectuar la consulta en mysql
        $query = mysqli_query(
            $conection,
            "SELECT * FROM historial WHERE  id != id"
        );

        $resultado = mysqli_fetch_array($query);
    }

    if ($resultado > 0) {
        $alert = '<p class = "msg_error">El Registro ya existe,ingrese otro</p>';
    } else {

        $sql_update = mysqli_query($conection, "UPDATE Historial SET Informa = '$Informa',Placas = '$Placas'
				WHERE id = $id");

        if ($sql_update) {

            $alert = '<p class = "msg_success">Actualizado Correctamente</p>';
        } else {
            $alert = '<p class = "msg_error">Error al Actualizar el Registro</p>';
        }
    }
}

//Recuperacion de datos para mostrar al seleccionar Actualizar


if (empty($_REQUEST['id'])) {
	header('location: ../Plantillas/dashboard.php');

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

}

$id = $_REQUEST['id'];

$sql = mysqli_query($conection,"SELECT * FROM historial  WHERE id = $id");   

//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

//echo 'paso el sql';
//exit();


$resultado = mysqli_num_rows($sql);

if ($resultado == 0) {
     
	header("location: ../Plantillas/dashboard.php");
}else{
	$option = '';
	while ($data = mysqli_fetch_array($sql)) {
		
		$id          = $data['id'];
		$Cedula      = $data['Cedula'];
		$Estudio     = $data['Estudio'];
		$Atendedor   = $data['Atendedor'];
		$Seguro      = $data['Seguro'];
		$Monto       = $data['Monto'];
		$Descuento   = $data['Descuento'];
		$Comentario  = $data['Comentario'];
		$Fecha       = $data['Fecha'];
		$Informa     = $data['Informa'];
		$Placas      = $data['Placas'];

	}
}
require_once("../body/header_admin.php");
?>
<link rel="stylesheet" href="../node_modules/chosen-js/chosen.css" type="text/css" />
    <script src="../node_modules/chosen-js/chosen.jquery.min.js"></script>
    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../node_modules/chosen-js/chosen.jquery.js"></script>
 <script>
        $(document).ready(function() {
            $(".chosen").chosen();
        });
  </script>
<main class="app-content">

    <div class="row" style="justify-content: center;">
        <div class="col-md-5">
            <div class="tile">
                <h3 class="tile-title">Asignar Informante</h3>
                <div class="tile-body">
                    <form action="" method="POST">
                        <input type="text" name="id" id="id" value="<?php echo $Informa; ?>">
                        <div class="form-group">
                            <input class="form-control" type="hidden" name="Informa" id="Informa" placeholder="Ingrese el Informa" value="<?php echo $Informa; ?>">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Medico Informante</label>
                            <?php
                            include "../Modelos/conexion.php";

                            $query_medicos = mysqli_query($conection, "SELECT * FROM medicos WHERE Especialidad like '%Informante%'");

                            mysqli_close($conection); //con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php
                            $resultado = mysqli_num_rows($query_medicos);

                            ?>
                            <select name="Informa" id="Informa" class="chosen form-control">
                            <option value="<?php echo $Informa; ?>"><?php echo $Informa; ?></option>
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

                        <div class="form-group">
                            <label class="control-label">Placas</label>
                            <input class="form-control" type="text" name="Placas" id="Placas" placeholder="Ingrese el Placas" required value="<?php echo $Placas; ?>">
                        </div>



                        <div class="tile-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Historial/PendientesAsignacionElena.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>

                        </div>
                    </form>
                    <br>
                    <?php if (isset($alert)) { ?>
                        <div class="alert alert-info"><?php echo  $alert; ?></div>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
</main>