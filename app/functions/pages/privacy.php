<?php
$conn = new mysqli($host, $username, $password, $dbname);
if (isset($_POST["submit"])) {
    error_reporting(0);
    $conn = new mysqli($host, $username, $password, $dbname);
    $widgetPrivacy = $_POST["privacy"];
    $sql = "UPDATE campaigns SET privacy='$widgetPrivacy' WHERE id=$_GET[campaign]";
    if ($conn->query($sql) === TRUE) {
    }
    $conn->close();
}
?>
