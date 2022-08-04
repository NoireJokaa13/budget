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
</head>
<body>

<?php if(!empty($this->homeMenu)): $this->view($this->homeMenu); endif; ?>


  <?php if(!empty($this->content)): $this->view($this->content); endif; ?>


<!-- Footer -->
<script src="<?=THEME;?>/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- inject:js -->
<script src="<?=THEME;?>/js/off-canvas.js"></script>
<script src="<?=THEME;?>/js/hoverable-collapse.js"></script>
<script src="<?=THEME;?>/js/template.js"></script>
<script src="<?=THEME;?>/js/settings.js"></script>
<script src="<?=THEME;?>/js/todolist.js"></script>
<!-- Footer -->

<?php if(!empty($this->script_content)): $this->view($this->script_content); endif; ?>

</body>
</html>
