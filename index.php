<?php

$alert = '';

session_start();

if (!empty($_SESSION['active'])) {

  header('Location: Plantillas/salir.php');
}else{

  if (!empty($_POST)) {


    if (empty($_POST['usuario']) || empty($_POST['password'])){
      $alert= '<div class= "alert alert-danger"><i class="fas fa-exclamation-triangle"></i><b> Rellene todos los Campos</b></div>';
    }else{

      require_once("Modelos/conexion.php");
      
      

      $user =  mysqli_real_escape_string($conection,$_POST['usuario']);
      $pass = md5(mysqli_real_escape_string($conection,$_POST['password']));

      if (preg_match('/^[a-zA-ZñÑ]+$/',$_POST['usuario']) &&
        preg_match('/^[0-9a-zA-Z]+$/',$_POST['password'])) {



        $query = mysqli_query($conection,"SELECT * FROM usuarios WHERE usuario = '$user'
          AND pass = '$pass' AND estatus = 1");

      mysqli_close($conection);//con esto cerramos la conexion a la base de datos una vez conectado arriba con el conexion.php
      $resultado = mysqli_num_rows($query);


      if ($resultado > 0) {
        $data = mysqli_fetch_array($query);

        $_SESSION['active'] = true;
        $_SESSION['idUser'] = $data['id_usuario'];
        $_SESSION['nombre'] = $data['nombre'];
        $_SESSION['correo'] = $data['correo'];
        $_SESSION['user'] = $data['usuario'];
        $_SESSION['rol'] = $data['rol'];
       
        


        if ($_SESSION['rol'] == 1 ) {
         header('Location: Plantillas/dashboard.php');

       }else if($_SESSION['rol'] == 2){
        header('Location: Plantillas/dashboard.php');

      } 
      
    }else{

      $alert= '<div class= "alert alert-danger"><i class="fas fa-exclamation-triangle"></i><b> El Usuario y/o la Contraseña son Incorrectas</b></div>';

      session_destroy();
    }
  }
}
}
}


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/estilos.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
  <title>Acceso - División Industrial</title>
</head>
<body>
  <section class="material-half-bg">
    <div class="cover">
     
    </div>
  </section>
  <section class="login-content">
    <div class="login-box">
      <form class="login-form" method="POST">
        <h3 class="login-head"><img src="images/diax.jpg" alt=""></h3>
        <div class="form-group">
        <label for="usuario">Usuario</label>
			<div class="input-group">
        
        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-user"></i></span></div>
          	<input type="text" class="form-control" name="usuario" id="usuarios" placeholder="Ingrese su Usuario" require autofocus>
        </div>
		</div>
    <div class="form-group">
      <label for="password">Contraseña</label>
			<div class="input-group">
        <div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-lock"></i></span></div>
          	<input type="password" class="form-control" name="password" id="password" placeholder="Ingrese su Contraseña" require >
        </div>
		</div>
        <div class="form-group">
          <div class="utility">
            <div class="animated-checkbox">

            </div>
            
          </div>
        </div>
        <div class="form-group btn-container">
          <button type="submit" class="btn btn-danger btn-block"><i class="fas fa-sign-in-alt fa-lg fa-fw"></i> Ingresar</button>
          <br>
        </div>

        <?php if($alert != ""){  ?>
          <div class="alert-danger"><?php echo $alert; ?></div>
        <?php } ?>
      </form>
      <form class="forget-form" action="">
        <h3 class="login-head"><img src="images/alexlogo.png" alt="imh"></h3>
        <div class="form-group">
          <label class="control-label">Usuario</label>
          <input class="form-control" type="text" placeholder="Usuario">
        </div>
        <div class="form-group btn-container">
          <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>Reestablecer</button>
        </div>
        <div class="form-group mt-3">
          <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Ir la Login</a></p>
        </div>
      </form>
      
    </div>
  
  </section>
    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="js/plugins/pace.min.js"></script>
    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      });
    </script>
  </body>
</html>