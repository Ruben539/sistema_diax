<?php
session_start();
if (empty($_SESSION['active'])) {
		header('location: ../Plantillas/salir.php');
}

require_once("../body/header_admin.php");


if (!empty($_POST)) {
	$alert = '';

	if (empty($_POST['usuario']) ) {

		$alert = '<p class = "msg_error">Debe llenar Todos los Campos</p>';

	}else{

        $id_infoPintura        = $_POST['id'];
		$total_varilla         = $_POST['total_varilla'];
		$total_sosten          = $_POST['total_sosten'];
		$total_horquilla       = $_POST['total_horquilla'];
		$total_caballete       = $_POST['total_caballete'];
		$total_posapie         = $_POST['total_posapie'];
		$total_manubrio        = $_POST['total_manubrio'];
		$total_mandil          = $_POST['total_mandil'];
        $total_posapie1        = $_POST['total_posapie1'];
		$total_posapie2        = $_POST['total_posapie2'];
		$total_motor           = $_POST['total_motor'];
		$total_bateria         = $_POST['total_bateria'];
        $total_cutanque        = $_POST['total_cutanque'];
		$total_velocimetro     = $_POST['total_velocimetro'];
		$total_adorno          = $_POST['total_adorno'];
        $total_bulto           = $_POST['total_bulto'];
		$total_chasis          = $_POST['total_chasis'];
		$total_freno           = $_POST['total_freno'];
		$total_tanque          = $_POST['total_tanque'];
        $diferencia_varilla    = $_POST['diferencia_varilla'];
		$diferencia_sosten     = $_POST['diferencia_sosten'];
		$diferencia_horquilla  = $_POST['diferencia_horquilla'];
		$diferencia_caballete  = $_POST['diferencia_caballete'];
		$diferencia_posapie    = $_POST['diferencia_posapie'];
		$diferencia_manubrio   = $_POST['diferencia_manubrio'];
		$diferencia_mandil     = $_POST['diferencia_mandil'];
        $diferencia_posapie1   = $_POST['diferencia_posapie1'];
		$diferencia_posapie2   = $_POST['diferencia_posapie2'];
		$diferencia_motor      = $_POST['diferencia_motor'];
		$diferencia_bateria    = $_POST['diferencia_bateria'];
        $diferencia_cutanque   = $_POST['diferencia_cutanque'];
		$diferencia_velocimetro= $_POST['diferencia_velocimetro'];
		$diferencia_adorno     = $_POST['diferencia_adorno'];
        $diferencia_bulto      = $_POST['diferencia_bulto'];
		$diferencia_chasis     = $_POST['diferencia_chasis'];
		$diferencia_freno      = $_POST['diferencia_freno'];
		$diferencia_tanque     = $_POST['diferencia_tanque'];
        $observacion           = $_POST['observacion'];
		$usuario               = $_POST['usuario'];
	
		$resultado = 0;

		$query = mysqli_query($conection,"SELECT * FROM infopintura WHERE total_varilla = '$total_varilla' ");

		$resultado = mysqli_fetch_array($query);



			$query_insert = mysqli_query($conection,"UPDATE infopintura SET total_varilla = '$total_varilla',total_sosten = '$total_sosten',total_horquilla = '$total_horquilla',
            total_caballete = '$total_caballete',total_posapie ='$total_posapie',total_manubrio = '$total_manubrio' ,total_mandil = '$total_mandil',total_posapie1 = '$total_posapie1',
            total_posapie2 = '$total_posapie2',total_motor = '$total_motor',total_bateria = '$total_bateria',total_cutanque = '$total_cutanque',
            total_velocimetro = '$total_velocimetro',total_adorno = '$total_adorno',total_bulto = '$total_bulto',total_chasis = '$total_chasis',total_freno = '$total_freno',total_tanque = '$total_tanque',
            diferencia_varilla = '$diferencia_varilla',diferencia_sosten = '$diferencia_sosten',diferencia_caballete = '$diferencia_caballete',diferencia_horquilla = '$diferencia_horquilla',diferencia_posapie = '$diferencia_posapie',
            diferencia_manubrio = '$diferencia_manubrio',diferencia_mandil = '$diferencia_mandil',diferencia_posapie1 = '$diferencia_posapie1',diferencia_posapie2 = '$diferencia_posapie2',diferencia_motor = '$diferencia_motor',
            diferencia_bateria = '$diferencia_bateria',diferencia_cutanque = '$diferencia_cutanque',diferencia_velocimetro =  '$diferencia_velocimetro',diferencia_adorno = '$diferencia_adorno',diferencia_bulto = '$diferencia_bulto',
            diferencia_chasis ='$diferencia_chasis',diferencia_freno = '$diferencia_freno', diferencia_tanque = '$diferencia_tanque',observacion = '$observacion',usuario = '$usuario'
            WHERE id_infoPintura = '$id_infoPintura' ");

			if ($query_insert ) {
				$alert = '<p class = "msg_save">Registro Guardado Correctamente</p>';

			}else{
				$alert = '<p class = "msg_error">Error al Guardar el Registro</p>';
			}

	}
	//mysqli_close($conection);
}


$id_infoPintura = $_REQUEST['id'];

$sql = mysqli_query($conection,"SELECT * FROM infopintura WHERE id_infoPintura = $id_infoPintura AND estatus= 1");

//mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php


$resultado = mysqli_num_rows($sql);

if ($resultado == 0) {
	header("location:../Informes/info_Pintura.php");
}else{

	while ($data = mysqli_fetch_array($sql)) {
 
		
		$meta_varilla    = $data['meta_varilla'];
		$meta_sosten     = $data['meta_sosten'];
		$meta_horquilla  = $data['meta_horquilla'];
		$meta_caballete  = $data['meta_caballete'];
		$meta_posapie    = $data['meta_posapie'];
		$meta_manubrio   = $data['meta_manubrio'];
		$meta_mandil     = $data['meta_mandil'];
        $meta_posapie1   = $data['meta_posapie1'];
		$meta_posapie2   = $data['meta_posapie2'];
		$meta_motor      = $data['meta_motor'];
		$meta_bateria    = $data['meta_bateria'];
        $meta_cutanque   = $data['meta_cutanque'];
		$meta_velocimetro= $data['meta_velocimetro'];
		$meta_adorno     = $data['meta_adorno'];
        $meta_bulto      = $data['meta_bulto'];
		$meta_chasis     = $data['meta_chasis'];
		$meta_freno      = $data['meta_freno'];
		$meta_tanque     = $data['meta_tanque'];
		

	}
}

?>

<main class="app-content">

  <div class="modal-dialog modal-lg" >
    <div class="modal-content">
      <div class="modal-header headerRegister">
        <h5 class="modal-title" id="titleModal">Total Producido de Pintura</h5>
      </div>
      <div class="modal-body">
 
		<form action="" method="POST">
       <div  class="formulario" id="formulario">
           <input type="hidden" name="id" id="id" value="<?php echo $id_infoPintura;?>">      
    	<!--Grupo de Formulario del Varilla-->
		<div class="form-group" ">
			<div class="input-group">
                 <div class="input-group-prepend"><span class="input-group-text">Varilla Tensor</span></div>
                 <input class="form-control" type="number" name="total_varilla" id="total_varilla" placeholder="Ingrese el meta_diaria"
             oninput="restar()" >
            </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
              <div class="input-group-prepend" ><span class="input-group-text">Varilla Tensor</span></div>
             <input class="form-control" type="hidden" name="meta_varilla" id="meta_varilla" placeholder="Ingrese la total_producido"
             oninput="restar()" value="<?php echo $meta_varilla?>">
        </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">Varilla Tensor</span></div>
                <input class="form-control" type="number" name="diferencia_varilla" id="diferencia_varilla" placeholder="Ingrese la Cantidad"  >
            </div>
        </div>

        <div class="form-group" >
			<div class="input-group">
                 <div class="input-group-prepend"><span class="input-group-text">Sosten Lateral</span></div>
                 <input class="form-control" type="number" name="total_sosten" id="total_sosten" placeholder="Ingrese el Cantidad"
             oninput="restar1()" >
            </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text">Sosten Lateral</span></div>
             <input class="form-control" type="number" name="meta_sosten" id="meta_sosten" placeholder="Ingrese la Cantidad"
             oninput="restar1()" value="<?php echo $meta_sosten?>">
        </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">Sosten Lateral</span></div>
                <input class="form-control" type="number" name="diferencia_sosten" id="diferencia_sosten" placeholder="Ingrese la Cantidad"  >
            </div>
        </div>

        <div class="form-group" >
			<div class="input-group">
                 <div class="input-group-prepend"><span class="input-group-text">Caballete</span></div>
                 <input class="form-control" type="number" name="total_caballete" id="total_caballete" placeholder="Ingrese la Cantidad"
             oninput="restar2()" >
            </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text">Caballete</span></div>
             <input class="form-control" type="number" name="meta_caballete" id="meta_caballete" placeholder="Ingrese la Cantidad"
             oninput="restar2()" value="<?php echo $meta_caballete?>">
        </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">Caballete</span></div>
                <input class="form-control" type="number" name="diferencia_caballete" id="diferencia_caballete" placeholder="Ingrese la Cantidad"  >
            </div>
        </div>

        <div class="form-group" >
			<div class="input-group">
                 <div class="input-group-prepend"><span class="input-group-text">Horquilla</span></div>
                 <input class="form-control" type="number" name="total_horquilla" id="total_horquilla" placeholder="Ingrese la Cantidad"
             oninput="restar3()" >
            </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text">Horquilla</span></div>
             <input class="form-control" type="number" name="meta_horquilla" id="meta_horquilla" placeholder="Ingrese la Cantidad"
             oninput="restar3()" value="<?php echo $meta_horquilla?>">
        </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">Hoquilla</span></div>
                <input class="form-control" type="number" name="diferencia_horquilla" id="diferencia_horquilla" placeholder="Ingrese la Cantidad"  >
            </div>
        </div>

        <div class="form-group" >
			<div class="input-group">
                 <div class="input-group-prepend"><span class="input-group-text">Posapie Central</span></div>
                 <input class="form-control" type="number" name="total_posapie" id="total_posapie" placeholder="Ingrese la Cantidad"
             oninput="restar4()" >
            </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text">Posapie Central</span></div>
             <input class="form-control" type="number" name="meta_posapie" id="meta_posapie" placeholder="Ingrese la Cantidad"
             oninput="restar4()" value="<?php echo $meta_horquilla?>">
        </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">Posapie Central</span></div>
                <input class="form-control" type="number" name="diferencia_posapie" id="diferencia_posapie" placeholder="Ingrese la Cantidad"  >
            </div>
        </div>

         <div class="form-group" >
			<div class="input-group">
                 <div class="input-group-prepend"><span class="input-group-text">Manubrio</span></div>
                 <input class="form-control" type="number" name="total_manubrio" id="total_manubrio" placeholder="Ingrese la Cantidad"
             oninput="restar5()" >
            </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text">Manubrio</span></div>
             <input class="form-control" type="number" name="meta_manubrio" id="meta_manubrio" placeholder="Ingrese la Cantidad"
             oninput="restar5()" value="<?php echo $meta_manubrio?>">
        </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">Manubrio</span></div>
                <input class="form-control" type="number" name="diferencia_manubrio" id="diferencia_manubrio" placeholder="Ingrese la Cantidad"  >
            </div>
        </div>

         <div class="form-group" >
			<div class="input-group">
                 <div class="input-group-prepend"><span class="input-group-text">Soporte Mandil</span></div>
                 <input class="form-control" type="number" name="total_mandil" id="total_mandil" placeholder="Ingrese la Cantidad"
             oninput="restar6()" >
            </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text">Sop. Mandil</span></div>
             <input class="form-control" type="number" name="meta_mandil" id="meta_mandil" placeholder="Ingrese la Cantidad"
             oninput="restar6()" value="<?php echo $meta_mandil?>">
        </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">Sop. Mandil</span></div>
                <input class="form-control" type="number" name="diferencia_mandil" id="diferencia_mandil" placeholder="Ingrese la Cantidad"  >
            </div>
        </div>

        <div class="form-group" >
			<div class="input-group">
                 <div class="input-group-prepend"><span class="input-group-text">Pos.Trasero Izq.</span></div>
                 <input class="form-control" type="number" name="total_posapie1" id="total_posapie1" placeholder="Ingrese la Cantidad"
             oninput="restar7()" >
            </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text">Pos.Trasero Izq.</span></div>
             <input class="form-control" type="number" name="meta_posapie1" id="meta_posapie1" placeholder="Ingrese la Cantidad"
             oninput="restar7()" value="<?php echo $meta_posapie1?>">
        </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">Pos.Trasero Izq.</span></div>
                <input class="form-control" type="number" name="diferencia_posapie1" id="diferencia_posapie1" placeholder="Ingrese la Cantidad"  >
            </div>
        </div>

        <div class="form-group">
			<div class="input-group">
                 <div class="input-group-prepend"><span class="input-group-text">Pos.Trasero Der.</span></div>
                 <input class="form-control" type="number" name="total_posapie2" id="total_posapie2" placeholder="Ingrese la Cantidad"
             oninput="restar8()" >
            </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text">Pos.Trasero Der.</span></div>
             <input class="form-control" type="number" name="meta_posapie2" id="meta_posapie2" placeholder="Ingrese la Cantidad"
             oninput="restar8()" value="<?php echo $meta_posapie2?>">
        </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">Pos.Trasero Der.</span></div>
                <input class="form-control" type="number" name="diferencia_posapie2" id="diferencia_posapie2" placeholder="Ingrese la Cantidad"  >
            </div>
        </div>

        <div class="form-group">
			<div class="input-group">
                 <div class="input-group-prepend"><span class="input-group-text">Soporte Motor</span></div>
                 <input class="form-control" type="number" name="total_motor" id="total_motor" placeholder="Ingrese la Cantidad"
             oninput="restar9()" >
            </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text">Soporte Motor</span></div>
             <input class="form-control" type="number" name="meta_motor" id="meta_motor" placeholder="Ingrese la Cantidad"
             oninput="restar9()" value="<?php echo $meta_posapie2?>">
        </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">Soporte Motor</span></div>
                <input class="form-control" type="number" name="diferencia_motor" id="diferencia_motor" placeholder="Ingrese la Cantidad"  >
            </div>
        </div>

        <div class="form-group">
			<div class="input-group">
                 <div class="input-group-prepend"><span class="input-group-text">Soporte Bateria</span></div>
                 <input class="form-control" type="number" name="total_bateria" id="total_bateria" placeholder="Ingrese la Cantidad"
             oninput="restar10()" >
            </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text">Soporte Bateria</span></div>
             <input class="form-control" type="number" name="meta_bateria" id="meta_bateria" placeholder="Ingrese la Cantidad"
             oninput="restar10()" value="<?php echo $meta_bateria?>">
        </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">Soporte Bateria</span></div>
                <input class="form-control" type="number" name="diferencia_bateria" id="diferencia_bateria" placeholder="Ingrese la Cantidad"  >
            </div>
        </div>

         <div class="form-group">
			<div class="input-group">
                 <div class="input-group-prepend"><span class="input-group-text">S. CubreTanque</span></div>
                 <input class="form-control" type="number" name="total_cutanque" id="total_cutanque" placeholder="Ingrese la Cantidad"
             oninput="restar11()" >
            </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text">S. CubreTanque</span></div>
             <input class="form-control" type="number" name="meta_cutanque" id="meta_cutanque" placeholder="Ingrese la Cantidad"
             oninput="restar11()" value="<?php echo $meta_cutanque;?>">
        </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">S. CubreTanque</span></div>
                <input class="form-control" type="number" name="diferencia_cutanque" id="diferencia_cutanque" placeholder="Ingrese la Cantidad"  >
            </div>
        </div>

        <div class="form-group">
			<div class="input-group">
                 <div class="input-group-prepend"><span class="input-group-text">Soporte Velocimetro</span></div>
                 <input class="form-control" type="number" name="total_velocimetro" id="total_velocimetro" placeholder="Ingrese la Cantidad"
             oninput="restar12()" >
            </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text">Soporte Velocimetro</span></div>
             <input class="form-control" type="number" name="meta_velocimetro" id="meta_velocimetro" placeholder="Ingrese la Cantidad"
             oninput="restar12()" value="<?php echo $meta_velocimetro;?>">
        </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">Soporte Velocimetro</span></div>
                <input class="form-control" type="number" name="diferencia_velocimetro" id="diferencia_velocimetro" placeholder="Ingrese la Cantidad"  >
            </div>
        </div>

        <div class="form-group">
			<div class="input-group">
                 <div class="input-group-prepend"><span class="input-group-text">Adorno Posapie</span></div>
                 <input class="form-control" type="number" name="total_adorno" id="total_adorno" placeholder="Ingrese la Cantidad"
             oninput="restar13()" >
            </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text">Adorno Posapie</span></div>
             <input class="form-control" type="number" name="meta_adorno" id="meta_adorno" placeholder="Ingrese la Cantidad"
             oninput="restar13()" value="<?php echo $meta_adorno;?>">
        </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">Adorno Posapie</span></div>
                <input class="form-control" type="number" name="diferencia_adorno" id="diferencia_adorno" placeholder="Ingrese la Cantidad"  >
            </div>
        </div>

        <div class="form-group">
			<div class="input-group">
                 <div class="input-group-prepend"><span class="input-group-text">Porta Bulto</span></div>
                 <input class="form-control" type="number" name="total_bulto" id="total_bulto" placeholder="Ingrese la Cantidad"
             oninput="restar14()" >
            </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text">Porta Bulto</span></div>
             <input class="form-control" type="number" name="meta_bulto" id="meta_bulto" placeholder="Ingrese la Cantidad"
             oninput="restar14()" value="<?php echo $meta_bulto;?>">
        </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">Porta Bulto</span></div>
                <input class="form-control" type="number" name="diferencia_bulto" id="diferencia_bulto" placeholder="Ingrese la Cantidad"  >
            </div>
        </div>

        <div class="form-group">
			<div class="input-group">
                 <div class="input-group-prepend"><span class="input-group-text">Chasis</span></div>
                 <input class="form-control" type="number" name="total_chasis" id="total_chasis" placeholder="Ingrese la Cantidad"
             oninput="restar15()" >
            </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text">Chasis</span></div>
             <input class="form-control" type="number" name="meta_chasis" id="meta_chasis" placeholder="Ingrese la Cantidad"
             oninput="restar15()" value="<?php echo $meta_chasis;?>">
        </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">Chasis</span></div>
                <input class="form-control" type="number" name="diferencia_chasis" id="diferencia_chasis" placeholder="Ingrese la Cantidad"  >
            </div>
        </div>

        <div class="form-group">
			<div class="input-group">
                 <div class="input-group-prepend"><span class="input-group-text">Cabo de Freno</span></div>
                 <input class="form-control" type="number" name="total_freno" id="total_freno" placeholder="Ingrese la Cantidad"
             oninput="restar16()" >
            </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text">Cabo de Freno</span></div>
             <input class="form-control" type="number" name="meta_freno" id="meta_freno" placeholder="Ingrese la Cantidad"
             oninput="restar16()" value="<?php echo $meta_freno;?>">
        </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">Cabo de Freno</span></div>
                <input class="form-control" type="number" name="diferencia_freno" id="diferencia_freno" placeholder="Ingrese la Cantidad"  >
            </div>
        </div>


        <div class="form-group">
			<div class="input-group">
                 <div class="input-group-prepend"><span class="input-group-text">Tanque</span></div>
                 <input class="form-control" type="number" name="total_tanque" id="total_tanque" placeholder="Ingrese la Cantidad"
             oninput="restar17()" >
            </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
              <div class="input-group-prepend"><span class="input-group-text">Cabo de Freno</span></div>
             <input class="form-control" type="number" name="meta_tanque" id="meta_tanque" placeholder="Ingrese la Cantidad"
             oninput="restar17()" value="<?php echo $meta_freno;?>">
        </div>
        </div>
        <div class="form-group" style="display:none;">
			<div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text">Cabo de Freno</span></div>
                <input class="form-control" type="number" name="diferencia_tanque" id="diferencia_tanque" placeholder="Ingrese la Cantidad"  >
            </div>
        </div>
           
	
</div>
    	<!--Grupo de Formulario de Puesto 1-->
    
        <textarea type="text" name="observacion" id="observacion" class="input-100" placeholder="Ingrese su Observación"></textarea>
		<input type="hidden" name="usuario" id="usuario" value="<?php echo $_SESSION['user'];?>">
          <br> <br>
		<div class="tile-footer" >
              <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Registrar</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="../Informes/informeHerreria.php"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
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
</div>

</main>

<script>
    function restar(){
        try{ 
        var numero1 = parseInt(document.getElementById('total_varilla').value);
        var numero2 = parseInt(document.getElementById('meta_varilla').value);
        var resultado;
        resultado = numero1-numero2;
        document.getElementById('diferencia_varilla').value = resultado;
       }catch(e){
           
       }
    }

      function restar1(){
        try{ 
        var numero1 = parseInt(document.getElementById('total_sosten').value);
        var numero2 = parseInt(document.getElementById('meta_sosten').value);
        var resultado;
        resultado = numero1-numero2;
        document.getElementById('diferencia_sosten').value = resultado;
       }catch(e){
           
       }
    }

     function restar2(){
        try{ 
        var numero1 = parseInt(document.getElementById('total_caballete').value);
        var numero2 = parseInt(document.getElementById('meta_caballete').value);
        var resultado;
        resultado = numero1-numero2;
        document.getElementById('diferencia_caballete').value = resultado;
       }catch(e){
           
       }
    }

     function restar3(){
        try{ 
        var numero1 = parseInt(document.getElementById('total_horquilla').value);
        var numero2 = parseInt(document.getElementById('meta_horquilla').value);
        var resultado;
        resultado = numero1-numero2;
        document.getElementById('diferencia_horquilla').value = resultado;
       }catch(e){
           
       }
    }

      function restar4(){
        try{ 
        var numero1 = parseInt(document.getElementById('total_posapie').value);
        var numero2 = parseInt(document.getElementById('meta_posapie').value);
        var resultado;
        resultado = numero1-numero2;
        document.getElementById('diferencia_posapie').value = resultado;
       }catch(e){
           
       }
    }

     function restar5(){
        try{ 
        var numero1 = parseInt(document.getElementById('total_manubrio').value);
        var numero2 = parseInt(document.getElementById('meta_manubrio').value);
        var resultado;
        resultado = numero1-numero2;
        document.getElementById('diferencia_manubrio').value = resultado;
       }catch(e){
           
       }
    }

    function restar6(){
        try{ 
        var numero1 = parseInt(document.getElementById('total_mandil').value);
        var numero2 = parseInt(document.getElementById('meta_mandil').value);
        var resultado;
        resultado = numero1-numero2;
        document.getElementById('diferencia_mandil').value = resultado;
       }catch(e){
           
       }
    }

    function restar7(){
        try{ 
        var numero1 = parseInt(document.getElementById('total_posapie1').value);
        var numero2 = parseInt(document.getElementById('meta_posapie1').value);
        var resultado;
        resultado = numero1-numero2;
        document.getElementById('diferencia_posapie1').value = resultado;
       }catch(e){
           
       }
    }

    function restar8(){
        try{ 
        var numero1 = parseInt(document.getElementById('total_posapie2').value);
        var numero2 = parseInt(document.getElementById('meta_posapie2').value);
        var resultado;
        resultado = numero1-numero2;
        document.getElementById('diferencia_posapie2').value = resultado;
       }catch(e){
           
       }
    }

    function restar9(){
        try{ 
        var numero1 = parseInt(document.getElementById('total_motor').value);
        var numero2 = parseInt(document.getElementById('meta_motor').value);
        var resultado;
        resultado = numero1-numero2;
        document.getElementById('diferencia_motor').value = resultado;
       }catch(e){
           
       }
    }

    function restar10(){
        try{ 
        var numero1 = parseInt(document.getElementById('total_bateria').value);
        var numero2 = parseInt(document.getElementById('meta_bateria').value);
        var resultado;
        resultado = numero1-numero2;
        document.getElementById('diferencia_bateria').value = resultado;
       }catch(e){
           
       }
    }

    function restar11(){
        try{ 
        var numero1 = parseInt(document.getElementById('total_cutanque').value);
        var numero2 = parseInt(document.getElementById('meta_cutanque').value);
        var resultado;
        resultado = numero1-numero2;
        document.getElementById('diferencia_cutanque').value = resultado;
       }catch(e){
           
       }
    }

    function restar12(){
        try{ 
        var numero1 = parseInt(document.getElementById('total_velocimetro').value);
        var numero2 = parseInt(document.getElementById('meta_velocimetro').value);
        var resultado;
        resultado = numero1-numero2;
        document.getElementById('diferencia_velocimetro').value = resultado;
       }catch(e){
           
       }
    }

    function restar13(){
        try{ 
        var numero1 = parseInt(document.getElementById('total_adorno').value);
        var numero2 = parseInt(document.getElementById('meta_adorno').value);
        var resultado;
        resultado = numero1-numero2;
        document.getElementById('diferencia_adorno').value = resultado;
       }catch(e){
           
       }
    }

    function restar14(){
        try{ 
        var numero1 = parseInt(document.getElementById('total_bulto').value);
        var numero2 = parseInt(document.getElementById('meta_bulto').value);
        var resultado;
        resultado = numero1-numero2;
        document.getElementById('diferencia_bulto').value = resultado;
       }catch(e){
           
       }
    }

    function restar15(){
        try{ 
        var numero1 = parseInt(document.getElementById('total_chasis').value);
        var numero2 = parseInt(document.getElementById('meta_chasis').value);
        var resultado;
        resultado = numero1-numero2;
        document.getElementById('diferencia_chasis').value = resultado;
       }catch(e){
           
       }
    }

    function restar16(){
        try{ 
        var numero1 = parseInt(document.getElementById('total_freno').value);
        var numero2 = parseInt(document.getElementById('meta_freno').value);
        var resultado;
        resultado = numero1-numero2;
        document.getElementById('diferencia_freno').value = resultado;
       }catch(e){
           
       }
    }

    function restar17(){
        try{ 
        var numero1 = parseInt(document.getElementById('total_tanque').value);
        var numero2 = parseInt(document.getElementById('meta_tanque').value);
        var resultado;
        resultado = numero1-numero2;
        document.getElementById('diferencia_tanque').value = resultado;
       }catch(e){
           
       }
    }
</script>