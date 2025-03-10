<?php
require_once 'config/database.php'; // Include the database configuration file to establish a connection
$database = new Database(); // Create a new Database object and establish a connection
$conn = $database->getConnection();

// Fetch the "About Us" page content from the database
$query = "SELECT * FROM pages WHERE page_name = 'about_us'";
$result = $conn->query($query); // Execute the query

// Check if the query returned any results
if ($result->num_rows > 0) {
    $page = $result->fetch_assoc(); // Fetch the page data as an associative array
    $title = $page['title']; // Get the page title
    $content = $page['content']; // Get the page content
} else {
    // Default values if no content is found in the database
    $title = "About Us";  // Default title
    $content = "<p>No content available.</p>"; // Default content
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>  <!-- Dynamic page title -->
    <link rel="stylesheet" href="assets/css/styles.css"> <!-- Link to the main CSS file -->
</head>
<body>
    <?php include 'includes/header.php'; ?> <!-- Include the header file -->
    <?php include 'includes/navigation.php'; ?>  <!-- Display the page title (sanitized) -->

    <main class="center-text">
        <h1><?php echo htmlspecialchars($title); ?></h1>
        <div class="page-content">
            <?php echo $content; ?> <!-- Display the page content -->
        </div>
    </main>

    <?php include 'includes/footer.php'; ?> <!-- Include the footer file -->
</body>
</html>
<?php
$conn->close(); // Close the database connection
?>
