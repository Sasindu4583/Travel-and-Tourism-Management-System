SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO"; -- Set SQL mode to prevent auto-increment columns from being affected by zero values
START TRANSACTION; -- Start a transaction to ensure data consistency
SET time_zone = "+00:00"; -- Set the default time zone to UTC

-- Database: `tourism_management`
-- Table structure for table `admin_users`

DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int NOT NULL AUTO_INCREMENT, -- Unique ID for each admin user
  `username` varchar(50) NOT NULL, -- Admin username 
  `password` varchar(255) NOT NULL, -- Admin password
  `email` varchar(100) DEFAULT NULL, -- Admin email address
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP, -- Timestamp when the admin account was created
  PRIMARY KEY (`id`), -- Primary key constraint
  UNIQUE KEY `username` (`username`) -- Ensure usernames are unique
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- Dumping data for table `admin_users`
INSERT INTO `admin_users` (`id`, `username`, `password`, `email`, `created_at`) VALUES -- Pre-populate the table with a default admin user
(1, 'admin', '123', 'admin@example.com', '2024-11-28 08:49:49');


-- Table structure for table `bookings`
-- Purpose: Stores user bookings for tour packages
DROP TABLE IF EXISTS `bookings`;
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int NOT NULL AUTO_INCREMENT, -- Unique ID for each booking
  `package_id` int DEFAULT NULL, -- Foreign key linking to the `tour_packages` table
  `user_name` varchar(100) NOT NULL, -- Name of the user making the booking
  `user_email` varchar(100) NOT NULL, -- Email of the user
  `booking_date` date NOT NULL,  -- Date of the booking
  `phone` int DEFAULT NULL, -- Contact number of the user
  `NIC` int DEFAULT NULL, -- National Identity Card number of the user
  PRIMARY KEY (`id`), -- Primary key constraint
  KEY `package_id` (`package_id`) -- Index for faster lookups on `package_id`
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Table structure for table `contacts`
-- Purpose: Stores user inquiries submitted through a contact form
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int NOT NULL AUTO_INCREMENT, -- Unique ID for each inquiry
  `name` varchar(100) NOT NULL, -- Name of the person submitting the inquiry
  `email` varchar(100) NOT NULL, -- Email of the person
  `phone` varchar(20) DEFAULT NULL, -- Contact number 
  `message` text, -- Content of the inquiry
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP, -- Timestamp when the inquiry was submitted
  PRIMARY KEY (`id`) -- Primary key constraint
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- Table structure for table `pages`
-- Purpose: Stores static pages like "About Us" and "Privacy Policy"
DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int NOT NULL AUTO_INCREMENT, -- Unique ID for each page
  `page_name` varchar(100) NOT NULL, -- Unique name of the page (e.g., "about_us")
  `title` varchar(150) NOT NULL, -- Title of the page
  `content` text NOT NULL, -- HTML content of the page
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP, -- Timestamp when the page was created
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- Timestamp when the page was last updated
  PRIMARY KEY (`id`), -- Primary key constraint
  UNIQUE KEY `page_name` (`page_name`) -- Ensure page names are unique
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


