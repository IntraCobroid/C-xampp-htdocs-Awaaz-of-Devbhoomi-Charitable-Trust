<?php
include('navbar.php');
// Folder where the images are stored
$imageFolder = 'img/'; // Add trailing slash

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-color: rgb(161, 201, 201); /* Light grey background */
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center mb-4">Gallery</h2>
    <div class="row">

        <?php
        // Loop through each image and create a Bootstrap card
        foreach ($img as $image) {
            // Select a random description
            $randomDescription = $descriptions[array_rand($descriptions)];
            ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?php echo $image; ?>" class="card-img-top" alt="Image" style="height: 200px; object-fit: cover;">
                    <div class="card-body" style="background-color: #d9eff7;">
                        <p class="card-text"><?php echo $randomDescription; ?></p>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<!-- Footer -->
<?php include('footer.php'); ?>
