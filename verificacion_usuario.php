<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $usuario = $_POST['usuario'];
    $password = $_POST['contraseña'];
    $base = "tictac";
    $user = "root";
    $pass = "root";
    $host = "localhost";
    try {
        $conn = new PDO("mysql:host=$host;dbname=$base;port=3308", $user, $pass);
        //$conn->beginTransaction();
        $sql = "SELECT *  FROM registro_usuarios WHERE usuario='$usuario' AND password='$password' AND campo_estado=1;";

        $consulta=$conn->query($sql);        
        // $resultado=[];        
        // if($consulta->num_rows > 0) {
        $valido = false;
        while($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
            if(isset($_SESSION['usuario'])) {
                session_destroy();   
            }
            session_start();            
            $_SESSION["usuario"] = $row["usuario"];
            $_SESSION["correo"] = "senati@senati.pe";
            $valido = true;
            echo json_encode(array("resultado"=>1,"mensaje"=>""));
        }
        if(!$valido) {
            echo json_encode(array("resultado"=>0,"mensaje"=>"usuario o clave incorrecta"));
        }
        // foreach($consulta as $row){
        //     array_push($resultado,$row);
        // }
        //echo json_encode($resultado);
    } catch (Exception $e) {
        echo "Error : " . $e->getMessage();
    }
}
?>