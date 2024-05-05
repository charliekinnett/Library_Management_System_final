<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h2 {
            margin-top: 0;
        }
        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        .error {
            color: red;
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
        p {
            margin-top: 15px;
            text-align: center;
        }
        a {
            color: #0366d6;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php
    // Include database configuration and initialize variables
    include 'db_config.php';
    $name = $email = $phoneNumber = $address = $password = "";
    $name_err = $email_err = $phoneNumber_err = $address_err = $password_err = "";

    // Processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate name
        if (empty(trim($_POST["name"]))) {
            $name_err = "Please enter your name.";
        } else {
            $name = trim($_POST["name"]);
        }

        // Validate email
        if (empty(trim($_POST["email"]))) {
            $email_err = "Please enter your email.";
        } else {
            $email = trim($_POST["email"]);
        }

        // Validate phone number
        if (empty(trim($_POST["phoneNumber"]))) {
            $phoneNumber_err = "Please enter your phone number.";
        } else {
            $phoneNumber = trim($_POST["phoneNumber"]);
        }

        // Validate address
        if (empty(trim($_POST["address"]))) {
            $address_err = "Please enter your address.";
        } else {
            $address = trim($_POST["address"]);
        }

        // Validate password
        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter a password.";
        } elseif (strlen(trim($_POST["password"])) < 6) {
            $password_err = "Password must have at least 6 characters.";
        } else {
            $password = trim($_POST["password"]);
        }

        // Check input errors before inserting into database
        if (empty($name_err) && empty($email_err) && empty($phoneNumber_err) && empty($address_err) && empty($password_err)) {
            // Prepare an insert statement
            $sql = "INSERT INTO Member (Name, Email, PhoneNumber, Address, Password, MembershipStatus, RegistrationDate) VALUES (?, ?, ?, ?, ?, 'Regular', NOW())";

            if ($stmt = $conn->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("sssss", $param_name, $param_email, $param_phoneNumber, $param_address, $param_password);

                // Set parameters
                $param_name = $name;
                $param_email = $email;
                $param_phoneNumber = $phoneNumber;
                $param_address = $address;
                $param_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Redirect to login page after successful registration
                    header("location: login.php");
                } else {
                    echo "Something went wrong. Please try again later.";
                }

                // Close statement
                $stmt->close();
            }
        }

        // Close connection
        $conn->close();
    }
    ?>
    
    <h2>Sign Up</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
            <span class="error"><?php echo $name_err; ?></span>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>
            <span class="error"><?php echo $email_err; ?></span>
        </div>
        <div>
            <label for="phoneNumber">Phone Number:</label>
            <input type="tel" id="phoneNumber" name="phoneNumber" value="<?php echo $phoneNumber; ?>" required>
            <span class="error"><?php echo $phoneNumber_err; ?></span>
        </div>
        <div>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo $address; ?>" required>
            <span class="error"><?php echo $address_err; ?></span>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <span class="error"><?php echo $password_err; ?></span>
        </div>
        <div>
            <input type="submit" value="Sign Up">
        </div>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </form>
</body>
</html>
