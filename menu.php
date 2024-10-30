<?php

    if(!isset($_SESSION['usuario'])) {
     header("Location : inicio_sesion.html");
     exit();
    }
    else {
     ?>   
     <p>MENU PRINCIPAL</p>
     
    <?}

?>
