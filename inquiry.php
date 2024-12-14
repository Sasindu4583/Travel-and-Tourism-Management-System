<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'travel_tours');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $country = htmlspecialchars($_POST['country']);
    $mobile = htmlspecialchars($_POST['mobile']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $additional_info = htmlspecialchars($_POST['additional_info']);

    // Insert data into the database
    $sql = "INSERT INTO custom_tour_inquiries (name, email, country, mobile, telephone, additional_info)
            VALUES ('$name', '$email', '$country', '$mobile', '$telephone', '$additional_info')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Inquiry submitted successfully!</p>";
    } else {
        echo "Error: " . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Tour Inquiry</title>
    <style>
        /* Basic styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #007BFF;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background: #0056b3;
        }

        .form-group {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Custom Tour Inquiry</h2>
        <form action="inquiry.php" method="POST">
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="country">Country</label>
                <select id="country" name="country" required>
                    <option value="">Select your Country</option>
                    <option value="USA">United States</option>
                    <option value="Canada">Canada</option>
                    <option value="UK">United Kingdom</option>
                    <option value="Australia">Australia</option>
                    <option value="India">India</option>
                    <option value="Sri Lanka">Sri Lanka</option>
                    <!-- Add more countries as necessary -->
                </select>
            </div>

            <div class="form-group">
                <label for="mobile">Mobile Number</label>
                <input type="text" id="mobile" name="mobile" required>
            </div>

            <div class="form-group">
                <label for="telephone">Telephone Number</label>
                <input type="text" id="telephone" name="telephone">
            </div>

            <div class="form-group">
                <label for="additional_info">Additional Information</label>
                <textarea id="additional_info" name="additional_info" rows="4"></textarea>
            </div>

            <div class="form-group">
                <input type="submit" value="Submit Inquiry">
            </div>
        </form>
    </div>

</body>
</html>
