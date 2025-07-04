<?php
require_once __DIR__ . '/../../App/DB/Database.php';
require_once __DIR__ . '/../../App/Entity/PasswordReset.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = trim($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<div class="alert alert-danger">Invalid email address provided.</div>';
        exit;
    }

    // Create database connection (make sure credentials are correct)
    $db = new Database(realpath(__DIR__));
    $pdo = $db->conecta();

    // Generate secure random key
    
    // Now create PasswordReset object with the key generated
    $passwordReset = new PasswordReset($db, $email);
    
    $resetKey = $passwordReset->generateResetKey();
    
    // Send email with the key
    if ($passwordReset->sendResetEmail($resetKey)) {
        echo '<div class="alert alert-success">An email has been sent to your address with instructions to reset your password.</div>';
    } else {
        echo '<div class="alert alert-danger">There was an error sending the reset email. Please try again later.</div>';
    }
}

echo 'OK'; // or echo JSON like: echo json_encode(['status' => 'ok']);
exit;
?>

