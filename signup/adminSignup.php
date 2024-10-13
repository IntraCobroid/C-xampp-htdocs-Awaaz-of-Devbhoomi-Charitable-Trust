<?php 
require_once "../pdo.php";
session_start();

if (isset($_POST['cancel'])) {
    header('Location: ../login/adminLogin.php');
    return;
}

if (isset($_POST['username'])) {
    if ((strlen($_POST['username']) > 0) && (strlen($_POST['password']) > 0)) {
        $stmt5 = $pdo->query("SELECT `username` FROM `admin_login` WHERE `username`= '" . $_POST['username'] . "';");
        $rows5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);
        if (count($rows5) > 0) {
            $_SESSION['error'] = "Username Already Exists. Choose a different username.";
            header('Location: adminSignup.php');
            return;
        }

        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['city']) && isset($_POST['phone'])) {
            if ((strlen($_POST['name']) > 0) && (strlen($_POST['email']) > 0) && (strlen($_POST['city']) > 0) && (strlen($_POST['phone']) > 0)) {
                $stmt5 = $pdo->query("SELECT `email` FROM `admin` WHERE `email`= '" . $_POST['email'] . "';");
                $rows5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);
                if (count($rows5) > 0) {
                    $_SESSION['error'] = "Email Already Exists. Choose a different email.";
                    header('Location: adminSignup.php');
                    return;
                }

                $stmt5 = $pdo->query("SELECT `phone` FROM `admin` WHERE `phone`= '" . $_POST['phone'] . "';");
                $rows5 = $stmt5->fetchAll(PDO::FETCH_ASSOC);
                if (count($rows5) > 0) {
                    $_SESSION['error'] = "Phone Already Exists. Choose a different phone.";
                    header('Location: adminSignup.php');
                    return;
                }

                $stmt = $pdo->prepare('INSERT INTO admin (name,email,city_id,phone) VALUES (:nm, :em, :ci, :ph)');
                $stmt->execute(array(
                    ':nm' => $_POST['name'],
                    ':em' => $_POST['email'],
                    ':ci' => $_POST['city'],
                    ':ph' => $_POST['phone'])
                );

                $stmt3 = $pdo->query("SELECT * FROM `admin` WHERE `admin_id`= (SELECT MAX(`admin_id`) FROM `admin`)");
                $rows2 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                if (($_POST['email'] != $rows2[0]['email']) || ($_POST['phone'] != $rows2[0]['phone'])) {
                    $_SESSION['error'] = "Something went wrong. Please try again.";
                    header('Location: adminSignup.php');
                    return;
                }

                $stmt1 = $pdo->prepare('INSERT INTO admin_login(username,password,admin_id) VALUES (:ur, :pw, :dn)');
                $stmt1->execute(array(
                    ':ur' => $_POST['username'],
                    ':pw' => $_POST['password'],
                    ':dn' => $rows2[0]['admin_id'],)
                );
                
                $_SESSION['success'] = "Record inserted successfully.";
                header('Location: ../login/adminLogin.php');
            } else {
                $_SESSION['error'] = "All fields are required.";
                header("Location: adminSignup.php");
                return;         
            }
        }
    }
}

$stmt3 = $pdo->query("SELECT * FROM city");
$rows = $stmt3->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Signup</title>
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
        .btn-custom {
            background-color: rgb(161, 201, 201); 
            color: white; 
            border-radius: 5px; 
            font-size: 16px;
            padding: 10px; 
            margin-top: 10px;
        }
        .btn-custom:hover {
            background-color: rgb(141, 181, 181);
        }
        .btn-secondary {
            background-color: #6c757d; 
            color: white;
            border-radius: 5px; 
            padding: 10px; 
            margin-top: 10px; 
        }
        .btn-secondary:hover {
            background-color: #5a6268; 
        }
    </style>
</head>
<body class="text-center">

    <div class="container">
    <h1 class="mt-5">Admin Signup</h1>
    <p class="lead">Please enter your credentials to sign.</p>

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
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" name="phone" id="phone" required>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <select id="city" name="city" class="form-control" required>
                    <?php
                    foreach($rows as $row){
                        echo "<option value = " . $row['city_id'] . ">";
                        echo htmlentities($row['cname']);
                        echo "</option>";
                    } 
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-custom btn-lg btn-block">Submit</button>
            <button type="submit" class="btn btn-secondary btn-lg btn-block" name="cancel">Cancel</button>
        </form>

        <a class="btn btn-link mt-3" href="../login/adminLogin.php">Already have an account? Log in »</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
