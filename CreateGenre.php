<?php
include 'db_config.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Project Creation</title>
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
    <?php include 'menu.php' ?>
<!-- <div class="menu">
        <ul>
            <li><a href="create_project.php">Create Project</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div> -->
<br />
<div class="container">
    <h2>Genre</h2>
    <form method="post" action="ProcessGenre.php">
        <label for="genre_name">Genre Name:</label>
        <input type="text" id="GenreName" name="GenreName" required><br><br>
        
        <input type="submit" value="Create Project">
    </form>
    <h2>Genre List</h2>
    <?php
    $sql = "SELECT * FROM genre";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Genre #</th>
        <th>Genre name</th>
        
        <th>Edit</th><th>Delete</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row['GenreID']."</td>";
            echo "<td>".$row['GenreName']."</td>";
            
            echo "<td><a class='edit-link' href='EditGenre.php?id=".$row['GenreID']."'>Edit</a></td>";
            echo "<td><a class='delete-link' href='DeleteGenre.php?id=".$row['GenreID']."'>Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p class='no-projects'>No projects found</p>";
    }
    ?>
</div>
</body>
</html>