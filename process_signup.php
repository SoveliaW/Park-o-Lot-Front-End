<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $creditcard_num = $_POST["creditcard_num"];
    $LPN = $_POST["LPN"];
    $temp_LPN = $_POST["temp_LPN"];

    // Save user information to the database
    $db->query("INSERT INTO ACCOUNT (membership_id, first_name, last_name, email, address, creditcard_num, LPN, temp_LPN) VALUES ('$first_name', '$last_name', '$email', '$address', '$creditcard_num', '$LPN', '$temp_LPN')");

    echo "Signup successful!";
}
?>