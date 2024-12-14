<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'travel_tours');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch single-day tours
$sql = "SELECT * FROM tours WHERE category = 'Single-Day' ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>One-Day Tours</title>
    <link rel="stylesheet" href="assets/onedaytours.css">
</head>
<body>
    <!-- Banner Section -->
    <header class="banner">
        <div class="banner-overlay">
            <h1>Discover Our Exciting One-Day Tours</h1>
            <p>Explore the beauty of Sri Lanka in just one day!</p>
        </div>
    </header>

    <!-- Tour Packages Section -->
    <section class="tours-container">
        <h2>Available One-Day Tour Packages</h2>
        <div class="tours-grid">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="tour-card">
                        <?php 
                        // Define the server path for the image file
                        $serverImagePath = __DIR__ . '/admin/uploads/' . htmlspecialchars($row['image']);
                        
                        // Define the web path for the image (relative path for the web browser)
                        $webImagePath = 'admin/uploads/' . htmlspecialchars($row['image']);

                        // Debugging: Output the full server image path to check if it's correct
                        echo "<!-- Debugging server path: " . $serverImagePath . " -->";

                        // Check if the image file exists on the server
                        if (!empty($row['image']) && file_exists($serverImagePath)): 
                        ?>
                            <img src="<?php echo $webImagePath; ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                        <?php else: ?>
                            <!-- Show a default placeholder image if the tour image doesn't exist -->
                            <img src="assets/images/img.jpg" alt="Default Image">
                            <p class="no-image">Image not available</p>
                        <?php endif; ?>

                        <div class="tour-details">
                            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                            <p><?php echo htmlspecialchars($row['description']); ?></p>
                            <p class="price">Price: $<?php echo htmlspecialchars($row['price']); ?></p>
                            <a href="tour_details.php?id=<?php echo $row['id']; ?>" class="btn-view">View Details</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="no-tours">No one-day tours available at the moment. Please check back later!</p>
            <?php endif; ?>
        </div>
    </section>

    <?php $conn->close(); ?>
</body>
</html>
