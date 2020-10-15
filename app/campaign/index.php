<?php
include "../functions/init.php";
if (!logged_in()) {
    header("Location:../../login");
}
header("Location:$url/campaign/$_GET[campaign]/responses");
?>
