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
    $vali = $_POST['validacion'];


    $base = "proyecto_tictac";
    $user = "root";
    $pass = "pass";
    $host = "localhost";
    try {
        $conn = new PDO("mysql:host=$host;dbname=$base", $user, $pass);
        $conn->beginTransaction();
        $sql = "INSERT INTO `proyecto_tictac`.`usuarios` 
        (`nombres`, `apellidos`, `correo`,`celular`,`dni`,`fecha nacimiento`) 
        VALUES 
        ('$nombre', '$apellido', '$correo','$cel','$dni','$fecha',$val);";

        $conn->exec($sql);
        $conn->commit();
        echo ("complete");
    } catch (Exception $e) {
        echo "Error : " . $e->getMessage();
    }
}
