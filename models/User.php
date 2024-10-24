<?php

include("utils/Database.php");

class User {  
    public $database;
    function __construct() {    
        $this->database = new Database();
    }

    public function getInfo() {
        $sql="SELECT * FROM registro_usuarios";
        $resultado=$this->database->query($sql);    
        return $resultado;
    }
}

?>
  