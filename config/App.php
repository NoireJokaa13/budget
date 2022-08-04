<?php
require_once("config/Routes.php");

class App extends Routes {

  public function __construct() {
    global $vars;
  }

  function redirect($url) {
    //echo 'Location: index.php/'.$url;
    header('Location: '.BASE_URL.'/'.$url);
    //exit();
  }


  public function view($views, $vars = array()) {
    if(file_exists('app/views/'.$views.'.php')) {
      require_once('app/views/'.$views.'.php');
    } else {
      echo '<blockquote class="blockquote blockquote-primary">
            <footer class="blockquote-footer">ERROR: No such file or directory.</footer>
            <p>'.BASE.'/app/views/'.$views.'.php</p>
            </blockquote>';
    }

  }

  public function template($views, $vars = array()) {
    $this->content = $views;
    if(!isset($_SESSION['auth'])) {
      require_once('app/views/template/layout_login.php');
    } else {
      require_once('app/views/template/layout.php');
    }

  }

  public function set($key, $value = '', $escape = TRUE) {
		$key = Routes::_object_to_array($key);
		if ( ! is_array($key)) {
			$key = array($key => $value);
		}

    foreach ($key as $k => $v) {
			$this->$k = $v;
		}

		return $this;
	}

  public function model($views) {
    if(file_exists('app/models/'.$views.'.php')) {
      require_once('app/models/'.$views.'.php');
    } else {
      echo '<blockquote class="blockquote blockquote-danger">
            <footer class="blockquote-footer">ERROR: No such file or directory.</footer>
            <p>'.BASE.'/app/models/'.$views.'.php</p>
            </blockquote>';
    }

  }

}

 ?>
