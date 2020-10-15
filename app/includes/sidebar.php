<div class="col-lg-2 mb-4 px-0">
   <div class="list-group list-group-transparent mb-0">

      <a href="<?php echo $url ?>" onclick="loaderInit()" class="list-group-item list-group-item-action mb-2">
      <span class="icon mr-3"><i class="fe fe-arrow-left"></i></span>All Campaigns</a>
      
      <a href="<?php echo $url; ?>/campaign/<?php echo $_GET["campaign"]; ?>/responses" onclick="loaderInit()" class="list-group-item list-group-item-action <?php if ($page == "responses") { echo "active"; } ?>">
      <span class="icon mr-3"><i class="fe fe-users"></i></span>Responses
      <span class="pull-right"><?php echo $responses ?></span></a>

      <a href="<?php echo $url; ?>/campaign/<?php echo $_GET["campaign"]; ?>/editor/view" onclick="loaderInit()" class="list-group-item list-group-item-action <?php if ($page == "editor") { echo "active"; } ?>">
      <span class="icon mr-3"><i id="editorClick" class="fe fe-edit-2"></i></span>Editor</a>

      <a href="<?php echo $url; ?>/campaign/<?php echo $_GET["campaign"]; ?>/integrations" onclick="loaderInit()" class="list-group-item list-group-item-action <?php if ($page == "integrations") { echo "active"; } ?>">
      <span class="icon mr-3"><i class="fe fe-code"></i></span>Integrations</a>

      <a href="<?php echo $url; ?>/campaign/<?php echo $_GET["campaign"]; ?>/privacy" onclick="loaderInit()" class="list-group-item list-group-item-action <?php if ($page == "privacy") { echo "active"; } ?>">
      <span class="icon mr-3"><i class="fe fe-eye"></i></span>Privacy</a>

      <a href="<?php echo $url; ?>/campaign/<?php echo $_GET["campaign"]; ?>/data" onclick="loaderInit()" class="list-group-item list-group-item-action <?php if ($page == "data") { echo "active"; } ?>">
      <span class="icon mr-3"><i class="fe fe-database"></i></span>Data Manager</a>

      <div class="dropdown-divider"></div>

      <a href="<?php echo $url; ?>/campaign/<?php echo $_GET["campaign"]; ?>/delete" onclick="loaderInit()" class="list-group-item list-group-item-action text-red">
      <span class="icon mr-3"><i class="fe fe-trash text-red"></i></span> Delete Campaign</a>

   </div>
</div>