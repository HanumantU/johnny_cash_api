<?php	

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

//$urlArray = explode("?", $_SERVER['REQUEST_URI']);
//echo "<pre>";
//print_r($urlArray);
//if (!in_array("index", $urlArray)) {
//    $urlArray[2] = isset($urlArray[1]) ? $urlArray[1] : '';
//    $urlArray[1] = "index";
//
//}
//$urlArray_uri = explode("/", $urlArray[0]);
//if(count($urlArray_uri) > 3) {
//    print_r($urlArray_uri);
//}
//array_shift($urlArray_uri);
//$url = end($urlArray_uri);

//print_r($urlArray_uri);exit;

$url = $_GET['url'];

require_once (ROOT . DS . 'library' . DS . 'bootstrap.php');
