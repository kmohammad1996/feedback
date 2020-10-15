<?php
include "../functions/init.php";
$conn = new mysqli($host, $username, $password, $dbname);
$sql = "SELECT * FROM campaigns WHERE id='$_GET[campaign]'";
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
        $widgetType = htmlentities(stripslashes($row["type"]), ENT_QUOTES, 'UTF-8');
        $widgetButtonText = htmlentities(stripslashes($row["buttonText"]), ENT_QUOTES, 'UTF-8');
        $widgetTyTitle = htmlentities(stripslashes($row["tyTitle"]), ENT_QUOTES, 'UTF-8');
        $widgetTyMessage = htmlentities(stripslashes($row["tyMessage"]), ENT_QUOTES, 'UTF-8');
        $widgetPrivacy = htmlentities(stripslashes($row["privacy"]), ENT_QUOTES, 'UTF-8');
        $widgetError = "false";
    }
} else {
    $widgetError = "true";
}
if (isset($_GET["type"]) == "widget") {
    header('Content-Type: application/javascript'); ?>

/**

  Reply - Collect user feedback

  (c) 2020 Reply

  Updated: September 7th, 2020

*/

<?php if ($widgetError == "true") { ?>
  console.error("The feedback widget (#<?php echo $_GET['campaign']; ?>) embeded on this page does not exist.");
<?php
    } else { ?>

  document.write("<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'><link href='https://fonts.googleapis.com/css?family=Fira+Sans:400,600,700' rel='stylesheet'><link href='<?php echo $url ?>/assets/libs/fontawesome-pro/css/all.min.css' rel='stylesheet'><script type='text/javascript' src='<?php echo $url ?>/assets/js/vendors/jquery-3.2.1.min.js'></script><link rel='stylesheet' media='all' href='<?php echo $url ?>/assets/css/siteFeedback.css'> <style> .feedbackFloat {background-color:<?php echo $widgetAccent ?>;} </style> <div class='lw-widget <?php if($widgetType == "") { if($widgetPosition == "1") {echo 'lw-widget_left'; } } if ($widgetType == "1") { echo 'lw-widget_sidebar '; if($widgetPosition == "1") {echo 'lw-widget_left'; } } if($widgetType == "2") {echo 'lw-widget_fullscreen'; } ?>' id='feedbackWidget'> <div class='lw-overlay' data-lw-close></div> <div class='lw-container lw-container_md'> <div class='lw-item' style='--theme-color: <?php echo $widgetAccent ?>'> <button class='lw-close' data-lw-close><i class='fal fa-times closeIcon'></i></button> <div class='lw-wrap lw-p-lg'><div id='widgetHeader'> <div class='lw-logo lw-logo_icon lw-mb-md iconBlock'> <div class='lw-preview'><i class='far fa-comment faIcon'></i></div> </div> <div class='lw-title lw-title_lg widgetTitle'><?php echo $widgetTitle ?></div> <div class='lw-content lw-mb-sm widgetSubtitle'><?php echo $widgetSubtitle ?></div></div><div id='response'><form id='feedbackForm'> <input type='text' name='campaignId' value='<?php echo $_GET['campaign']; ?>' hidden> <?php if ($widgetRating == '1') { ?> <div class='lw-title lw-title_sm lw-mb-sm rateTitle'>Rate your experience</div> <div class='lw-tags lw-mb-sm emojiContainer'> <div class='lw-tags-item lw-active' id='rateFive' title='Amazing'><i class='fad fa-grin-hearts'></i></div> <div class='lw-tags-item' id='rateFour' title='Great'><i class='fad fa-grin'></i></div> <div class='lw-tags-item' id='rateThree' title='OK'><i class='fad fa-meh'></i></div> <div class='lw-tags-item' id='rateTwo' title='Bad'><i class='fad fa-frown'></i></div> <div class='lw-tags-item' id='rateOne' title='Terrible'><i class='fad fa-angry'></i></div> </div> <input type='text' name='rate' id='rateValue' value='5' hidden> <?php } ?> <div class='lw-mb-md'> <?php if ($widgetPrivacy !== "1") { ?><div class='lw-field lw-mb'> <div class='lw-icon'><i class='fas fa-envelope'></i></div><input class='lw-input' type='email' name='email' placeholder='Email address' <?php if ($widgetEmailField == "1") { echo 'required'; } ?>> </div><?php } ?> <div class='lw-field'><textarea class='lw-textarea' name='message' placeholder='Tell us what you think...' required></textarea></div> </div><input type='text' name='campaign' value='1' hidden> <button type='submit' id='feedbackSubmit' class='lw-btn lw-btn_wide'>Send feedback</button> </form></div> </div> </div> </div> </div> </div> <div class='feedbackFloat' id='feedbackFloat' data-lw-onclick='#feedbackWidget' style='<?php if($widgetPosition == "1") {echo 'left:40px'; } else {echo 'right:40px';} ?>'> <i class='fas fa-comment feedbackIcon'  data-lw-onclick='#feedbackWidget'></i> <p data-lw-onclick='#feedbackWidget'><?php echo $widgetButtonText ?></p> </div><script>var postUrl = '<?php echo $url ?>/functions/submit.php';</script><script type='text/javascript' src='<?php echo $url ?>/assets/js/siteFeedback.js'></script>");


<?php
    }
} else {
?>
<!doctype html>
<html lang="en">
   <head>
      <title><?php if ($widgetError == "false") { echo $widgetTitle; } else { echo "404 Not Found"; } ?></title>
      <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,600,700" rel="stylesheet">
      <link href="<?php echo $url ?>/assets/libs/fontawesome-pro/css/all.min.css" rel="stylesheet">
      <script type="text/javascript" src="<?php echo $url ?>/assets/js/vendors/jquery-3.2.1.min.js"></script>
      <link rel="stylesheet" media="all" href="<?php echo $url ?>/assets/css/siteFeedback.css">
   </head>
   <body class="feedbackBody">
      <div class="lw-widget feedbackPage lw-widget_fullscreen" data-lw-onload>
         <div class="lw-container lw-container_md">
            <div class="lw-item feedbackContain" style="--theme-color:<?php if ($widgetError == "false") { echo $widgetAccent; } ?>">
               <div class="lw-wrap lw-p-lg">
                 <?php if ($widgetError == "true") { ?>
                   <div class="lw-title lw-title_lg lw-center">Page Not Found</div>
                   <div class="lw-content lw-mb-sm lw-center">The feedback form you're trying to access doesn't exist.</div>
                 <?php } else { ?>
                   <div id="widgetHeader">
                  <div class="lw-logo lw-logo_icon lw-logo_center lw-mb-md iconBlock">
                     <div class="lw-preview"><i class="far fa-comment faIcon"></i></div>
                  </div>
                  <div class="lw-title lw-title_lg widgetTitle"><?php echo $widgetTitle ?></div>
                  <div class="lw-content lw-mb-sm widgetSubtitle"><?php echo $widgetSubtitle ?></div>
                </div>
                  <div id="response">
                  <form id="feedbackForm">
                     <input type="text" name="campaignId" value="<?php echo $_GET["campaign"]; ?>" hidden>
                     <?php if ($widgetRating == "1") { ?>
                     <div class="lw-title lw-title_sm lw-mb-sm rateTitle">Rate your experience</div>
                     <div class="lw-tags lw-mb-sm emojiContainer">
                        <div class="lw-tags-item lw-active" id="rateFive" title="Amazing"><i class="fad fa-grin-hearts"></i></div>
                        <div class="lw-tags-item" id="rateFour" title="Great"><i class="fad fa-grin"></i></div>
                        <div class="lw-tags-item" id="rateThree" title="OK"><i class="fad fa-meh"></i></div>
                        <div class="lw-tags-item" id="rateTwo" title="Bad"><i class="fad fa-frown"></i></div>
                        <div class="lw-tags-item" id="rateOne" title="Terrible"><i class="fad fa-angry"></i></div>
                     </div>
                     <input type="text" name="rate" id="rateValue" value="5" hidden>
                     <?php } ?>
                     <div class="lw-mb-md">
                       <?php if ($widgetPrivacy !== "1") { ?>
                        <div class="lw-field lw-mb">
                           <div class="lw-icon"><i class="fas fa-envelope"></i></div>
                           <input class="lw-input" type="email" name="email" value="<?php if (isset($_GET["email"])) { echo $_GET["email"]; } ?>" placeholder="Email address" <?php if ($widgetEmailField == "1") { echo "required"; } ?>>
                        </div>
                        <?php } ?>
                        <div class="lw-field"><textarea class="lw-textarea" name="message" placeholder="Tell us what you think..." required></textarea></div>
                     </div>
                     <input type="text" name="campaign" value="1" hidden>
                     <button type="submit" id="feedbackSubmit" class="lw-btn lw-btn_wide">Send feedback</button>
                  </form>
                </div>
              <?php } ?>
               </div>
            </div>
         </div>
      </div>
    </body>
      <script type="text/javascript" src="<?php echo $url ?>/assets/js/siteFeedback.js"></script>
      <script>var postUrl = "<?php echo $url ?>/functions/submit.php";</script>
</html>
<?php } ?>
