<?php
//a db class for connecting to the database
  class Db {
    private static $instance = NULL;

    protected static $host = "localhost";
    protected static $port  = "5432";
    protected static $user  = "postgres";
    protected static $pass = "admin123";
    protected static $db = "budget";

    protected static $options = [
      PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    public static function getInstance() {
      if (!isset(self::$instance)) {

        self::$instance = new PDO("pgsql:host=".self::$host." port=".self::$port." dbname=".self::$db, self::$user, self::$pass, self::$options);
        //self::$instance = mysqli_connect("localhost", "root", "root", "assignment2");
      }
      return self::$instance;
    }
  }




?>
