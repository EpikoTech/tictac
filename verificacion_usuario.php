<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $usuario = $_POST['usuario'];
    $password = $_POST['contraseña'];
    $base = "proyecto_tictac";
    $user = "root";
    $pass = "pass";
    $host = "localhost";
    try {
        $conn = new PDO("mysql:host=$host;dbname=$base", $user, $pass);
        $conn->beginTransaction();
        $sql = "SELECT *  FROM registro_usuarios WHERE usuario='$usuario' AND password='$password' AND campo_estado=1;";

        $consulta=$conn->query($sql);
        $resultado=[];
        foreach($consulta as $row){
            array_push($resultado,$row);
        }
        echo json_encode($resultado);
    } catch (Exception $e) {
        echo "Error : " . $e->getMessage();
    }
}
?>