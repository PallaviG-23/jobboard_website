<?php
// Make sure session started and gain access to it
if(session_start() === PHP_SESSION_NONE){
    session_start();
}

//1. clear and destroy the session
session_unset();
session_destroy();

//2. Tell the browser its JSON response
header('Content-Type: application/json');

//3. Send back API message
echo json_encode([
    'status' => 'success',
    'message' => 'Logged out successfully.'
]);
exit;

?>