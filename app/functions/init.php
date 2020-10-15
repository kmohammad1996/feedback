<?php
ob_start();
session_start();
if(isset($page)) { $page !== "data"; } {
include ("config.php");
}
include ("functions.php");
if (isset($_SESSION['email'])) {
    $conn = new mysqli($host, $username, $password, $dbname);
    $emailSession = $_SESSION['email'];
    $sql = "SELECT * FROM users WHERE email='$emailSession'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $first_name = $row["first_name"];
            $last_name = $row["last_name"];
            $email = $row["email"];
            $userid = $row["id"];
            $theplan = $row["plan"];
        }
    }
    if (isset($page)) {
        $sql = "SELECT * FROM campaigns WHERE id='$_GET[campaign]'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $widgetName = $row["name"];
                $widgetTitle = $row["title"];
                $widgetSubtitle = $row["subtitle"];
                $widgetRating = $row["rating"];
                $widgetEmailField = $row["emailField"];
                $widgetAccent = $row["accent"];
                $widgetPosition = $row["position"];
                $widgetType = $row["type"];
                $widgetButtonText = $row["buttonText"];
                $widgetTyTitle = $row["tyTitle"];
                $widgetTyMessage = $row["tyMessage"];
                $widgetTyMessage = $row["tyMessage"];
                $widgetPrivacy = $row["privacy"];
            }
        } else {
            header("Location:$url");
        }
        $sql1 = "SELECT COUNT(*) FROM responses WHERE campaignId='$_GET[campaign]'";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) {
                $responses = $row1['COUNT(*)'];
            }
        }
    }
}
$con = mysqli_connect($host, $username, $password, $dbname);
function row_count($result) {
    return mysqli_num_rows($result);
}
function escape($string) {
    global $con;
    return mysqli_real_escape_string($con, $string);
}
function confirm($result) {
    global $con;
    if (!$result) {
        die("QUERY FAILED" . mysqli_error($con));
    }
}
function query($query) {
    global $con;
    $result = mysqli_query($con, $query);
    confirm($result);
    return $result;
}
function fetch_array($result) {
    global $con;
    return mysqli_fetch_array($result);
}
?>