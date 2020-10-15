<?php
if (isset($_POST["submit"])) {
    $conn = new mysqli($host, $username, $password, $dbname);
    $theuserid= $_POST["userid"];
    $widgetName = $conn->real_escape_string($_POST["name"]);
    $widgetTitle = $conn->real_escape_string("How are we doing?");
    $widgetSubtitle = $conn->real_escape_string("Leave us feedback so we know how we're doing.");
    $widgetAccent = $conn->real_escape_string("#110635");
    $widgetButtonText = $conn->real_escape_string("Feedback");
    $widgetTyTitle = $conn->real_escape_string("Thank you!");
    $widgetTyMessage = $conn->real_escape_string("Thanks for your feedback. We'll continue to improve, based on your suggestions.");
    $widgetDate = $conn->real_escape_string(date("F j, Y"));
    $sql = "INSERT INTO campaigns (userid, name, title, subtitle, rating, emailField, accent, buttonText, tyTitle, tyMessage, privacy, created)
   VALUES ('$userid','$widgetName', '$widgetTitle', '$widgetSubtitle', '1', '1', '$widgetAccent', '$widgetButtonText', '$widgetTyTitle', '$widgetTyMessage', '0', '$widgetDate')";
    if ($conn->query($sql) === TRUE) {
        header("Location:$url/campaign/$conn->insert_id/editor/view");
    }
    $conn->close();
}
?>
