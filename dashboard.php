<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    redirect('login.php');
}

require 'includes/db.php';

// Fetch user data
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $_SESSION['user_id']]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Welcome, <?php echo $user['username']; ?></h2>
        <p>Email: <?php echo $user['email']; ?></p>
        <?php if ($user['file_path']): ?>
            <img src="<?php echo $user['file_path']; ?>" alt="User Profile Picture" width="150" height="150">
            <p>Uploaded File: <a href="<?php echo $user['file_path']; ?>" target="_blank">View File</a></p>
        <?php else: ?>
            <p>No file uploaded.</p>
        <?php endif; ?>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>

</html>