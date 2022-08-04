<?php
require_once("config/App.php");

class dean extends App {

  public function __construct() {
    $this->model('dean_m');
  }

  public function index() {
    if(!isset($_SESSION['auth'])) {
      $this->redirect('login/index');
    }
    $years = dean_m::get_years($_SESSION['auth']->centre_code);
    $month = dean_m::get_month($_SESSION['auth']->centre_code);
    $amounts = dean_m::get_amount($_SESSION['auth']->centre_code);
    $this->set('years', $years);
    $this->set('month', $month);
    $this->set('amounts', $amounts);
    $this->set('homeMenu', 'template/home-menu');
    $this->set('menuSide', 'template/menu-dean');
    $this->set('script_content', 'dean_f/script/script-index');
    $this->template("dean_f/index");
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

      $total_records = count(dean_m::get_budget_new($_SESSION['auth']->centre_code, 'type', $_GET['type']));
      $budgetlist = dean_m::get_budget_new_all($_SESSION['auth']->centre_code, 'type', $_GET['type'],$offset, $total_records_per_page);
    } else if(isset($_GET['GL'])) {
      //$budgetlist = bursary_m::get_budget_new('GL', $_GET['GL']);

      $total_records = count(dean_m::get_budget_new($_SESSION['auth']->centre_code, 'GL', $_GET['GL']));
      $budgetlist = dean_m::get_budget_new_all($_SESSION['auth']->centre_code, 'GL', $_GET['GL'],$offset, $total_records_per_page);
    } else {
      //$budgetlist = bursary_m::get_budget_new('', '');

      $total_records = count(dean_m::get_budget_new($_SESSION['auth']->centre_code, '', ''));
      $budgetlist = dean_m::get_budget_new_all($_SESSION['auth']->centre_code, '', '',$offset, $total_records_per_page);

    }

    $total_no_of_pages = ceil($total_records / $total_records_per_page);
    $second_last = $total_no_of_pages - 1;

    $this->set('total_no_of_pages', $total_no_of_pages);
    $this->set('page_no', $page_no);
    $this->set('budgetlist', $budgetlist);
    $this->set('homeMenu', 'template/home-menu');
    $this->set('menuSide', 'template/menu-dean');
    $this->set('pagination', 'template/pagination');
    //$this->set('script_content', 'dean_f/script/script-index');
    $this->template("dean_f/new");
  }


  public function list() {
    if(!isset($_SESSION['auth'])) {
      $this->redirect('login/index');
    }
    if(isset($_GET['type'])) {
      $budgetlist = dean_m::get_budget($_SESSION['auth']->centre_code, 'type', $_GET['type']);
    } else if(isset($_GET['GL'])) {
      $budgetlist = dean_m::get_budget($_SESSION['auth']->centre_code, 'GL', $_GET['GL']);
    } else if(isset($_GET['status'])) {
      $budgetlist = dean_m::get_budget($_SESSION['auth']->centre_code, 'status', $_GET['status']);
    } else {
      $budgetlist = dean_m::get_budget($_SESSION['auth']->centre_code, '', '');
    }
    $this->set('budgetlist', $budgetlist);
    $this->set('homeMenu', 'template/home-menu');
    $this->set('menuSide', 'template/menu-dean');
    //$this->set('script_content', 'dean_f/script/script-index');
    $this->template("dean_f/list");
  }

  public function edit() {
    if(!isset($_SESSION['auth'])) {
      $this->redirect('login/index');
    }
    $budget_id = $_GET['id'];
    $budget = dean_m::get_budget_by_budgetID($budget_id);
    $items = dean_m::get_budget_items_by_budgetID($budget_id);
    $this->set('budget', $budget);
    $this->set('items', $items);
    $this->set('homeMenu', 'template/home-menu');
    $this->set('menuSide', 'template/menu-dean');
    //$this->set('script_content', 'dean_f/script/script-edit');
    $this->template("dean_f/edit");
  }

  public function delete() {
    if(!isset($_SESSION['auth'])) {
      $this->redirect('login/index');
    }
    $budget_id = $_GET['id'];
    $array = array(
      'budget_id' => $budget_id
    );

    dean_m::remove_budget_items($budget_id);
    $budget = dean_m::remove_budget($array);
    if($budget) {
      $echo = GOTO_URL.'/dean/new';
      echo "<script>alert('Application succesfully removed.');
              window.location.href = '".$echo."'
           </script>";
    } else {
      $echo = GOTO_URL.'/dean/new';
      echo "<script>alert('Application cannot removed.');
              window.location.href = '".$echo."'
           </script>";
    }

    $this->set('budget', $budget);
    $this->set('items', $items);
    $this->set('homeMenu', 'template/home-menu');
    $this->set('menuSide', 'template/menu-dean');
    $this->set('script_content', 'dean_f/script/script-edit');
    $this->template("dean_f/edit");
  }

  public function update() {
    if(!isset($_SESSION['auth'])) {
      $this->redirect('login/index');
    }

    if(isset($_POST['txt_title'])) {
      $txt_budget_id = $_POST['txt_budget_id'];
      $dean_id = $_SESSION['auth']->work_id;
      $txt_remark_dean = $_POST['txt_remark_dean'];
      $txt_status_dean = $_POST['txt_status_dean'];
      if($txt_status_dean == 'Approved') {
        $status = 'Waiting for Approval From Bursary';
      } else if($txt_status_dean == 'Rejected') {
        $status = 'Not Approved';
      }

      $data = array(
        'budget_id' => $txt_budget_id,
        'dean_id' => $dean_id,
        'remark_dean' => $txt_remark_dean,
        'status_dean' => $txt_status_dean,
        'status' => $status,
        'dean_approve_dated' => date('Y-m-d')
      );

      $budget_id = dean_m::update_budget($data);

      if($budget_id) {

        $echo = GOTO_URL.'/dean/new';
        echo "<script>alert('Application succesfully updated.');
                window.location.href = '".$echo."'
             </script>";


      } else {
        $echo = GOTO_URL.'/dean/new';
        echo "<script>alert('Application cannot submit.');
                window.location.href = '".$echo."'
             </script>";
      }


    } else {
      $echo = GOTO_URL.'/dean/new';
      echo "<script>alert('Application cannot submit.');
              window.location.href = '".$echo."'
           </script>";
    }
  }


}
