<?php
include 'sidebar.php';
include 'conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowing History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-left: 10%;
        }

        body {
            background: #f5f5f5;
            font-family: Arial, sans-serif;
            padding: 2rem;
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

        .btn-primary {
            background: #4e73df;
            border: none;
        }

        .btn-primary:hover {
            background: #2e59d9;
        }
        .search-a{
            padding: 0.5rem;
            border-radius: 50px;
            border: 1px solid #ccc;
            width: 250px;
            margin-right: 0.5rem;
            position: relative;
            left:70% ;
            right: -10px;
        }   
        #search-b{
            position: relative;
            left: 70%;
            right: -10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="text-center mb-4">Borrowing and Returning History</h2>

    <form method="GET">
        <input type="text" name="search" class="search-a" placeholder="Search by Book Title or Borrower" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>" autocomplete="off">
        <button type="submit" id="search-b" class="btn btn-primary">Search</button>
    </form>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Book ID</th>
                <th>Book Title</th>
                <th>Borrower</th>
                <th>Borrow Date</th>
                <th>Required Return</th>
                <th>Return Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
            $sql = "SELECT * FROM borrow_records";

            if (!empty($search)) {
                $sql .= " WHERE book_title LIKE '%$search%' OR borrower_name LIKE '%$search%'";
            }

            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['book_id']}</td>
                            <td>{$row['book_title']}</td>
                            <td>{$row['borrower_name']}</td>
                            <td>{$row['borrow_date']}</td>
                            <td>{$row['required_return_date']}</td>
                            <td>" . ($row['return_date'] ? $row['return_date'] : 'Not Returned') . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No records found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>