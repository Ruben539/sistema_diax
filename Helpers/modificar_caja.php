<?php 

session_start();

require_once("../Modelos/conexion.php");
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
	}


	if (!empty($_POST)) {
		$alert = '';
	
		if (empty($_POST['forma_pago']) ||  empty($_POST['tipo_salida']) || empty($_POST['monto']) || empty($_POST['concepto'])) {
	
			$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';
	
		}else{
	
            $id            = $_POST['id'];
            $forma_pago    = $_POST['forma_pago'];
            $nro_cheque    = $_POST['nro_cheque'];
            $tipo_salida   = $_POST['tipo_salida'];
            $monto         = $_POST['monto'];
            $concepto      = trim($_POST['concepto']);
           
	
	
	//echo "SELECT * FROM usuario
	
			//WHERE(usuario = '$user' AND idusuario != $iduser) or (correo = '$email' AND idusuario != $iduser";
	//exit; sirve para ejectuar la consulta en mysql
			$query = mysqli_query($conection,"SELECT * FROM caja_chica
				WHERE  id != id"
			);
	
			$resultado = mysqli_fetch_array($query);
	
	
		}
	
		if ($resultado > 0) {
			$alert = '<p class = "msg_error">El Registro ya existe,ingrese otro</p>';
	
		}else{
	
			$sql_update = mysqli_query($conection,"UPDATE caja_chica SET forma_pago = '$forma_pago',nro_cheque = '$nro_cheque',
            tipo_salida = '$tipo_salida',monto = '$monto',concepto = '$concepto'
				WHERE id = $id");
	
			if ($sql_update) {
	
				$alert = '<p class = "msg_success">Actualizado Correctamente</p>';
	
			}else{
				$alert = '<p class = "msg_error">Error al Actualizar el Registro</p>';
			}
		}
	}

//Recuperacion de datos para mostrar al seleccionar Actualizar

if (empty($_REQUEST['id'])) {
	header('location: ../Plantillas/caja_chica.php');

	//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php

}

$id = $_REQUEST['id'];

$sql = mysqli_query($conection,"SELECT * FROM caja_chica  WHERE id = $id");   

//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php


$resultado = mysqli_num_rows($sql);

if ($resultado == 0) {
	header("location: ../Plantillas/caja_chica.php");
}else{
	$option = '';
	while ($data = mysqli_fetch_array($sql)) {
		
		$id            = $data['id'];
        $forma_pago    = $data['forma_pago'];
        $nro_cheque    = $data['nro_cheque'];
        $tipo_salida   = $data['tipo_salida'];
        $monto         = number_format($data['monto'], 3,'.','.');
        $concepto      = $data['concepto'];

	}
}

require_once("../body/header_admin.php");
?>
<main class="app-content">

      <div class="row" style="justify-content: center;">
        <div class="col-md-5">
          <div class="tile">
            <h3 class="tile-title">Modificar de Caja</h3>
            <div class="tile-body">
              <form action="" method="POST">
                  <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                  <div class="form-group">
                            <label class="control-label" for="forma_pago">Tipo de Transacción</label>
                            <select name="forma_pago" id="forma_pago" class="form-control">
                                <option value="<?php echo $forma_pago?>"><?php echo $forma_pago?></option>
                                <option value=""></option>
                                <option value="Deposito">Deposito</option>
                                <option value="Transferencia">Transferencia</option>
                                <option value="Cheque">Cheque</option>
                                <option value="Efectivo">Efectivo</option>
                            </select>
                        </div>

                        <div class="form-group" id="mov">
                            <label class="control-label">Nro de Transacción</label>
                            <input class="form-control" type="text" name="nro_cheque" id="nro_cheque"
                             placeholder="Ingrese la el numero de Transacción" value="<?php echo $nro_cheque?>">
                        </div>


                        <div class="form-group">
                            <label class="control-label" for="tipo_salida">Tipo de Movimiento</label>
                            <select name="tipo_salida" id="tipo_salida" class="form-control">
                                <option value="<?php echo $tipo_salida?>"><?php echo $tipo_salida?></option>
                                <option value=""></option>
                                <option value="Egreso">Egreso</option>
                                <option value="Ingreso">Ingreso</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Cantidad de Monto</label>
                            <input class="form-control" type="text" name="monto" id="monto"
                             placeholder="Ingrese el monto" value="<?php echo $monto?>">
                        </div>

                        <div class="form-group">
                        <label class="control-label" for="concepto">Concepto de Pago</label>
                            <input type="text" name="concepto" id="concepto" class="form-control"
                            
                            style="height: 75px;" value="<?php echo $concepto?>">

                        </div>
                                  
                 <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Actualizar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Plantillas/caja_chica.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
              
            </div>
              </form>
              <br>
              <?php if(isset($alert)) {?>
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
            document.getElementById('mov').value = '';
        }
    });
                        


 
                        
</script>