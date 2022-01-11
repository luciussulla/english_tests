<?php 
  require_once('root.php'); 
  require_once($root . 'functions.php'); 
  require_once($root . 'session/session.php'); 
?>

<?php 
  session_start();  
  // $_SESSION["username"] = null; 
  // $_SESSION["user_id"] = null; 

  $_SESSION = array(); 
  if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-4200, '/'); 
  }
  session_destroy(); 

  redirect_to("login.php"); 
?>