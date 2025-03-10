<?php
session_start(); // Start a session to manage user login state
require_once '../config/database.php'; // Include the database configuration file

// Check if the admin is already logged in, redirect to the dashboard if true
if(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard.php');
    exit;
}

$error = ''; // Variable to store error messages

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $database = new Database(); // Create a new Database object
    $conn = $database->getConnection(); // Establish a connection

    // Sanitize and retrieve form inputs
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    // Query to check if the username exists
    $query = "SELECT * FROM admin_users WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc(); // Fetch the user data
        
        // Simple password verification (in real-world, use password_hash and password_verify)
        if ($password === $user['password']) { // Set session variables to indicate the user is logged in
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $user['username'];
            header('Location: dashboard.php'); // Redirect to the dashboard
            exit;
        } else {
            $error = 'Invalid username or password'; // Set error message
        }
    } else {
        $error = 'Invalid username or password'; // Set error message
    }

    $database->closeConnection(); // Close the database connection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="assets/css/admin.css"> <!-- Link to the admin CSS file -->
</head>
<body>
    <div class="logo">
        <a href="../index.php">Website</a> <!-- Link back to the main website -->
    </div>
    <div class="login-container">
        <form method="POST" action="">
            <h2>Admin Login</h2>
            <?php if($error): ?> <!-- Display error message if any -->
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required> <!-- Username input field -->
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required> <!-- Password input field -->
            </div>
            <button type="submit">Login</button> <!-- Submit button -->
        </form>
    </div>
</body>
</html>