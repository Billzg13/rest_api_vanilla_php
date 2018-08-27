<?php

    class Author{
        private $conn;
        private $books_table = 'books';
        private $authors_table = 'authors';

        //properties
        public $id;
        public $author_id;
        public $book_name;
        public $author_name;

        //constructor
        public function __construct($db){
            $this->conn = $db;
        }


        public function getAuthors(){
            $query = 'Select * from '.$this->authors_table;

            //prepare Statement
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }


    }