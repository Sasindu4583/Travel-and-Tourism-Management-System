<?php
require_once 'config/database.php';
$database = new Database();
$conn = $database->getConnection();

// Fetch the "About Us" page content
$query = "SELECT * FROM pages WHERE page_name = 'about_us'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $page = $result->fetch_assoc();
    $title = $page['title'];
    $content = $page['content'];
} else {
    $title = "About Us";
    $content = "<p>No content available.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/navigation.php'; ?>

    <main class="center-text">
        <h1><?php echo htmlspecialchars($title); ?></h1>
        <div class="page-content">
            <?php echo $content; ?>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
<?php
$conn->close();
?>
