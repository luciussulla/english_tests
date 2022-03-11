<?php
  defined('DS')        ? null : define('DS',        DIRECTORY_SEPARATOR); 
  defined('SITE_ROOT') ? null : define('SITE_ROOT', DS.'xampp'.DS.'htdocs'.DS.'tester'); 
  defined('LIB_PATH')  ? null : define('LIB_PATH',  SITE_ROOT.DS.'includes');
  // require db connection
  require_once(LIB_PATH.DS.'database.php'); 
  // function 
  require_once(LIB_PATH.DS.'functions.php'); 
  // core objects 
  require_once(LIB_PATH.DS.'transformation.php'); 
  require_once(LIB_PATH.DS.'test.php'); 
  require_once(LIB_PATH.DS.'user_test.php'); 
?>