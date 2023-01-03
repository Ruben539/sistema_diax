<?php

require_once("host.php");


class MYSQL {
	private $oConBD = null;

	public function __construct(){
		global $usuarioBD,$passBD,$ipBD,$nombreBD,$rq;

		$this->usuarioBD = $usuarioBD;
		$this->passBD = $passBD;
		$this->ipBD = $ipBD;
		$this->nombreBD = $nombreBD;
		$this->$rq = $rq;

	}




	//Vamos a utlilzar la sintaxis PDO de Conexion
	public function conexBDPDO(){
		try{
			$this->oConBD = new PDO("mysql:host=".$this->ipBD.";dbname=". $this->nombreBD , $this->usuarioBD, $this->passBD);

			return true;
		}catch(PDOException $e){
			echo "Error de Conexion: ". $e->getMessage(). "\n";
			return false;
		}
	}
/*
	//Codigo sirve para traer los parametros para las vistas
	public function getDesembalado(){
		$desembalado = 0;
		try{
			$strQuery = "SELECT COUNT(*) AS tdesembalado FROM desembalado WHERE estatus !=0 ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$desembalado= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getDesembalado: ". $e->getMessage(). "\n";
			return -1;;
		}
		return $desembalado;
	}

	//Codigo sirve para traer los parametros para las vistas
	public function getHerreria(){
		$herreria = 0;
		 $mes =  date('m');
		 $anio =  date('Y');
		try{
			$strQuery = "SELECT COUNT(*) from herreria WHERE year(fecha_add)= $anio AND month(fecha_add)= $mes AND estatus !=0 ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$herreria= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getHerreria: ". $e->getMessage(). "\n";
			return -1;
		}
		return $herreria;
	}



	//Codigo sirve para traer los parametros para las vistas
	public function getPintura(){
		$pintura = 0;
		$mes = date('m');
		$anio =  date('Y');
		try{
			$strQuery = "SELECT COUNT(*) AS tpintura FROM pintura WHERE year(fecha_add)= $anio AND month(fecha_add) = $mes AND estatus !=0 ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$pintura= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getPintura: ". $e->getMessage(). "\n";
			return false;
		}
		return $pintura;
	}

	public function getRuedas(){
		$ruedas = 0;
		$mes = date('m');
		$anio = date('Y');
		try{
			$strQuery = "SELECT COUNT(*) AS truedas FROM ruedas WHERE year(fecha_add) = $anio AND month(fecha_add) = $mes AND estatus !=0 ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$ruedas= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getRuedas: ". $e->getMessage(). "\n";
			return -1;
		}
		return $ruedas;
	}

	public function getCinta(){
		$cinta = 0;
		$mes = date('m');
		$anio = date('Y');
		try{
			$strQuery = "SELECT COUNT(*) AS tcinta FROM cinta WHERE year(fecha_add) = $anio AND month(fecha_add) = $mes AND estatus !=0 ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$cinta= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getCinta: ". $e->getMessage(). "\n";
			return -1;
		}
		return $cinta;
	}

	public function getProbado(){
		$probado = 0;
		$mes = date('m');
		$anio = date('Y');
		try{
			$strQuery = "SELECT COUNT(*) AS tprobado FROM probado WHERE year(fecha_add) = $anio AND month(fecha_add) = $mes AND estatus !=0 ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$probado= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getProbado: ". $e->getMessage(). "\n";
			return -1;
		}
		return $probado;
	}

	public function getDeposito(){
		$deposito = 0;
		$mes = date('m');
		$anio = date('Y');
		try{
			$strQuery = "SELECT COUNT(*) AS tdeposito FROM deposito WHERE year(fecha_add) = $anio AND month(fecha_add) = $mes AND estatus !=0 ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$deposito= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getDeposito: ". $e->getMessage(). "\n";
			return -1;
		}
		return $deposito;
	}

	//Codigo sirve para traer los parametros para las vistas
	public function getDesembalado_Lib(){
		$desembalado = 0;
		$mes = date('m');
		$anio = date('Y');
		try{
			$strQuery = "SELECT COUNT(*) AS tdesembalado FROM desembalado WHERE  estatus !=1 ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$desembalado= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getDesembalado: ". $e->getMessage(). "\n";
			return -1;;
		}
		return $desembalado;
	}

	//Codigo sirve para traer los parametros para las vistas
	public function getHerreria_Lib(){
		$herreria = 0;
		$mes = date('m');
		try{
			$strQuery = "SELECT COUNT(*) AS therreria FROM herreria WHERE month(fecha_fin) = $mes AND estatus !=1 ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$herreria= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getHerreria: ". $e->getMessage(). "\n";
			return -1;
		}
		return $herreria;
	}



	//Codigo sirve para traer los parametros para las vistas
	public function getPintura_Lib(){
		$pintura = 0;
		$mes = date('m');
		try{
			$strQuery = "SELECT COUNT(*) AS tpintura FROM pintura WHERE month(fecha_fin) = $mes AND estatus !=1 ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$pintura= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getPintura: ". $e->getMessage(). "\n";
			return false;
		}
		return $pintura;
	}

	public function getRuedas_Lib(){
		$ruedas = 0;
		$mes = date('m');
		try{
			$strQuery = "SELECT COUNT(*) AS truedas FROM ruedas WHERE month(fecha_fin) = $mes AND estatus !=1 ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$ruedas= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getRuedas: ". $e->getMessage(). "\n";
			return -1;
		}
		return $ruedas;
	}

	public function getCinta_Lib(){
		$cinta = 0;
		$mes = date('m');
		try{
			$strQuery = "SELECT COUNT(*) AS tcinta FROM cinta WHERE month(fecha_fin) = $mes AND estatus !=1 ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$cinta= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getCinta: ". $e->getMessage(). "\n";
			return -1;
		}
		return $cinta;
	}

	public function getProbado_Lib(){
		$probado = 0;
		$mes = date('m');
		try{
			$strQuery = "SELECT COUNT(*) AS tprobado FROM probado WHERE month(fecha_fin) = $mes AND estatus !=1 ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$probado= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getProbado: ". $e->getMessage(). "\n";
			return -1;
		}
		return $probado;
	}

	public function getDeposito_Lib(){
		$deposito = 0;
		$mes = date('m');
		try{
			$strQuery = "SELECT COUNT(*) AS tdeposito FROM deposito WHERE month(fecha_fin) = $mes AND estatus !=1 ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$deposito= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getDeposito: ". $e->getMessage(). "\n";
			return -1;
		}
		return $deposito;
	}


	//Codigo para recuperar los datos para la grafica
	public function getDatosGrafica(){
		$jDatos = '';
		$rawData= array();
		$i=0;
		try{
			$strQuery = "SELECT SUM(producida) as tproduccion, SUM(probado) as tprobados,SUM(faltante) as tfaltante, SUM(banco) as tbanco, DATE_FORMAT(fecha_alta,'%Y-%m/%d') as fecha FROM control GROUP BY DATE_FORMAT(fecha_alta,'%Y-%m/%d') ORDER BY fecha DESC ";
			//echo $strQuery;
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$pQuery->setFetchMode(PDO::FETCH_ASSOC);
				while ($producto = $pQuery->fetch()) {
					$oGrafica = new Grafica();
					$oGrafica->totalProducido = $producto['tproduccion'];
					$oGrafica->totalProbado = $producto['tprobados'];
					$oGrafica->totalFaltante = $producto['tfaltante'];
					$oGrafica->totalBanco = $producto['tbanco'];
					$oGrafica->fechaVenta = $producto['fecha'];
					$rawData[$i] = $oGrafica;
					$i++;

				}

				$jDatos = json_encode($rawData);

			}
		}catch(PDOException $e){
			echo "MYSQL.getDatosGrafica: ". $e->getMessage(). "\n";
		}
		return $jDatos;
	}

	//Funciones para llamar a la cantidad probada por los Miguel
	public function getMiguel(){
		$miguel = 0;
		$mes = date('m');
		$anio = date('Y');
		try{
			$strQuery = "SELECT SUM(cantidad) as tmiguel FROM probadores WHERE year(fecha_add) = $anio AND month(fecha_add) = $mes AND nombre = 'Miguel Urbieta' ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$miguel= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getMiguel: ". $e->getMessage(). "\n";
			return -1;;
		}
		return $miguel;
	 }

	//Funciones para llamar a la cantidad probada por Pablo
	public function getPablo(){
		$pablo = 0;
		$mes = date('m');
		$anio = date('Y');
		try{
			$strQuery = "SELECT SUM(cantidad) as tpablo FROM probadores WHERE year(fecha_add) = $anio AND month(fecha_add) = $mes AND nombre = 'Pablo Gonzalez' ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$pablo= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getPablo: ". $e->getMessage(). "\n";
			return -1;;
		}
		return $pablo;
	 }

	//Funciones para llamar a la cantidad probada por  Diego
	public function getDiego(){
		$diego = 0;
		$mes = date('m');
		$anio = date('Y');
		try{
			$strQuery = "SELECT SUM(cantidad) as tdiego FROM probadores WHERE year(fecha_add) = $anio AND month(fecha_add) = $mes AND nombre = 'Diego Colman' ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$diego= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getDiego: ". $e->getMessage(). "\n";
			return -1;;
		}
		return $diego;
	 }

	//Funciones para llamar a la cantidad probada por Mario
	public function getMario(){
		$mario = 0;
		$mes = date('m');
		$anio = date('Y');
		try{
			$strQuery = "SELECT SUM(cantidad) as tmario FROM probadores WHERE year(fecha_add) = $anio AND month(fecha_add) = $mes AND nombre = 'Mario Britez' ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$mario= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getMario: ". $e->getMessage(). "\n";
			return -1;;
		}
		return $mario;
	 }

	//Funciones para llamar a la cantidad probada por Junior
	public function getJunior(){
		$junior = 0;
		$mes = date('m');
		$anio = date('Y');
		try{
			$strQuery = "SELECT SUM(cantidad) as tjunior FROM probadores WHERE year(fecha_add) = $anio AND month(fecha_add) = $mes AND nombre = 'Junior Guanes' ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$junior= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getjunior: ". $e->getMessage(). "\n";
			return -1;;
		}
		return $junior;
	 }


	//Funciones para llamar a la cantidad probada por Bruno
	public function getBrunos(){
		$bruno = 0;
		$mes = date('m');
		$anio = date('Y');
		try{
			$strQuery = "SELECT SUM(cantidad) as tbruno FROM probadores WHERE year(fecha_add) = $anio AND month(fecha_add) = $mes AND nombre = 'Bruno Segovia' ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$bruno= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getBruno: ". $e->getMessage(). "\n";
			return -1;;
		}
		return $bruno;
	}


	//Funciones para llamar a la cantidad probada por bruno
	public function getJuan(){
		$juan = 0;
		$mes = date('m');
		$anio = date('Y');
		try{
			$strQuery = "SELECT SUM(cantidad) as tjuan FROM probadores WHERE year(fecha_add) = $anio AND month(fecha_add) = $mes AND nombre = 'Juan Alvarez' ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$juan= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getJuan: ". $e->getMessage(). "\n";
			return -1;;
		}
		return $juan;
	}

	//Funciones para llamar a la cantidad probada por  Herminio
	public function getHerminio(){
		$herminio = 0;
		$mes = date('m');
		$anio = date('Y');
		try{
			$strQuery = "SELECT SUM(cantidad) as tHerminio FROM probadores WHERE year(fecha_add) = $anio AND month(fecha_add) = $mes AND nombre = 'Herminio Irala' ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$herminio= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getHerminio: ". $e->getMessage(). "\n";
			return -1;
		}
		return $herminio;
	}


	//Funciones para llamar a la cantidad probada por  Chamorro
	public function getChamorro(){
		$carlos = 0;
		$mes = date('m');
		$anio = date('Y');
		try{
			$strQuery = "SELECT SUM(cantidad) as tChamorro FROM probadores WHERE year(fecha_add) = $anio AND month(fecha_add) = $mes AND nombre = 'Carlos Chamorro' ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$carlos= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getChamorro: ". $e->getMessage(). "\n";
			return -1;
		}
		return $carlos;
	}

	//Funciones para llamar a la cantidad probada por  Chamorro
	public function getNofificaciones(){
		$notificacion = 0;
		$mes = date('m');
		$anio = date('Y');
		try{
			$strQuery = "SELECT COUNT(*) as tNotificacion FROM reclamos WHERE estatus = 1";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$notificacion= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getNofificaciones: ". $e->getMessage(). "\n";
			return -1;
		}
		return $notificacion;
	}
	
}

class Grafica{
	public $totalProducido = 0;
	public $totalProbado = 0;
	public $totalFaltante = 0;
	public $totalBanco = 0;*/
}