-- Dumping data for table `pages`
-- Pre-populate the table with static pages
INSERT INTO `pages` (`id`, `page_name`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 'about_us', 'About us', '<b><i><p>\r\nWelcome to Sri Travels, your gateway to discovering the breathtaking beauty and rich heritage of Sri Lanka. As a leading tourism platform, we are dedicated to showcasing the diverse experiences our island has to offer, from pristine beaches and lush tea plantations to ancient cultural landmarks and vibrant local traditions.\r\n\r\n<br><br>\r\n\r\nAt Sri Travels, we strive to provide travelers with reliable information, curated tour packages, and exceptional customer service to ensure your journey through Sri Lanka is unforgettable. Whether you\'re seeking adventure, relaxation, or a deeper understanding of Sri Lankan culture, we are here to guide you every step of the way.\r\n\r\n<br><br>\r\n\r\nOur team consists of passionate tourism professionals who are committed to promoting sustainable travel and sharing the wonders of Sri Lanka with the world. We believe in creating meaningful connections between travelers and local communities, preserving the environment, and celebrating the island’s unique charm.\r\n\r\n<br><br>\r\n\r\nThank you for choosing Sri Travels as your trusted travel companion. We look forward to helping you create memories that will last a lifetime.\r\n\r\n<br><br><br>\r\n\r\n<center> Thank you ! </center>\r\n\r\n<br><br>\r\n\r\n</p></i></b>', '2024-11-29 09:41:48', '2024-12-16 05:28:46'),
(2, 'privacy_policy', 'Privacy Policy', '<b><p>\r\nLast Update Date - 2024/12/10 \r\n\r\n<br><br>\r\n\r\nAt Sri Travels, we are committed to protecting your privacy and ensuring the security of your personal information. This Privacy Policy outlines how we collect, use, and safeguard the data you share with us. By using our website, you agree to the terms outlined in this policy.\r\n\r\n<br><br>\r\n\r\n1. Information We Collect\r\nWe may collect personal information such as your name, email address, phone number, and other relevant details when you contact us, make bookings, or sign up for updates. Additionally, we may collect non-personal data such as browser type, device information, and browsing behavior to improve our services.\r\n\r\n<br><br>\r\n\r\n\r\n2. How We Use Your Information\r\nTo process your inquiries, bookings.To provide you with information about Sri Lankan tourism, special offers, and updates.To improve our website\'s functionality and user experience.To comply with legal obligations or respond to government requests.\r\n\r\n<br><br>\r\n\r\n\r\n3. Data Security\r\nWe implement robust security measures to protect your personal information from unauthorized access, disclosure, or alteration. However, while we strive to secure your data, we cannot guarantee absolute security due to the nature of online interactions.\r\n\r\n<br><br>\r\n\r\n\r\n4. Sharing Your Information\r\nWe do not sell or rent your personal information to third parties. We may share your data with trusted partners, such as tour operators or payment processors, solely for the purpose of fulfilling your requests. Any sharing of data is done with strict confidentiality.\r\n\r\n<br><br>\r\n\r\n\r\n5. Use of Cookies\r\nOur website uses cookies to enhance your browsing experience. Cookies help us understand how visitors interact with our site and enable us to provide personalized content. You can manage or disable cookies through your browser settings.\r\n\r\n<br><br>\r\n\r\n\r\n6. Your Rights\r\nAs a user, you have the right to:\r\n- Access, update, or delete your personal information.\r\n- Opt out of receiving promotional communications.\r\n- Request details about how your data is used.\r\n\r\nTo exercise your rights, please contact us at [sritravels@gmail.com].\r\n\r\n<br><br>\r\n\r\n\r\n7. Links to Third-Party Websites\r\nOur website may include links to external sites. Please note that we are not responsible for the privacy practices of these websites. We encourage you to read their privacy policies when visiting.\r\n\r\n<br><br>\r\n\r\n\r\n8. Updates to This Policy\r\nWe may update this Privacy Policy from time to time. Changes will be posted on this page, and the \"Last Updated\" date will be revised accordingly.\r\n\r\n<br><br>\r\n\r\n\r\n9.Contact Us\r\nIf you have any questions about our Privacy Policy or how we handle your data, please contact us at:\r\n- Email: sritravels@gmail.com\r\n- Phone: +94\r\n- Address: \r\n\r\n<br><br>\r\n\r\n</p></b>', '2024-11-29 09:41:48', '2024-12-16 05:27:57');


