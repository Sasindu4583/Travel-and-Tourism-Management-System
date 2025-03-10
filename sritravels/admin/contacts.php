<?php
// Start session to manage user login state
session_start();
// Ensure user is logged in before accessing this page
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php'); // Redirect login page if not logged in
    exit; // Stop further execution
}


require_once '../config/database.php'; // Include database configuration file
$database = new Database(); // Create new instance of the Database class
$conn = $database->getConnection(); // Get database connection

// Handle enquiry deletion if delete_id is set in the request
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']); // Sanitize delete_id parameter to ensure it's an integer
    $delete_query = "DELETE FROM contacts WHERE id = $delete_id"; // Prepare SQL query to delete the contact with the specified ID
    $conn->query($delete_query); // Execute delete query
    header('Location: contacts.php'); // Refresh page after deletion
    exit;
}

// Fetch all contacts from the database, ordered by creation date in descending order
$contacts_query = "SELECT * FROM contacts ORDER BY created_at DESC";
$contacts_result = $conn->query($contacts_query); // Execute the query and store the result
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Contacts</title>
    <link rel="stylesheet" href="assets/css/admin.css"> <!-- Link to admin CSS file for styling -->
</head>
<body>
    <div class="admin-container">
        <?php include 'includes/sidebar.php'; ?> <!-- Include the sidebar navigation -->
        
        <main class="dashboard">
            <h1>Manage Contacts</h1>
            
            <div class="contacts-table">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>   
                        <?php while($contacts = $contacts_result->fetch_assoc()): ?> <!-- Loop through each contact and display its details in a table row -->
                            <tr>
                                <td><?php echo $contacts['id']; ?></td> <!-- Display contact ID -->
                                <td><?php echo htmlspecialchars($contacts['name']); ?></td> <!-- Display contact name -->
                                <td><?php echo htmlspecialchars($contacts['email']); ?></td> <!-- Display contact email -->
                                <td><?php echo htmlspecialchars($contacts['phone'] ?? 'N/A'); ?></td> <!-- Display phone number, default to N/A if empty -->
                                <td><?php echo htmlspecialchars($contacts['message']); ?></td> <!-- Display message -->
                                <td><?php echo date('Y-m-d H:i', strtotime($contacts['created_at'])); ?></td> <!-- Format and display date -->
                                <td>
                                    <a href="mailto:<?php echo htmlspecialchars($contacts['email']); ?>" class="btn btn-reply">Reply</a>  <!-- Link to reply to the contact via email -->                                 
                                    <a href="https://wa.me/<?php echo htmlspecialchars($contacts['phone']); ?>" class="btn btn-whatsapp" target="_blank">WhatsApp</a> <!-- Link to message the contact via WhatsApp -->                                                                  
                                    <a href="?delete_id=<?php echo $contacts['id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this contact?')" >Delete</a> <!-- Link to delete the contact, with a confirmation dialog -->
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
<?php 
$database->closeConnection(); // Close database connection
?>