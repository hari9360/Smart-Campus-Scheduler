<?php
session_start();

// If the user is already logged in, redirect them to the index page
if (isset($_SESSION['login_user'])) {
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="img/logo.png" rel="icon">
    <title>College Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f4f6f9;
        }

        .login-container {
            background: #ffffff;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        .login-container h2 {
            font-weight: bold;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .form-control {
            border-radius: 30px;
            padding: 12px;
            font-size: 1rem;
        }

        .btn-login {
            background-color: #2980b9;
            color: white;
            border-radius: 30px;
            padding: 12px;
            font-size: 1rem;
            width: 100%;
            transition: 0.3s;
        }

        .btn-login:hover {
            background-color: #1f618d;
        }

        .error-message {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-top: 10px;
        }

        .icons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .icons i {
            font-size: 2rem;
            color: #3498db;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="icons">
            <i class="fas fa-book"></i>
            <i class="fas fa-laptop"></i>
            <i class="fas fa-university"></i>
        </div>
        <h2>College Login</h2>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <input type="text" name="u_id" class="form-control" placeholder="Phone Number" required>
            </div>
            <div class="mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" name="submit" class="btn btn-login">Login</button>
        </form>
        <div class="error-message">
            <?php
            if (isset($_SESSION['error'])) {
                echo $_SESSION['error'];
                unset($_SESSION['error']);
            }
            ?>
        </div>
    </div>
</body>
</html>
