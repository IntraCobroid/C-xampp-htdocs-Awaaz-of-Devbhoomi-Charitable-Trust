<?php 
require_once "../pdo.php";
session_start();

if (isset($_POST['cancel'])) {
    header('Location: ../login/volunteerLogin.php');
    return;
}

if (isset($_POST['username'])) {
    if (strlen($_POST['username']) > 0) {
        // Check if username already exists
        $stmt5 = $pdo->prepare("SELECT `username` FROM `volunteer_login` WHERE `username` = :username");
        $stmt5->execute([':username' => $_POST['username']]);
        $rows5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows5) > 0) {
            $_SESSION['error'] = "Username Already Exists. Choose a different username.";
            header('Location: volunteerSignup.php');
            return;
        }

        // Validate other input fields
        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['intrests']) && isset($_POST['date']) && isset($_POST['city']) && isset($_POST['phone'])) {
            if ((strlen($_POST['name']) > 0) && (strlen($_POST['email']) > 0) && (strlen($_POST['intrests']) > 0) && (strlen($_POST['date']) > 0) && (strlen($_POST['city']) > 0) && (strlen($_POST['phone']) > 0)) {
                
                // Check if email already exists
                $stmt5 = $pdo->prepare("SELECT `email` FROM `volunteer` WHERE `email` = :email");
                $stmt5->execute([':email' => $_POST['email']]);
                $rows5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);
                if (count($rows5) > 0) {
                    $_SESSION['error'] = "Email Already Exists. Choose a different email.";
                    header('Location: volunteerSignup.php');
                    return;
                }

                // Check if phone already exists
                $stmt5 = $pdo->prepare("SELECT `phone` FROM `volunteer` WHERE `phone` = :phone");
                $stmt5->execute([':phone' => $_POST['phone']]);
                $rows5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);
                if (count($rows5) > 0) {
                    $_SESSION['error'] = "Phone number Already Exists. Choose a different phone.";
                    header('Location: volunteerSignup.php');
                    return;
                }

                // Insert volunteer information
                $stmt = $pdo->prepare('INSERT INTO volunteer (name, email, intrests, dob, city_id, phone) VALUES (:nm, :em, :inn, :db, :ci, :ph)');
                $stmt->execute(array(
                    ':nm' => $_POST['name'],
                    ':em' => $_POST['email'],
                    ':inn' => $_POST['intrests'],
                    ':db' => $_POST['date'],
                    ':ci' => $_POST['city'],
                    ':ph' => $_POST['phone'])
                );

                // Get the latest volunteer ID
                $stmt3 = $pdo->query("SELECT * FROM `volunteer` WHERE `volunteer_id` = (SELECT MAX(`volunteer_id`) FROM `volunteer`)");
                $rows2 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                if (count($rows2) == 0 || ($_POST['email'] != $rows2[0]['email']) || ($_POST['phone'] != $rows2[0]['phone'])) {
                    $_SESSION['error'] = "Something went wrong. Please try again.";
                    header('Location: volunteerSignup.php');
                    return;
                }

                // Insert volunteer login information
                $stmt1 = $pdo->prepare('INSERT INTO volunteer_login (username, password, volunteer_id) VALUES (:ur, :pw, :dn)');
                $stmt1->execute(array(
                    ':ur' => $_POST['username'],
                    ':pw' => $_POST['password'],
                    ':dn' => $rows2[0]['volunteer_id'])
                );

                $_SESSION['success'] = "Record inserted successfully.";
                header('Location: ../login/volunteerLogin.php');
                exit();
            } else {
                $_SESSION['error'] = "All fields are required.";
                header("Location: volunteerSignup.php");
                return;         
            }
        }
    }
}

// Fetch city data
$stmt3 = $pdo->query("SELECT * FROM city");
$rows = $stmt3->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Signup</title>
    <link rel="stylesheet" href="../bootstrap/css/style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: rgb(161, 201, 201); /* Light background color */
        }
        .form-signin {
            width: 100%;
            max-width: 400px; /* Max width for form */
            padding: 15px;
            margin: auto; /* Center form */
            border-radius: 8px; /* Rounded corners */
            background: white; /* White background for form */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
    </style>
</head>
<body class="text-center">

    <div class="container">
        <h1 class="mt-5">Volunteer Signup</h1>
        <p class="lead">Please enter your credentials to sign up.</p>

        <?php 
            // Display success or error messages
            if (isset($_SESSION['success'])) {
                echo '<div class="alert alert-success" role="alert">';
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                echo '</div>';
            }

            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger" role="alert">';
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                echo '</div>';
            }
        ?>

        <form class="form-signin" method="post">
            <img class="mb-4" src="../images/index/logo.png" alt="Logo" width="72" height="72">

            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="intrests">Interests:</label>
                <input type="text" class="form-control" name="intrests" id="intrests" required>
            </div>
            <div class="form-group">
                <label for="date">Date of Birth:</label>
                <input type="date" class="form-control" name="date" id="date" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" name="phone" id="phone" required>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <select id="city" name="city" class="form-control" required>
                    <?php foreach ($rows as $row): ?>
                        <option value="<?= htmlentities($row['city_id']); ?>">
                            <?= htmlentities($row['cname']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-lg btn-primary btn-block">Submit</button>
            <button type="submit" name="cancel" class="btn btn-lg btn-secondary btn-block">Cancel</button>
        </form>
    </div>
</body>
</html>
