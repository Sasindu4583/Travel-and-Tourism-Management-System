<?php
require_once 'config/database.php';
$database = new Database();
$conn = $database->getConnection();

// Check if a search term is provided
$search_term = '';
if (isset($_GET['search'])) {
    $search_term = $conn->real_escape_string($_GET['search']);
}

// Fetch active tour packages with optional search filter
$query = "SELECT * FROM tour_packages WHERE is_active = TRUE";
if (!empty($search_term)) {
    $query .= " AND (package_name LIKE '%$search_term%' OR package_location LIKE '%$search_term%')";
}
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tour Packages</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/search.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/navigation.php'; ?>

    <main class="tour-packages">
        <h1>Our Tour Packages</h1>
        
        <!-- Search Form -->
        <form method="GET" action="tour-packages.php" class="search-form">
            <input type="text" name="search" placeholder="Search places..." value="<?php echo htmlspecialchars($search_term); ?>">
            <button type="submit">Search</button>
        </form>

        <div class="packages-container">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($package = $result->fetch_assoc()): ?>
                    <div class="package-card">
                        <img src="assets/images/packages/<?php echo htmlspecialchars($package['package_image']); ?>" alt="<?php echo htmlspecialchars($package['package_name']); ?>">
                        <h3><?php echo htmlspecialchars($package['package_name']); ?></h3>
                        <p>Location: <?php echo htmlspecialchars($package['package_location']); ?></p>
                        <p>Type: <?php echo htmlspecialchars($package['package_type']); ?></p>
                        <p>Price: $<?php echo number_format($package['package_price'], 2); ?></p>
                        <a href="booking.php?package_id=<?php echo $package['id']; ?>" class="btn">Book Now</a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="no-results-message">No packages found for "<?php echo htmlspecialchars($search_term); ?>"</p>
            <?php endif; ?>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
<?php $database->closeConnection(); ?>
