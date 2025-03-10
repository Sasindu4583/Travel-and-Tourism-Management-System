<?php
session_start(); // Start a session to manage login state
// Check if the admin is logged in, otherwise redirect to the login page
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

require_once '../config/database.php'; // Include the database configuration file
$database = new Database(); // Create a new Database object and establish a connection
$conn = $database->getConnection();

// Fetch statistics for the dashboard
$package_count = $conn->query("SELECT COUNT(*) as count FROM tour_packages")->fetch_assoc()['count']; // Total packages
$booking_count = $conn->query("SELECT COUNT(*) as count FROM bookings")->fetch_assoc()['count']; // Total bookings
$contacts_count = $conn->query("SELECT COUNT(*) as count FROM contacts")->fetch_assoc()['count']; // Total contacts
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/admin.css">  <!-- Link to the admin CSS file -->
</head>
<body>
    <div class="admin-container">
        <?php include 'includes/sidebar.php'; ?> <!-- Include the sidebar navigation -->
        
        <main class="dashboard">
            <h1>Dashboard</h1> <!-- Page heading -->
            
            <div class="stats-container"> 
                <div class="stat-card"> <!-- Display total packages -->
                    <h3>Total Packages</h3>
                    <p><?php echo $package_count; ?></p>
                </div>
                <div class="stat-card"> <!-- Display total bookings -->
                    <h3>Total Bookings</h3>
                    <p><?php echo $booking_count; ?></p>
                </div>
                <div class="stat-card">  <!-- Display total contacts -->
                    <h3>Total Contacts</h3>
                    <p><?php echo $contacts_count; ?></p>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
<?php $database->closeConnection(); // Close the database connection ?>