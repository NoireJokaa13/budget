<?php
require_once("config/database.php");

class bursary_m extends Db {

  public function __construct() {
  }

  public static function get_years() {

    $db = Db::getInstance();
    $stmt = $db->prepare("SELECT EXTRACT(ISOYEAR FROM create_dated) as years, count(budget_id) as total FROM budget GROUP BY EXTRACT(ISOYEAR FROM create_dated) ORDER BY EXTRACT(ISOYEAR FROM create_dated) ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public static function get_month() {
    $curr = date('Y');
    $db = Db::getInstance();
    $stmt = $db->prepare("SELECT EXTRACT(MONTH FROM create_dated) as month, count(budget_id) as total FROM budget WHERE create_dated between '$curr-01-01' and '$curr-12-31' GROUP BY EXTRACT(MONTH FROM create_dated) ORDER BY EXTRACT(MONTH FROM create_dated) ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public static function get_faculty() {
    $curr = date('Y');
    $db = Db::getInstance();
    $stmt = $db->prepare("SELECT users.centre_code, count(budget_id) as total FROM budget,users WHERE users.work_id = budget.work_id GROUP BY users.centre_code ORDER BY users.centre_code ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public static function get_amount() {
    $curr = date('Y');
    $db = Db::getInstance();
    $stmt = $db->prepare("SELECT EXTRACT(MONTH FROM create_dated) as month, SUM(fulltotal)::numeric as total FROM budget WHERE create_dated between '$curr-01-01' and '$curr-12-31' GROUP BY EXTRACT(MONTH FROM create_dated) ORDER BY EXTRACT(MONTH FROM create_dated) ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public static function get_budget($filter, $value) {

    $where = ''; $from = '';
    if($filter == 'type') {
      $where .= " AND budget.budget_type = '$value'";
    }
    if($filter == 'GL') {
      $from = ", budget_items";
      $where .= " AND budget_items.budget_id = budget.budget_id";
      $where .= " AND budget_items.type = '$value'";
    }
    if($filter == 'status') {
      if($value != 'Waiting') {
        $where .= " AND budget.status LIKE '$value%'";
        $where .= " OR budget.status_bursary LIKE '%$value%'";
      } else {
      }
    }

    $db = Db::getInstance();
    $stmt = $db->prepare("SELECT budget.*,users.name FROM budget,users $from WHERE users.work_id = budget.work_id AND (budget.status_dean is not null AND budget.status_dean != '' AND budget.status_dean != 'Rejected') $where ORDER BY budget.create_dated DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public static function get_budget_new($filter, $value) {

    $where = ''; $from = '';
    if($filter == 'type') {
      $where .= " AND budget.budget_type = '$value'";
    }
    if($filter == 'GL') {
      $from = ", budget_items";
      $where .= " AND budget_items.budget_id = budget.budget_id";
      $where .= " AND budget_items.type = '$value'";
    }

    $db = Db::getInstance();
    $stmt = $db->prepare("SELECT budget.*,users.name FROM budget,users $from WHERE users.work_id = budget.work_id AND budget.status_dean is not null AND budget.status_bursary is null AND budget.status_dean != 'Rejected' $where ORDER BY budget.create_dated DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);

  }

  public static function get_budget_new_all($filter, $value, $offset, $total_records_per_page) {

    $where = ''; $from = '';
    if($filter == 'type') {
      $where .= " AND budget.budget_type = '$value'";
    }
    if($filter == 'GL') {
      $from = ", budget_items";
      $where .= " AND budget_items.budget_id = budget.budget_id";
      $where .= " AND budget_items.type = '$value'";
    }

    $db = Db::getInstance();
    $stmt = $db->prepare("SELECT budget.*,users.name FROM budget,users $from WHERE users.work_id = budget.work_id AND budget.status_dean is not null AND budget.status_bursary is null AND budget.status_dean != 'Rejected' $where ORDER BY budget.create_dated DESC LIMIT $offset, $total_records_per_page");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);

  }

  public static function get_budget_by_budgetID($budgetid) {

    $db = Db::getInstance();
    $stmt = $db->prepare("SELECT * FROM budget WHERE budget_id = :id");
    $stmt->execute([
      'id' => $budgetid
    ]);
    return $stmt->fetchAll(PDO::FETCH_OBJ);

  }

  public static function get_budget_items_by_budgetID($budgetid) {

    $db = Db::getInstance();
    $stmt = $db->prepare("SELECT * FROM budget_items WHERE budget_id = :id");
    $stmt->execute([
      'id' => $budgetid
    ]);
    return $stmt->fetchAll(PDO::FETCH_OBJ);

  }

  public static function update_budget($data) {

    $db = Db::getInstance();
    $stmt = $db->prepare("UPDATE budget SET remark_bursary = :remark_bursary, status_bursary = :status_bursary, status = :status, bursary_id = :bursary_id, bursary_approve_dated = :bursary_approve_dated WHERE budget_id = :budget_id");
    return $stmt->execute([
      'budget_id' => $data['budget_id'],
      'remark_bursary' => $data['remark_bursary'],
      'status_bursary' => $data['status_bursary'],
      'bursary_id' => $data['bursary_id'],
      'status' => $data['status'],
      'bursary_approve_dated' => $data['bursary_approve_dated']
    ]);
    //return $db->lastInsertId();

  }


}
?>
