<?php

session_start();
require 'includes/db.php';
require 'includes/helpers.php';

$ip_address = $_SERVER['REMOTE_ADDR'];    // Capture IP Address
$timestamp = date("Y-m-d H:i:s"); // Timestamp

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</head>

<body>