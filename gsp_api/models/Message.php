<?php 
    class Message {
        // DB stuff
        private $conn;
        private $table = 'messages';

        // Post Properties
        public $id;
        public $message;
        public $receiver;
        public $social_media_type;
        public $viewers;

        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Messages
        public function read($start, $end) {
            // Create query
            $query = 'SELECT * FROM ' . $this->table . ' LIMIT ' . $start . ', ' . $end;

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        // Get Single Post
        public function read_single() {
            // Create query
            $query = 'SELECT
                c.name as category_name,
                p.id,
                p.category_id,
                p.title,
                p.body,
                p.author,
                p.created_at
            FROM
                ' . $this->table . ' p
            LEFT JOIN
                categories c ON p.category_id = c.id
            WHERE
                p.id = ?
            LIMIT 0,1';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind ID
            $stmt->bindParam(1, $this->id);

            // Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->title = $row['title'];
            $this->body = $row['body'];
            $this->author = $row['author'];
            $this->category_id = $row['category_id'];
            $this->category_name = $row['category_name'];   
        }

        // Create Post
        public function create() {
            // Create query
            $query = 'INSERT INTO ' . $this->table . '
                SET
                    message = :message,
                    receiver = :receiver,
                    social_media_type = :social_media_type,
                    viewers = :viewers';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            // $this->message = htmlspecialchars(strip_tags($this->message));
            // $this->receiver = htmlspecialchars(strip_tags($this->receiver));
            // $this->social_media_type = htmlspecialchars(strip_tags($this->social_media_type));
            // $this->viewers = htmlspecialchars(strip_tags($this->viewers));


            // Bind data
            $stmt->bindParam(':message', $this->message);
            $stmt->bindParam(':receiver', $this->receiver);
            $stmt->bindParam(':social_media_type', $this->social_media_type);
            $stmt->bindParam(':viewers', $this->viewers);

            // Execute query
            if($stmt->execute()) {
                return true;
            } 
            // Print error if something goes wrong
            printf("Error: %s. \n", $stmt->error);
            
            return false; 
        }

        // Update Post
        public function update() {
            // Create query
            $query = 'UPDATE ' . $this->table . '
                SET
                    title = :title,
                    body = :body,
                    author = :author,
                    category_id = :category_id
                WHERE 
                    id = :id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->body = htmlspecialchars(strip_tags($this->body));
            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind data
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':body', $this->body);
            $stmt->bindParam(':author', $this->author);
            $stmt->bindParam(':category_id', $this->category_id);
            $stmt->bindParam(':id', $this->id);

            // Execute query
            if($stmt->execute()) {
                return true;
            } 

            // Print error if something goes wrong
            printf("Error: %s. \n", $stmt->error);
            
            return false; 
        }

        // Delete Post
        public function delete() {
            // Create query
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind data
            $stmt->bindParam(':id', $this->id);

             // Execute query
             if($stmt->execute()) {
                return true;
            } 

            // Print error if something goes wrong
            printf("Error: %s. \n", $stmt->error);
            
            return false; 
        }

        public function incrementViewers($message_id) {
            // Create query for updating 
            $query = "UPDATE messages
            SET
                viewers=viewers+1
            WHERE 
                id = $message_id";

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
    }