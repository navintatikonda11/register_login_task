<?php
$host = 'localhost';
$dbname = 'nec_dbs';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Database Connectes Succesfully";
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
