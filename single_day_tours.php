<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'travel_tours');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch single-day tours
$sql = "SELECT * FROM tours WHERE category = 'Single-Day' ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>One-Day Tours</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f9f9f9;
            line-height: 1.6;
        }

        a {
            text-decoration: none;
            color: #007BFF;
        }

        a:hover {
            color: #0056b3;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        /* Banner Section */
        .banner {
            position: relative;
            height: 400px;
            color: white;
            background-image: url('assets/images/colombo.webp');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
        }

        .banner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .banner h1 {
            font-size: 2.8em;
            margin-bottom: 10px;
            font-weight: bold;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }

        .banner p {
            font-size: 1.2em;
            margin-bottom: 10px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);
        }

        .banner p.subtitle {
            font-size: 1em;
            font-style: italic;
            margin-top: 10px;
        }

        /* Responsive Hero Section Styles */
        @media (max-width: 768px) {
            .banner {
                height: 300px;
            }

            .banner h1 {
                font-size: 2em;
            }

            .banner p {
                font-size: 1em;
            }

            .banner p.subtitle {
                font-size: 0.9em;
            }
        }

        @media (max-width: 480px) {
            .banner {
                height: 250px;
            }

            .banner h1 {
                font-size: 1.8em;
            }

            .banner p {
                font-size: 0.9em;
            }

            .banner p.subtitle {
                font-size: 0.8em;
            }
        }

        /* Tours Section */
        .tours-container {
            padding: 40px 20px;
            text-align: center;
            background: #fff;
        }

        .tours-container h2 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #555;
        }

        .tours-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .tour-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .tour-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .tour-card img {
            height: 200px;
            object-fit: cover;
        }

        .tour-details {
            padding: 15px;
            text-align: left;
        }

        .tour-details h3 {
            font-size: 1.4em;
            color: #333;
            margin-bottom: 10px;
        }

        .tour-details p {
            margin-bottom: 10px;
            color: #555;
        }

        .tour-details .price {
            color: #e74c3c;
            font-weight: bold;
            font-size: 1.2em;
        }

        .btn-view {
            display: inline-block;
            text-align: center;
            margin-top: 10px;
            background: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .btn-view:hover {
            background: #0056b3;
        }

        .no-tours {
            color: #777;
            font-style: italic;
        }
    </style>
</head>
<body>
    <!-- Banner Section -->
    <header class="banner">
        <div class="banner-overlay">
            <h1>Discover Our Exciting One-Day Tours</h1>
            <p>Explore the beauty of Sri Lanka in just one day!</p>
            <p class="subtitle">Tailored experiences for adventurers, explorers, and nature lovers.</p>
        </div>
    </header>

    <!-- Tour Packages Section -->
    <section class="tours-container">
        <h2>Available One-Day Tour Packages</h2>
        <div class="tours-grid">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="tour-card">
                        <?php 
                        $serverImagePath = __DIR__ . '/admin/uploads/' . htmlspecialchars($row['image']);
                        $webImagePath = 'admin/uploads/' . htmlspecialchars($row['image']);

                        if (!empty($row['image']) && file_exists($serverImagePath)): 
                        ?>
                            <img src="<?php echo $webImagePath; ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
                        <?php else: ?>
                            <img src="assets/images/img.jpg" alt="Default Image">
                        <?php endif; ?>

                        <div class="tour-details">
                            <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                            <p><?php echo htmlspecialchars($row['description']); ?></p>
                            <p class="price">Price: $<?php echo htmlspecialchars($row['price']); ?></p>
                            <a href="tour_details.php?id=<?php echo $row['id']; ?>" class="btn-view">View Details</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="no-tours">No one-day tours available at the moment. Please check back later!</p>
            <?php endif; ?>
        </div>
    </section>

    <?php $conn->close(); ?>
</body>
</html>
