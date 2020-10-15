<?php
if (isset($_POST["save"])) {
    error_reporting(0);
    $conn = new mysqli($host, $username, $password, $dbname);
    $firstName = $conn->real_escape_string($_POST["first"]);
    $lastName = $conn->real_escape_string($_POST["last"]);
    $emailAddress = $conn->real_escape_string($_POST["email"]);
    $sql = "UPDATE users SET first_name='$firstName', last_name='$lastName', email='$emailAddress' WHERE email='$email'";
    if ($conn->query($sql) === TRUE) {
        header("Location:logout.php");
    }
    $conn->close();
}
if (isset($_POST["changePassword"])) {
    $conn = new mysqli($host, $username, $password, $dbname);
    error_reporting(0);
    $newPassword = $conn->real_escape_string(password_hash($_POST["newPassword"], PASSWORD_BCRYPT));
    $sql = "UPDATE users SET password='$newPassword' WHERE email='$email'";
    if ($conn->query($sql) === TRUE) {
        header("Location:logout.php");
    }
    $conn->close();
}
