<?php

require_once("config/database.php");


$basepath = 'http'.'://'.$_SERVER['HTTP_HOST'].str_replace('//','/',dirname($_SERVER['SCRIPT_NAME']));

define('PATH', $_SERVER['DOCUMENT_ROOT']);
define('BASE', $basepath);
define('GOTO_URL', BASE.'/'.'index.php');
define('BASE_URL', BASE.'index.php');
define('APP', 'app');
define('THEME', BASE.'/'.'assets');

require_once("config/Config.php");

?>
