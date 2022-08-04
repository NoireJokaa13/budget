<?php

require_once("config/Routes.php");

$Routes = new Routes();
$uri = $Routes->uri_segment();

if(count($uri) > 2) {
  require_once("app/controllers/$uri[2].php");
  $controller=new $uri[2];
  $controller->{$uri[3]}();
} else {
  require_once("app/controllers/login.php");
  $controller=new login;
  $controller->{'index'}();
}

/*
//the function for calling the actions on the controller
function call($controller,$action){

  //first we load the php file, with the correct controller and model
require_once("app/controllers/$controller.php");
require_once("app/models/$controller.php");

//we call the action function on the controller
$controller=new $controller;
$controller->{$action}();
}


//an array, for the allowed controllers and their respective actions
$controllers = array('product' => ['all','showAll','add','delete'],
                        'comment' => ['all','showAll','allFromUser','delete','add']);


  //we check, if the invoked action is part of our mvc code
  //without this check, a malicous product, could execute arbitrary code
  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('errorController', 'error');
    }
  } else {
    call('errorController', 'error');
  }
*/


?>
