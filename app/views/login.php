<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth px-0">
      <div class="row w-100 mx-0">
        <div class="col-lg-4 mx-auto">
          <?php if(isset($_SESSION['error_message'])): ?>
            <blockquote class="blockquote blockquote-primary">
              <footer class="blockquote-footer"><?=$_SESSION['error_message'];?></footer>
            </blockquote>
          <?php endif;?>
          <div class="auth-form-light text-left py-5 px-4 px-sm-5">
            <div class="brand-logo">
              <img src="<?=THEME;?>/images/logo.png" alt="logo">
            </div>
            <h4>Hello! let's get started</h4>
            <h6 class="font-weight-light">Sign in to continue.</h6>
            <form class="pt-3" action="<?=BASE_URL.'/login/login';?>" method="post">
              <div class="form-group">
                <input type="text" class="form-control form-control-lg" id="txt_id" name="txt_id" placeholder="Work ID" required>
              </div>
              <div class="form-group">
                <input type="password" class="form-control form-control-lg" id="txt_password" name="txt_password" placeholder="Password" required>
              </div>
              <div class="mt-3">
                <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" name="btn_submit" value="SIGN IN">
              </div>
              <!--<div class="my-2 d-flex justify-content-between align-items-center">
                <div class="form-check">
                  <label class="form-check-label text-muted">
                    <input type="checkbox" class="form-check-input">
                    Keep me signed in
                  </label>
                </div>
                <a href="#" class="auth-link text-black">Forgot password?</a>
              </div>-->
              <!--<div class="mb-2">
                <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                  <i class="typcn typcn-social-facebook mr-2"></i>Connect using facebook
                </button>
              </div>-->
              <!--<div class="text-center mt-4 font-weight-light">
                Don't have an account? <a href="register.html" class="text-primary">Create</a>
              </div>-->
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>
