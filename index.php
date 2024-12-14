<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Sri Travels</title>
    <link rel="stylesheet" href="assets/style.css">
    <!-- You can use FontAwesome for the icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <?php include "header.php"?>
    
    <!-- Hero Section -->
    <section class="hero" style="background-image: url('assets/images/img.jpg'); background-size: cover; background-position: center;">
        <h1>Welcome to Sri Travels in Sri Lanka</h1>
        <p>Experience the Best of Sri Lanka with Our Premier Tourism Services</p>
        <div class="hero-buttons">
            <a href="packages.php" class="btn btn-primary">Tour Packages</a>
        </div>
    </section>

    

    <!-- About Us Section -->
    <section class="about-section">
        <div class="about-content">
            <h2>About Us</h2>
            <p>
                Sri Travels is your gateway to unforgettable experiences in Sri Lanka. 
                Our team of dedicated professionals ensures you discover the perfect balance of 
                culture, adventure, and relaxation. Whether it's a single day or a multi-day journey, 
                we are here to make your trip extraordinary.
            </p>
            <a href="about.php" class="btn btn-primary">Learn More</a>
        </div>
        <div class="about-image">
            <img src="assets/images/img.jpg" alt="About Sri Travels">
        </div>
    </section>

    <!-- Main Section with Tour Categories -->
    <section class="main-content">
        <div class="tour-categories">
            <h2>Tour Packages</h2>
            <div class="categories">
                <div class="category">
                    <img src="assets/images/img.jpg" alt="One Day Tours">
                    <h3>One Day Tours</h3>
                    <p>Explore Sri Lanka's best destinations in a day!</p>
                    <a href="single_day_tours.php" class="btn btn-secondary">Learn More</a>
                </div>
                <div class="category">
                    <img src="assets/images/img.jpg" alt="Multi-Day Tours">
                    <h3>Multi-Day Tours</h3>
                    <p>Immerse yourself in the culture and beauty of Sri Lanka with our extended tours.</p>
                    <a href="multi_day_tours.php" class="btn btn-secondary">Learn More</a>
                </div>
                <div class="category">
                    <img src="assets/images/img.jpg" alt="Customized Tours">
                    <h3>Customized Tours</h3>
                    <p>Create a personalized travel experience tailored just for you!</p>
                    <a href="customized.php" class="btn btn-secondary">Learn More</a>
                </div>
            </div>
        </div>
    </section>

    <!-- 4 Categories Section Above Tour Packages -->
    <section class="categories-section">
        
        <div class="categories">
            <!-- Category 1 -->
            <div class="category">
                <i class="fas fa-car"></i>
                <h3>Transport Services</h3>
                <p>Safe and comfortable transport for your Sri Lanka travels.</p>
            </div>
            <!-- Category 2 -->
            <div class="category">
                <i class="fas fa-hotel"></i>
                <h3>Hotel Bookings</h3>
                <p>We help you find the best hotels for your stay in Sri Lanka.</p>
            </div>
            <!-- Category 3 -->
            <div class="category">
                <i class="fas fa-utensils"></i>
                <h3>Food & Dining</h3>
                <p>Discover Sri Lankan cuisine with local food experiences.</p>
            </div>
           
        </div>
    </section>
    <!-- Main Section with Tour Categories -->
    <section class="main-content">
        <div class="tour-categories">
            <h2>Tour Packages</h2>
            <div class="categories">
                <div class="category">
                    <img src="assets/images/img.jpg" alt="One Day Tours">
                    <h3>One Day Tours</h3>
                    <p>Explore Sri Lanka's best destinations in a day!</p>
                    <a href="single_day_tours.php" class="btn btn-secondary">Learn More</a>
                </div>
                <div class="category">
                    <img src="assets/images/img.jpg" alt="Multi-Day Tours">
                    <h3>Multi-Day Tours</h3>
                    <p>Immerse yourself in the culture and beauty of Sri Lanka with our extended tours.</p>
                    <a href="multi_day_tours.php" class="btn btn-secondary">Learn More</a>
                </div>
                <div class="category">
                    <img src="assets/images/img.jpg" alt="Customized Tours">
                    <h3>Customized Tours</h3>
                    <p>Create a personalized travel experience tailored just for you!</p>
                    <a href="customized.php" class="btn btn-secondary">Learn More</a>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
