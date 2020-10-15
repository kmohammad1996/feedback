<?php
header("Access-Control-Allow-Origin: *");
include ("../functions/init.php");
if (isset($_POST['campaign'])) {
    $conn = new mysqli($host, $username, $password, $dbname);
    $sql = "SELECT * FROM campaigns WHERE id='$_POST[campaignId]'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $widgetName = htmlentities(stripslashes($row["name"]), ENT_QUOTES, 'UTF-8');
            $widgetTitle = htmlentities(stripslashes($row["title"]), ENT_QUOTES, 'UTF-8');
            $widgetSubtitle = htmlentities(stripslashes($row["subtitle"]), ENT_QUOTES, 'UTF-8');
            $widgetRating = htmlentities(stripslashes($row["rating"]), ENT_QUOTES, 'UTF-8');
            $widgetEmailField = htmlentities(stripslashes($row["emailField"]), ENT_QUOTES, 'UTF-8');
            $widgetAccent = htmlentities(stripslashes($row["accent"]), ENT_QUOTES, 'UTF-8');
            $widgetPosition = htmlentities(stripslashes($row["position"]), ENT_QUOTES, 'UTF-8');
            $widgetButtonText = htmlentities(stripslashes($row["buttonText"]), ENT_QUOTES, 'UTF-8');
            $widgetTyTitle = htmlentities(stripslashes($row["tyTitle"]), ENT_QUOTES, 'UTF-8');
            $widgetTyMessage = htmlentities(stripslashes($row["tyMessage"]), ENT_QUOTES, 'UTF-8');
            $widgetPrivacy = htmlentities(stripslashes($row["privacy"]), ENT_QUOTES, 'UTF-8');
        }
    }
    if (isset($_POST["email"])) {
        $email = $conn->real_escape_string($_POST["email"]);
    } else {
        $email = "";
    }
    $message = $conn->real_escape_string($_POST["message"]);
    if (isset($_POST["rate"])) {
        $rate = $conn->real_escape_string($_POST["rate"]);
    } else {
        $rate = "";
    }
    $ip = $conn->real_escape_string($_SERVER['REMOTE_ADDR']);
    $date = $conn->real_escape_string(date("F j, Y, g:i a"));

    if ($widgetPrivacy == "1") {
        $email = "";
        $ip = "";
    }

    $sql = "INSERT INTO responses (campaignId,email,message,rate,ip,created)
VALUES ('$_POST[campaignId]', '$email', '$message','$rate', '$ip', '$date')";
    if ($conn->query($sql) === TRUE) {
?>

<div class='lw-title lw-title_lg lw-center' style='margin-top:.5em;margin-bottom:.5em'><?php echo $widgetTyTitle ?></div>
<div class='lw-content lw-center lw-mb'><?php echo $widgetTyMessage ?></div>

<?php
    } else { ?>

<div class='lw-title lw-title_lg lw-center" style="margin-top:.5em;margin-bottom:.5em'>An error has occured.</div>
<div class='lw-content lw-center lw-mb'>Please refresh the page and try again.</div>
<a href='' class='lw-btn lw-btn_wide'><i class='far fa-sync-alt' style='margin-right:5px'></i> Reload</a>

<?php
    }
} else {
    echo "Access Denied";
} ?>
