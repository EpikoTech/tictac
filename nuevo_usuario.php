<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $dni = $_POST['dni'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $cel = $_POST['telefono'];
    $fecha = $_POST['fecha_nacimiento'];
    $vali = $_POST['check'];
    $base = "proyecto_tictac";
    $user = "root";
    $pass = "pass";
    $host = "localhost";
    try {
        $conn = new PDO("mysql:host=$host;dbname=$base", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        $sql_registro="INSERT INTO `proyecto_tictac`.`registro_usuarios` 
        (`usuario`,`password`,`campo_estado`) VALUES 
        ('$usuario','$password','1')";
        $stmt_registro=$conn->prepare($sql_registro);
        $stmt_registro->execute();

        $usuario_id=$conn->lastInsertId();
        //ALTER TABLE `registro_usuarios` CHANGE COLUMN `usuario_ID` `usuario_ID` INT(11) NOT NULL AUTO_INCREMENT FIRST;

        $sql_usuarios = "INSERT INTO `proyecto_tictac`.`usuarios` 
        (`usuario_ID`,`nombres`, `apellidos`, `correo`,`celular`,`dni`,`fecha_nacimiento`,`val_term_cond`) 
        VALUES 
        ('$usuario_id','$nombre', '$apellido', '$correo','$cel','$dni','$fecha',$vali);";
        $stmt_usuarios=$conn->prepare($sql_usuarios);
        $stmt_usuarios->execute();
        
        $conn->commit();
        echo ("datos insertados en ambas tablas");
    } catch (Exception $e) {
        $conn->rollBack();
        echo ($usuario_id);
        echo ("Error : " . $e->getMessage());
    }
}
