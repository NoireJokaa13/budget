<?php
require_once("config/database.php");

class budget_m extends Db {

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

  public static function get_budget_by_workID($workid, $filter, $value) {

    $where = ''; $from = ''; $select = "";
    if($filter == 'type') {
      $where .= " AND budget.budget_type = '$value'";
    }
    if($filter == 'GL') {
      $select = ",budget_items.budget_id";
      $from = ", budget_items";
      $where .= " AND budget_items.budget_id = budget.budget_id";
      $where .= " AND budget_items.type = '$value'";
      $where .= " GROUP BY budget_items.budget_id, budget.budget_id";
    }
    if($filter == 'status') {
      $where .= " AND (budget.status LIKE '$value%' OR budget.status_dean LIKE '$value%' OR budget.status_bursary LIKE '$value%')";
    }

    $db = Db::getInstance();
    $stmt = $db->prepare("SELECT budget.* $select FROM budget $from WHERE budget.work_id = '$workid' $where ORDER BY budget.create_dated DESC");
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

  public static function set_budget($data) {

    $db = Db::getInstance();
    $stmt = $db->prepare("INSERT INTO budget(work_id,title,justify,budget_type,usage_type,fulltotal,status,create_dated) VALUES(:work_id,:title,:justify,:budget_type,:usage_type,:fulltotal,:status,:create_dated)");
    $stmt->execute([
      'work_id' => $data['work_id'],
      'title' => $data['title'],
      'justify' => $data['justify'],
      'budget_type' => $data['budgettype'],
      'usage_type' => $data['usagetype'],
      'fulltotal' => $data['fulltotal'],
      'status' => $data['status'],
      'create_dated' => $data['create_dated']
    ]);
    return $db->lastInsertId();

  }

  public static function set_budget_item($data) {

    $db = Db::getInstance();
    $stmt = $db->prepare("INSERT INTO budget_items(budget_id,name,type,justification,price,qty,uom,total,create_dated) VALUES(:budget_id,:name,:type,:justification,:price,:qty,:uom,:total,:create_dated)");
    $stmt->execute([
      'budget_id' => $data['budget_id'],
      'name' => $data['name'],
      'type' => $data['type'],
      'justification' => $data['justification'],
      'price' => $data['price'],
      'qty' => $data['qty'],
      'uom' => $data['uom'],
      'total' => $data['total'],
      'create_dated' => $data['create_dated']
    ]);
    return $db->lastInsertId();

  }


  public static function update_budget($data) {

    $db = Db::getInstance();
    $stmt = $db->prepare("UPDATE budget SET title = :title, justify = :justify, budget_type = :budget_type, usage_type = :usage_type, fulltotal = :fulltotal, status = :status, update_dated = :update_dated WHERE budget_id = :budget_id");
    return $stmt->execute([
      'title' => $data['title'],
      'justify' => $data['justify'],
      'budget_type' => $data['budgettype'],
      'usage_type' => $data['usagetype'],
      'fulltotal' => $data['fulltotal'],
      'status' => $data['status'],
      'update_dated' => $data['update_dated'],
      'budget_id' => $data['budget_id']
    ]);
    //return $db->lastInsertId();

  }

  public static function remove_budget_items($budget_id) {

    $db = Db::getInstance();
    $stmt = $db->prepare("DELETE FROM budget_items WHERE budget_id = :budget_id");
    return $stmt->execute([
      'budget_id' => $budget_id
    ]);
    //return $db->lastInsertId();

  }

  public static function remove_budget($data) {

    $db = Db::getInstance();
    $stmt = $db->prepare("DELETE FROM budget WHERE budget_id = :budget_id");
    return $stmt->execute([
      'budget_id' => $data['budget_id']
    ]);
    //return $db->lastInsertId();

  }



}
?>
