<?php
    
    #defined('TIME_ZONE_PERU') OR define('TIME_ZONE_PERU','-05:00');

    class Database {
        // Conexión a la base de datos
        private $servername = "127.0.0.1";
        private $username = "root";
        private $password = "root";
        private $dbname = "tictac";
        private $port = "3308";
        private $conn;

        public function __construct($databasename = "") {
            if($databasename!="") $this->dbname = $databasename;            
        }

        private function connect() {
            $this->conn = new \mysqli($this->servername, $this->username, $this->password, $this->dbname,$this->port); // Verificar la conexión
            if ($this->conn->connect_error) {
                die("Conexión fallida: " . $this->conn->connect_error);        
            }            
        }

        private function disconnect() {
            $this->conn->close();
        }

        public function execute($sql, $connection = null) {
            if($connection == null) $this->connect();
            $result = $this->conn->query($sql);
            if ($result === TRUE) {                
                if($connection == null) $this->disconnect();
                return $result;                
            } else {
                $error = $this->conn->error;
                if($connection == null) $this->disconnect();
                return "error at insert: " . $error;
            }
        }

        public function query($sql, $connection = null) {
            if($connection == null) $this->connect();
            //echo $sql."<br>";
         
            $result = $this->conn->query($sql);
            //print_r($result);
            // Procesar los resultados
            if ($result->num_rows > 0) {
                //echo "-----<br>";
                while($row = $result->fetch_assoc()) {
                    
                  $data[] = array_map(function($value) {
                    // Verificar si el valor es nulo antes de aplicar utf8_encode
                        return ($value !== null) ? $value : null;
                    }, $row);
                }
            }
            else {
              $data = [];
            }
        
            if($connection == null) $this->disconnect();
            return $data;
        }

        function insert($tabla, $datos) {
            $this->connect();
            // Obtener nombres de columnas y valores
            $columnas = implode(", ", array_keys($datos));
            $valores = "'" . implode("', '", $datos) . "'";
        
            // Sentencia SQL para la inserción
            $sql = "INSERT INTO $tabla ($columnas) VALUES ($valores)";            
            $sql = str_replace("'null'","null",$sql);
             
            // Ejecutar la consulta
            $valid = $this->conn->query($sql);
            // print_r($valid);
            // exit;
            if ( $valid === TRUE) {
                $id = $this->conn->insert_id;
                $this->disconnect();
                return $id;                
            } else {
                $error = $this->conn->error;
                $this->disconnect();
                return "error at insert: " . $error;
            }
        }

        public function getServerDate() {
            $this->connect();
            #$sql="SET time_zone = '".TIME_ZONE_PERU."'";
            #$this->execute($sql,true);
            $sql="select NOW() as FechaServidor";
            $resultado=$this->query($sql,true);          
            $this->disconnect();
            return $resultado[0]["FechaServidor"];
        }
    }
