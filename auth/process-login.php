<?php
//Make sure sessions are started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../config/config.php";

header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //check for empty input
    if(empty($_POST['email']) OR empty($_POST['password'])){
        echo json_encode(['status' => 'error', 'message' => 'Some inputs are empty']);
        exit;
    }

    $email = $_POST['email'];
    $password = $_POST['password'];

    // 2. Fetch the user using our dynamic function
    $user = getRecord($conn, 'users', 'email', $email);

    // 3. Verify user existence and password hash
    if($user && password_verify($password, $user['password'])) {
      
    // Login Success: Save data to session
    $_SESSION['username'] = $user['username'];
    $_SESSION['email']    = $user['email'];
    $_SESSION['user_id']  = $user['id'];
    $_SESSION['usertype'] = $user['usertype'];

    echo json_encode([
        'status' => 'success', 
        'message' => 'Welcome back, ' . htmlspecialchars($user['username']) . '!'
      ]);
    } else {
        // Security tip: Keep message vague so hackers don't know if email or password was wrong
        echo json_encode(['status' => 'error', 'message' => 'Invalid email address or password.']);
    }
}

?>