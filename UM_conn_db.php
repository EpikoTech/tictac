<?php
class conexionDB
{
    private $host = "localhost";
    private $user = "root";
    private $password = "pass";
    private $database;
    private $pdo;

    function __construct($database)
    {
        $this->host = "localhost";
        $this->user = "root";
        $this->password = "pass";
        $this->database = $database;
        // Establecer la conexión cuando se instancia la clase
        try {
            //crear la cadena de datos para PDO
            $dsn = "mysql:host={$this->host};dbname={$this->database};charset={'utf8mb4'}";

            //crear instancia pdo al llamar la clase
            $this->pdo = new PDO($dsn, $this->user, $this->password, [//definimos atributos
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // manejo de errores mediante excepciones
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_PERSISTENT => true, // hacer que la conexión se mantenga
            ]);

            echo "Conexión exitosa a la base de datos.";
        } catch (PDOException $e) {
            //manejar error de conexión
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }

    //para obtener la instancia de PDO si es necesario
    public function getPDO() {
        return $this->pdo;
    }

    // cerrar la conexión al destruir la clase
    public function __destruct() {
        $this->pdo = null; 
    }
}
