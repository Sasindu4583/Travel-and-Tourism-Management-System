<?php
session_start(); // Start a session to manage user login state

// Ensure the user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}

require_once '../config/database.php'; // Include the database configuration file
$database = new Database(); // Create a new Database object and establish a connection
$conn = $database->getConnection();

// Fetch all pages from the database
$query = "SELECT * FROM pages ORDER BY created_at DESC";
$result = $conn->query($query); // Execute the query
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Pages</title> <!-- Page title -->
    <link rel="stylesheet" href="assets/css/admin.css"> <!-- Link to the admin CSS file -->
</head> 
<body>
    <div class="admin-container">
        <?php include 'includes/sidebar.php'; ?> <!-- Include the sidebar navigation -->

        <main class="dashboard">
            <h1>Manage Pages</h1> <!-- Page heading -->

            <table> <!-- Pages Table -->
                <thead>
                    <tr>
                        <th>ID</th> <!-- Table headers -->
                        <th>Page Name</th>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($page = $result->fetch_assoc()): ?> <!-- Loop through each page -->
                        <tr>
                            <td><?php echo $page['id']; ?></td> <!-- Display page ID -->
                            <td><?php echo htmlspecialchars($page['page_name']); ?></td> <!-- Display page name -->
                            <td><?php echo htmlspecialchars($page['title']); ?></td> <!-- Display page title -->
                            <td>
                                <a href="edit-page.php?id=<?php echo $page['id']; ?>" class="btn btn-edit">Edit</a> <!-- Edit button -->
                            </td>
                        </tr>
                    <?php endwhile; ?> <!-- End of loop -->
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
<?php
$conn->close(); // Close the database connection
?>
