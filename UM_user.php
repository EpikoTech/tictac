<?php
class User
{
    private $host = "localhost";
    private $user = "root";
    private $password = "pass";
    private $database;
    private $conn;

    function __construct($database)
    {
        $this->host = "localhost";
        $this->user = "root";
        $this->password = "pass";
        $this->database = $database;
        // Establecer la conexión cuando se instancia la clase
        try {
            //crear la cadena de datos para PDO
            $dsn = "mysql:host={$this->host};dbname={$this->database};charset=utf8mb4";
            
            //crear instancia pdo al llamar la clase
            $this->conn = new PDO($dsn, $this->user, $this->password, [//definimos atributos
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // manejo de errores mediante excepciones
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_PERSISTENT => true, // hacer que la conexión se mantenga
            ]);
            
            echo ("Conexión exitosa a la base de datos.");
        } catch (PDOException $e) {
            //manejar error de conexión
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }

    //funcion de insercion
    public function insert($table, $data) {
        $fields = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO $table ($fields) VALUES ($placeholders)";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data);
            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            echo "Error al crear registro: " . $e->getMessage();
            return false;
        }
    }

    // funcion de lectura
    public function read($table, $conditions = [], $fields = "*") {
        $sql = "SELECT $fields FROM $table";
        
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(" AND ", array_map(function($key) { return "$key = :$key"; }, array_keys($conditions)));
        }

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($conditions);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al leer registros: " . $e->getMessage();
            return false;
        }
    }

    // funcion de actualizacion
    public function update($table, $data, $conditions) {
        $fields = implode(", ", array_map(function($key) { return "$key = :$key"; }, array_keys($data)));
        $where = implode(" AND ", array_map(function($key) { return "$key = :$key"; }, array_keys($conditions)));

        $sql = "UPDATE $table SET $fields WHERE $where";
        
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(array_merge($data, $conditions));
            return $stmt->rowCount(); // Retorna el número de filas afectadas
        } catch (PDOException $e) {
            echo "Error al actualizar registro: " . $e->getMessage();
            return false;
        }
    }

    // funcion de eliminacion
    public function delete($table, $conditions) {
        $where = implode(" AND ", array_map(function($key) { return "$key = :$key"; }, array_keys($conditions)));
        $sql = "DELETE FROM $table WHERE $where";

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($conditions);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Error al eliminar registro: " . $e->getMessage();
            return false;
        }
    }

    // Método para cerrar la conexión
    public function closeConnection() {
        $this->conn = null;
    }
    //para obtener la instancia de PDO si es necesario
    public function getPDO() {
        return $this->conn;
    }

    // cerrar la conexión al destruir la clase
    public function __destruct() {
        $this->conn = null; 
    }
}
