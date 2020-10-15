<?php
$page = "responses";
include "../functions/init.php";
if (!logged_in()) {
    header("Location:../../login");
}
include "../functions/pages/responses.php";
?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="shortcut icon" href="<?php echo $url ?>/assets/images/logo.png" type="image/png">
      <title>Responses | Reply</title>
<?php include '../includes/styles.php'; ?>
   </head>
   <body>
      <div class="page">
         <div class="page-main">
            <?php include "../includes/header.php" ?>
            <div class="my-3 my-md-5">
               <div class="container">
                  <div class="page-header">
                     <div class="avatar bg-camp d-block mr-2" id="loadSwitchDiv">
                        <i class="fe fe-layout" id="loadSwitch"></i>
                     </div>
                     <h2 class="page-title">
                        <span><?php echo htmlentities($widgetName, ENT_QUOTES, 'UTF-8'); ?></span>
                     </h2>
                  </div>
                  <div class="row">
                     <?php include "../includes/sidebar.php"; ?>
                     <div class="col-lg-10 order-md-1">
                        <div class="row">
                           <div class="col-12">
                              <?php if (isset($_POST["deleteSubmit"])) { ?>
                              <div id="alertSlide" class="alert alert-success"><i class="far fa-check mr-3"></i> Success, response was deleted successfully.</div>
                              <?php } ?>
                              <?php if ($widgetPrivacy == "1") { ?>
                              <div class="alert alert-primary">
                                 <b>Privacy Mode</b> is enabled for this campaign. Some information has not been collected.
                                 <a href="<?php echo $url ?>/campaign/<?php echo $_GET["campaign"]; ?>/privacy" class="d-none d-lg-inline btn btn-white text-uppercase btn-sm float-right">Configure</a>
                              </div>
                              <?php } ?>
                              <div class="card">
                                 <div class="card-header">
                                    <h3 class="card-title">Responses</h3>
                                    <div class="card-options">
                                       <a href="<?php echo $url ?>/campaign/<?php echo $_GET["campaign"]; ?>/data" class="btn btn-secondary btn-sm" onclick="$(this).addClass('disabled').addClass('btn-loading');"><i class="fe fe-database mr-2"></i> Data Manager</a>
                                    </div>
                                 </div>
                                 <?php
                                    $sql = "SELECT * FROM responses WHERE campaignId='$_GET[campaign]' ORDER BY id DESC";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) { ?>
                                 <div class="table-responsive">
                                    <table class="table table-hover table-outline table-vcenter card-table table-striped">
                                       <thead>
                                          <tr>
                                             <th>Email</th>
                                             <?php if ($widgetRating == "1") { echo '<th>Rating</th>'; } ?>
                                             <th>Message</th>
                                             <th>IP Address</th>
                                             <th>Created</th>
                                             <th>Actions</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <?php while ($row = $result->fetch_assoc()) { ?>
                                          <tr>
                                             <td>
                                                <?php if ($widgetPrivacy == "1") { echo '<h6 class="text-secondary" title="Privacy Mode is currently enabled"><i class="far fa-eye mr-2"></i> Privacy</h6>'; } else { if (!$row["email"]) { echo '<strong>(Not provided)</strong>'; } else { ?>
                                                        <strong><?php echo htmlentities(stripslashes($row["email"]), ENT_QUOTES, 'UTF-8'); ?></strong>
                                                <?php } } ?>
                                             </td>
                                             <?php if ($widgetRating == "1") { ?>
                                             <td>
                                                <?php if ($row["rate"] == "5") { echo '<i class="fad fa-grin-hearts fa-2x text-dark"></i>'; } ?>
                                                <?php if ($row["rate"] == "4") { echo '<i class="fad fa-grin fa-2x text-dark"></i>'; } ?>
                                                <?php if ($row["rate"] == "3") { echo '<i class="fad fa-meh fa-2x text-dark"></i>'; } ?>
                                                <?php if ($row["rate"] == "2") { echo '<i class="fad fa-frown fa-2x text-dark"></i>'; } ?>
                                                <?php if ($row["rate"] == "1") { echo '<i class="fad fa-angry fa-2x text-dark"></i>'; } ?>
                                                <?php if ($row["rate"] == "") { echo 'Null'; } ?>
                                             </td>
                                             <?php } ?>
                                             <td class="messageTable">
                                                <?php echo htmlentities(stripslashes($row["message"]), ENT_QUOTES, 'UTF-8'); ?>
                                             </td>
                                             <td>
                                                <?php if ($widgetPrivacy == "1") { echo '<h6 class="text-secondary" title="Privacy Mode is currently enabled"><i class="far fa-eye mr-2"></i> Privacy</h6>'; } else { if (!$row["email"]) { echo 'Unknown'; } else { ?>
                                                <a href="https://whatismyipaddress.com/ip/<?php echo htmlentities(stripslashes($row["ip"]), ENT_QUOTES, 'UTF-8'); ?>" target="_blank"><?php echo htmlentities(stripslashes($row["ip"]), ENT_QUOTES, 'UTF-8'); ?></a>
                                                <?php } } ?>
                                             </td>
                                             <td>
                                                <?php echo htmlentities(stripslashes($row["created"]), ENT_QUOTES, 'UTF-8'); ?>
                                             </td>
                                             <td class="text-center">
                                                <a  href="javascript:void(0)" data-toggle="modal" data-target="#deleteResponse<?php echo $row["id"]; ?>" class="btn btn-danger btn-sm pt-2 pb-2 pl-4 pr-4"><i class="fe fe-trash mr-2"></i> Delete</a>
                                                <div class="modal fade" id="deleteResponse<?php echo $row["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                   <div class="modal-dialog modal-dialog-centered" role="document">
                                                      <div class="modal-content">
                                                         <div class="modal-header text-center">
                                                            <h4 class="modal-title" id="myModalLabel">Are you sure?</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                                                         </div>
                                                         <div class="modal-body">
                                                            You're about to delete a response from this campaign.<br><br>
                                                            <strong>This action cannot be undone.</strong>
                                                         </div>
                                                         <div class="modal-footer">
                                                            <form method="post">
                                                               <input type="hidden" name="responseId" value="<?php echo $row["id"]; ?>">
                                                               <button type="submit" name="deleteSubmit" value="1" class="btn btn-danger mr-2" onclick="$(this).addClass('disabled').addClass('btn-loading');"><i class="fe fe-trash mr-2" ></i> Delete</button>
                                                               <button type="button" class="btn btn-white" data-dismiss="modal"><i class="fe fe-x"></i> Cancel</button>
                                                            </form>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                          <?php } ?>
                                       </tbody>
                                    </table>
                                 </div>
                                 <?php } else { ?>
                                 <div class="card-body">
                                    <p>No responses, yet.</p>
                                    <br>
                                    <strong>Click <a href="<?php echo $url ?>/campaign/<?php echo $_GET["campaign"]; ?>/integrations">here</a> to set up integrations, if you haven't already.</strong>
                                 </div>
                                 <?php } ?>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <?php include "../includes/footer.php" ?>
      </div>
   </body>
</html>
