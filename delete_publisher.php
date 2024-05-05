<?php
session_start(); 
include 'db_config.php';

if(isset($_GET['id'])) {
    $publisherID = $_GET['id'];
    
    // SQL to delete a record from the Publisher table
    $sql = "DELETE FROM Publisher WHERE PublisherID = $publisherID";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the Publisher form page after successful deletion
        header("Location: create_publisher.php");
        exit();
    } else {
        // If an error occurs during deletion, display the error message
        echo "Error deleting publisher: " . $conn->error;
    }
}

$conn->close();
?>
