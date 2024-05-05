<?php
include 'db_config.php'; // Include your database connection file
?>
<!DOCTYPE html>
<html>
<head>
    <title>Book Management</title>
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
        input[type="checkbox"],
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

        .no-books {
            text-align: center;
            font-style: italic;
        }

        .no-books td {
            padding: 20px;
        }

        .edit-link,
        .delete-link {
            display: inline-block;
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 3px;
        }

        .edit-link:hover,
        .delete-link:hover {
            background-color: #45a049;
        }

        .delete-link {
            background-color: #f44336;
        }

        .delete-link:hover {
            background-color: #d32f2f;
        }

        /* Add more styles as needed */
    </style>
</head>
<body>
    <?php include 'menu.php'; ?> <!-- Include menu.php for navigation menu -->
    <br />
    <div class="container">
        <h2>Create Book</h2>
        <form method="post" action="process_book.php">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required><br><br>
            <label for="author">Author:</label>
            <input type="text" id="author" name="author" required><br><br>
            <label for="isbn">ISBN:</label>
            <input type="text" id="isbn" name="isbn" required><br><br>
            <label for="publisherID">Publisher:</label>
            <select id="publisherID" name="publisherID" required>
                <option value="">Select Publisher</option>
                <?php
                // Fetch publishers from the database and populate the dropdown
                $sql = "SELECT * FROM Publisher";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['PublisherID'] . "'>" . $row['PublisherName'] . "</option>";
                }
                ?>
            </select><br><br>
            <label for="genreID">Genre:</label>
            <select id="genreID" name="genreID" required>
                <option value="">Select Genre</option>
                <?php
                // Fetch genres from the database and populate the dropdown
                $sql = "SELECT * FROM Genre";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['GenreID'] . "'>" . $row['GenreName'] . "</option>";
                }
                ?>
            </select><br><br>
            <label for="publicationYear">Publication Year:</label>
            <input type="text" id="publicationYear" name="publicationYear" required><br><br>
            <label for="availability">Availability:</label>
            <input type="checkbox" id="availability" name="availability" value="1"><br><br>
            <input type="submit" value="Create Book">
        </form>
        <h2>Book List</h2>
        <?php
        $sql = "SELECT * FROM Book";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Title</th>
            <th>Author</th>
            <th>ISBN</th>
            <th>Publisher</th>
            <th>Genre</th>
            <th>Publication Year</th>
            <th>Availability</th>
            <th>Edit</th><th>Delete</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row['Title']."</td>";
                echo "<td>".$row['Author']."</td>";
                echo "<td>".$row['ISBN']."</td>";
                echo "<td>".$row['PublisherID']."</td>";
                echo "<td>".$row['GenreID']."</td>";
                echo "<td>".$row['PublicationYear']."</td>";
                echo "<td>".$row['Availability']."</td>";
                echo "<td><a class='edit-link' href='edit_book.php?id=".$row['BookID']."'>Edit</a></td>";
                echo "<td><a class='delete-link' href='delete_book.php?id=".$row['BookID']."'>Delete</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p class='no-books'>No books found</p>";
        }
        ?>
    </div>
</body>
</html>
