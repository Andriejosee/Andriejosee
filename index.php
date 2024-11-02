<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>User Dashboard</title>
    <style>
        .container {
            margin-top: 50px;
        }
        .navbar {
            margin-bottom: 30px;
            background-color: #87ceeb; /* Sky Blue */
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .nav-link.btn-warning {
            color: white !important;
            background-color: #00bfff !important; /* Deep Sky Blue */
            border-color: #00bfff !important;
        }
        .nav-link.btn-warning:hover {
            background-color: #1e90ff !important; /* Dodger Blue */
            border-color: #1e90ff !important;
        }
        h1, p {
            color: #333;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">Sample</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="settings.php">Settings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-warning ms-2" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center">Welcome!</h1>
        <p class="text-center">Hello, <?php echo isset($_SESSION["user"]["FirstName"]) ? htmlspecialchars($_SESSION["user"]["FirstName"]) : "User"; ?>!</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+2Iu5H7e2B44pBymZ9GU6EIx56t7m" crossorigin="anonymous"></script>
</body>
</html>
