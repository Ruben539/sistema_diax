<?php
session_start();
if (empty($_SESSION['active'])) {
    header('location: ../Plantillas/salir.php');
}

require_once("../body/header_admin.php");


if (!empty($_POST)) {
    $alert = '';

    if (empty($_POST['forma_pago']) ||  empty($_POST['tipo_salida']) || empty($_POST['monto']) || empty($_POST['concepto']) || empty($_POST['usuario'])) {

        $alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';
    } else {

        $forma_pago    = $_POST['forma_pago'];
        $nro_cheque    = $_POST['nro_cheque'];
        $tipo_salida   = $_POST['tipo_salida'];
        $monto         = number_format($_POST['monto'], 3,'.','.');
        $concepto      = trim($_POST['concepto']);
        $usuario       = $_POST['usuario'];
        $fecha         = $_POST['fecha'];
        $created_at    =  date('Y-m-d H:i:s');
        $estatus       = 1;
        


        $resultado = 0;

        $query = mysqli_query($conection, "SELECT * FROM caja_chica WHERE forma_pago = '$forma_pago' ");

        $resultado = mysqli_fetch_array($query);



        $query_insert = mysqli_query($conection, "INSERT INTO caja_chica(forma_pago,nro_cheque,tipo_salida,monto,concepto,usuario,fecha,created_at,estatus)
				VALUES('$forma_pago','$nro_cheque','$tipo_salida','$monto','$concepto','$usuario','$fecha','$created_at','$estatus');");

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
                <h3 class="tile-title text-center">Registro de Movimiento</h3>
                <div class="tile-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label class="control-label" for="forma_pago">Tipo de Transacción</label>
                            <select name="forma_pago" id="forma_pago" class="form-control">
                                <option value="Deposito">Deposito</option>
                                <option value="Transferencia">Transferencia</option>
                                <option value="Cheque">Cheque</option>
                                <option value="Efectivo">Efectivo</option>
                            </select>
                        </div>

                        <div class="form-group" id="mov">
                            <label class="control-label">Nro de Transacción</label>
                            <input class="form-control" type="text" name="nro_cheque" id="nro_cheque" placeholder="Ingrese la el numero de Transacción">
                        </div>


                        <div class="form-group">
                            <label class="control-label" for="tipo_salida">Tipo de Movimiento</label>
                            <select name="tipo_salida" id="tipo_salida" class="form-control">
                                <option value="Egreso">Egreso</option>
                                <option value="Ingreso">Ingreso</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Cantidad de Monto</label>
                            <input class="form-control" type="text" name="monto" id="monto" placeholder="Ingrese el monto">
                        </div>

                        <div class="form-group">
                        <label class="control-label" for="fecha">Fecha de Movimiento</label>
                            <input type="date" name="fecha" id="fecha" class="form-control" 
                            >
                            
                        </div>

                        <div class="form-group">
                        <label class="control-label" for="concepto">Concepto de Pago</label>
                            <textarea type="text" name="concepto" id="concepto" class="form-control" placeholder="Ingrese el concepto del Gasto" 
                            style="max-height: 145px;">
                            </textarea>
                        </div>

                                               
                        <input class="form-control" type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION['nombre']; ?>">
                        <input class="form-control" type="hidden" name="estatus" id="estatus" value="1">

                        <div class="tile-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar
                            </button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Plantillas/caja_chica.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>

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

<script type="text/javascript">
    const valor = document.querySelector('#forma_pago');
    document.getElementById('mov').style.display = 'none';

    console.log(valor);

    /*OBTENER VALOR SELECCIONADO DE LA LISTA DE OPCIONES*/
    valor.addEventListener('change', function() {
        let valorOptions = valor.value;

        var opctionSelect = valor.options[valor.selectedIndex];

        console.log('Opciones: ' + opctionSelect.text);
        console.log('Opciones: ' + opctionSelect.value);

        if (opctionSelect.value === 'Cheque'){
            document.getElementById('mov').style.display = 'block';
        }else if (opctionSelect.value === 'Transferencia'){
            document.getElementById('mov').style.display = 'block';
        }else{
            document.getElementById('mov').style.display = 'none'; 
        }
    });
                        


 
                        
</script>