<?php

require 'templates/header.php';

$logFile = __DIR__ . "/includes/logs.php";

// $ip_address = $_SERVER['REMOTE_ADDR'];    // Capture IP Address
// $timestamp = date("Y-m-d H:i:s"); // Timestamp

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $username = sanitizeInput($_POST['username']);
        $email = sanitizeInput($_POST['email']);
        $password = sanitizeInput($_POST['password']);
        $file = $_FILES['file'];

        // Validate inputs
        if (empty($username) || empty($email) || empty($password)) {
            throw new Exception("All fields are required.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }

        if (strlen($password) < 8) {
            throw new Exception("Password must be at least 8 characters long.");
        }

        // Validate file
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("File upload failed.");
        }

        // Check file type and size
        $allowedTypes = ['image/jpeg', 'image/png', 'application/pdf'];
        $maxFileSize = 2 * 1024 * 1024; // 2MB

        if (!in_array($file['type'], $allowedTypes)) {
            throw new Exception("Only JPEG, PNG, and PDF files are allowed.");
        }

        if ($file['size'] > $maxFileSize) {
            throw new Exception("File size must be less than 2MB.");
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Upload file
        $uploadDir = 'assets/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fileName = uniqid() . '_' . basename($file['name']);
        $uploadFile = $uploadDir . $fileName;

        if (!move_uploaded_file($file['tmp_name'], $uploadFile)) {
            throw new Exception("Failed to move uploaded file.");
        }

        // Insert user into database
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, file_path) VALUES (:username, :email, :password, :file_path)");
        $stmt->execute(['username' => $username, 'email' => $email, 'password' => $hashedPassword, 'file_path' => $uploadFile]);



        $_SESSION['message'] = "Registration successful!";
        redirect('login.php');
    } catch (Exception $e) {
        if ($e->getCode() == 23000) { // Duplicate entry error
            $_SESSION['error'] = "Username or Email already exists!";
        } else {
            $_SESSION['error'] = "Something went wrong. Please try again.";
        }
        // Log the error and display a message
        $logMessage = "[$timestamp] FAILED LOGIN ATTEMPT: Email '$email' from IP: $ip_address - {$e->getMessage()}\n";
        file_put_contents($logFile, $logMessage, FILE_APPEND);
        redirect('register.php');
    }
}
