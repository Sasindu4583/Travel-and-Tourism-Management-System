<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Header with Login and Location</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* Custom Styles for Header */
        .navbar {
            background-color: #28a745; /* Green background */
            border-bottom: 2px solid #1c7430; /* Darker green border for contrast */
        }
        .navbar-brand img {
            height: 50px; /* Logo size */
        }
        .navbar-nav .nav-link {
            color: white; /* White text for menu items */
            font-weight: 500; /* Slightly bolder text */
        }
        .navbar-nav .nav-link:hover {
            color: #f8f9fa; /* Light color on hover */
            text-decoration: underline; /* Underline effect on hover */
        }
        .user-icon {
            font-size: 1.8rem;
            color: white; /* White color for user icon */
            text-decoration: none;
            margin-left: 15px;
        }
        .user-icon:hover {
            color: #f8f9fa; /* Light color on hover */
        }
        .location-icon {
            font-size: 1rem;
            color: white; /* White color for location text */
            margin-right: 10px;
        }
        .navbar-toggler-icon {
            background-color: white; /* White hamburger icon for mobile */
        }
        @media (max-width: 768px) {
            .navbar-nav {
                text-align: center; /* Center menu items on mobile */
            }
            .d-flex {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <!-- Left Column: Logo -->
                <a class="navbar-brand" href="index.php">
                    <img src="path/to/your/logo.png" alt="Logo">
                </a>

                <!-- Right Column: Hamburger Menu (for mobile) -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Center Column: Menu -->
                <div class="collapse navbar-collapse" id="navbarMenu">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about_us.php">About Us</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="toursDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Tours
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="toursDropdown">
                                <li><a class="dropdown-item" href="single_day_tours.php">Single-Day Tours</a></li>
                                <li><a class="dropdown-item" href="multi_day_tours.php">Multi-Day Tours</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="contact_us.php">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="gallery.php">Gallery</a>
                        </li>
                    </ul>

                    <!-- Right Column: Location and User Login Icon -->
                    <div class="d-flex align-items-center">
                        <div class="location-icon">
                            <i class="bi bi-geo-alt-fill"></i>
                            Colombo, Sri Lanka
                        </div>
                        <a href="login.php" class="user-icon">
                            <i class="bi bi-person-circle"></i>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