-- Table structure for table `tour_packages`
-- Purpose: Stores details of tour packages offered by the website
DROP TABLE IF EXISTS `tour_packages`;
CREATE TABLE IF NOT EXISTS `tour_packages` (
  `id` int NOT NULL AUTO_INCREMENT, -- Unique ID for each tour package
  `package_name` varchar(100) NOT NULL, -- Name of the tour package
  `package_type` varchar(50) NOT NULL, -- Type of package (e.g., "1 Day Package")
  `package_location` varchar(100) NOT NULL, -- Location of the tour
  `package_price` decimal(10,2) NOT NULL, -- Price of the package
  `package_details` text, -- Description of the package
  `package_image` varchar(255) DEFAULT NULL, -- Path to the image associated with the package
  `is_active` tinyint(1) DEFAULT '1', -- Flag to indicate if the package is active (1) or inactive (0)
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP, -- Timestamp when the package was added
  PRIMARY KEY (`id`) -- Primary key constraint
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table `tour_packages`
--
-- Pre-populate the table with sample tour packages
INSERT INTO `tour_packages` (`id`, `package_name`, `package_type`, `package_location`, `package_price`, `package_details`, `package_image`, `is_active`, `created_at`) VALUES
(19, 'Nuwara Eliya', '1 Day Package', 'Nuwara Eliya', 100.00, 'Known as \"Little England\" for its colonial charm, Nuwara Eliya is a hill station surrounded by lush tea estates, waterfalls, and cool weather. Don’t miss Gregory Lake, Hakgala Botanical Garden, and the tea factory tours. The town’s misty ambiance and serene landscapes make it a perfect retreat.', '6759578f8e448_Nuwara Eliya.jpg', 1, '2024-12-10 08:42:19'),
(1, 'Yala National Park', '1 Day Package', 'Hambantota', 100.00, 'Yala National Park is a wildlife enthusiast’s dream, offering thrilling safaris to see leopards, elephants, sloth bears, and a variety of bird species. As Sri Lanka’s most popular national park, Yala combines dense jungles, open plains, and coastal lagoons, making it a prime location for wildlife photography and exploration.', '67581114985e7_yala national park.jpg', 1, '2024-12-10 08:36:07'),
(20, 'Bentota', '1 Day Package', 'Galle', 100.00, 'Bentota is a coastal paradise perfect for water sports enthusiasts. With its pristine beaches, calm waters, and lush mangroves, it’s a favorite spot for jet-skiing, diving, and boat safaris. The nearby Brief Garden and Turtle Hatchery are also popular attractions.', '6757ff623aa94_Bentota.jpg', 1, '2024-12-10 08:44:18'),
(21, 'Sigiriya', '1 Day Package', 'Anuradhapura', 100.00, 'Sigiriya, a UNESCO World Heritage Site, is an ancient rock fortress that rises majestically from the plains of central Sri Lanka. Built in the 5th century by King Kashyapa, this iconic site features stunning frescoes, elaborate water gardens, and a lion-shaped gateway. The summit offers breathtaking panoramic views of the surrounding jungle and ruins, making Sigiriya a must-visit for history buffs and nature lovers.', '67580f36568cf_Sigiriya.jpg', 1, '2024-12-10 08:47:09'),
(22, 'Sacred Tooth Relic ', '1 Day Package', 'Kandy', 100.00, 'Located in the heart of Kandy, this sacred Buddhist temple houses the revered tooth relic of Lord Buddha. The Temple of the Sacred Tooth Relic is not only a spiritual center but also an architectural masterpiece adorned with intricate carvings and beautiful shrines. The annual Esala Perahera festival held here is a grand cultural event.', '675800b7b611f_temple-sacred-tooth-relic-kandy-sri-lanka.jpg', 1, '2024-12-10 08:49:59'),
(44, 'Galle Fort', '1 Day Package', 'Galle', 100.00, 'The Galle Fort, located in the coastal city of Galle in southern Sri Lanka, is a UNESCO World Heritage Site and a living testament to the island’s colonial history. Originally built by the Portuguese in 1588 and extensively fortified by the Dutch in the 17th century, the fort is a unique blend of European architectural styles and South Asian cultural influences. This historic landmark spans over 52 hectares and offers a rich blend of history, culture, and stunning coastal views.', '675fc43fa0303_GalleFort.jpg', 1, '2024-12-16 06:10:07'),
(26, 'Anuradhapura', '1 Day Package', 'Anuradhapura', 100.00, 'As one of Sri Lanka’s ancient capitals, Anuradhapura is a treasure trove of archaeological wonders. This UNESCO World Heritage Site is home to sacred stupas, ancient monasteries, and the Sri Maha Bodhi tree, believed to be the world’s oldest historically documented tree.', '675803f824bce_Anuradhapura.jpg', 1, '2024-12-10 09:03:52'),
(27, 'Polonnaruwa', '1 Day Package', 'Polonnaruwa', 100.00, 'Polonnaruwa, another ancient capital, is famous for its well-preserved ruins of palaces, temples, and statues. The Gal Vihara, a group of impressive rock-carved Buddha statues, is a highlight of this UNESCO World Heritage Site.', '6758043460010_polonnaruwa.jpg', 1, '2024-12-10 09:04:52'),
(28, 'Horton Plains and World’s End', '1 Day Package', 'Nuwara Eliya', 100.00, 'Horton Plains National Park is a breathtaking plateau in the central highlands known for its stunning landscapes, rare flora and fauna, and scenic hiking trails. World’s End, a sheer cliff with a drop of over 800 meters, offers a jaw-dropping view on clear mornings.', '675fab60c10ab_Horton Plains and World’s End.jpg', 1, '2024-12-10 09:06:08'),
(31, 'Adams Peak (Sri Pada)', '1 Day Package', 'Ratnapura ', 100.00, 'A sacred pilgrimage site for people of all faiths, Adams Peak is famous for the \"Sacred Footprint\" at its summit, believed to belong to Buddha, Shiva, or Adam, depending on religious beliefs. The climb is challenging but rewarding, especially at sunrise when the views are simply spectacular.', '675806ffc2559_sri-pada-adam-s-peak-sri-lanka.jpg', 1, '2024-12-10 09:16:47'),
(32, 'Jaffna', '1 Day Package', 'Jaffna', 100.00, 'Jaffna, in the northern region of Sri Lanka, is a cultural hub with its rich Tamil heritage, ancient Hindu temples, and stunning beaches. The Nallur Kandaswamy Temple and Jaffna Fort are must-visit landmarks, offering a glimpse into the area’s unique history and traditions.', '67580817ed18b_jaffna-sril-lanka-travel.jpg', 1, '2024-12-10 09:21:27'),
(33, 'Cave Temple', '1 Day Package', 'Dambulla ', 100.00, 'The Dambulla Cave Temple, a UNESCO World Heritage Site, is a mesmerizing complex of cave shrines adorned with intricate frescoes and over 150 statues of Buddha. The temple’s hilltop location provides stunning views of the surrounding countryside.', '675808f6a4b4d_dambulla-cave-temple-architecture-1024x585.jpg', 1, '2024-12-10 09:25:10'),
(34, 'Arugam Bay', '1 Day Package', 'Ampara', 100.00, 'A surfer’s paradise, Arugam Bay on the east coast is renowned for its world-class waves, laid-back atmosphere, and vibrant beachside cafes. It’s also a gateway to exploring nearby lagoons, wildlife, and ancient ruins.', '67580988e3957_Arugambay.jpg', 1, '2024-12-10 09:27:36'),
(43, 'Dehiwala Zoo', '1 Day Package', 'Colombo', 100.00, 'The Dehiwala Zoo, officially known as the National Zoological Gardens of Sri Lanka, is one of the oldest and most well-maintained zoos in Asia. Located in Dehiwala, a suburb of Colombo, this iconic zoo spans over 24 acres and is home to a diverse range of animals, reptiles, birds, and marine life. It serves as a center for recreation, education, and conservation.', '675fada9b1142_Dehiwala.jpg', 1, '2024-12-16 04:33:45'),
(36, 'Pinnawala Elephant Orphanage', '1 Day Package', 'Kegalle ', 100.00, 'Pinnawala Elephant Orphanage is a sanctuary for orphaned and rescued elephants. Visitors can watch these majestic creatures roam freely, bathe in the river, and interact with their caretakers in an ethical environment.', '67580ce1a2e3b_pinnawala-orphanage-was-founded.jpg', 1, '2024-12-10 09:41:53'),
(37, 'Trincomalee', '1 Day Package', 'Trincomalee', 100.00, 'Trincomalee is famous for its natural harbor, pristine beaches like Nilaveli and Uppuveli, and historic sites such as the Koneswaram Temple. It’s also a great spot for whale watching and snorkeling at Pigeon Island.', '67580d44c8c4e_trincomalee-day-tours-in-sri-lanka.jpg', 1, '2024-12-10 09:43:32'),
(38, 'Udawalawe National Park', '1 Day Package', 'Moneragala', 100.00, 'Udawalawe National Park is renowned for its large population of wild elephants. It’s a fantastic safari destination to observe elephants in their natural habitat, along with crocodiles, water buffalo, and colorful birds.', '67580dddbe235_Udawalawe.jpg', 1, '2024-12-10 09:46:05'),
(39, 'Colombo', '1 Day Package', 'Colombo', 100.00, 'The bustling capital city of Sri Lanka, Colombo, is a vibrant mix of modernity and tradition. From historical landmarks like the Gangaramaya Temple to shopping hubs like Pettah Market and upscale malls, Colombo offers something for everyone.', '67580e01c6ec3_Colombo.jpg', 1, '2024-12-10 09:46:41'),
(40, 'Hikkaduwa', '1 Day Package', 'Galle', 100.00, 'Hikkaduwa is a lively beach town famous for its coral reefs, snorkeling, and nightlife. It’s a great spot to enjoy vibrant marine life, indulge in fresh seafood, and soak up the coastal vibes.', '67580e377e0a6_Hikkaduwa.jpg', 1, '2024-12-10 09:47:35');
COMMIT; -- Commit the transaction to save all changes

