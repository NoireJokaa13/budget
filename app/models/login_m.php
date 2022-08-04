<?php
require_once("config/database.php");

class login_m extends Db {

  public function __construct() {
  }

  public static function get_userAuth($workid, $password) {

    $db = Db::getInstance();
    $stmt = $db->prepare("SELECT * FROM users WHERE work_id = :id AND password = :password");
    $stmt->execute([
      'id' => $workid,
      'password' => $password
    ]);
    return $stmt->fetch(PDO::FETCH_OBJ);

  }

}
?>
