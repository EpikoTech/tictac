<?php
require_once 'UM_user.php';

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

    try {
        $conexion = new User($base); //conecto a la base de datos
        $conn = $conexion->getPDO(); //obtengo el pdo
        $conn->beginTransaction();
        //primera insercion en la tabla registro_usuarios
        $data_registro=['usuario'=>$usuario,'password'=>$password,'campo_estado'=>1];
        $lastid=$conexion->insert('registro_usuarios',$data_registro);
        //segunda insercion en la tabla usuarios
        $data_usuario=['usuario_ID'=>$lastid,'nombres'=>$nombre, 'apellidos'=>$apellido, 'correo'=>$correo,'celular'=>$cel,'dni'=>$dni,
        'fecha_nacimiento'=>$fecha,'val_term_cond'=>$vali];
        $conexion->insert('usuarios',$data_usuario);
        $conn->commit();
        
        echo ("datos insertados en ambas tablas");
    } catch (Exception $e) {
        $conn->rollBack();
        echo ($usuario_id);
        echo ("Error : " . $e->getMessage());
    }
}
