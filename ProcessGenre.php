<?php
session_start();
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $GenreName = $_POST["GenreName"];
    
    $sql = "INSERT INTO genre (GenreName) VALUES ('$GenreName')";  
    if ($conn->query($sql) === TRUE) {
        header("Location: CreateGenre.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>