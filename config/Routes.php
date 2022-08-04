<?php

class Routes {

  public function __construct() {
    //global $post;
    //$this->post = $_POST;
    session_start();
  }

  public function _object_to_array($object)
    {
        if (!is_object($object) && !is_array($object)) {
            return $object;
        }

        return array_map('object_to_array', (array) $object);
    }

  public function uri_segment() {
    $uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $uri_segments = explode('/', $uri_path);

    return $uri_segments;
  }
}

 ?>
