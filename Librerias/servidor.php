<?php

require_once("MSQLI.php");

$oMysql = new MYSQL();

$respuesta = "";
if($_POST){ 
$rq = $_POST['rq'];
}
if($rq == 1){
	$respuesta = $oMysql->getPacientePaz();

}elseif ($rq == 2) {
 	$respuesta = $oMysql->getPacienteDiax();

}elseif ($rq == 3) {
	$respuesta = $oMysql->getPacientesEspera();

}elseif ($rq == 4) {
	$respuesta = $oMysql->getPacientesAtendido();

}elseif ($rq == 5) {
	$respuesta = $oMysql->getPacientesTotal();

}
echo $respuesta;



