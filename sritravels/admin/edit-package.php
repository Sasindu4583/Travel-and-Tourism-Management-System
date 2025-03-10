<?php
session_start(); // Start a session to manage user login state

// Ensure the user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php'); // Redirect to login page if not logged in
    exit;
}

require_once '../config/database.php'; // Include the database configuration file
$database = new Database(); // Create a new Database object and establish a connection
$conn = $database->getConnection();

// Check if package_id is set in the URL
if (!isset($_GET['id'])) {
    header('Location: tour-packages.php'); // Redirect if no package ID is provided
    exit;
}

$package_id = intval($_GET['id']); // Sanitize the package_id from the URL

// Fetch package details from the database
$query = "SELECT * FROM tour_packages WHERE id = $package_id";
$result = $conn->query($query); // Execute the query
$package = $result->fetch_assoc(); // Fetch the package data as an associative array

if (!$package) {
    header('Location: tour-packages.php'); // Redirect if the package is not found
    exit;
}

// Handle form submission for updating package
if ($_SERVER['REQUEST_METHOD'] === 'POST') {  // Sanitize and retrieve form inputs
    $package_name = $conn->real_escape_string($_POST['package_name']);
    $package_type = $conn->real_escape_string($_POST['package_type']);
    $package_location = $conn->real_escape_string($_POST['package_location']);
    $package_price = floatval($_POST['package_price']);
    $package_details = $conn->real_escape_string($_POST['package_details']);
    $upload_dir = "../assets/images/packages/";  // Directory to store uploaded images

    // Handle file upload if a new file is selected
    if (!empty($_FILES['package_image']['name']) && $_FILES['package_image']['error'] === 0) {
        $unique_filename = uniqid() . '_' . basename($_FILES['package_image']['name']); // Generate a unique filename
        $target_file = $upload_dir . $unique_filename;

        // Ensure the directory exists
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true); // Create the directory if it doesn't exist
        }

         // Move uploaded file to the target directory
        if (move_uploaded_file($_FILES['package_image']['tmp_name'], $target_file)) {
            // Update the package_image if the upload is successful
            $package_image = $unique_filename; // Update the package_image if upload is successful
        } else {
            $error_message = "Failed to upload the image. Please try again."; // Error message if upload fails
        }
    } else {
        // Keep the existing image if no new file is uploaded
        $package_image = $package['package_image'];
    }

    // Update package details in the database
    $update_query = "UPDATE tour_packages 
                     SET package_name = '$package_name', package_type = '$package_type', 
                         package_location = '$package_location', package_price = $package_price, 
                         package_details = '$package_details', package_image = '$package_image' 
                     WHERE id = $package_id";

    if ($conn->query($update_query)) {
        $success_message = "Package updated successfully!"; // Success message
    } else {
        $error_message = "Failed to update the package. Please try again."; // Error message
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Package</title> <!-- Page title -->
    <link rel="stylesheet" href="assets/css/admin.css"> <!-- Link to the admin CSS file -->
</head>
<body>
    <div class="admin-container">
        <?php include 'includes/sidebar.php'; ?> <!-- Include the sidebar navigation -->

        <main class="dashboard">
            <h1>Edit Package</h1> <!-- Page heading -->

             <!-- Display success message if update is successful -->
            <?php if (isset($success_message)): ?>
                <div class="success-message"><?php echo $success_message; ?></div>
            <?php endif; ?>

            <!-- Display error message if update fails -->
            <?php if (isset($error_message)): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <form method="POST" enctype="multipart/form-data"> <!-- Edit Package Form -->
                <div class="form-group">
                    <label for="package_name">Package Name</label> <!-- Package name input -->
                    <input type="text" id="package_name" name="package_name" value="<?php echo htmlspecialchars($package['package_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="package_type">Package Type</label> <!-- Package type input -->
                    <input type="text" id="package_type" name="package_type" value="<?php echo htmlspecialchars($package['package_type']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="package_location">Package Location</label> <!-- Package location input -->
                    <input type="text" id="package_location" name="package_location" value="<?php echo htmlspecialchars($package['package_location']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="package_price">Package Price</label> <!-- Package price input -->
                    <input type="number" id="package_price" name="package_price" value="<?php echo htmlspecialchars($package['package_price']); ?>" step="0.01" required>
                </div>
                <div class="form-group">
                    <label for="package_details">Package Details</label> <!-- Package details textarea -->
                    <textarea id="package_details" name="package_details" required><?php echo htmlspecialchars($package['package_details']); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="package_image">Package Image</label> <!-- Display current image filename -->
                    <input type="file" id="package_image" name="package_image" accept="image/*">
                    <p>Current Image: <?php echo htmlspecialchars($package['package_image']); ?></p>
                </div>
                <button type="submit" class="btn">Update Package</button> <!-- Submit button -->
                <a href="tour-packages.php" class="btn btn-cancel">Cancel</a> <!-- Cancel button -->
            </form>
        </main>
    </div>
</body>
</html>
<?php
$conn->close(); // Close the database connection
?>
