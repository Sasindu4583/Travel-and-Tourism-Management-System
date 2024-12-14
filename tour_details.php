<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'travel_tours');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the tour ID from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch tour details
$sql = "SELECT * FROM tours WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$tour = $result->fetch_assoc();

// If no tour is found, show an error
if (!$tour) {
    echo "Tour not found!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($tour['title']); ?></title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        /* Hero Section */
        .hero {
            position: relative;
            background-size: cover;
            background-position: center;
            height: 400px; /* Increased height for better visibility */
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.7);
        }

        .hero-overlay {
            background-color: rgba(0, 0, 0, 0.5);
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero h1 {
            font-size: 3rem; /* Larger title */
            margin: 0;
        }

        /* Main Content */
        .main-content {
            display: grid;
            grid-template-columns: 3fr 1fr;
            gap: 20px;
            padding: 20px;
            max-width: 1600px;
            margin: 0 auto;
        }

        .tabs {
            display: flex;
            gap: 50px;
            margin-bottom: 30px; /* Increased margin */
            flex-wrap: wrap; /* For responsiveness */
        }

        .tab {
            padding: 15px 25px;
            border: 1px solid #ddd;
            cursor: pointer;
            background: #f0f0f0;
            border-radius: 4px;
            flex: 1; /* Make tabs flexible on smaller screens */
            text-align: center;
            font-size: 1.2rem; /* Larger text */
        }

        .tab.active {
            background: #008751;
            color: white;
            border-color: #008751;
        }

        .tab-content {
            display: none;
            padding: 20px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .tab-content.active {
            display: block;
        }

        /* Right Sidebar */
        .content-right {
            background: white;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .tour-price {
            margin-bottom: 20px;
            text-align: center;
        }

        .tour-price h3 {
            margin: 0;
            font-size: 1.5rem;
            color: #008751;
        }

        .enquiry-btn {
            display: block;
            width: 100%;
            padding: 10px 20px;
            background: #008751;
            color: white;
            border: none;
            border-radius: 4px;
            text-align: center;
            font-size: 1rem;
            cursor: pointer;
        }

        .enquiry-btn:hover {
            background: #006633;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-content {
                grid-template-columns: 1fr;
                padding: 10px;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .tour-price h3 {
                font-size: 1.2rem;
            }

            .tabs {
                flex-direction: column;
                width: 100%;
            }

            .tab {
                width: 100%;
                text-align: center;
                font-size: 1rem; /* Adjust text size for smaller screens */
            }
        }

        @media (max-width: 480px) {
            .hero h1 {
                font-size: 1.5rem;
            }

            .tabs {
                gap: 10px;
            }

            .tab {
                padding: 8px 10px;
            }

            .tab-content {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="hero" style="background-image: url('<?php echo "uploads/" . htmlspecialchars($tour['image']); ?>');">
        <div class="hero-overlay">
            <h1><?php echo htmlspecialchars($tour['title']); ?></h1>
        </div>
    </section>

    <!-- Main Content Section -->
    <main class="main-content">
        <div class="content-left">
            <!-- Tab Navigation -->
            <div class="tabs">
                <button class="tab active" onclick="showTab('itinerary')">Itinerary</button>
                <button class="tab" onclick="showTab('inclusion')">Inclusion</button>
                <button class="tab" onclick="showTab('exclusion')">Exclusion</button>
            </div>

            <!-- Tab Content -->
            <div id="itinerary" class="tab-content active">
                <h2>description</h2>
                <p><?php echo nl2br(htmlspecialchars($tour['description'])); ?></p>
            </div>

            <div id="inclusion" class="tab-content">
                <h2>Inclusion</h2>
                <p>
                    <?php 
                    if (!empty($tour['inclusions'])) {
                        echo nl2br(htmlspecialchars($tour['inclusions']));
                    } else {
                        echo "No inclusions available for this tour.";
                    }
                    ?>
                </p>
            </div>

            <div id="exclusion" class="tab-content">
                <h2>Exclusion</h2>
                <p>
                    <?php 
                    if (!empty($tour['exclusions'])) {
                        echo nl2br(htmlspecialchars($tour['exclusions']));
                    } else {
                        echo "No exclusions available for this tour.";
                    }
                    ?>
                </p>
            </div>

        </div>

        <!-- Right Sidebar -->
        <aside class="content-right">
            <div class="tour-price">
                <h3>Price: $<?php echo htmlspecialchars($tour['price']); ?></h3>
                <p>Duration: <?php echo htmlspecialchars($tour['days']); ?> Days</p>
            </div>
            <div class="enquiry">
            <a href="inquiry.php">
            <button class="enquiry-btn">Enquire Now</button>
        </a>
            </div>
        </aside>
    </main>

    <script>
        // Tab Navigation Logic
        function showTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
            document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
            document.getElementById(tabId).classList.add('active');
            document.querySelector(`[onclick="showTab('${tabId}')"]`).classList.add('active');
        }
    </script>
</body>
</html>

<?php $conn->close(); ?>
