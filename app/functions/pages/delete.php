<?php
$conn = new mysqli($host, $username, $password, $dbname);
if (isset($_POST["deleteSubmit"])) {
    $sql = "DELETE FROM campaigns WHERE id=$_GET[campaign]";
    if (mysqli_query($conn, $sql)) {
        $sql = "DELETE FROM responses WHERE campaignId=$_GET[campaign]";
        if (mysqli_query($conn, $sql)) {
            header("Location:$url");
        }
    }
}
?>
