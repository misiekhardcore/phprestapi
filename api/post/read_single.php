<?php
//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

//Instance DB & connect
$database = new Database();
$db = $database->connect();

//Instance blog post obiect
$post = new Post($db);

//Get id
$post->id = isset($_GET['id']) ? $_GET['id'] : die();

//Get post
$post->read_single();

//Make JSON
if ($post->read_single()) {
    //Create array
    $post_arr = array(
        'id' => $post->id,
        'title' => $post->title,
        'body' => $post->body,
        'author' => $post->author,
        'category_id' => $post->category_id,
        'category_name' => $post->category_name
    );

    echo json_encode($post_arr);
} else {
    echo json_encode(
        array(
            'message' => 'No such post'
        )
    );
}
