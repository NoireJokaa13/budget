<?php
require_once("config/App.php");

class accountant extends App {

  public function __construct() {
    $this->model('budget_m');
  }

  public function index() {
    if(!isset($_SESSION['auth'])) {
      $this->redirect('login/index');
    }
    $years = budget_m::get_years($_SESSION['auth']->centre_code);
    $month = budget_m::get_month($_SESSION['auth']->centre_code);
    $amounts = budget_m::get_amount($_SESSION['auth']->centre_code);
    $this->set('years', $years);
    $this->set('month', $month);
    $this->set('amounts', $amounts);
    $this->set('homeMenu', 'template/home-menu');
    $this->set('menuSide', 'template/menu-accountant');
    $this->set('script_content', 'accountant_f/script/script-index');
    $this->template("accountant_f/index");
  }


  public function new() {
    if(!isset($_SESSION['auth'])) {
      $this->redirect('login/index');
    }
    $this->set('homeMenu', 'template/home-menu');
    $this->set('menuSide', 'template/menu-accountant');
    $this->set('script_content', 'accountant_f/script/script-new');
    $this->template("accountant_f/new");
  }


  public function list() {
    if(!isset($_SESSION['auth'])) {
      $this->redirect('login/index');
    }
    if(isset($_GET['type'])) {
      $budgetlist = budget_m::get_budget_by_workID($_SESSION['auth']->work_id, 'type', $_GET['type']);
    } else if(isset($_GET['GL'])) {
      $budgetlist = budget_m::get_budget_by_workID($_SESSION['auth']->work_id, 'GL', $_GET['GL']);
    } else if(isset($_GET['status'])) {
      $budgetlist = budget_m::get_budget_by_workID($_SESSION['auth']->work_id, 'status', $_GET['status']);
    } else {
      $budgetlist = budget_m::get_budget_by_workID($_SESSION['auth']->work_id, '', '');
    }
    $this->set('budgetlist', $budgetlist);
    $this->set('homeMenu', 'template/home-menu');
    $this->set('menuSide', 'template/menu-accountant');
    //$this->set('script_content', 'accountant_f/script/script-index');
    $this->template("accountant_f/list");
  }

  public function edit() {
    if(!isset($_SESSION['auth'])) {
      $this->redirect('login/index');
    }
    $budget_id = $_GET['id'];
    $budget = budget_m::get_budget_by_budgetID($budget_id);
    $items = budget_m::get_budget_items_by_budgetID($budget_id);
    $this->set('budget', $budget);
    $this->set('items', $items);
    $this->set('homeMenu', 'template/home-menu');
    $this->set('menuSide', 'template/menu-accountant');
    $this->set('script_content', 'accountant_f/script/script-edit');
    $this->template("accountant_f/edit");
  }

  public function delete() {
    if(!isset($_SESSION['auth'])) {
      $this->redirect('login/index');
    }
    $budget_id = $_GET['id'];
    $array = array(
      'budget_id' => $budget_id
    );

    budget_m::remove_budget_items($budget_id);
    $budget = budget_m::remove_budget($array);
    if($budget) {
      $echo = GOTO_URL.'/accountant/list';
      echo "<script>alert('Application succesfully removed.');
              window.location.href = '".$echo."'
           </script>";
    } else {
      $echo = GOTO_URL.'/accountant/list';
      echo "<script>alert('Application cannot removed.');
              window.location.href = '".$echo."'
           </script>";
    }

    $this->set('budget', $budget);
    $this->set('items', $items);
    $this->set('homeMenu', 'template/home-menu');
    $this->set('menuSide', 'template/menu-accountant');
    $this->set('script_content', 'accountant_f/script/script-edit');
    $this->template("accountant_f/edit");
  }

