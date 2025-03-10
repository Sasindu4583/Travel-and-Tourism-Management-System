<?php
require_once 'config/database.php'; // Include the database configuration file to establish a connection
$database = new Database(); // Create a new Database object and establish a connection
$conn = $database->getConnection();

$feedback = ""; // Initialize a variable to store feedback messages

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     // Sanitize and validate form inputs
    $name = $conn->real_escape_string(trim($_POST['name'])); // User's name
    $email = $conn->real_escape_string(trim($_POST['email'])); // User's email
    $phone = $conn->real_escape_string(trim($_POST['phone'])); // User's phone number
    $message = $conn->real_escape_string(trim($_POST['message'])); // User's message

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // Validate the email address
        $feedback = "Invalid email address.";  // Error message for invalid email
    } else {
        // Insert contact form data into the database
        $contacts = "INSERT INTO contacts (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";
        if ($conn->query($contacts)) {
            $feedback = "Thank you for your message. We will get back to you shortly."; // Success message
        } else {
            $feedback = "There was an error submitting your message. Please try again."; // Error message
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title> <!-- Page title -->
    <link rel="stylesheet" href="assets/css/styles.css"> <!-- Link to the main CSS file -->
</head>
<body>
    <?php include 'includes/header.php'; ?> <!-- Include the header file -->
    <?php include 'includes/navigation.php'; ?> <!-- Include the navigation file -->

    <main class="contact-page">
        <section class="contact-form">
            <h1><center>Contact Us<center></h1> <!-- Contact form heading -->

            <label><b>Requesting cancel booking or Ask about any other problem !</b></label>
            <br><br>
          

            <!-- Display feedback message if available -->
            <?php if (!empty($feedback)): ?>
                <div class="feedback <?php echo strpos($feedback, 'Thank you') !== false ? 'success' : 'error'; ?>">
                    <?php echo htmlspecialchars($feedback); ?> <!-- Sanitized feedback message -->
                </div>
            <?php endif; ?>

            <!-- Contact Form -->
            <form method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required> <!-- Name input field -->
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required> <!-- Email input field -->
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone"> <!-- Phone input field -->
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" required></textarea> <!-- Message textarea -->
                </div>
                <button type="submit" class="btn">Send Message</button> <!-- Submit button -->
            </form>
         
            <!-- WhatsApp Contact Section -->
             <section class="whatsapp-contact">
                <a href="https://wa.me/1234567890" target="_blank"> <!-- WhatsApp link -->
                <img src="assets/images/whatsapp-icon.png" alt="WhatsApp Logo"> <!-- WhatsApp logo -->
                Chat with us on WhatsApp <!-- WhatsApp text -->
            </a>
        </section>
        </section>


     
    </main>
    <br>
    <?php include 'includes/footer.php'; ?> <!-- Include the footer file -->
</body>
</html>
<?php $database->closeConnection(); // Close the database connection
?>
