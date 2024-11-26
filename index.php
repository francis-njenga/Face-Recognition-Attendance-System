<?php
require_once __DIR__ . "/database/database_connection.php";
require_once __DIR__ . "/resources/lib/php_functions.php";

//we get the request url and store it in a variable $request_site
$request_site = isset($_GET['request_site']) ? $_GET['request_site'] : 'home';

session_start();


if ($request_site === "logout") {
  session_destroy();
  header("Location: login");
  exit();
}


$logged_in = user();
//displaying login page
if (!$logged_in) {
    $request_site = "login";
}

$path = __DIR__ . "/resources/pages/";
//path to pages 
if ($logged_in) {
  //we check the role of logged in user and construct link to either administrator or lecture folder
  $page_path = $path . "$logged_in->role/$request_site.php";
} else {
  $page_path =  $path . "$request_site.php";
}

// echo $page_path;
if (file_exists($page_path)) {
  require $page_path;
} else {
  require "{$path}404.php";
}



// unsetting the errors after they have been displayed
if (isset($_SESSION['errors'])) {
  unset($_SESSION['errors']);
}
