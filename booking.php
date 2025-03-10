<?php
require_once 'config/database.php'; // Include the database configuration file to establish a connection
$database = new Database(); // Create a new Database object and establish a connection
$conn = $database->getConnection();

// Check if a package_id is provided in the URL
if (!isset($_GET['package_id'])) {
    header('Location: tour-packages.php'); // Redirect to the tour packages page if no package_id is provided
    exit;
}

$package_id = intval($_GET['package_id']); // Sanitize the package_id from the URL

// Fetch the package details from the database
$query = "SELECT * FROM tour_packages WHERE id = $package_id";
$result = $conn->query($query); // Execute the query
$package = $result->fetch_assoc(); // Fetch the package data as an associative array

if (!$package) {
    header('Location: tour-packages.php'); // Redirect to the tour packages page if the package is not found
    exit;
}

// Handle form submission for booking
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Sanitize and retrieve form inputs
    $user_name = $conn->real_escape_string($_POST['user_name']); // User's name
    $user_email = $conn->real_escape_string($_POST['user_email']); // User's email
    $booking_date = $conn->real_escape_string($_POST['booking_date']); // Booking date
    $phone = $conn->real_escape_string($_POST['phone']); // User's phone number
    $NIC = $conn->real_escape_string($_POST['NIC']); // User's NIC number for verify

     // Insert the booking into the database
    $booking_query = "INSERT INTO bookings (package_id, user_name, user_email, booking_date,phone,NIC) 
                      VALUES ($package_id, '$user_name', '$user_email', '$booking_date','$phone','$NIC')";
    
    // Execute the query and check if it was successful
    if ($conn->query($booking_query)) {
        $booking_success = "Booking successful! We'll contact you soon."; // Success message
    } else {
        $booking_error = "Booking failed. Please try again."; // Error message
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Package - <?php echo htmlspecialchars($package['package_name']); ?></title> <!-- Dynamic page title -->
    <link rel="stylesheet" href="assets/css/styles.css"> <!-- Link to the main CSS file -->
</head>
<body>
    <?php include 'includes/header.php'; ?> <!-- Include the header file -->
    <?php include 'includes/navigation.php'; ?> <!-- Include the navigation file -->

    <main class="booking-page">
        <div class="booking-container">  
            <div class="package-preview"> <!-- Package Preview Section -->
                <img src="assets/images/packages/<?php echo htmlspecialchars($package['package_image']); ?>" alt="<?php echo htmlspecialchars($package['package_name']); ?>"> <!-- Display the package image -->
                <h2><?php echo htmlspecialchars($package['package_name']); ?></h2> <!-- Package name -->
                <p>Location: <?php echo htmlspecialchars($package['package_location']); ?></p> <!-- Package location -->
                <p>Type: <?php echo htmlspecialchars($package['package_type']); ?></p>
                <p>Price: $<?php echo number_format($package['package_price'], 2); ?></p> <!-- Package price -->
                <p><?php echo htmlspecialchars($package['package_details']); ?></p> <!-- Package details -->
            </div>

            <div class="booking-form"> <!-- Booking Form Section -->
                <h2>Book This Package</h2> <!-- Form heading -->
                
                <?php if(isset($booking_success)): ?>
                    <div class="success-message"><?php echo $booking_success; ?></div> <!-- Display success message if booking was successful -->
                <?php endif; ?>
                
                <?php if(isset($booking_error)): ?>
                    <div class="error-message"><?php echo $booking_error; ?></div>  <!-- Display error message if booking failed -->
                <?php endif; ?>

                <form method="POST"> <!-- Booking Form -->
                    <div class="form-group">
                        <label for="user_name">Full Name</label>
                        <input type="text" id="user_name" name="user_name" required> <!-- Full name input -->
                    </div>
                    <div class="form-group">
                        <label for="user_email">Email</label>
                        <input type="email" id="user_email" name="user_email" required> <!-- Email input -->
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="phone" id="phone" name="phone" required> <!-- Phone number input -->  
                    </div>
                    <div class="form-group">
                        <label for="NIC">NIC Number</label>
                        <input type="NIC" id="NIC" name="NIC" required> <!-- NIC number input for verify -->
                    </div>
                    <div class="form-group">
                        <label for="booking_date">Preferred Booking Date</label> 
                        <input type="date" id="booking_date" name="booking_date" required> <!-- Booking date input -->
                    </div>
                    <button type="submit" class="btn">Book Package</button> <!-- Submit button -->
                </form>
            </div>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?> <!-- Include the footer file -->
</body>
</html>
<?php 
$database->closeConnection(); // Close the database connection
?>
