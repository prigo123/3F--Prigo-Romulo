<?php
include 'sidebar.php';
include 'conn.php';

$date = date('Y-m-d');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['book_id']) && !empty($_POST['return_date'])) {
        $book_id = $_POST['book_id'];
        $return_date = $_POST['return_date'];

        $sql = "UPDATE borrow_records SET return_date='$return_date' WHERE book_id='$book_id' AND return_date IS NULL";

        if ($conn->query($sql) === TRUE) {
            if ($conn->affected_rows > 0) {
                echo "<script>alert('Book marked as returned successfully.');</script>";
            } else {
                echo "<script>alert('No matching borrowed book found or book already returned.');</script>";
            }
        } else {
            echo "<script>alert('Error occurred while updating the return record.');</script>";
        }
    } else {
        echo "<script>alert('All fields are required.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-left: 11%;
        }

        body {
            background: #f5f5f5;
            font-family: Arial, sans-serif;
            padding: 2rem;
        }

        .return-box {
            background: #fff;
            padding: 2rem;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            position: fixed;
            right: 51%;
            left: 15%;
        }

        .return-box h2 {
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

        table {
            width: 100%;
            margin-top: 1rem;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 0.8rem;
            text-align: center;
            border-bottom: 1px solid #ddd;
            color: black !important;
        }

        th {
            background-color: #4e73df;
            color: white;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row g-4">
        <div class="col-md-5">
            <div class="return-box">
                <h2>Return a Book</h2>
                <form method="post">
                    <input type="text" name="book_id" class="form-control" placeholder="Book ID" required autocomplete="off">
                    <input type="date" name="return_date" class="form-control" value="<?php echo $date ?>" required autocomplete="off">
                    <button type="submit" class="btn btn-primary w-100">Mark as Returned</button>
                </form>
            </div>
        </div>
        <div class="col-md-7">
            <h3 class="text-center mb-3">Books Not Yet Returned</h3>

            <form method="GET" class="mb-3 d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search by Book Title or Borrower" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" autocomplete="off">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Book ID</th>
                        <th>Book Title</th>
                        <th>Borrower</th>
                        <th>Borrow Date</th>
                        <th>Required Return</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
                    $sql = "SELECT * FROM borrow_records WHERE return_date IS NULL";

                    if (!empty($search)) {
                        $sql .= " AND (book_title LIKE '%$search%' OR borrower_name LIKE '%$search%')";
                    }

                    $sql = "SELECT * FROM borrow_records WHERE return_date IS NULL";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['book_id']}</td>
                                    <td>{$row['book_title']}</td>
                                    <td>{$row['borrower_name']}</td>
                                    <td>{$row['borrow_date']}</td>
                                    <td>{$row['required_return_date']}</td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No unreturned books found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
