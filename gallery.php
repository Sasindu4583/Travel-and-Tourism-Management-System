<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'travel_tours');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch images from the database
$sql = "SELECT * FROM images ORDER BY created_at DESC";
$result = $conn->query($sql);

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .gallery-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .gallery-item {
            background: #fff;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .gallery-item img {
            width: 100%;
            border-radius: 8px;
        }
        .gallery-item p {
            text-align: center;
            color: #555;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="gallery-container">
        <?php
        if ($result->num_rows > 0) {
            // Output each image and description
            while($row = $result->fetch_assoc()) {
                echo "<div class='gallery-item'>";
                echo "<img src='" . $row['image_path'] . "' alt='Image'>";
                echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No images found in the gallery.</p>";
        }
        ?>
    </div>

</body>
</html>
