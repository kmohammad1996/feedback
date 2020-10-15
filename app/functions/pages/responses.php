<?php
$conn = new mysqli($host, $username, $password, $dbname);
if (isset($_POST["deleteSubmit"])) {
    $sql = "DELETE FROM responses WHERE id=$_POST[responseId]";
    if (mysqli_query($conn, $sql)) {
    }
}
?>
