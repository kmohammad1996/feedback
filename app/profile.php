<?php
include "functions/init.php";
if (!logged_in()) {
    header("Location:login");
}
include "functions/pages/profile.php";
?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <link rel="shortcut icon" href="<?php echo $url ?>/assets/images/logo.png" type="image/png">
      <title>Settings | Reply</title>
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
                        Settings
                     </h1>
                  </div>
                  <div class="row">
                     <div class="col-lg-4">
                        <div class="card card-profile">
                           <div class="card-body text-center">
                              <img class="avatar avatar-lg text-white" src="https://www.gravatar.com/avatar/<?php echo md5($email); ?>?d=<?php echo $url ?>/assets/images/avatar.png" onerror="this.src='<?php echo $url ?>/assets/images/avatar.png'">
                              <h3 class="mb-3 mt-4"><?php echo htmlentities(stripslashes($first_name), ENT_QUOTES, 'UTF-8'); ?> <?php echo htmlentities(stripslashes($last_name), ENT_QUOTES, 'UTF-8'); ?></h3>
                              <p class="mb-4">
                                 <?php echo htmlentities(stripslashes($email), ENT_QUOTES, 'UTF-8'); ?>
                              </p>
                           </div>
                        </div>
                        <div class="card">
                           <div class="card-body">
                              <h3>Plan <?php
if ($theplan == "pro") {
    echo "(Pro)";
} else {
    echo "(Free)";
}
?></h3>
<?php
if ($theplan == "pro") {
    echo "<p>Unlimited Campaigns</p>";
} else {
    echo "<p>Up to 3 campaigns</p>";
    echo "<a href='/app/upgrade' class='btn bg-camp w-100'>Upgrade to Pro <i class='fe fe-arrow-right ml-2'></i></a>";
}
?>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-8">
                        <div class="card">
                           <div class="card-header">
                              <h4 class="card-title">Account Settings</h4>
                           </div>
                           <div class="card-body">
                              <form method="post">
                                 <div class="row">
                                    <div class="col-lg-6">
                                       <div class="form-group">
                                          <label>First Name</label>
                                          <input type="text" class="form-control" name="first" placeholder="John" value="<?php echo htmlentities(stripslashes($first_name), ENT_QUOTES, 'UTF-8'); ?>" required>
                                       </div>
                                    </div>
                                    <div class="col-lg-6">
                                       <div class="form-group">
                                          <label>Last Name</label>
                                          <input type="text" class="form-control" name="last" placeholder="Doe" value="<?php echo htmlentities(stripslashes($last_name), ENT_QUOTES, 'UTF-8'); ?>" required>
                                       </div>
                                    </div>
                                    <div class="col-lg-12">
                                       <div class="form-group">
                                          <label>Email Address</label>
                                          <input type="text" class="form-control mb-2" name="email" placeholder="john.doe@gmail.com" value="<?php echo htmlentities(stripslashes($email), ENT_QUOTES, 'UTF-8'); ?>" required>
                                       </div>
                                    </div>
                                 </div>
                                 <button type="submit" class="btn bg-camp w-100" name="save" value="1" onclick="$('#editCampaign').submit(); $(this).addClass('disabled').addClass('btn-loading');">Save Changes</button>
                              </form>
                           </div>
                        </div>
                        <div class="card">
                           <div class="card-header">
                              <h3 class="card-title">Change Password</h3>
                           </div>
                           <div class="card-body">
                              <form method="post">
                                 <div class="row">
                                    <div class="col-lg-12">
                                       <div class="form-group">
                                          <label>New Password</label>
                                          <input type="password" class="form-control mb-2" name="newPassword" placeholder="Enter a new password" required>
                                       </div>
                                    </div>
                                 </div>
                                 <button type="submit" class="btn bg-camp w-25" name="changePassword" value="1" onclick="$('#editCampaign').submit(); $(this).addClass('disabled').addClass('btn-loading');">Change Password</button>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <?php include "includes/footer.php" ?>
      </div>
   </body>
</html>
