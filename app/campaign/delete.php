<?php
$page = "delete";
include "../functions/init.php";
if (!logged_in()) {
    header("Location:../../login");
}
include "../functions/pages/delete.php";
?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="shortcut icon" href="<?php echo $url ?>/assets/images/logo.png" type="image/png">
      <title>Delete Campaign | Reply</title>
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
                              <div class="card">
                                 <div class="card-header">
                                    <h3 class="card-title text-dark"><i class="fe fe-trash mr-2"></i> Delete Campaign</h3>
                                 </div>
                                 <div class="card-body">
                                    <p>Are you sure you want to delete this campaign? All data, including feedback responses, will be permanently deleted.</p>
                                    <div class="mt-5">
                                       <form method="post" class="mb-5">
                                          <input type="hidden" name="deleteSubmit" value="1">
                                          <button type="submit" class="btn btn-danger w-25 mr-1" name="privacy" value="1" onclick="$(this).addClass('disabled').addClass('btn-loading');">
                                          <i class="fe fe-trash mr-2"></i> Delete Campaign
                                          </button>
                                       </form>
                                    </div>
                                 </div>
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
