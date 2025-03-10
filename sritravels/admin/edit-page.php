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

// Get page ID from the URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die('Invalid page ID.'); // Terminate script if page ID is invalid
}

$page_id = intval($_GET['id']); // Sanitize the page ID

// Fetch page details from the database
$query = "SELECT * FROM pages WHERE id = $page_id";
$result = $conn->query($query); // Execute the query

if (!$result || $result->num_rows === 0) {
    die('Page not found.'); // Terminate script if page is not found
}

$page = $result->fetch_assoc(); // Fetch the page data as an associative array

// Handle form submission for updating page
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $conn->real_escape_string($_POST['title']); // Sanitize and retrieve form inputs
    $content = $conn->real_escape_string($_POST['content']);

    // Update page details in the database
    $update_query = "UPDATE pages SET title = '$title', content = '$content' WHERE id = $page_id";
    if ($conn->query($update_query)) {
        header('Location: manage-page.php'); // Redirect to manage-page.php after successful update
        exit;
    } else {
        $error_message = "Failed to update the page. Please try again."; // Error message if update fails
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Page</title> <!-- Page title -->
    <link rel="stylesheet" href="assets/css/admin.css"> <!-- Link to the admin CSS file -->
</head>
<body>
    <div class="admin-container">
        <?php include 'includes/sidebar.php'; ?> <!-- Include the sidebar navigation -->

        <main class="dashboard">
            <h1>Edit Page</h1> <!-- Page heading -->

            <?php if (isset($error_message)): ?> <!-- Display error message if update fails -->
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <form method="POST">  <!-- Edit Page Form -->
                <div class="form-group">
                    <label for="title">Page Title</label> <!-- Page title input -->
                    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($page['title']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="content">Page Content</label> <!-- Page content textarea -->
                    <textarea id="content" name="content" rows="6" required><i><?php echo htmlspecialchars($page['content']); ?></i></textarea>
                </div>

                <button type="submit" class="btn">Save Changes</button> <!-- Submit button -->
                <a href="manage-page.php" class="btn btn-cancel">Cancel</a> <!-- Cancel button -->
            </form>
        </main>
    </div>
</body>
</html>
<?php
$conn->close(); // Close the database connection
?>
