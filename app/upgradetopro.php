<?php
$servername = "localhost";
$username = "replyodf_main";
$password = "Ibeatitup@23";
$dbname = "replyodf_main";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE users SET plan='pro' WHERE id='$_POST[userid]'";

if ($conn->query($sql) === TRUE) {
  echo "Upgrade Successful";
  header("Location: /app");
} else {
  echo "Upgrade Failed: " . $conn->error;
}

$conn->close();
?>