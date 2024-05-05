<?php
session_start(); 
include 'db_config.php';

if(isset($_GET['id'])) {
    $bookID = $_GET['id'];
    
    // SQL to delete a record from the Book table
    $sql = "DELETE FROM Book WHERE BookID = $bookID";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the create_book.php page after successful deletion
        header("Location: create_book.php");
        exit();
    } else {
        // If an error occurs during deletion, display the error message
        echo "Error deleting book: " . $conn->error;
    }
}

$conn->close();
?>
