<?php
session_start();
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $memberID = $_POST["memberID"];
    $bookID = $_POST["bookID"];
    $librarianID = $_POST["librarianID"];
    $checkOutDate = $_POST["checkOutDate"];
    $dueDate = $_POST["dueDate"];
    
    // SQL to insert a new borrowing record
    $sql = "INSERT INTO Borrowing (MemberID, BookID, LibrarianID, CheckOutDate, DueDate) 
            VALUES ('$memberID', '$bookID', '$librarianID', '$checkOutDate', '$dueDate')";
    
    if ($conn->query($sql) === TRUE) {
        // Redirect back to the borrowing form page after successful insertion
        header("Location: create_borrowing.php");
        exit();
    } else {
        // If an error occurs during insertion, display the error message
        echo "Error borrowing book: " . $conn->error;
    }
}

$conn->close();
?>
