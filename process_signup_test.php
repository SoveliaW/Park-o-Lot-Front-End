<?php

// Database configuration
$servername = "your_database_server";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

try {
    // Create a PDO connection
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Collect form data
    $first_name = test_input($_POST["first_name"]);
    $last_name = test_input($_POST["last_name"]);
    $email = test_input($_POST["email"]);
    $address = test_input($_POST["address"]);

    // Validate data (you can add more validation as needed)
    if (empty($first_name) || empty($last_name) || empty($email) || empty($address)) {
        die("All fields are required");
    }

    // Prepare and execute SQL statement to insert data into the database
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, address) VALUES (:first_name, :last_name, :email, :address)");
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':address', $address);
    $stmt->execute();

    echo "Data stored successfully.";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn = null;

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>