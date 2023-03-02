<?php
session_start();
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

	//Codigo sirve para traer los parametros para las vistas
	public function getPacientePaz(){
		$idPacientePaz = 0;
		$fecha =  date('d-m-Y');
		// $anio =  date('Y');
		try{
			$strQuery = "SELECT count(*) tpacientes  FROM historial  where Fecha LIKE '%$fecha%' AND Atendedor like '%PAZ%'";
			//$strQuery = "SELECT COUNT(*) from clientes WHERE year(FechaIngreso)= $anio AND month(FechaIngreso)= $mes ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$idPacientePaz= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getPacientePaz: ". $e->getMessage(). "\n";
			return -1;;
		}
		return $idPacientePaz;
	}

	public function getPacienteDiax(){
		$idPacienteDiax = 0;
		$fecha =  date('d-m-Y');
		// $anio =  date('Y');
		try{
			$strQuery = "SELECT count(*) tpacientes  FROM historial  where Fecha LIKE '%$fecha%' AND Atendedor like '%DIAX%'";
			//$strQuery = "SELECT COUNT(*) from clientes WHERE year(FechaIngreso)= $anio AND month(FechaIngreso)= $mes ";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$idPacienteDiax= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getPacienteDiax: ". $e->getMessage(). "\n";
			return -1;;
		}
		return $idPacienteDiax;
	}

	//Codigo sirve para traer los parametros para las de los Pacientes en espera
	public function getPacientesEspera(){
		$idPacienteEspera = 0;
		$fecha  =  date('m-Y');
		$medico = trim($_SESSION['Nombre']);

		try{
			$strQuery = "SELECT count(*) tpacientes  FROM historial  
						where Fecha LIKE '%".$fecha."%' AND Atendedor LIKE '%".$medico."%' AND estado = 'En Espera'";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$idPacienteEspera= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getPacientesEspera: ". $e->getMessage(). "\n";
			return -1;
		}
		return $idPacienteEspera;
	}

	//Codigo sirve para traer los parametros para las de los Pacientes Atendidos
	public function getPacientesAtendido(){
		$idPacienteAtendido = 0;
		$fecha  =  date('m-Y');
		$medico = trim($_SESSION['Nombre']);

		try{
			$strQuery = "SELECT count(*) tpacientes  FROM historial  
						where Fecha LIKE '%".$fecha."%' AND Atendedor LIKE '%".$medico."%' AND estado = 'Atendido'";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$idPacienteAtendido= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getPacientesAtendido: ". $e->getMessage(). "\n";
			return -1;
		}
		return $idPacienteAtendido;
	}

	//Codigo sirve para traer los parametros para las de los Pacientes totales en el mes
	public function getPacientesTotal(){
		$idPacienteTotal = 0;
		$fecha  =  date('m-Y');
		$medico = trim($_SESSION['Nombre']);

		try{
			$strQuery = "SELECT count(*) tpacientes  FROM historial  
						where Fecha LIKE '%".$fecha."%' AND Atendedor LIKE '%".$medico."%'";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$idPacienteTotal= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getPacientesTotal: ". $e->getMessage(). "\n";
			return -1;
		}
		return $idPacienteTotal;
	}


	public function getNofificaciones(){
		$idNotificacion = 0;
		$mes = date('m');
		$anio = date('Y');
		try{
			$strQuery = "SELECT COUNT(*) as tNotificacion FROM historial WHERE estatus = 2";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$idNotificacion= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getNofificaciones: ". $e->getMessage(). "\n";
			return -1;
		}
		return $idNotificacion;
	}

	public function getNofificacionesPendientes(){
		$idNotificacionPen = 0;
		$mes = date('m');
		$anio = date('Y');
		try{
			$strQuery = "SELECT COUNT(*) as tNotificacion FROM historial WHERE estatus = 2";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$idNotificacionPen= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getNofificacionesPendientes: ". $e->getMessage(). "\n";
			return -1;
		}
		return $idNotificacionPen;
	}

	public function getMedicos(){
		$idMedicos = 0;
		$mes = date('m');
		$anio = date('Y');
		try{
			$strQuery = "SELECT COUNT(*) as tNotificacion FROM medicos WHERE estatus = 2";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$idMedicos= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getMedicos: ". $e->getMessage(). "\n";
			return -1;
		}
		return $idMedicos;
	}

	public function getMedicosPen(){
		$idMedicosPen = 0;
		$mes = date('m');
		$anio = date('Y');
		try{
			$strQuery = "SELECT COUNT(*) as tNotificacion FROM medicos WHERE estatus = 2";
			if($this->conexBDPDO()){
				$pQuery =$this->oConBD->prepare($strQuery);
				$pQuery->execute();
				$idMedicosPen= $pQuery->fetchColumn();
			}
		}catch(PDOException $e){
			echo "MYSQL.getMedicos: ". $e->getMessage(). "\n";
			return -1;
		}
		return $idMedicosPen;
	}

	/*//Codigo para recuperar los datos para la grafica
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
*/
	
}
class Grafica{
	public $totalProducido = 0;
	public $totalProbado = 0;
	public $totalFaltante = 0;
	public $totalBanco = 0;
}
