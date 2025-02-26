<?php
require_once 'config/database.php';
$database = new Database();
$conn = $database->getConnection();

// Fetch featured packages
$query = "SELECT * FROM tour_packages WHERE is_active = TRUE LIMIT 3";
$featured_packages = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sri Travels</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/navigation.php'; ?>

    <main class="home-page">
        <section class="hero">
            <h1>Discover Amazing Travel Experiences</h1>
            <p>Explore the world with our exciting tour packages</p>
            <br>
            <a href="tour-packages.php" class="btn">View Packages</a>
        </section>

        <section class="featured-packages">
            <h2>Featured Packages</h2>
            <div class="packages-container">
                <?php while($package = $featured_packages->fetch_assoc()): ?>
                    <div class="package-card">
                        <img src="assets/images/packages/<?php echo $package['package_image']; ?>" alt="<?php echo $package['package_name']; ?>">
                        <h3><?php echo $package['package_name']; ?></h3>
                        <p>Location: <?php echo $package['package_location']; ?></p>
                        <p>Price: $<?php echo number_format($package['package_price'], 2); ?></p>
                        <a href="booking.php?package_id=<?php echo $package['id']; ?>" class="btn">Book Now</a>
                    </div>
                <?php endwhile; ?>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
<?php $database->closeConnection(); ?>