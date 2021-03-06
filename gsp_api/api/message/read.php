<?php
// Headers
header('Access-Control-Allow-Origin: https://master.d1ubo1y2yglotf.amplifyapp.com');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Message.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instatiate message object
$message = new Message($db);

// Get Current page
$start = isset($_GET['page']) ? $_GET['page'] : die();
$end = $start + 10;

// Message query
$result = $message->read($start, $end);

// Get row count
$num = $result->rowCount();

// Check if any messages
if($num > 0) {
    // Post array
    $messages_arr = array();
    $messages_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $message_item = array(
            'id' => $id,
            'message' => $message,
            'receiver' => html_entity_decode($receiver),
            'social_media_type' => $social_media_type,
            'viewers' => $viewers,
        );

    // Push to "data"
    array_push($messages_arr['data'], $message_item);
    }
    // Turn to JSON & Output
    echo json_encode($messages_arr);
} else {
    // No Messages
    echo json_encode(
        array('message' => 'No Messages Found!')
    );
}