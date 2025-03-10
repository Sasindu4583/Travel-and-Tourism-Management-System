<?php
session_start(); // Start a session to manage user login state
// Check if the admin is logged in, otherwise redirect to the login page
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

require_once '../config/database.php'; // Include the database configuration file
$database = new Database(); // Create a new Database object and establish a connection
$conn = $database->getConnection();

// Handle package creation form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_package'])) { // Sanitize and retrieve form inputs
    $package_name = $conn->real_escape_string($_POST['package_name']);
    $package_type = $conn->real_escape_string($_POST['package_type']);
    $package_location = $conn->real_escape_string($_POST['package_location']);
    $package_price = floatval($_POST['package_price']);
    $package_details = $conn->real_escape_string($_POST['package_details']);

    // Handle file upload for the package image
    $package_image = '';
    if (isset($_FILES['package_image']) && $_FILES['package_image']['error'] == 0) {
        $target_dir = "../assets/images/packages/";
        $package_image = uniqid() . '_' . basename($_FILES['package_image']['name']);
        $target_file = $target_dir . $package_image;
        move_uploaded_file($_FILES['package_image']['tmp_name'], $target_file); // Move the uploaded file
    }

    // Handle package deletion if a delete_id is provided in the URL
    $query = "INSERT INTO tour_packages (package_name, package_type, package_location, package_price, package_details, package_image) 
              VALUES ('$package_name', '$package_type', '$package_location', $package_price, '$package_details', '$package_image')";
    $conn->query($query); // Execute the query
}

// Handle package deletion
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']); // Sanitize the ID
    $delete_query = "DELETE FROM tour_packages WHERE id = $delete_id";// SQL query to delete the package
    $conn->query($delete_query); // Execute the query
    header('Location: tour-packages.php'); // Redirect back to the packages page
    exit;
}

// Fetch all existing packages from the database
$packages_query = "SELECT * FROM tour_packages";
$packages_result = $conn->query($packages_query); // Execute the query
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Tour Packages</title>
    <link rel="stylesheet" href="assets/css/admin.css"> <!-- Link to the admin CSS file -->
</head>
<body>
    <div class="admin-container">
        <?php include 'includes/sidebar.php'; ?> <!-- Include the sidebar navigation -->
        
        <main class="dashboard">
            <h1>Manage Tour Packages</h1> <!-- Page heading -->
            
            <div class="package-creation-form">
                <h2>Create New Package</h2>
                <form method="POST" enctype="multipart/form-data"> <!-- Form for creating a new package -->
                    <div class="form-group">
                        <label for="package_name">Package Name</label>
                        <input type="text" id="package_name" name="package_name" required> <!-- Package name input -->
                    </div>
                    <div class="form-group">
                        <label for="package_type">Package Type</label>
                        <input type="text" id="package_type" name="package_type" required> <!-- Package type input -->
                    </div>
                    <div class="form-group">
                        <label for="package_location">Package Location</label>
                        <input type="text" id="package_location" name="package_location" required> <!-- Package location input -->
                    </div>
                    <div class="form-group">
                        <label for="package_price">Package Price</label>
                        <input type="number" id="package_price" name="package_price" step="0.01" required> <!-- Package price input -->
                    </div>
                    <div class="form-group">
                        <label for="package_details">Package Details</label>
                        <textarea id="package_details" name="package_details" required></textarea> <!-- Package details textarea -->
                    </div>
                    <div class="form-group">
                        <label for="package_image">Package Image</label>
                        <input type="file" id="package_image" name="package_image" accept="image/*" required>  <!-- Package image file input -->
                    </div>
                    <button type="submit" name="create_package" a href="admin\login.php">Create Package</button> <!-- Submit button -->
                </form>
            </div>

            <div class="existing-packages">
                <h2>Existing Packages</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Location</th>
                            <th>Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($package = $packages_result->fetch_assoc()): ?> <!-- Loop through each package -->
                            <tr>
                                <td><?php echo htmlspecialchars($package['package_name']); ?></td> <!-- Display package name -->
                                <td><?php echo htmlspecialchars($package['package_type']); ?></td> <!-- Display package type -->
                                <td><?php echo htmlspecialchars($package['package_location']); ?></td> <!-- Display package location -->
                                <td>$<?php echo number_format($package['package_price'], 2); ?></td> <!-- Display package price -->
                                <td> <!-- Action buttons for each package -->
                                    <a href="edit-package.php?id=<?php echo $package['id']; ?>" class="btn btn-edit">Edit</a>
                                    <a href="?delete_id=<?php echo $package['id']; ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this package?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?> <!-- End loop -->
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
<?php 
$database->closeConnection(); // Close the database connection
?>