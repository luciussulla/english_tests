<?php 
  session_start(); 

  function message() {
    $output = "<div class=\"session_message\">"; 
    $output .= htmlentities($_SESSION["message"]); 
    $output .= "</div>"; 

    $_SESSION["message"] = null; 
    
    return $output; 
  }

?>