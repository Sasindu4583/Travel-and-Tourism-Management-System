<?php
// File to store the "About Us" content
$aboutFile = 'about_us.txt';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $aboutContent = $_POST['aboutContent'] ?? '';
    // Save content to the file
    file_put_contents($aboutFile, $aboutContent);
    $message = "About Us content updated successfully!";
}

// Read the current content from the file
$aboutContent = file_exists($aboutFile) ? file_get_contents($aboutFile) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .form-section {
            max-width: 600px;
            margin: auto;
            background: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .form-section h2 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group textarea {
            width: 100%;
            height: 150px;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
            resize: none;
        }
        .form-group button {
            display: block;
            width: 100%;
            padding: 10px;
            background: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .form-group button:hover {
            background: #218838;
        }
        .message {
            text-align: center;
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="form-section">
        <h2>Edit About Us</h2>
        <?php if (!empty($message)) : ?>
            <p class="message"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
        <form action="about.php" method="POST">
            <div class="form-group">
                <label for="aboutContent">About Us Content</label>
                <textarea name="aboutContent" id="aboutContent" required><?= htmlspecialchars($aboutContent) ?></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Save</button>
            </div>
        </form>
    </div>
</body>
</html>
