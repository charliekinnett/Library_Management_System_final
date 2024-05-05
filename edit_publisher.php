<?php
session_start();
include 'db_config.php';

if (!isset($_GET['id'])) {
    header("Location: create_publisher.php"); // Redirect if publisher ID is not provided
    exit();
}

$publisherID = $_GET['id'];

// Fetch publisher details from the database
$sql = "SELECT * FROM Publisher WHERE PublisherID = $publisherID";
$result = $conn->query($sql);

// Check if publisher exists
if ($result->num_rows == 0) {
    header("Location: create_publisher.php"); // Redirect if publisher does not exist
    exit();
}

$row = $result->fetch_assoc();
$publisherName = $row['PublisherName'];
$address = $row['Address'];
$phoneNumber = $row['PhoneNumber'];
$email = $row['Email'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPublisherName = $_POST["publisherName"];
    $newAddress = $_POST["address"];
    $newPhoneNumber = $_POST["phoneNumber"];
    $newEmail = $_POST["email"];
    
    // Update publisher details in the database
    $sql = "UPDATE Publisher SET PublisherName = '$newPublisherName', Address = '$newAddress', PhoneNumber = '$newPhoneNumber', Email = '$newEmail' WHERE PublisherID = $publisherID";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: create_publisher.php"); // Redirect after successful update
        exit();
    } else {
        echo "Error updating publisher: " . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Publisher</title>
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
        input[type="number"],
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

        .no-projects {
            text-align: center;
            font-style: italic;
        }

        .no-projects td {
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
        <h2>Edit Publisher</h2>
        <form method="post" action="">
            <label for="publisherName">Publisher Name:</label>
            <input type="text" id="publisherName" name="publisherName" value="<?php echo $publisherName; ?>" required><br><br>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo $address; ?>" required><br><br>
            <label for="phoneNumber">Phone Number:</label>
            <input type="tel" id="phoneNumber" name="phoneNumber" value="<?php echo $phoneNumber; ?>" required><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br><br>    
            <input type="submit" value="Update Publisher">
        </form>
    </div>
</body>
</html>
