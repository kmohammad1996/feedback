<div class="header py-4">
   <div class="container">
      <div class="d-flex">
         <a class="header-brand" href="<?php echo $url ?>">
         <img src="<?php echo $url ?>/assets/images/transparent.svg" class="header-brand-img mr-2" alt="Reply Logo">
         <span class="hidden-sm-down">Reply</span>
         </a>
         <div class="d-flex order-lg-2 ml-auto">
            <div class="nav-item d-none d-md-flex">
               <a href="https://help.reply.so" target="_blank" style="-webkit-box-shadow: none !important; box-shadow: none !important;" class="btn btn-sm pl-4 pr-4 bg-camp">Help</a>
            </div>
            <div class="dropdown">
               <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
               <img class="avatar" src="https://www.gravatar.com/avatar/<?php echo md5($email); ?>?d=<?php echo $url ?>/assets/images/avatar.png" onerror="this.src='<?php echo $url ?>/assets/images/avatar.png'">
               <span class="ml-2 d-none d-lg-block">
               <span class="text-default">
               <?php echo htmlentities(stripslashes($first_name), ENT_QUOTES, 'UTF-8'); ?>
               </span>
               </span>
               </a>
               <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                  <a class="dropdown-item" href="<?php echo $url ?>/profile">
                  <i class="dropdown-icon fe fe-user"></i> Settings
                  </a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="<?php echo $url ?>/logout">
                  <i class="dropdown-icon fe fe-log-out"></i> Log Out
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>