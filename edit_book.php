<?php
session_start();
include 'db_config.php';

if (!isset($_GET['id'])) {
    header("Location: create_book.php"); // Redirect if book ID is not provided
    exit();
}

$bookID = $_GET['id'];

// Fetch book details from the database
$sql = "SELECT * FROM `book` inner join genre on genre.GenreID = book.GenreID inner join publisher on publisher.PublisherID = book.PublisherID WHERE BookID = $bookID";
$result = $conn->query($sql);

// Check if book exists
if ($result->num_rows == 0) {
    header("Location: create_book.php"); // Redirect if book does not exist
    exit();
}

$row = $result->fetch_assoc();
$bookTitle = $row['Title'];
$author = $row['Author'];
$genre = $row['GenreID'];
$publisher = $row['PublisherID'];
$publicationYear = $row['PublicationYear'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newBookTitle = $_POST["bookTitle"];
    $newAuthor = $_POST["author"];
    $newGenre = $_POST["genre"];
    $newPublisher = $_POST["publisher"];
    $newPublicationYear = $_POST["publicationYear"];
    
    // Update book details in the database
    $sql = "UPDATE Book SET Title = '$newBookTitle', Author = '$newAuthor', GenreID = '$newGenre', PublisherID = '$newPublisher', PublicationYear = '$newPublicationYear' WHERE BookID = $bookID";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: create_book.php"); // Redirect after successful update
        exit();
    } else {
        echo "Error updating book: " . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Book</title>
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
        input[type="tel"],
        input[type="email"] {
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

        .no-publishers {
            text-align: center;
            font-style: italic;
        }

        .no-publishers td {
            padding: 20px;
        }

        a {
            text-decoration: none;
            color: #0366d6;
        }

        a:hover {
            text-decoration: underline;
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

        .menu {
            background-color: #333;
            overflow: hidden;
            position: fixed;
            top: 0;
            width: 100%;
        }

        .menu ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        .menu li {
            float: left;
        }

        .menu li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .menu li a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <?php include 'menu.php'; ?> <!-- Include menu.php for navigation menu -->
    <br />
    <div class="container">
        <h2>Edit Book</h2>
        <form method="post" action="">
            <label for="bookTitle">Book Title:</label>
            <input type="text" id="bookTitle" name="bookTitle" value="<?php echo $bookTitle; ?>" required><br><br>
            <label for="author">Author:</label>
            <input type="text" id="author" name="author" value="<?php echo $author; ?>" required><br><br>
            <label for="genre">Genre:</label>
            <input type="text" id="genre" name="genre" value="<?php echo $genre; ?>" required><br><br>
            <label for="publisher">Publisher:</label>
            <input type="text" id="publisher" name="publisher" value="<?php echo $publisher; ?>" required><br><br>
            <label for="publicationYear">Publication Year:</label>
            <input type="text" id="publicationYear" name="publicationYear" value="<?php echo $publicationYear; ?>" required><br><br>    
            <input type="submit" value="Update Book">
        </form>
    </div>
</body>
</html>
