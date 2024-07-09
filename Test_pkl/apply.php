<?php
include 'connect.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Retrieve user's name from the database using the email stored in session
$email = $_SESSION['email'];
$sql = "SELECT name FROM user WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
} else {
    $name = "User"; // Default name if not found in the database
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            padding: 50px;
            background-color: #f8f9fa;
        }

        .nav-item {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .profil {
            position: absolute;
            top: 20px;
            left: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Logout</a>
                        </li>
                        <li class="profil">
                            <a class="nav-link" href="profile.php">Edit Profil</a>
                        </li>
                    </ul>
                    <div>
                        <h3>Halo, <?= htmlspecialchars($name) ?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-e6HlGr5czF02rwQn5z2hAPYoO6O+VbZ/6jrnzF5xIKm4WgHdiVgag5S04jbQ"
        crossorigin="anonymous"></script>
</body>

</html>
