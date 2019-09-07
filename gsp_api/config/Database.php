<?php
    class Database {
        // DB Params
        private $host = 'gsp.cuvh9b3cjvcv.us-east-2.rds.amazonaws.com';
        private $db_name = 'gsp';
        private $username = 'root_gsp';
        private $password = 'gsp123gsp';
        private $conn;
        // private $host = 'localhost';
        // private $db_name = 'gsp';
        // private $username = 'root';
        // private $password = '';
        // private $conn;

        // DB Connect
        public function connect() {
            $this->conn = null;

            try {
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name,
                $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch(PDOException $e) {
                echo 'Connection error ' . $e->getMessage();
            }

            return $this->conn;
        }
    }