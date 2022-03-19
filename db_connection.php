<!-- <?php 

  // $dbhost = "localhost";
  // $dbuser = "bond007_tester"; 
  // $dbpass = "bond007_tester";
  // $dbname = "bond007_tester"; 
  
  $dbhost = "localhost";
  $dbuser = "root"; 
  $dbpass = "";
  $dbname = "tester"; 

  $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname); 

  if(mysqli_connect_errno()) {
    die("Database connection failed: " . 
          mysqli_connect_error() . " (" .
          mysqli_connect_errno() . ")"
    ); 
  }
?> -->