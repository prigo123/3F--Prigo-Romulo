<?php
session_start();
include 'conn.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
        if (!empty($_POST['name']) && !empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {
            $name = $_POST['name'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql = "INSERT INTO users (name, username, email, password) VALUES ('$name', '$username', '$email', '$password')";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Registered successfully. Please login.');</script>";
            } else {
                echo "<script>alert('Username or email already exists or error occurred.');</script>";
            }
        } else {
            echo "<script>alert('All fields are required.');</script>";
        }
    }

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            if ($_SESSION['role'] == 'admin') {
                echo "<script>alert('Login successful!'); window.location.href='admin_dashboard.php';</script>";
            } else {
                echo "<script>alert('Login successful!'); window.location.href='borrow.php';</script>";
            }
        } else {
            echo "<script>alert('Invalid username or password.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f5f5;
            font-family: Arial, sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            background: #fff;
            padding: 2rem;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 380px;
            border-radius: 10px;
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #333;
        }

        .form-control {
            margin-bottom: 1rem;
            border-radius: 50px;
            padding: 0.9rem;
            font-size: 1rem;
        }

        .btn {
            border-radius: 50px;
            padding: 1rem;
            font-size: 1.1rem;
        }

        .btn-primary {
            background: #4e73df;
            border: none;
        }

        .btn-primary:hover {
            background: #2e59d9;
        }

        .login-footer {
            text-align: center;
            margin-top: 1.5rem;
        }

        .login-footer a {
            color: #4e73df;
            text-decoration: none;
            font-weight: bold;
        }

        .modal-header {
            background-color: #4e73df;
            color: white;
            border-radius: 8px 8px 0 0;
        }

        .modal-body {
            padding: 2rem;
        }

        .modal-footer {
            text-align: center;
        }

        .modal-footer .btn {
            width: 100%;
        }
    </style>
</head>
<body>
<div class="login-box">
    <h2>Welcome to Book Portal</h2>
    <form method="post">
        <input type="text" name="username" class="form-control" placeholder="Username" required autocomplete="off">
        <input type="password" name="password" class="form-control" placeholder="Password" required autocomplete="off">
        <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
    </form>
    <div class="login-footer">
        <p>New here? <a href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Register Here</a></p>
    </div>
</div>
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerModalLabel">Register</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <input type="text" name="name" class="form-control mb-3" placeholder="Full Name" required>
                    <input type="text" name="username" class="form-control mb-3" placeholder="Username" required>
                    <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
                    <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
                    <button type="submit" name="register" class="btn btn-primary w-100">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>