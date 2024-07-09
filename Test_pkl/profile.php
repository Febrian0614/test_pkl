<?php
include 'connect.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

// Retrieve user's current data from the database using the email stored in session
$email = $_SESSION['email'];
$sql = "SELECT * FROM user WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
} else {
    echo "User not found.";
    exit();
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newName = $_POST['name'];

    // Validate and sanitize input
    $newName = filter_var($newName, FILTER_SANITIZE_STRING);

    // Update user's name in the database
    $updateSql = "UPDATE user SET name='$newName' WHERE email='$email'";
    if ($conn->query($updateSql) === TRUE) {
        header("Location: apply.php"); // Redirect to profile page after update
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 50px;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .edit-button {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .mb-3 {
            margin-bottom: 1.5rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="apply.php" class="btn btn-success edit-button">Back</a>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <h1 class="card-header text-center">Edit Profil</h1>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control" name="name" id="name" value="<?= htmlspecialchars($name) ?>" required>
                            </div>
                            <button type="submit" class="btn btn-success">Update Nama</button>
                        </form>
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
