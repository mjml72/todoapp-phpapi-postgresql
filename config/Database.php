<?php

    class Database {
        private $host = "";
        private $dbname = "";
        private $username = "";
        private $password = "";
        public $conn;

        public function getConnection() {
            $hostdb = "pgsql:host=$this->host;port=5432;dbname=$this->dbname;";
            try {
                $this->conn = new PDO($hostdb, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->conn;

            } catch (PDOException $e) {
                echo 'Error al conectar con la base de datos: '. $e->getMessage();
            }
        }

    }


?>