<?php 
    class Viewer {
        // DB stuff
        private $conn;
        private $table = 'viewers';

        // Viewer Properties
        public $id;
        public $ip;
        public $message_id;

        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Single Viewer
        public function read_single() {
            // Create query
            $query = "SELECT * FROM $this->table WHERE ip = '$this->ip' AND message_id = $this->message_id";

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->id = $row['id'];
        }

        // Create Viewer
        public function create() {

            // Clean data
            $this->ip = htmlspecialchars(strip_tags($this->ip));
            $this->message_id = htmlspecialchars(strip_tags($this->message_id));

            // Create query
            $query = "INSERT INTO  $this->table
                SET
                    ip = '$this->ip',
                    message_id = $this->message_id";

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            if($stmt->execute()) {
                return true;
            } 

            // Print error if something goes wrong
            printf("Error: %s. \n", $stmt->error);
            
            return false; 
        }

        // Method for getting the client ip
        public function getClientIP(){       
            if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)){
                   return  $_SERVER["HTTP_X_FORWARDED_FOR"];  
            }else if (array_key_exists('REMOTE_ADDR', $_SERVER)) { 
                   return $_SERVER["REMOTE_ADDR"]; 
            }else if (array_key_exists('HTTP_CLIENT_IP', $_SERVER)) {
                   return $_SERVER["HTTP_CLIENT_IP"]; 
            } 
       
            return '';
       }
    }