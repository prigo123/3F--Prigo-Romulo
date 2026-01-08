<?php
include 'conn.php';
session_start();   
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
if (isset($_POST['logout'])) {
  session_destroy();
  header("Location: index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            height: 100vh;
            width: 200px;
            background-color: #4e73df;
            color: white;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            padding: 1rem;
        }

        .sidebar h3 {
            text-align: center;
            margin-bottom: 2rem;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 0.8rem 1rem;
            border-radius: 5px;
            margin-bottom: 0.5rem;
            display: block;
        }

        .sidebar a:hover {
            background-color: #2e59d9;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>Book Portal</h3>
        <a href="borrow.php">Borrow Book</a>
        <a href="returned.php">Returned Books</a>
        <a href="history.php">History</a>
        <form method="post">
      <button class="dropdown-item" type="submit" name="logout">LOGOUT</button>
    </form>
    </div>
</body>
</html>