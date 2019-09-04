<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Viewer.php';
include_once '../../models/Message.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instatiate blog post object
$viewer = new Viewer($db);

// Get message ID
$viewer->message_id = isset($_GET['id']) ? $_GET['id'] : die();
// Get IP
$viewer->ip = $viewer->getClientIP();

// Get post
$viewer->read_single();

// Create array
$viewer_arr = array(
    'id' => $viewer->id,
    'ip' => $viewer->ip,
    'message_id' => $viewer->message_id,
);

// Check if this ip has seen this message and add a new record if not
if ($viewer->id === null){
    $viewer_arr['exists'] = false;
    $viewer->create();
     // Create Message object for updating viewers number 
     $message = new Message($db);

     // Execute query
     if($message->incrementViewers($viewer->message_id)) {
        $viewer_arr['viewers_updated'] = true;
     } else {
        $viewer_arr['viewers_updated'] = false;
     }
} else {
    $viewer_arr['exists'] = true;
}



// Make JSON
print_r(json_encode($viewer_arr));
