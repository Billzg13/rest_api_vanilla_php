<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,
    Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Book.php';

    $database = new Database();
    $db = $database->connect();

    $book = new Book($db);

    $data = json_decode(file_get_contents("php://input"));
    
    $book->id = $data->id;

    $book->author_id = $data->author_id;
    $book->book_name = $data->book_name;


    if($book->updateBook()){
        echo json_encode(
            array('message' => 'Book successfully updated')
        );
    }else {
        echo json_encode(
            array('message' => 'Something went wrong')
        );
    }