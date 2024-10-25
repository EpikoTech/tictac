<?php
require_once 'UM_conn_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];

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
        $conexion = new conexionDB('proyecto_tictac');//conecto a la base de datos
        $conn = $conexion->getPDO();//obtengo el pdo
        $conn->beginTransaction();

        $sql_registro="INSERT INTO `proyecto_tictac`.`registro_usuarios` 
        (`usuario`,`password`,`campo_estado`) VALUES 
        ('$usuario','$password','1')";
        $stmt_registro=$conn->prepare($sql_registro);
        $stmt_registro->execute();

        $usuario_id=$conn->lastInsertId();

        $sql_usuarios = "INSERT INTO `proyecto_tictac`.`usuarios` 
        (`usuario_ID`,`nombres`, `apellidos`, `correo`,`celular`,`dni`,`fecha_nacimiento`,`val_term_cond`) 
        VALUES 
        ('$usuario_id','$nombre', '$apellido', '$correo','$cel','$dni','$fecha',$vali);";
        $stmt_usuarios=$conn->prepare($sql_usuarios);
        $stmt_usuarios->execute();
        
        $conn->commit();
        echo ("datos insertados en ambas tablas");
        // echo "Tu dirección IP es: $ip";
    } catch (Exception $e) {
        $conn->rollBack();
        echo ($usuario_id);
        echo ("Error : " . $e->getMessage());
    }
}
