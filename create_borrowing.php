<?php
include 'db_config.php'; // Include your database connection file
?>
<!DOCTYPE html>
<html>
<head>
    <title>Borrowing Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        .no-borrowings {
            text-align: center;
            font-style: italic;
        }

        .no-borrowings td {
            padding: 20px;
        }

        /* Add more styles as needed */
    </style>
</head>
<body>
    <?php include 'menu2.php'; ?> <!-- Include menu.php for navigation menu -->
    <br />
    <div class="container">
        <h2>Create Borrowing</h2>
        <form method="post" action="process_borrowing.php">
            <label for="memberID">Member:</label>
            <select id="memberID" name="memberID" required>
                <option value="">Select Member</option>
                <?php
                // Fetch members from the database and populate the dropdown
                $sql = "SELECT * FROM Member";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['MemberID'] . "'>" . $row['Name'] . "</option>";
                }
                ?>
            </select><br><br>
            <label for="bookID">Book:</label>
            <select id="bookID" name="bookID" required>
                <option value="">Select Book</option>
                <?php
                // Fetch books from the database and populate the dropdown
                $sql = "SELECT * FROM Book";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['BookID'] . "'>" . $row['Title'] . "</option>";
                }
                ?>
            </select><br><br>
            <label for="librarianID">Librarian:</label>
            <select id="librarianID" name="librarianID" required>
                <option value="">Select Librarian</option>
                <?php
                // Fetch librarians from the database and populate the dropdown
                $sql = "SELECT * FROM Librarian";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['LibrarianID'] . "'>" . $row['Name'] . "</option>";
                }
                ?>
            </select><br><br>
            <label for="checkOutDate">Check Out Date:</label>
            <input type="date" id="checkOutDate" name="checkOutDate" required><br><br>
            <label for="dueDate">Due Date:</label>
            <input type="date" id="dueDate" name="dueDate" required><br><br>
            <input type="submit" value="Create Borrowing">
        </form>
        <h2>Borrowing List</h2>
        <?php
        $sql = "SELECT BorrowingID, MemberID, BookID, LibrarianID, CheckOutDate, DueDate, DueDate as ReturnDate FROM Borrowing;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Borrowing ID</th>
            <th>Member ID</th>
            <th>Book ID</th>
            <th>Librarian ID</th>
            <th>Check Out Date</th>
            <th>Due Date</th>
            <th>Return Date</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['BorrowingID']."</td>";
                echo "<td>".$row['MemberID']."</td>";
                echo "<td>".$row['BookID']."</td>";
                echo "<td>".$row['LibrarianID']."</td>";
                echo "<td>".$row['CheckOutDate']."</td>";
                echo "<td>".$row['DueDate']."</td>";
                echo "<td>".$row['ReturnDate']."</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='no-borrowings'>No borrowings found</p>";
        }
        ?>
    </div>
</body>
</html>
