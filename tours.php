<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'travel_tours');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Categories</title>
    <link rel="stylesheet" href="assets/tours.css">
</head>
<body>
    <header class="main-header">
        <h1>Explore Tour Categories</h1>
    </header>

    <section class="categories-container">
        <div class="category-card">
            <h2>One-Day Tours</h2>
            <p>Explore our exciting single-day tours, perfect for a quick adventure!</p>
            <a href="single_day_tours.php" class="btn-view">View One-Day Tours</a>
        </div>

        <div class="category-card">
            <h2>Multi-Day Tours</h2>
            <p>Discover our multi-day tours for a complete travel experience!</p>
            <a href="multi_day_tours.php" class="btn-view">View Multi-Day Tours</a>
        </div>
    </section>
</body>
</html>
