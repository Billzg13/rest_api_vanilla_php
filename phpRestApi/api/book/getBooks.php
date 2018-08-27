<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Book.php';

    $database = new Database();
    $db = $database->connect();

    $book = new Book($db);

    $result = $book ->getBooks();
    //row Count
    $num = $result->rowCount();

    if ($num > 0 ){
        $books_arr = array();
        $books_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $book_item = array(
                'id' => $id,
                'author_id'=> $author_id,
                'book_name'=> $book_name,
                'author_name' => $author_name
            );
            //push to "data"
            array_push($books_arr['data'], $book_item);
        }
        //turn to JSON and echo
        echo json_encode($books_arr);
    }else{
        echo json_encode(
            array('message' => 'No books founds ')
        );

    }
