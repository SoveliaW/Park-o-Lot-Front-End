<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // User input
    $login_email = $_POST["email"];
    $login_id = $_POST["membership_id"];
    
    // Database connection parameters
    $host = "database_host";
    $dbname = "database_name";
    $user = "database_user";
    $password = "database_password";

    // Create a PDO connection to the database
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    } catch (PDOException $e) {
        die("Error: Could not connect to the database");
    }

    // Prepare and execute a SQL query to retrieve user information
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username=:username");
    $stmt->bindParam(":username", $login_username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);


    // Retrieve user information from the database using email
    $stmt = $pdo->query("SELECT * FROM ACCOUNT WHERE email='$login_email'");
    $stmt->bindParam("email", $login_email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify the member_id
    if ($user && password_verify($login_id, $user["membership_id"])) {
        // Set session variable
        $_SESSION["user_email"] = $user["email"];

        // Redirect to dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        header("Location: login_page.php?error=1");
        exit();
    }
}
?>