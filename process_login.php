<?php

require 'templates/header.php';

$logFile = __DIR__ . "/includes/logs.php";

// $ip_address = $_SERVER['REMOTE_ADDR'];    // Capture IP Address
// $timestamp = date("Y-m-d H:i:s"); // Timestamp

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $email = sanitizeInput($_POST['email']);
        $password = sanitizeInput($_POST['password']);

        // Validate inputs
        if (empty($email) || empty($password)) {
            throw new Exception("Email and password are required.");
        }

        // Fetch user from database
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        // Verify password
        if ($user && password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Redirect to dashboard
            redirect('dashboard.php');
        } else {
            throw new Exception("Invalid email or password.");
        }
    } catch (Exception $e) {

        // Log the error and display a message
        $logMessage = "[$timestamp] FAILED LOGIN ATTEMPT: Email '$email' from IP: $ip_address - {$e->getMessage()}\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);
        $_SESSION['error'] = $e->getMessage();
        redirect('login.php');
    }
}
