<?php
session_start();
if (isset($_SESSION["user"])){
    header("Location: index.php");
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
    <title>Login Form</title>
    <style>
        body {
            background-color: #f0f8ff; /* Alice Blue for a very light blue background */
        }
        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            background-color: #fff;
        }
        .login-header {
            background-color: #87ceeb; /* Sky Blue */
            color: #fff;
            text-align: center;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 10px 10px 0 0;
        }
        .login-header h2 {
            margin-bottom: 10px;
        }
        .login-header p {
            color: #f0f8ff; /* Lighter text color for contrast */
        }
        .btn-primary {
            background-color: #87ceeb; /* Sky Blue */
            border-color: #87ceeb; /* Sky Blue */
        }
        .btn-primary:hover {
            background-color: #00bfff; /* Deep Sky Blue on hover */
            border-color: #00bfff;
        }
        .alert {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container login-container">
        <div class="card login-card">
            <div class="login-header">
                <h2>Welcome Back!</h2>
                <p>Please login to your account</p>
            </div>
            <?php
            if (isset($_POST["login"])) {
                $email = $_POST["email"];
                $password = $_POST["password"];
                require_once "database.php";

                $sql = "SELECT email, password FROM users WHERE email = ?";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 's', $email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $db_email, $db_password);
                mysqli_stmt_fetch($stmt);

                if ($db_email) {
                    if (password_verify($password, $db_password)) {
                        $_SESSION["user"] = "yes";
                        header("Location: index.php");
                        exit();
                    } else {
                        echo "<div class='alert alert-danger'>Password does not match</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Email does not exist!</div>";
                }

                mysqli_stmt_close($stmt);
            }
            ?>
            
            <form action="login.php" method="post">
                <div class="form-group mb-3">
                    <input type="email" placeholder="Enter Email" name="email" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <input type="password" placeholder="Enter Password" name="password" class="form-control" required>
                </div>
                <div class="form-btn mb-3">
                    <input type="submit" value="Login" name="login" class="btn btn-primary w-100">
                </div>
            </form>
            <div class="text-center">
                <p>Not registered yet? <a href="registration.php">Register here</a></p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+2Iu5H7e2B44pBymZ9GU6EIx56t7m" crossorigin="anonymous"></script>
</body>
</html>
