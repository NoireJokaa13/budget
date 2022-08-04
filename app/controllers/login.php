<?php
require_once("config/App.php");

class login extends App {

  public function __construct() {
    $this->model('login_m');
  }

  public function index() {
    //$this->set('script_content', 'script/login');
    if(isset($_SESSION['auth'])) {
      $auth = $_SESSION['auth'];
      if($auth->role == 'accountant') {
        $this->redirect('accountant/index');
      } else if($auth->role == 'dean') {
        $this->redirect('dean/index');
      } else if($auth->role == 'bursary') {
        $this->redirect('bursary/index');
      }
    } else {
      $this->template("login");
    }
  }


  public function login() {
    unset($_SESSION["error_message"]);
    if($_POST['btn_submit']) {
      $workid = $_POST['txt_id'];
      $password = $_POST['txt_password'];
      $password = strtoupper(md5($password));

      $auth = login_m::get_userAuth($workid, $password);

      if($auth) {
        $_SESSION['auth'] = $auth;
        if($auth->role == 'accountant') {
          $this->redirect('accountant/index');
        } else if($auth->role == 'dean') {
          $this->redirect('dean/index');
        } else if($auth->role == 'bursary') {
          $this->redirect('bursary/index');
        }
      } else {
        $_SESSION['error_message'] = 'Error: Work ID or Password Incorrect.';
        $this->redirect('login/index');
      }

    } else {
      $this->set('error_message','Error: Cannot Login.');
      $this->redirect('login/index');
    }

  }

  public function logout() {
    session_destroy();
    $this->redirect('login/index');
  }

}
