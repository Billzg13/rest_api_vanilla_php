<?php
    class Book{
        private $conn;
        private $table = 'books';
        private $authors_table = 'authors';
        
        //properties
        public $id;
        public $author_id;
        public $book_name;
        public $author_name;

        //lets see
        public $par1 = 'books.author_id';
        public $par2 = 'authors.id';
        public $par3 = 'authors.id WHERE books.id = ?';


        //constructor
        public function __construct($db){
            $this->conn = $db;
        }


        public function getBooks(){
            
            $query = 'SELECT books.id,books.author_id,books.book_name,authors.author_name FROM '.$this->table.' INNER JOIN '.$this->authors_table.' ON '.$this->par1.' = '.$this->par2;
            

            //prepare Statement
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }

        //id of the book
        public function single_book(){
            $query = 'SELECT books.id,books.author_id,books.book_name,authors.author_name FROM '.$this->table.' INNER JOIN '.$this->authors_table.' ON '.$this->par1.' = '.$this->par2.' WHERE books.id = ? ';
            
            //$query = 'SELECT books.id,books.author_id,books.book_name,authors.author_name FROM '.$this->table.' INNER JOIN '.$this->authors_table.' ON '.$this->par1.' = '.$this->par3;
            
            //prepare Statement
            $stmt = $this->conn->prepare($query);
            //bind ID
            $stmt->bindParam(1, $this->id, PDO::PARAM_INT);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->id = $row['id'];
            $this->author_id = $row['author_id'];
            $this->book_name = $row['book_name'];
            $this->author_name = $row['author_name'];
 
        }

        public function create(){
            // Create query
            $query = 'INSERT INTO ' . $this->table .
            ' SET author_id = :author_id, book_name = :book_name';
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind data
            $stmt->bindParam(':author_id', $this->author_id);
            $stmt->bindParam(':book_name', $this->book_name);

            if($stmt->execute()) {
                return true;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;

        }

        public function updateBook(){
            //update book
            // Create query
            $query = 'UPDATE ' . $this->table .
            ' SET author_id = :author_id, book_name = :book_name 
            WHERE id = :id';
            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Bind data
            $stmt->bindParam(':author_id', $this->author_id);
            $stmt->bindParam(':book_name', $this->book_name);
            $stmt->bindParam(':id', $this->id);

            if($stmt->execute()) {
                return true;
            }
            printf("Error: %s.\n", $stmt->error);
            return false;
        }

        public function deleteBook(){
            //delete
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $this->id);

            if($stmt->execute()) {
                return true;
                }

            printf("Error: %s.\n", $stmt->error);
            
            return false;
        }

    }

    /*
    SELECT books.id,books.author_id,books.book_name,authors.author_name 
    FROM `books` INNER JOIN authors ON books.author_id = authors.id
    */
?>

