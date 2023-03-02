    <script src="../js/jquery-3.3.1.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="../js/plugins/pace.min.js"></script>
    <?php if($_SESSION['rol'] == 1){?>
         <script src="../js/funciones.js"></script>
    <?php }elseif($_SESSION['rol'] == 2){?>  
         <script src="../js/recepcionista.js"></script>
    <?php }elseif($_SESSION['rol'] == 5 || $_SESSION['rol'] == 6){?>  
         <script src="../js/informante.js"></script>
    <?php }?>