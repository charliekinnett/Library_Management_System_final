<?php
session_start();
include 'db_config.php'; // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $isbn = $_POST["isbn"];
    $publisherID = $_POST["publisherID"];
    $genreID = $_POST["genreID"];
    $publicationYear = $_POST["publicationYear"];
    $availability = isset($_POST["availability"]) ? 1 : 0;

    $sql = "INSERT INTO Book (Title, Author, ISBN, PublisherID, GenreID, PublicationYear, Availability) VALUES ('$title', '$author', '$isbn', '$publisherID', '$genreID', '$publicationYear', '$availability')";

    if ($conn->query($sql) === TRUE) {
        header("Location: create_book.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
