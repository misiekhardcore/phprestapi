<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Authorisation,Access-Control-Allow-Methods,X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    //Instance DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instance blog post obiect
    $post = new Post($db);

    //Get raw post
    $data = json_decode(file_get_contents("php://input"));

    //Set id to update
    $post->id = $data->id;

    if($post->delete()){
        echo json_encode(
            array(
                'message' => 'Post deleted'
            )
        );
    } else{
        echo json_encode(
            array(
                'message' => 'Post not deleted'
            )
        );
    }