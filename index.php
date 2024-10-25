<?php 
session_start();
require_once "./pdo.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Awaaz of Devbhoomi Charitable Trust</title>
    
    <?php include("bootstrap.php"); ?>
    <link rel="stylesheet" href="bootstrap/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            background-color: rgb(161, 201, 201);
        }

        .contact-info i {
            font-size: 1.5rem;
            color: #17a2b8;
            margin-right: 10px;
        }

        .map-container {
            height: 400px;
            width: 100%;
            margin-top: 20px;
        }

        .contact-form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<?php
if (isset($_SESSION['volunteer_id'])) {
    require_once "volunteerIndex.php";
} else if (isset($_SESSION['admin_id'])) {
    require_once "./adminIndex2.php";
} else if (isset($_SESSION['donor_id'])) {
    require_once "donorIndex.php";  
} else {
    require_once "./navbar.php";
    require_once "./carousel.php";
}
?>

<!-- Gallery Section -->
<div class="container mt-5">
    <h2 class="text-center mb-4">Gallery</h2>
    <div class="row">

        <?php
        // Folder where the images are stored
        $imageFolder = 'img/';
        // Fetch all image files from the folder
        $img = glob($imageFolder . "*.{jpg,png,gif,jpeg}", GLOB_BRACE);
        // Array of random descriptions
        $descriptions = [
            "A beautiful sunrise over the mountains.",
            "A serene lake surrounded by trees.",
            "An amazing cityscape at night.",
            "Colorful flowers in full bloom.",
            "A breathtaking view of the ocean.",
            "A cozy cabin in the woods.",
            "A vibrant sunset on the beach.",
            "A snowy landscape in winter.",
            "A bustling market filled with life.",
            "An enchanting forest path."
        ];

        // Limit the number of images displayed to 6
        $displayLimit = 6;
        $imageCount = count($img);

        // Loop through images and display them as Bootstrap cards
        for ($i = 0; $i < min($displayLimit, $imageCount); $i++) {
            $image = $img[$i];
            // Select a random description
            $randomDescription = $descriptions[array_rand($descriptions)];
            ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?php echo $image; ?>" class="card-img-top" alt="Image" style="height: 200px; object-fit: cover;">
                    <div class="card-body"  style="background-color: #d9eff7;">
                        <p class="card-text"><?php echo $randomDescription; ?></p>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

    <!-- Show "View All Gallery" button if there are more than 6 images -->
    <?php if ($imageCount > 6) : ?>
        <div class="text-center mt-4">
            <a href="gallery.php" class="btn btn-success">View All Gallery</a>
        </div>
    <?php endif; ?>
</div>

<!-- Contact Section -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <h4>Get in Touch</h4>
            <p>
                <i class="fas fa-phone"></i>
                <a href="tel:+919368080321" style="text-decoration: none; color: inherit;">+91-9368080321</a>
            </p>
            <p>
                <i class="fas fa-envelope"></i>
                <a href="mailto:awaazofdevbhoomi@gmail.com" style="text-decoration: none; color: inherit;">awaazofdevbhoomi@gmail.com</a>
            </p>
            <p><i class="fas fa-map-marker-alt"></i> Awaaz of Devbhoomi Charitable Trust, Dehradun, Uttarakhand, India</p>

            <!-- Google Maps -->
            <h5 class="mt-4">Find Us</h5>
            <div class="map-container">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3458.9024913171365!2d78.03219181511493!3d30.31649498178257!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3909294f2bbf5337%3A0x65d91a0a6f1c499e!2sDehradun%2C%20Uttarakhand!5e0!3m2!1sen!2sin!4v1602184138566!5m2!1sen!2sin"
                    width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false"
                    tabindex="0"></iframe>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="col-md-6" >
            <div class="contact-form" style="background-color: #d9eff7;">
                <h4>Send Us a Message</h4>
                <form action="processContact.php" method="POST">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<?php include('footer.php'); ?>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