  public function add() {
    if(!isset($_SESSION['auth'])) {
      $this->redirect('login/index');
    }
    if(isset($_POST['txt_title'])) {
      $txt_title = $_POST['txt_title'];
      $txt_justify = $_POST['txt_justify'];
      $txt_budgettype = $_POST['txt_budgettype'];
      $txt_usagetype = $_POST['txt_usagetype'];
      $txt_fulltotal = $_POST['txt_fulltotal'];

      //echo $_SESSION['auth']->work_id;die;

      $data = array(
        'work_id' => $_SESSION['auth']->work_id,
        'title' => $txt_title,
        'justify' => $txt_justify,
        'budgettype' => $txt_budgettype,
        'usagetype' => $txt_usagetype,
        'fulltotal' => $txt_fulltotal,
        'status' => "Waiting for Approval",
        'create_dated' => date('Y-m-d')
      );

      $budget_id = budget_m::set_budget($data);

      if($budget_id) {
        if(count($_POST['txt_item']) > 0) {

          for($i = 0; $i < count($_POST['txt_item']); $i++) {

            $name = $_POST['txt_item'][$i];
            $txt_type = $_POST['txt_type'][$i];
            $txt_justification = $_POST['txt_justification'][$i];
            $txt_price = $_POST['txt_price'][$i];
            $txt_qty = $_POST['txt_qty'][$i];
            $txt_uom = $_POST['txt_uom'][$i];
            $txt_total = $_POST['txt_total'][$i];

            $data = array(
              'budget_id' => $budget_id,
              'name' => $name,
              'type' => $txt_type,
              'justification' => $txt_justification,
              'price' => $txt_price,
              'qty' => $txt_qty,
              'uom' => $txt_uom,
              'total' => $txt_total,
              'create_dated' => date('Y-m-d')
            );

            budget_m::set_budget_item($data);
          }


        }

        $echo = GOTO_URL.'/accountant/list';
        echo "<script>alert('Application succesfully submitted.');
                window.location.href = '".$echo."'
             </script>";


      } else {
        $echo = GOTO_URL.'/accountant/new';
        echo "<script>alert('Application cannot submit. Please fill all the form');
                window.location.href = '".$echo."'
             </script>";
      }


    } else {
      $echo = GOTO_URL.'/accountant/new';
      echo "<script>alert('Application cannot submit. Please fill all the form');
              window.location.href = '".$echo."'
           </script>";
    }
  }

  public function update() {
    if(!isset($_SESSION['auth'])) {
      $this->redirect('login/index');
    }
    if(isset($_POST['txt_title'])) {
    $txt_budget_id = $_POST['txt_budget_id'];
      $txt_title = $_POST['txt_title'];
      $txt_justify = $_POST['txt_justify'];
      $txt_budgettype = $_POST['txt_budgettype'];
      $txt_usagetype = $_POST['txt_usagetype'];
      $txt_fulltotal = $_POST['txt_fulltotal'];

      //echo $_SESSION['auth']->work_id;die;

      $data = array(
        'budget_id' => $txt_budget_id,
        'title' => $txt_title,
        'justify' => $txt_justify,
        'budgettype' => $txt_budgettype,
        'usagetype' => $txt_usagetype,
        'fulltotal' => $txt_fulltotal,
        'status' => "Waiting for Approval",
        'update_dated' => date('Y-m-d')
      );

      $budget_id = budget_m::update_budget($data);

      if($budget_id) {
        if(count($_POST['txt_item']) > 0) {

          budget_m::remove_budget_items($txt_budget_id);

          for($i = 0; $i < count($_POST['txt_item']); $i++) {

            $name = $_POST['txt_item'][$i];
            $txt_type = $_POST['txt_type'][$i];
            $txt_justification = $_POST['txt_justification'][$i];
            $txt_price = $_POST['txt_price'][$i];
            $txt_qty = $_POST['txt_qty'][$i];
            $txt_uom = $_POST['txt_uom'][$i];
            $txt_total = $_POST['txt_total'][$i];

            $data = array(
              'budget_id' => $txt_budget_id,
              'name' => $name,
              'type' => $txt_type,
              'justification' => $txt_justification,
              'price' => $txt_price,
              'qty' => $txt_qty,
              'uom' => $txt_uom,
              'total' => $txt_total,
              'create_dated' => date('Y-m-d')
            );

            budget_m::set_budget_item($data);
          }


        }

        $echo = GOTO_URL.'/accountant/list';
        echo "<script>alert('Application succesfully updated.');
                window.location.href = '".$echo."'
             </script>";


      } else {
        $echo = GOTO_URL.'/accountant/new';
        echo "<script>alert('Application cannot submit. Please fill all the form');
                window.location.href = '".$echo."'
             </script>";
      }


    } else {
      $echo = GOTO_URL.'/accountant/new';
      echo "<script>alert('Application cannot submit. Please fill all the form');
              window.location.href = '".$echo."'
           </script>";
    }
  }


}
