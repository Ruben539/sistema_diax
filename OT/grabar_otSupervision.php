<?php
session_start();
if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2){
    if (empty($_SESSION['active'])) {
    header('location: ../Plantillas/salir.php');
}

}else{
  header('location: ../Plantillas/salir.php');
}

require_once("../body/header_admin.php");


if (!empty($_POST)) {
	$alert = '';

	if (empty($_POST['modelo']) || empty($_POST['nro_partida']) || empty($_POST['pieza'])) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{

		$modelo         = $_POST['modelo'];
		$nro_partida    = $_POST['nro_partida'];
		$pieza          = $_POST['pieza'];
		$color          = $_POST['color'];
		$cantidad       = $_POST['cantidad'];
        $observacion    = $_POST['observacion'];
        $sector_1       = $_POST['sector_1'];
        $usuario_1      = $_POST['usuario_1'];
		

		$resultado = 0;

		$query = mysqli_query($conection,"SELECT * FROM orden_trabajo WHERE modelo = '$modelo' ");

		$resultado = mysqli_fetch_array($query);



			$query_insert = mysqli_query($conection,"INSERT INTO orden_trabajo(modelo,nro_partida,pieza,color,cantidad,observacion,sector_1,usuario_1)
				VALUES('$modelo','$nro_partida','$pieza','$color','$cantidad','$observacion','$sector_1','$usuario_1')");

			if ($query_insert ) {
				$alert = '<p class = "msg_save">Registro Guardado Correctamente</p>';

			}else{
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
            <h3 class="tile-title">Orden de Trabajo</h3>
            <div class="tile-body">
              <form action="" method="POST">
                <div class="form-group">
                <label class="control-label">Modelo</label>
                  <select class="form-control" name="modelo" id="modelo" autofocus>
                        <option value="SK110-DAX-CKD">SK110-DAX-CKD</option>
                        <option value="SK110DAX-A-CKD">SK110DAX-A-CKD</option>
                        <option value="SK125GENIUS-CKD">SK125GENIUS-CKD</option>
                        <option value="SK125-MAGIC-CKD">SK125-MAGIC-CKD</option>
                        <option value="SK125-5-CKD">SK125-5-CKD</option>
                        <option value="SK150-CG-CKD">SK150-CG-CKD</option>
                        <option value="SK150-X-CKD">SK150-X-CKD</option>
                        <option value="SK150NT-A-CKD">SK150NT-A-CKD</option>
                        <option value="SK150XPRO-R-CKD">SK150XPRO-R-CKD</option>
                        <option value="SK150GY-5-CKD">SK150GY-5-CKD</option>
                        <option value="SK150-RX4-CKD">SK150-RX4-CKD</option>
                        <option value="SK150-FXZ-CKD">SK150-FXZ-CKD</option>
                        <option value="SK150BR-NEW-CKD">SK150BR-NEW-CKD</option>
                        <option value="SK150-SMX-CKD">SK150-SMX-CKD</option>
                        <option value="SKSTAR-200">SK200-STAR</option>
                        <option value="SK200XPRO-R-CKD">SK200XPRO-R-CKD</option>
                        <option value="SK200-BR-CKD">SK200-BR-CKD</option>
                        <option value="SK200GY-5-CKD">SK200GY-5-CKD</option>
                        <option value="SKCARGA200-CKD">SKCARGA200-CKD</option>
                        <option value="SKCARGA200-C-CKD">SKCARGA200-C-CKD</option>
                    </select>
                </div>
                <div class="form-group">
                  <label class="control-label">Nro Partida</label>
                  <input class="form-control" type="text" name="nro_partida" id="nro_partida" placeholder="Ingrese el Numero" required>
                </div>
                <div class="form-group">
                  <label class="control-label">Pieza</label>
                  <select class="form-control" id="pieza" name="pieza" required>
                        <option value="ACELERADOR">ACELERADOR</option>
                        <option value="ADORNO DEL ESCAPE">ADORNO DEL ESCAPE</option>
                        <option value="AGARRADERA">AGARRADERA</option>
                        <option value="AMORTIGUADOR">AMORTIGUADOR</option>
                        <option value="ASIENTO">ASIENTO</option>
                        <option value="BAULETO">BAULETO</option>
                        <option value="BLOQUEO DE LA DIRECCIÓN">BLOQUEO DE LA DIRECCIÓN</option>
                        <option value="BOCINA">BOCINA</option>
                        <option value="BULBO DE FRENO">BULBO DE FRENO</option>
                        <option value="BULBO DE REVERSA">BULBO DE REVERSA</option>
                        <option value="CABALLETE ">CABALLETE </option>
                        <option value="CABO DE ACELERADOR  ">CABO DE ACELERADOR  </option>
                        <option value="CABO DE EMBRAGUE">CABO DE EMBRAGUE</option>
                        <option value="CABO DE VELOCÍMETRO">CABO DE VELOCÍMETRO</option>
                        <option value="CADENA">CADENA</option>
                        <option value="CAJA DE HERRAMIENTAS">CAJA DE HERRAMIENTAS</option>
                        <option value="CAÑO  DE COMBUSTIBLE ">CAÑO  DE COMBUSTIBLE </option>
                        <option value="TanqueCAÑO DE ESCAPE">CAÑO DE ESCAPE</option>
                        <option value="CAÑO DE ESCAPE (MULTIPLE)">CAÑO DE ESCAPE (MULTIPLE)</option>
                        <option value="CAPUCHÓN DE MANIVELA">CAPUCHÓN DE MANIVELA</option>
                        <option value="CARBURADOR">CARBURADOR</option>
                        <option value="CARDÁN">CARDÁN</option>
                        <option value="CARETA FARO DELANTERO">CARETA FARO DELANTERO</option>
                        <option value="CEBADOR">CEBADOR</option>
                        <option value="CERRADURA DE ASIENTO ">CERRADURA DE ASIENTO </option>
                        <option value="CHASIS">CHASIS</option>
                        <option value="CILINDRO DE DIRECCIÓN">CILINDRO DE DIRECCIÓN</option>
                        <option value="CINTILLO METÁLICO">CINTILLO METÁLICO</option>
                        <option value="CODO DE ESCAPE">CODO DE ESCAPE</option>
                        <option value="CONEXIÓNES ELÉCTRICAS">CONEXIÓNES ELÉCTRICAS</option>
                        <option value="CUBRE CADENAS">CUBRE CADENAS</option>
                        <option value="CUBRE CHASIS">CUBRE CHASIS</option>
                        <option value="CUBRE ESCAPE">CUBRE ESCAPE</option>
                        <option value="CUBRE MANO">CUBRE MANO</option>
                        <option value="CUBRE TANQUE">CUBRE TANQUE</option>
                        <option value="DIRECCIÓN">DIRECCIÓN</option>
                        <option value="EJE DE DIRECCIÓN">EJE DE DIRECCIÓN</option>
                        <option value="EJE DE HORQUILLA ">EJE DE HORQUILLA </option>
                        <option value="EJE TRASERO">EJE TRASERO</option>
                        <option value="ENGRANAJE DE RPM">ENGRANAJE DE RPM</option>
                        <option value="ESCORIAS">ESCORIAS</option>
                        <option value="FARO DELANTERO">FARO DELANTERO</option>
                        <option value="FARO TRASERO">FARO TRASERO</option>
                        <option value="FLOTADOR">FLOTADOR</option>
                        <option value="FRENO">FRENO</option>
                        <option value="GUARDABARROS DELANTERO">GUARDABARROS DELANTERO</option>
                        <option value="GUARDABARROS TRASERO">GUARDABARROS TRASERO</option>
                        <option value="GUARDACADENAS">GUARDACADENAS</option>
                        <option value="HORQUILLA">HORQUILLA</option>
                        <option value="JUNTA CENTRAL DE ESCAPE">JUNTA CENTRAL DE ESCAPE</option>
                        <option value="LLAVE DE CONTACTO">LLAVE DE CONTACTO</option>
                        <option value="LLAVE DE LUCES">LLAVE DE LUCES</option>
                        <option value="MANGUERA DE COMBUSTIBLE">MANGUERA DE COMBUSTIBLE</option>
                        <option value="MANILLAR DE FRENO DELANTERO ">MANILLAR DE FRENO DELANTERO </option>
                        <option value="MANUBRIO">MANUBRIO</option>
                        <option value="MARCADOR DE COMBUSTIBLE">MARCADOR DE COMBUSTIBLE</option>
                        <option value="MEDIDOR DE ACEITE">MEDIDOR DE ACEITE</option>
                        <option value="MOTOR">MOTOR</option>
                        <option value="MOTOR DE ARRANQUE">MOTOR DE ARRANQUE</option>
                        <option value="NÚMERO DE CHASIS">NÚMERO DE CHASIS</option>
                        <option value="OJO DE GATO">OJO DE GATO</option>
                        <option value="PARAGOLPES DELANTERO">PARAGOLPES DELANTERO</option>
                        <option value="PARAGOLPES TRASERO">PARAGOLPES TRASERO</option>
                        <option value="PEDAL DE ARRANQUE">PEDAL DE ARRANQUE</option>
                        <option value="PEDAL DE CAMBIOS">PEDAL DE CAMBIOS</option>
                        <option value="PEDAL DE FRENO">PEDAL DE FRENO</option>
                        <option value="PERILLA DE LUZ">PERILLA DE LUZ</option>
                        <option value="PERNOS / RESORTES">PERNOS / RESORTES</option>
                        <option value="PINTURA">PINTURA</option>
                        <option value="PLÁSTICO CUBRE MOTOR">PLÁSTICO CUBRE MOTOR</option>
                        <option value="PLÁSTICOS">PLÁSTICOS</option>
                        <option value="PORTABULTOS">PORTABULTOS</option>
                        <option value="PORTACASCO">PORTACASCO</option>
                        <option value="POSAPIE CENTRAL">POSAPIE CENTRAL</option>
                        <option value="POSAPIES LADO DERECHO">POSAPIES LADO DERECHO</option>
                        <option value="POSAPIES LADO IZQUIERDO">POSAPIES LADO IZQUIERDO</option>
                        <option value="POSAPIES TRASERO LADO DERECHO">POSAPIES TRASERO LADO DERECHO</option>
                        <option value="POSAPIES TRASERO LADO IZQUIERDO">POSAPIES TRASERO LADO IZQUIERDO</option>
                        <option value="RABETA">RABETA</option>
                        <option value="REFLECTIVO">REFLECTIVO</option>
                        <option value="REGULADOR DE VOLTAJE">REGULADOR DE VOLTAJE</option>
                        <option value="RESORTE DEL CABALLETE">RESORTE DEL CABALLETE</option>
                        <option value="RUEDAS">RUEDAS</option>
                        <option value="SEÑALERO">SEÑALERO</option>
                        <option value="SILENCIADOR (TAPA)">SILENCIADOR (TAPA)</option>
                        <option value="SOLDADURA">SOLDADURA</option>
                        <option value="SOPORTE BULBO DE REVERSA">SOPORTE BULBO DE REVERSA</option>
                        <option value="SOPORTE CAJA DE HERRAMIENTAS">SOPORTE CAJA DE HERRAMIENTAS</option>
                        <option value="SOPORTE CAÑO DE ESCAPE">SOPORTE CAÑO DE ESCAPE</option>
                        <option value=" SOPORTE CEBADOR"> SOPORTE CEBADOR</option>
                        <option value="SOPORTE CUBRE TANQUE">SOPORTE CUBRE TANQUE</option>
                        <option value="SOPORTE DE AGARRADERA">SOPORTE DE AGARRADERA</option>
                        <option value="SOPORTE DE AMORTIGUADOR TRASERO">SOPORTE DE AMORTIGUADOR TRASERO</option>
                        <option value="SOPORTE DE BATERÍA">SOPORTE DE BATERÍA</option>
                        <option value="SOPORTE DE BOBINA ALTA">SOPORTE DE BOBINA ALTA</option>
                        <option value="SOPORTE DE BOCINA">SOPORTE DE BOCINA</option>
                        <option value="SOPORTE DE CABOS Y CABLES">SOPORTE DE CABOS Y CABLES</option>
                        <option value="SOPORTE DE CARETA">SOPORTE DE CARETA</option>
                        <option value="SOPORTE TAPA COSTADO">SOPORTE TAPA COSTADO</option>
                        <option value="SOPORTE TAPA MASA">SOPORTE TAPA MASA</option>
                        <option value="SOPORTE TRABACUELLO"> SOPORTE TRABACUELLO</option>
                        <option value="SOPORTES DE CUBRE MANDIL"> SOPORTES DE CUBRE MANDIL</option>
                        <option value="SOPORTES MAL SOLDADOS">SOPORTES MAL SOLDADOS</option>
                        <option value="SOSTÉN LATERAL">SOSTÉN LATERAL</option>
                        <option value="TABLERO">TABLERO</option>
                        <option value="TANQUE">TANQUE</option>
                        <option value="TAPA COSTADO">TAPA COSTADO</option>
                        <option value="TAPA DE AMORTIGUADOR">TAPA DE AMORTIGUADOR</option>
                        <option value="TAPA FRONTAL">TAPA FRONTAL</option>
                        <option value="TAPA PIÑON">TAPA PIÑON</option>
                        <option value="TAPA TANQUE">TAPA TANQUE</option>
                        <option value="TIRA CADENA">TIRA CADENA</option>
                        <option value="TOPE DE MANUBRIO">TOPE DE MANUBRIO</option>
                        <option value="TORNILLOS / TUERCAS">TORNILLOS / TUERCAS</option>
                        <option value="TRABACUELLO">TRABACUELLO</option>
                        <option value="TUBO DE ADMISIÓN">TUBO DE ADMISIÓN</option>
                        <option value="VARILLA TENSOR">VARILLA TENSOR</option>
                        <option value="VARIOS ELEMENTOS">VARIOS ELEMENTOS</option>
                        <option value="VELOCÍMETRO">VELOCÍMETRO</option>  
                   </select> 
                </div>
               
                <div class="form-group">
                  <label class="control-label">Color</label>
                  <input class="form-control"  name="color" id="color"  placeholder="Ingrese el Color" required>
                </div>

                <div class="form-group">
                  <label class="control-label">Cantidad</label>
                  <input class="form-control"  name="cantidad" id="cantidad"  placeholder="Ingrese la Cantidad" required>
                </div>

                <div class="form-group">
                  <label class="control-label">Falla Detectada</label>
                  <textarea class="form-control" rows="4" name="observacion" id="observacion"  placeholder="Ingrese la Falla Detectada"></textarea>
                </div>
                
                 <input type="hidden" name="sector_1" id="sector_1" value="SUPERVISION">
                 <input type="hidden" name="usuario_1" id="usuario_1" value="<?php echo $_SESSION['user'];?>">
                 <div class="tile-footer">
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Plantillas/orden_trabajo.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
              
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
