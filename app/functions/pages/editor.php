<?php

include "../../functions/init.php";

if (isset($_POST["submit"])) {
    error_reporting(0);
    $conn = new mysqli($host, $username, $password, $dbname);
    $widgetName = $conn->real_escape_string($_POST["name"]);
    $widgetTitle = $conn->real_escape_string($_POST["title"]);
    $widgetSubtitle = $conn->real_escape_string($_POST["subtitle"]);
    $widgetRating = $conn->real_escape_string($_POST["rating"]);
    $widgetEmailField = $conn->real_escape_string($_POST["emailField"]);
    $widgetAccent = $conn->real_escape_string($_POST["accent"]);
    $widgetType = $conn->real_escape_string($_POST["type"]);
    $widgetPosition = $conn->real_escape_string($_POST["position"]);
    $widgetButtonText = $conn->real_escape_string($_POST["buttonText"]);
    $widgetTyTitle = $conn->real_escape_string($_POST["tyTitle"]);
    $widgetTyMessage = $conn->real_escape_string($_POST["tyMessage"]);
    $widgetPrivacy = $conn->real_escape_string($_POST["privacy"]);
    $widgetDate = $conn->real_escape_string(date("F j, Y"));
    $sql = "UPDATE campaigns SET name='$widgetName', title='$widgetTitle', subtitle='$widgetSubtitle', rating='$widgetRating', emailField='$widgetEmailField', accent='$widgetAccent', position='$widgetPosition', type='$widgetType', buttonText='$widgetButtonText', tyTitle='$widgetTyTitle', tyMessage='$widgetTyMessage', privacy='$widgetPrivacy' WHERE id=$_POST[submit]";
    if ($conn->query($sql) === TRUE) {
    }
    $conn->close();
}
