<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../Plantillas/salir.php');
}

require_once("../body/header_admin.php");


if (!empty($_POST)) {
    $alert = '';

    if (empty($_POST['Tipo']) || empty($_POST['SubTipo']) || empty($_POST['Fmovimiento']) || empty($_POST['Monto']) || empty($_POST['Estado']) || empty($_POST['Concepto']) || empty($_POST['Factura'])) {

        $alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';
    } else {

        $Tipo          = $_POST['Tipo'];
        $SubTipo       = $_POST['SubTipo'];
        $Fmovimiento   = $_POST['Fmovimiento'];
        $Monto         = $_POST['Monto'];
        $Estado        = $_POST['Estado'];
        $Concepto      = $_POST['Concepto'];
        $Factura       = $_POST['Factura'];
        $Fecha         = $_POST['Fecha'];


        $resultado = 0;

        $query = mysqli_query($conection, "SELECT * FROM historialie WHERE Tipo = '$Tipo' ");

        $resultado = mysqli_fetch_array($query);



        $query_insert = mysqli_query($conection, "INSERT INTO historialie(Tipo,SubTipo,Monto,Fmovimiento,Factura,Estado,Concepto,Fecha)
				VALUES('$Tipo','$SubTipo','$Monto','$Fmovimiento','$Factura','$Estado','$Concepto','$Fecha')");

        if ($query_insert) {

            $alert = '<p class = "msg_save">Se grabo el Registro</p>';
        } else {
            $alert = '<p class = "msg_error">Error al Guardar el Registro</p>';
        }
    }
    mysqli_close($conection);
}

?>

<main class="app-content">

    <div class="row" style="justify-content: center;">
        <div class="col-md-5">
            <div class="tile">
                <h3 class="tile-title">Registro de Movimientos</h3>
                <div class="tile-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label class="control-label">Tipo de Operacion</label>
                            <select class="form-control" type="text" name="Tipo" id="Tipo" required>
                                <option>Seleccione el Tipo de Movimiento</option>
                                <option value="Ingresos">Ingresos</option>
                                <option value="Egresos">Egresos</option>
                                <option value="Depositos">Deposito Bancario</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Categoria del Movimiento</label>
                            <?php
                            include "../Modelos/conexion.php";

                            $query_categoria = mysqli_query($conection, "SELECT * FROM categreingre");

                            mysqli_close($conection); //con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php
                            $resultado = mysqli_num_rows($query_categoria);

                            ?>

                            <select name="SubTipo" id="SubTipo" class="form-control" type="text">
                                <?php

                                if ($resultado > 0) {
                                    while ($categoria = mysqli_fetch_array($query_categoria)) {

                                ?>
                                        <option value="<?php echo $categoria["SubTipo"]; ?>"><?php echo
                                        $categoria["SubTipo"] ?></option>

                                <?php


                                    }
                                }

                                ?>


                            </select>

                        </div>

                        <div class="form-group">
                            <label class="control-label">Fecha De Movimiento</label>
                            <input class="form-control" type="date" name="Fmovimiento" id="Fmovimiento" placeholder="Ingrese la Fecha" required>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Cantidad de Monto</label>
                            <input class="form-control" type="text" name="Monto" id="Monto" placeholder="Ingrese el monto" required>
                        </div>


                        <div class="form-group">
                            <label class="control-label">Numero de la Factura</label>
                            <input class="form-control" type="text" name="Factura" id="Factura" placeholder="Ingrese el nro de factura" required>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Estado de Movimiento</label>
                            <select name="Estado" id="Estado" class="form-control" type="text">
                                <option value="">Seleccione Estado</option>
                                <option value="Pagado">Pagado</option>
                                <option value="A Pagar">A pagar</option>
                                <option value="Cobrado">Cobrado</option>
                                <option value="A cobrar">A cobrar</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Concepto del Movimiento</label>
                            <textarea class="form-control" type="text" name="Concepto" id="Concepto" placeholder="Ingrese el concepto del movimiento" required></textarea>
                        </div>
                        <input class="form-control" type="hidden" name="Fecha" id="Fecha" value="<?php echo date('d-m-Y H:i:s')?>">

                        <div class="tile-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar
                            </button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Plantillas/ingreso.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>

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