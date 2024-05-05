<?php
include 'db_config.php'; // Include your database connection file
?>
<!DOCTYPE html>
<html>
<head>
    <title>Publisher Management</title>
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
<?php include 'menu.php' ?>
<br />
<div class="container">
    <h2>Publisher</h2>
    <form method="post" action="process_publisher.php">
        <label for="publisherName">Publisher Name:</label>
        <input type="text" id="publisherName" name="publisherName" required><br><br>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required><br><br>
        <label for="phoneNumber">Phone Number:</label>
        <input type="tel" id="phoneNumber" name="phoneNumber" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <input type="submit" value="Create Publisher">
    </form>
    <h2>Publisher List</h2>
    <?php
    $sql = "SELECT * FROM Publisher";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Publisher ID</th>
        <th>Publisher Name</th>
        <th>Address</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Edit</th><th>Delete</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['PublisherID']."</td>";
            echo "<td>".$row['PublisherName']."</td>";
            echo "<td>".$row['Address']."</td>";
            echo "<td>".$row['PhoneNumber']."</td>";
            echo "<td>".$row['Email']."</td>";
            echo "<td><a class='edit-link' href='edit_publisher.php?id=".$row['PublisherID']."'>Edit</a></td>";
            echo "<td><a class='delete-link' href='delete_publisher.php?id=".$row['PublisherID']."'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p class='no-publishers'>No publishers found</p>";
    }
    ?>
</div>
</body>
</html>
