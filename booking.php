<?php
require_once 'config/database.php';
$database = new Database();
$conn = $database->getConnection();

// Check if package_id is set
if (!isset($_GET['package_id'])) {
    header('Location: tour-packages.php');
    exit;
}

$package_id = intval($_GET['package_id']);

// Fetch package details
$query = "SELECT * FROM tour_packages WHERE id = $package_id";
$result = $conn->query($query);
$package = $result->fetch_assoc();

if (!$package) {
    header('Location: tour-packages.php');
    exit;
}

// Handle booking submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name = $conn->real_escape_string($_POST['user_name']);
    $user_email = $conn->real_escape_string($_POST['user_email']);
    $booking_date = $conn->real_escape_string($_POST['booking_date']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $NIC = $conn->real_escape_string($_POST['NIC']);

    $booking_query = "INSERT INTO bookings (package_id, user_name, user_email, booking_date,phone,NIC) 
                      VALUES ($package_id, '$user_name', '$user_email', '$booking_date','$phone','$NIC')";
    
    if ($conn->query($booking_query)) {
        $booking_success = "Booking successful! We'll contact you soon.";
    } else {
        $booking_error = "Booking failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Package - <?php echo htmlspecialchars($package['package_name']); ?></title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/navigation.php'; ?>

    <main class="booking-page">
        <div class="booking-container">
            <div class="package-preview">
                <img src="assets/images/packages/<?php echo htmlspecialchars($package['package_image']); ?>" alt="<?php echo htmlspecialchars($package['package_name']); ?>">
                <h2><?php echo htmlspecialchars($package['package_name']); ?></h2>
                <p>Location: <?php echo htmlspecialchars($package['package_location']); ?></p>
                <p>Price: $<?php echo number_format($package['package_price'], 2); ?></p>
                <p><?php echo htmlspecialchars($package['package_details']); ?></p>
            </div>

            <div class="booking-form">
                <h2>Book This Package</h2>
                
                <?php if(isset($booking_success)): ?>
                    <div class="success-message"><?php echo $booking_success; ?></div>
                <?php endif; ?>
                
                <?php if(isset($booking_error)): ?>
                    <div class="error-message"><?php echo $booking_error; ?></div>
                <?php endif; ?>

                <form method="POST">
                    <div class="form-group">
                        <label for="user_name">Full Name</label>
                        <input type="text" id="user_name" name="user_name" required>
                    </div>
                    <div class="form-group">
                        <label for="user_email">Email</label>
                        <input type="email" id="user_email" name="user_email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="phone" id="phone" name="phone" required>
                    </div>
                    <div class="form-group">
                        <label for="NIC">NIC Number</label>
                        <input type="NIC" id="NIC" name="NIC" required>
                    </div>
                    <div class="form-group">
                        <label for="booking_date">Preferred Booking Date</label>
                        <input type="date" id="booking_date" name="booking_date" required>
                    </div>
                    <button type="submit" class="btn">Book Package</button>
                </form>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>
</body>
</html>
<?php 
$database->closeConnection(); 
?>