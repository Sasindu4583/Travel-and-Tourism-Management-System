<?php
require_once 'config/database.php';
$database = new Database();
$conn = $database->getConnection();

$feedback = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input
    $name = $conn->real_escape_string(trim($_POST['name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $phone = $conn->real_escape_string(trim($_POST['phone']));
    $message = $conn->real_escape_string(trim($_POST['message']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $feedback = "Invalid email address.";
    } else {
        // Insert contact form data into the database
        $contacts = "INSERT INTO contacts (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";
        if ($conn->query($contacts)) {
            $feedback = "Thank you for your message. We will get back to you shortly.";
        } else {
            $feedback = "There was an error submitting your message. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/navigation.php'; ?>

    <main class="contact-page">
        <section class="contact-form">
            <h1>Contact Us</h1>

            <!-- Feedback message -->
            <?php if (!empty($feedback)): ?>
                <div class="feedback <?php echo strpos($feedback, 'Thank you') !== false ? 'success' : 'error'; ?>">
                    <?php echo htmlspecialchars($feedback); ?>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="tel" id="phone" name="phone">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <button type="submit" class="btn">Send Message</button>
            </form>
         
            <!-- WhatsApp Contact Section -->
             <section class="whatsapp-contact">
                <a href="https://wa.me/1234567890" target="_blank">
                <img src="assets/images/whatsapp-icon.png" alt="WhatsApp Logo">
                Chat with us on WhatsApp
            </a>
        </section>
        </section>


     
    </main>
    <br>
    <?php include 'includes/footer.php'; ?>
</body>
</html>
<?php $database->closeConnection(); ?>
