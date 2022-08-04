<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Budget System</title>
  <!-- base:css -->
  <link rel="stylesheet" href="<?=THEME;?>/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="<?=THEME;?>/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?=THEME;?>/css/vertical-layout-light/style.css">
  <link rel="stylesheet" href="<?=THEME;?>/css/styles-addon.css">
</head>
<body>

<?php if(!empty($this->homeMenu)): $this->view($this->homeMenu); endif; ?>

<div class="container-scroller">

    <div class="container-fluid page-body-wrapper">
    <?php if(!empty($this->menuSide)): $this->view($this->menuSide); endif; ?>
    <?php if(!empty($this->content)): $this->view($this->content); endif; ?>

<!-- partial:partials/_footer.html -->
<footer class="footer">
    <div class="card">
        <div class="card-body">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2020 <a href="https://www.bootstrapdash.com/" class="text-muted" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
                <!--<span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center text-muted">Free <a href="https://www.bootstrapdash.com/" class="text-muted" target="_blank">Bootstrap dashboard</a> templates from Bootstrapdash.com</span>-->
            </div>
        </div>
    </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>


</div>


  <!-- base:js -->
  <script src="<?=THEME;?>/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?=THEME;?>/js/off-canvas.js"></script>
  <script src="<?=THEME;?>/js/hoverable-collapse.js"></script>
  <script src="<?=THEME;?>/js/template.js"></script>
  <script src="<?=THEME;?>/js/settings.js"></script>
  <script src="<?=THEME;?>/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?=THEME;?>/js/dashboard.js"></script>
<!-- Footer -->
<?php if(!empty($this->script_content)): $this->view($this->script_content); endif; ?>

</body>
</html>
