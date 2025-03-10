<?php
session_start(); // Start a session to manage user login state
// Ensure user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');  // Redirect to login page if not logged in
    exit;
}

require_once '../config/database.php'; // Include the database configuration file
$database = new Database(); // Create a new Database object and establish a connection
$conn = $database->getConnection();

// Handle booking status update
if (isset($_POST['update_status'])) {
    $booking_id = intval($_POST['booking_id']); // Sanitize booking ID
    $new_status = $conn->real_escape_string($_POST['booking_status']); // Sanitize new status
    
    // Update booking status in the database
    $update_query = "UPDATE bookings SET status = '$new_status' WHERE id = $booking_id";
    $conn->query($update_query); // Execute the query
}

// Handle booking deletion
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']); // Sanitize booking ID
    $delete_query = "DELETE FROM bookings WHERE id = $delete_id";  // Delete booking from the database
    $conn->query($delete_query); // Execute the query
    header('Location: manage-bookings.php'); // Redirect to refresh the page
    exit;
}

// Fetch bookings with package details
$bookings_query = "SELECT b.*, p.package_name, p.package_location 
                   FROM bookings b 
                   JOIN tour_packages p ON b.package_id = p.id";
$bookings_result = $conn->query($bookings_query); // Execute the query
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Bookings</title> <!-- Page title -->
    <link rel="stylesheet" href="assets/css/admin.css"> <!-- Link to the admin CSS file -->
</head>
<body>
    <div class="admin-container">
        <?php include 'includes/sidebar.php'; ?> <!-- Include the sidebar navigation -->
        
        <main class="dashboard">
            <h1>Manage Bookings</h1> <!-- Page heading -->
            
            <div class="bookings-table"> <!-- Bookings Table -->
                <table>
                    <thead>
                        <tr>
                            <th>Booking ID</th> <!-- Table headers -->
                            <th>Package Name</th>
                            <th>Location</th>
                            <th>User Name</th>
                            <th>User Email</th>
                            <th>Booking Date</th>
                            <th>Phone Number</th>
                            <th>NIC</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($booking = $bookings_result->fetch_assoc()): ?> <!-- Loop through each booking -->
                            <tr>
                                <td><?php echo $booking['id']; ?></td> <!-- Display booking ID -->
                                <td><?php echo htmlspecialchars($booking['package_name']); ?></td>  <!-- Display package name -->
                                <td><?php echo htmlspecialchars($booking['package_location']); ?></td> <!-- Display package location -->
                                <td><?php echo htmlspecialchars($booking['user_name']); ?></td> <!-- Display user name -->
                                <td><?php echo htmlspecialchars($booking['user_email']); ?></td> <!-- Display user email -->
                                <td><?php echo $booking['booking_date']; ?></td> <!-- Display booking date -->
                                <td><?php echo htmlspecialchars($booking['phone']); ?></td> <!-- Display phone number -->   
                                <td><?php echo htmlspecialchars($booking['NIC']); ?></td> <!-- Display NIC number -->                        
                                <td> 
                                    <!-- Action buttons -->
                                    <a href="mailto:<?php echo htmlspecialchars($booking['user_email']); ?>" class="btn btn-reply">Reply</a> <!-- Reply via email -->
                                    <a href="https://wa.me/<?php echo htmlspecialchars($booking['phone']); ?>" class="btn btn-whatsapp" target="_blank">WhatsApp</a> <!-- WhatsApp link -->  
                                    <a href="?delete_id=<?php echo $booking['id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this booking?')">Delete</a> <!-- Delete booking -->
                                </td>
                            </tr>
                        <?php endwhile; ?> <!-- End of loop -->
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
<?php 
$database->closeConnection(); // Close the database connection
?>