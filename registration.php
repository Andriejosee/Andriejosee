<?php
session_start();
if (isset($_SESSION["user"])){
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            max-width: 500px;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-primary {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
    <?php
    if (isset($_POST["submit"])) {
        $FirstName = $_POST["FirstName"];
        $LastName = $_POST["LastName"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $password_Hash = password_hash($password, PASSWORD_DEFAULT);
        $errors = array();
        
        if (empty($FirstName) OR empty($LastName) OR empty($email) OR empty($password)) {
            array_push($errors, "All fields are required");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
        }
        if (strlen($password) < 8) {
            array_push($errors, "Password must be at least 8 characters long");
        }
        require_once "database.php";
        $sql ="SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($result);
        if ($rowCount>0) {
            array_push($errors,"Email already exist!");
        }

        if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } else {
            require_once "database.php";
            $sql = "INSERT INTO users (First_Name, Last_Name, email, password) VALUES (?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt, "ssss", $FirstName, $LastName, $email, $password_Hash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You are registered successfully.</div>";
            } else {
                echo "<div class='alert alert-danger'>Something went wrong. Please try again later.</div>";
            }
        }
    }
    ?>
    
    <form action="registration.php" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="FirstName" placeholder="First Name" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="LastName" placeholder="Last Name" required>
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email" required>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Register" name="submit">
        </div>
    </form>
    <div><p>Already have an account? <a href="login.php">Sign in here</a></p></div>
    </div>
</html>
