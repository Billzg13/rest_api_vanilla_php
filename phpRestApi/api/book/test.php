<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Book.php';

    $database = new Database();
    $db = $database->connect();

    if ($db){
        echo json_encode(
            array('message' => 'so far so good x1')
        );
    }else{
        echo json_encode(
            array('message' => 'so far not so good ')
        );
    }

    $book = new Book($db);

    echo json_encode(
        array('message' => 'so far so good x2')
    );

    $result = $book->read();
    //problem here
    echo json_encode(
        array('message' => 'so far so good x3')
    );
    //row Count
    $num = $result->rowCount();

    if ($num > 0 ){
        echo json_encode(
            array('message' => 'num has more than 0 ')
        );
    }else{
        echo json_encode(
            array('message' => 'something is not going well')
        );
    }