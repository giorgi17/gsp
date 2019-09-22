<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Request-With');

include_once '../../config/Database.php';
include_once '../../models/Message.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instatiate blog post object
$message = new Message($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$message->message = $data->message;
$message->receiver = $data->receiver;
$message->social_media_type = $data->social_media_type;
$message->viewers = $data->viewers;

// Create post
if($message->create()) {
    echo json_encode(
        array('result' => 'Message Created')
    );
} else {
    echo json_encode(
        array('result' => 'Message Not Created')
    );
}