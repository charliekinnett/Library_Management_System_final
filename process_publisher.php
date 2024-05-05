<?php
session_start();
include 'db_config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $publisherName = $_POST["publisherName"];
    $address = $_POST["address"];
    $phoneNumber = $_POST["phoneNumber"];
    $email = $_POST["email"];
    
    $sql = "INSERT INTO Publisher (PublisherName, Address, PhoneNumber, Email) VALUES ('$publisherName', '$address', '$phoneNumber', '$email')";  
    if ($conn->query($sql) === TRUE) {
        header("Location: create_publisher.php"); // Redirect to the Publisher form page
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
