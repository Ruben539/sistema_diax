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
}
echo $respuesta;



