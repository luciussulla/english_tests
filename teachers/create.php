<?php include('root.php'); ?>
<?php include($root . 'db_connection.php'); ?>
<?php include($root . 'functions.php'); ?>
<?php include($root . 'layouts/header.php'); ?>

<p>Create Teacher</p>
<?php 
  echo "<pre>"; 
  echo var_dump($_POST); 
  echo "</pre>"; 
?>
<?php 
  // make sure it's a post request
  // make sure data is send 
  if($_POST["submit"]) {
     // perform create 
    $user_password = $_POST["password"]; 
    $first_name = $_POST["first_name"]; 
    $last_name = $_POST["last_name"]; 
    $email = $_POST["email"]; 
    // encrypt password 
    $hashed_password = password_encrypt($user_password); 
    // save user
    $query = "INSERT INTO teachers "; 
    $query .= "(first_name, last_name, password, email) ";
    $query .= "VALUES ("; 
    $query .= "'{$first_name}', '{$last_name}', '{$hashed_password}', '{$email}' "; 
    $query .= ")";
    // inform about results and redirect
    $result = mysqli_query($connection, $query); 
    if($result) {
      echo "query successful \n"; 
    } else {
      echo "problem connecting to the db \n"; 
    }
  }
 
?>
<?php include($root . 'layouts/footer.php'); ?>