<?php
if (!file_exists('functions/config.php')) {
    header("Location: install");
    exit;
}
include ("functions/init.php");
if (!logged_in()) {
    header("Location:login");
}
include "functions/pages/home.php";
?>
<!doctype html>
<html lang="en">
   <head><meta charset="windows-1252">
      
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="shortcut icon" href="<?php echo $url ?>/assets/images/logo.png" type="image/png">
      <title>Campaigns | Reply</title>
      <?php include 'includes/styles.php'; ?>
   </head>
   <body>
      <div class="page">
         <div class="page-main">
            <?php include "includes/header.php" ?>
            <div class="my-3 my-md-5">
               <div class="container">
                  <div class="page-header">
                     <h1 class="page-title">
                        Campaigns
                     </h1>
                  </div>
                  <div class="row">
                     <div class="col-sm-6 col-md-3 col-lg-2">
                        <div class="card cardHome bg-camp text-white" data-toggle="modal" <?php
$conn2=mysqli_connect($host, $username, $password, $dbname);
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql2="SELECT * FROM `campaigns` WHERE userid='$userid'";

if ($result2=mysqli_query($conn2,$sql2))
  {
  $rowcount=mysqli_num_rows($result2);
  if ($theplan == "pro"){
    echo "data-target='#newListModal'";
  } else {
    if ($rowcount == "3"){
    echo "onclick=\"window.location.href = '/app/upgrade';\""; 
  } else {
    echo "data-target='#newListModal'";  
  }  
  }
  mysqli_free_result($result2);
  }

mysqli_close($conn2);
?> id="newListModalBtn" data-backdrop="static" data-keyboard="false">
                           <div class="card-body text-center py-6 d-flex justify-content-center align-items-center">
                              <h4>
                                 <span class="display-4 font-weight-bold plusIcon">+</span>
                                 <br>
                                 <br>

<?php
$conn2=mysqli_connect($host, $username, $password, $dbname);
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql2="SELECT * FROM `campaigns` WHERE userid='$userid'";

if ($result2=mysqli_query($conn2,$sql2))
  {
  if ($theplan == "pro"){
    echo "New Campaign";
  } else {
    if ($rowcount == "3"){
    echo "Upgrade Account"; 
  } else {
    echo "New Campaign";  
  }  
  }
  mysqli_free_result($result2);
  }

mysqli_close($conn2);
?>
                              </h4>
                           </div>
                        </div>
                     </div>
                     <?php
$conn = new mysqli($host, $username, $password, $dbname);
$sql = "SELECT * FROM campaigns WHERE userid='$userid' ORDER BY `campaigns`.`created` DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) { ?>
                     <?php
        $sql1 = "SELECT COUNT(*) FROM responses WHERE campaignId='$row[id]'";
        $result1 = $conn->query($sql1);
        if ($result1->num_rows > 0) {
            while ($row1 = $result1->fetch_assoc()) { ?>
                     <?php $responses = $row1['COUNT(*)']; ?>
                     <?php
            }
        } ?>
                     <div class="col-sm-6 col-md-3 col-lg-2">
                        <div class="card cardHome">
                           <div class="card-body text-center py-6 d-flex justify-content-center align-items-center" onclick="window.location.href = '<?php echo $url ?>/campaign/<?php echo $row["id"]; ?>/responses'">
                              <h4>
                                 <?php echo htmlentities($row["name"], ENT_QUOTES, 'UTF-8'); ?>
                              </h4>
                           </div>
                           <div class="card-footer card-footerHome">
                              <span class="tag text-dark" onclick="window.location.href = '<?php echo $url ?>/campaign/<?php echo $row["id"]; ?>/responses'">
                              <?php echo $responses; ?> <?php if ($responses == "1") { echo "response"; } else { echo "responses"; } ?>
                              </span>
                              <div class="item-action dropdown campaignDropdown">
                                 <a href="javascript:void(0)" data-toggle="dropdown" class="icon"><i class="fe fe-more-horizontal"></i></a>
                                 <div class="dropdown-menu dropdown-menu-right">
                                    <a href="<?php echo $url ?>/campaign/<?php echo $row["id"]; ?>/integrations" class="dropdown-item"><i class="dropdown-icon fe fe-code"></i> Integrations</a>
                                    <a href="<?php echo $url ?>/campaign/<?php echo $row["id"]; ?>/privacy" class="dropdown-item"><i class="dropdown-icon fe fe-eye"></i> Privacy</a>
                                    <a href="<?php echo $url ?>/campaign/<?php echo $row["id"]; ?>/data" class="dropdown-item"><i class="dropdown-icon fe fe-database"></i> Data Manager</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="<?php echo $url ?>/campaign/<?php echo $row["id"]; ?>/delete" class="dropdown-item text-red"><i class="dropdown-icon fe fe-trash text-red"></i> Delete Campaign</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <?php
    }
} else { ?>
                     <div class="ml-7 mt-6">
                        <h1 class="font-weight-normal">
                           📩 Create your first campaign
                        </h1>
                        <p class="lead font-weight-normal">
                           Start tracking user feedback by creating a new campaign.<br>
                           Once you've done that, your campaigns will appear here.
                        </p>
                     </div>
                  </div>
                  <?php } ?>
               </div>
               <div class="modal fade" id="newListModal" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-dialog-centered modal-s" role="document">
                     <div class="modal-content px-3">
                        <div class="modal-header">
                           <h5 class="modal-title">New Campaign</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           </button>
                        </div>
                        <form method="post">
                           <div class="modal-body">
                              <div class="form-group">
                                 <div style="margin-top: -20px;" class="input">
                                    <input type="text" class="form-control mb-2" id="listName" name="name" placeholder="Campaign Name" required>
                                 </div>
                              </div>
                              <button type="submit" name="submit" class="btn bg-camp w-25 btn-block new-list-modal-btn mb-3"><i class="fe fe-check"></i> Create</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php include "includes/footer.php"; ?>
      </div>
   </body>
</html>
