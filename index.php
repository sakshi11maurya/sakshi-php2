<?php 
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$insert = false; // Initialize variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $server = "localhost"; // Change if using a different server
    $username = "root"; // Default username for XAMPP
    $password = ""; // Default password for XAMPP (empty)
    $database = "trip_db"; // Your database name

    // Create a database connection
    $con = mysqli_connect($server, $username, $password, $database);

    // Check if connection is successful
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    } 

    // Sanitize user inputs
    $name = mysqli_real_escape_string($con, $_POST['name'] ?? '');
    $age = mysqli_real_escape_string($con, $_POST['age'] ?? '');
    $gender = mysqli_real_escape_string($con, $_POST['gender'] ?? '');
    $email = mysqli_real_escape_string($con, $_POST['email'] ?? '');
    $phone = mysqli_real_escape_string($con, $_POST['phone'] ?? '');
    $desc = mysqli_real_escape_string($con, $_POST['desc'] ?? '');

    // Ensure required fields are not empty before inserting into the database
    if (!empty($name) && !empty($email) && !empty($phone)) {
        // Correct SQL query (NO single quotes around table name)
        $sql = "INSERT INTO trip (name, age, gender, email, phone, other, dt) 
                VALUES ('$name', '$age', '$gender', '$email', '$phone', '$desc', current_timestamp())";

        // Execute query
        if (mysqli_query($con, $sql)) {
            $insert = true;
        } else {
            echo "Error: " . mysqli_error($con);
        }
    } else {
        echo "Please fill in all required fields!";
    }

    // Close connection
    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Travel</title>
    <link rel="stylesheet" href="formm.css"> <!-- Your CSS file -->
</head>
<body>
    <div class="container">
        <img class="im" src="image.png" alt="form">
        <h1>Welcome to Travel</h1>

        <!-- Display success message only when the form is submitted successfully -->
        <?php if ($insert == true): ?>
            <p class="sub">Thank you for submitting your form!</p>
        <?php endif; ?>

        <form id="myForm" action="index.php" method="POST">
            <input type="text" name="name" id="name" placeholder="Enter your name" required>
            <input type="number" name="age" id="age" placeholder="Enter your age">
            <input type="text" name="gender" id="gender" placeholder="Enter your gender">
            <input type="email" name="email" id="email" placeholder="Enter your email" required>
            <input type="tel" name="phone" id="phone" placeholder="Enter your phone" required>
            <textarea name="desc" id="desc" cols="30" rows="10" placeholder="Enter any other information"></textarea>
            <button class="btn" type="submit">Submit</button>
        </form>
    </div>
    <script src="formm.js"></script> <!-- Make sure this file is not blocking form submission -->
</body>
</html>
