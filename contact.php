<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Awaaz of Devbhoomi Charitable Trust</title>

    <!-- Include Bootstrap CSS -->
    <?php include("bootstrap.php"); ?>

    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: rgb(161, 201, 201);;
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

    <?php include('navbar.php'); ?>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Contact Us</h2>
        <div class="row">
            <!-- Contact Information -->
            <div class="col-md-6 mb-4">
                <div class="contact-info">
                    <h4>Get in Touch</h4>
                    <p>
                        <i class="fas fa-phone"></i>
                        <a href="tel:+919876543210" style="text-decoration: none; color: inherit;">+91-9876543210</a>
                    </p>
                    <p>
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:info@awaazdevbhoomi.org"
                            style="text-decoration: none; color: inherit;">info@awaazdevbhoomi.org</a>
                    </p>
                    <p><i class="fas fa-map-marker-alt"></i> Awaaz of Devbhoomi Charitable Trust, Dehradun, Uttarakhand,
                        India</p>


                    <!-- Google Maps -->
                    <h5 class="mt-4">Find Us</h5>
                    <div class="map-container">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3458.9024913171365!2d78.03219181511493!3d30.31649498178257!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3909294f2bbf5337%3A0x65d91a0a6f1c499e!2sDehradun%2C%20Uttarakhand!5e0!3m2!1sen!2sin!4v1602184138566!5m2!1sen!2sin"
                            width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen=""
                            aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-md-6">
                <div class="contact-form">
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