<?php
require_once "../config/config.php";

// Tell the browser this file returns JSON data, not HTML
header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //check for empty input
    if(empty($_POST['username']) OR empty($_POST['email']) OR empty($_POST['password']) OR empty($_POST['repassword']) OR empty($_POST['usertype'])){
        echo json_encode(['status' => 'error', 'message' => 'Some inputs are empty']);
        exit;
    } 

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $img = 'web-coding.png';
    $usertype = $_POST['usertype'];

    //checking for password match
    if($password != $repassword){
        echo json_encode(['status' => 'error', 'message' => 'Password does not match.']);
        exit;
    }

    //check for duplicate emails
    if(recordExists($conn, 'users', 'email', $email)){
        echo json_encode(['status' => 'error', 'message' => 'This email address is already registered.']);
        exit;
    }

    //if all check pass, insert data using insertRecord function
    $userData = [
        'username' => $username,
        'email'    => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'img'      => $img,
        'usertype' => $usertype
    ];

    $isInserted = insertRecord($conn, 'users', $userData);

    if($isInserted) {
        // Send a success JSON response back to AJAX
        echo json_encode(['status' => 'success', 'message' => 'You have successfully registered with us. You can login with your email-id']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Registration failed. Please try again.']);
  }

}

?>