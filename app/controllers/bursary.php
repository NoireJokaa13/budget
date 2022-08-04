<?php
require_once("config/App.php");

class bursary extends App {

  public function __construct() {
    $this->model('bursary_m');
  }

  public function index() {
    if(!isset($_SESSION['auth'])) {
      $this->redirect('login/index');
    }
    $years = bursary_m::get_years();
    $month = bursary_m::get_month();
    $faculty = bursary_m::get_faculty();
    $amounts = bursary_m::get_amount();
    $this->set('years', $years);
    $this->set('month', $month);
    $this->set('faculty', $faculty);
    $this->set('amounts', $amounts);
    $this->set('homeMenu', 'template/home-menu');
    $this->set('menuSide', 'template/menu-bursary');
    $this->set('script_content', 'bursary_f/script/script-index');
    $this->template("bursary_f/index");
  }


  public function new() {
    if(!isset($_SESSION['auth'])) {
      $this->redirect('login/index');
    }

    if (isset($_GET['page_no']) && $_GET['page_no']!="") {
      $page_no = $_GET['page_no'];
    } else {
      $page_no = 1;
    }

    $total_records_per_page = 3;

    $offset = ($page_no-1) * $total_records_per_page;
    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;
    $adjacents = "2";

    if(isset($_GET['type'])) {
      //$budgetlist = bursary_m::get_budget_new('type', $_GET['type']);

      $total_records = count(bursary_m::get_budget_new('type', $_GET['type']));
      $budgetlist = bursary_m::get_budget_new_all('type', $_GET['type'],$offset, $total_records_per_page);
    } else if(isset($_GET['GL'])) {
      //$budgetlist = bursary_m::get_budget_new('GL', $_GET['GL']);

      $total_records = count(bursary_m::get_budget_new('GL', $_GET['GL']));
      $budgetlist = bursary_m::get_budget_new_all('GL', $_GET['GL'],$offset, $total_records_per_page);
    } else {
      //$budgetlist = bursary_m::get_budget_new('', '');

      $total_records = count(bursary_m::get_budget_new('', ''));
      $budgetlist = bursary_m::get_budget_new_all('', '',$offset, $total_records_per_page);

    }

    $total_no_of_pages = ceil($total_records / $total_records_per_page);
    $second_last = $total_no_of_pages - 1;

    $this->set('budgetlist', $budgetlist);
    $this->set('homeMenu', 'template/home-menu');
    $this->set('menuSide', 'template/menu-bursary');
    $this->set('pagination', 'template/pagination');
    //$this->set('script_content', 'bursary_f/script/script-index');
    $this->template("bursary_f/new");
  }


  public function list() {
    if(!isset($_SESSION['auth'])) {
      $this->redirect('login/index');
    }
    if(isset($_GET['type'])) {
      $budgetlist = bursary_m::get_budget('type', $_GET['type']);
    } else if(isset($_GET['GL'])) {
      $budgetlist = bursary_m::get_budget('GL', $_GET['GL']);
    } else if(isset($_GET['status'])) {
      $budgetlist = bursary_m::get_budget('status', $_GET['status']);
    } else {
      $budgetlist = bursary_m::get_budget('', '');
    }
    $this->set('budgetlist', $budgetlist);
    $this->set('homeMenu', 'template/home-menu');
    $this->set('menuSide', 'template/menu-bursary');
    //$this->set('script_content', 'bursary_f/script/script-index');
    $this->template("bursary_f/list");
  }

  public function edit() {
    if(!isset($_SESSION['auth'])) {
      $this->redirect('login/index');
    }
    $budget_id = $_GET['id'];
    $budget = bursary_m::get_budget_by_budgetID($budget_id);
    $items = bursary_m::get_budget_items_by_budgetID($budget_id);
    $this->set('budget', $budget);
    $this->set('items', $items);
    $this->set('homeMenu', 'template/home-menu');
    $this->set('menuSide', 'template/menu-bursary');
    //$this->set('script_content', 'bursary_f/script/script-edit');
    $this->template("bursary_f/edit");
  }

  public function delete() {
    if(!isset($_SESSION['auth'])) {
      $this->redirect('login/index');
    }
    $budget_id = $_GET['id'];
    $array = array(
      'budget_id' => $budget_id
    );

    bursary_m::remove_budget_items($budget_id);
    $budget = bursary_m::remove_budget($array);
    if($budget) {
      $echo = GOTO_URL.'/bursary/new';
      echo "<script>alert('Application succesfully removed.');
              window.location.href = '".$echo."'
           </script>";
    } else {
      $echo = GOTO_URL.'/bursary/new';
      echo "<script>alert('Application cannot removed.');
              window.location.href = '".$echo."'
           </script>";
    }

    $this->set('budget', $budget);
    $this->set('items', $items);
    $this->set('homeMenu', 'template/home-menu');
    $this->set('menuSide', 'template/menu-bursary');
    $this->set('script_content', 'bursary_f/script/script-edit');
    $this->template("bursary_f/edit");
  }

  public function update() {
    if(!isset($_SESSION['auth'])) {
      $this->redirect('login/index');
    }

    if(isset($_POST['txt_title'])) {
      $txt_budget_id = $_POST['txt_budget_id'];
      $bursary_id = $_SESSION['auth']->work_id;
      $txt_remark_bursary = $_POST['txt_remark_bursary'];
      $txt_status_bursary = $_POST['txt_status_bursary'];
      if($txt_status_bursary == 'Approved') {
        $status = 'Approved';
      } else if($txt_status_bursary == 'Rejected') {
        $status = 'Not Approved';
      }

      $data = array(
        'budget_id' => $txt_budget_id,
        'bursary_id' => $bursary_id,
        'remark_bursary' => $txt_remark_bursary,
        'status_bursary' => $txt_status_bursary,
        'status' => $status,
        'bursary_approve_dated' => date('Y-m-d')
      );

      var_dump($data);

      $budget_id = bursary_m::update_budget($data);

      if($budget_id) {

        $echo = GOTO_URL.'/bursary/new';
        echo "<script>alert('Application succesfully updated.');
                window.location.href = '".$echo."'
             </script>";


      } else {
        $echo = GOTO_URL.'/bursary/new';
        echo "<script>alert('Application cannot submit.');
                window.location.href = '".$echo."'
             </script>";
      }


    } else {
      $echo = GOTO_URL.'/bursary/new';
      echo "<script>alert('Application cannot submit.');
              window.location.href = '".$echo."'
           </script>";
    }
  }


}
