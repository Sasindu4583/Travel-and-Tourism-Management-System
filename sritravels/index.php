<?php
require_once 'config/database.php'; // Include the database configuration file
$database = new Database(); // Create a new Database object and establish a connection
$conn = $database->getConnection();

// Fetch featured packages from the database
$query = "SELECT * FROM tour_packages WHERE is_active = TRUE LIMIT 3";
$featured_packages = $conn->query($query); // Execute the query
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sri Travels</title>
    <link rel="stylesheet" href="assets/css/styles.css"> <!-- Link to the main CSS file -->
</head>
<body>
    <?php include 'includes/header.php'; ?> <!-- Include the header -->
    <?php include 'includes/navigation.php'; ?> <!-- Include the navigation -->

    <main class="home-page">
        <section class="hero">
            <h1>Discover Amazing Travel Experiences</h1> <!-- Hero section heading -->
            <p>Explore the world with our exciting tour packages</p> <!-- Hero section text -->
            <br>
            <a href="tour-packages.php" class="btn">View Packages</a> <!-- Button to view packages -->
        </section>

        <section class="featured-packages">
            <h2>Popular Packages</h2> <!-- Featured packages heading -->
            <div class="packages-container">
                <?php while($package = $featured_packages->fetch_assoc()): ?> <!-- Loop through featured packages -->
                    <div class="package-card">
                        <img src="assets/images/packages/<?php echo $package['package_image']; ?>" alt="<?php echo $package['package_name']; ?>"> <!-- Package image -->
                        <h3><?php echo $package['package_name']; ?></h3> <!-- Package name -->
                        <p>Location: <?php echo $package['package_location']; ?></p> <!-- Package location -->
                        <p>Price: $<?php echo number_format($package['package_price'], 2); ?></p> <!-- Package price -->
                        <a href="booking.php?package_id=<?php echo $package['id']; ?>" class="btn">Book Now</a> <!-- Button to book package -->
                    </div>
                <?php endwhile; ?> <!-- End of loop -->
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?> <!-- Include the footer -->
</body>
</html>
<?php $database->closeConnection(); // Close the database connection  ?>