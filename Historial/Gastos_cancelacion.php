<?php
session_start();
require_once("../Modelos/conexion.php");
if (empty($_SESSION['active'])) {
    header('location: ../Plantillas/salir.php');
}


if (!empty($_POST)) {
    $alert = '';

    if (empty($_POST['id']) || empty($_POST['comentario']) || empty($_POST['estatus'])) {

        $alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';
        
    } else {

        $id           = $_POST['id'];
        $comentario   = $_POST['comentario'];
        $estatus      = $_POST['estatus'];
        $usuario_1    = $_POST['usuario_1'];
       



        $query = mysqli_query($conection,"SELECT * FROM historial
			WHERE  id != id"
        );

        $resultado = mysqli_fetch_array($query);
    }

    if ($resultado > 0) {
        $alert = '<p class = "msg_error">El Registro ya existe,ingrese otro</p>';
    } else {
      
        
        $sql_update = mysqli_query($conection, "UPDATE gastos SET comentario = '$comentario', estatus = '$estatus',
         usuario_1 = '$usuario_1'
			WHERE id = $id");

        if ($sql_update) {

            $alert = '<p class = "msg_success">Solicitado Correctamente</p>';

        } else {
            $alert = '<p class = "msg_error">Error al Solicitar la Cancelación</p>';

        }
    }
}

//Recuperacion de datos para mostrar al seleccionar Actualizar

if (empty($_REQUEST['id'])) {
    header('location: ../Plantillas/gastos.php');

    //mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

}

$id = $_REQUEST['id'];

$sql = mysqli_query($conection, "SELECT * FROM gastos  WHERE id = $id");

//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php


$resultado = mysqli_num_rows($sql);

if ($resultado == 0) {
    header("location: ../Plantilla/gastos.php");
} else {
    $option = '';
    while ($data = mysqli_fetch_array($sql)) {

        $id           = $data['id'];
        $comentario   = $data['comentario'];
    }
}

require_once("../body/header_admin.php");
?>
<main class="app-content">

    <div class="row" style="justify-content: center;">
        <div class="col-md-5">
            <div class="tile">
                <h3 class="tile-title text-center alert alert-danger">Solicitar Cancelación <i class="fa  fa-window-close"></i></h3>
                <div class="tile-body">
                    <form action="" method="POST">
                        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

                        <div class="form-group">
                            <label class="control-label"><span>Ingrese un sobre el pedido de la Cancelación</span></label>
                            <textarea class="form-control" type="text" name="comentario" id="comentario"
                             placeholder="Ingrese su comentario" style="max-height: 170px;" required ></textarea>
                        </div>
                        <input type="hidden" class="form-control" name="estatus" id="estatus" value="2">
                        <input type="hidden" class="form-control" name="usuario_1" id="usuario_1" value="<?= $_SESSION['nombre']; ?>">



                        <div class="tile-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-user-times"></i>Cancelar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Plantillas/gastos.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Regresar</a>

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