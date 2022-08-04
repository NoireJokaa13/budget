<?php
require_once("config/database.php");

class dean_m extends Db {

  public function __construct() {
  }

  public static function get_years($centre) {

    $db = Db::getInstance();
    $stmt = $db->prepare("SELECT EXTRACT(ISOYEAR FROM budget.create_dated) as years, count(budget.budget_id) as total FROM budget,users WHERE users.centre_code = '$centre' AND users.work_id = budget.work_id GROUP BY EXTRACT(ISOYEAR FROM budget.create_dated) ORDER BY EXTRACT(ISOYEAR FROM budget.create_dated) ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public static function get_month($centre) {
    $curr = date('Y');
    $db = Db::getInstance();
    $stmt = $db->prepare("SELECT EXTRACT(MONTH FROM budget.create_dated) as month, count(budget.budget_id) as total FROM budget,users WHERE (create_dated between '$curr-01-01' and '$curr-12-31') AND users.centre_code = '$centre' AND users.work_id = budget.work_id GROUP BY EXTRACT(MONTH FROM budget.create_dated) ORDER BY EXTRACT(MONTH FROM budget.create_dated) ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public static function get_amount($centre) {
    $curr = date('Y');
    $db = Db::getInstance();
    $stmt = $db->prepare("SELECT EXTRACT(MONTH FROM budget.create_dated) as month, SUM(budget.fulltotal)::numeric as total FROM budget,users WHERE create_dated between '$curr-01-01' and '$curr-12-31' AND users.centre_code = '$centre' AND users.work_id = budget.work_id GROUP BY EXTRACT(MONTH FROM budget.create_dated) ORDER BY EXTRACT(MONTH FROM budget.create_dated) ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
  }

  public static function get_budget($centre, $filter, $value) {

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
      $where .= " AND budget.status LIKE '$value%'";
      $where .= " OR budget.status_dean LIKE '%$value%'";
    }

    $db = Db::getInstance();
    $stmt = $db->prepare("SELECT budget.*,users.name FROM budget, users $from WHERE users.centre_code = '$centre' AND users.work_id = budget.work_id $where ORDER BY budget.create_dated DESC");
    $stmt->execute();
    //echo "SELECT budget.* FROM budget, users $from WHERE users.centre_code = '$centre' AND users.work_id = budget.work_id $where ORDER BY budget.create_dated DESC";die;
    return $stmt->fetchAll(PDO::FETCH_OBJ);

  }

  public static function get_budget_new($centre, $filter, $value) {

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
    $stmt = $db->prepare("SELECT budget.*,users.name FROM budget, users $from WHERE users.centre_code = '$centre' AND users.work_id = budget.work_id AND (budget.status_dean = '' OR budget.status_dean is null) $where ORDER BY budget.create_dated DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);

  }

  public static function get_budget_new_all($centre, $filter, $value, $offset, $total_records_per_page) {

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
    $stmt = $db->prepare("SELECT budget.*,users.name FROM budget, users $from WHERE users.centre_code = '$centre' AND users.work_id = budget.work_id AND (budget.status_dean = '' OR budget.status_dean is null) $where ORDER BY budget.create_dated DESC OFFSET $offset LIMIT $total_records_per_page");
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
    $stmt = $db->prepare("UPDATE budget SET remark_dean = :remark_dean, status_dean = :status_dean, status = :status, dean_id = :dean_id, dean_approve_dated = :dean_approve_dated WHERE budget_id = :budget_id");
    return $stmt->execute([
      'budget_id' => $data['budget_id'],
      'remark_dean' => $data['remark_dean'],
      'status_dean' => $data['status_dean'],
      'dean_id' => $data['dean_id'],
      'status' => $data['status'],
      'dean_approve_dated' => $data['dean_approve_dated']
    ]);
    //return $db->lastInsertId();

  }


}
?>
