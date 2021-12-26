<?php 
  // capture data send from test/show.php
  // show the answers 
  if(isset($_POST["submit"])) {
    echo $_POST["answers_json"]; 
  }
  
?>