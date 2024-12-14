<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'travel_tours');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch multi-day tours
$sql = "SELECT * FROM tours WHERE category = 'Multi-Day' ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Day Tours</title>
    <link rel="stylesheet" href="assets/tours.css">
</head>
<body>
    <header class="main-header">
        <h1>Multi-Day Tours</h1>
    </header>

    <section class="tours-container">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="tour-card">
                    <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                    <div class="tour-details">
                        <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                        <p class="price">Price: $<?php echo htmlspecialchars($row['price']); ?></p>
                        <a href="tour_details.php?id=<?php echo $row['id']; ?>" class="btn-view">View Details</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No multi-day tours available at the moment. Please check back later!</p>
        <?php endif; ?>
    </section>

    <?php $conn->close(); ?>
</body>
</html>
