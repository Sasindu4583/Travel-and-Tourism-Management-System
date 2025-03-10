<?php
require_once 'config/database.php'; // Include the database configuration file to establish a connection
$database = new Database(); // Create a new Database object and establish a connection
$conn = $database->getConnection();

// Check if a search term is provided in the URL
$search_term = '';
if (isset($_GET['search'])) {
    $search_term = $conn->real_escape_string($_GET['search']);  // Sanitize the search term to prevent SQL injection
}

// Fetch active tour packages with optional search filter
$query = "SELECT * FROM tour_packages WHERE is_active = TRUE";
if (!empty($search_term)) {
    $query .= " AND (package_name LIKE '%$search_term%' OR package_location LIKE '%$search_term%')"; // Add a search filter to the query if a search term is provided
}
$result = $conn->query($query); // Execute the query
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tour Packages</title> <!-- Page title -->
    <link rel="stylesheet" href="assets/css/styles.css"> <!-- Link to the main CSS file -->
    <link rel="stylesheet" href="assets/css/search.css"> <!-- Link to the search CSS file -->
</head>
<body>
    <?php include 'includes/header.php'; ?> <!-- Include the header file -->
    <?php include 'includes/navigation.php'; ?> <!-- Include the navigation file -->

    <main class="tour-packages">
        <h1>Our Tour Packages</h1> <!-- Page heading -->
        
        <!-- Search Form -->
        <form method="GET" action="tour-packages.php" class="search-form">
            <input type="text" name="search" placeholder="Search places..." value="<?php echo htmlspecialchars($search_term); ?>"> <!-- Search input field -->
            <button type="submit">Search</button> <!-- Search button -->
        </form>

        <div class="packages-container">
            <?php if ($result->num_rows > 0): ?> <!-- Check if there are any packages -->
                <?php while ($package = $result->fetch_assoc()): ?> <!-- Loop through each package -->
                    <div class="package-card">
                        <img src="assets/images/packages/<?php echo htmlspecialchars($package['package_image']); ?>" alt="<?php echo htmlspecialchars($package['package_name']); ?>"> <!-- Display the package image -->
                        <h3><?php echo htmlspecialchars($package['package_name']); ?></h3> <!-- Package name -->
                        <p>Location: <?php echo htmlspecialchars($package['package_location']); ?></p> <!-- Package location -->
                        <p>Type: <?php echo htmlspecialchars($package['package_type']); ?></p>  <!-- Package type -->
                        <p>Price: $<?php echo number_format($package['package_price'], 2); ?></p> <!-- Package price -->
                        <a href="booking.php?package_id=<?php echo $package['id']; ?>" class="btn">Book Now</a> <!-- Link to book the package -->
                    </div>
                <?php endwhile; ?> <!-- End of loop -->
            <?php else: ?> <!-- If no packages are found -->
                <p class="no-results-message">No packages found for "<?php echo htmlspecialchars($search_term); ?>"</p> <!-- No results message -->
            <?php endif; ?>
        </div>
    </main>
    <?php include 'includes/footer.php'; ?>  <!-- Include the footer file -->
</body>
</html>
<?php $database->closeConnection(); // Close the database connection
?>
