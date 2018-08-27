<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Book.php';

    $database = new Database();
    $db = $database->connect();

    $book = new Book($db);

    $book->id = isset($_GET['id']) ? $_GET['id'] : die();

    $book->single_book();

    $book_arr = array(
        'id' => $book->id,
        'author_id' => $book->author_id,
        'book_name' => $book->book_name,
        'author_name' => $book->author_name
    );

    print_r(json_encode($book_arr));