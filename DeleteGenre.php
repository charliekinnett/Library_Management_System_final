<?php
session_start(); 
include 'db_config.php';
$project_id = $_GET['id'];
$sql = "DELETE FROM genre WHERE genreid = $project_id";
if ($conn->query($sql) === TRUE) {
    header("Location: CreateGenre.php");
    exit();
} else {
    echo "Error deleting project: " . $conn->error;
}
$conn->close();
?>