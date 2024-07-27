<?php 
    class Database {
        private $host = "localhost";
        private $db_name = "api_php_01";
        private $password = "root";
        private $username = "postgres";
        public $conn;

        public function makeConnection(){
            $this->conn = null;
            try {
                $this->conn = new PDO("pgsql:host=".$this->host.";dbname=".$this->db_name, $this->username, $this->password);
                echo 'conexion';
                return $this->conn;
            } catch (Exception $e) {
                echo 'Error en conexión con base de datos'. $e->getMessage();
            }
        }

    }

?>