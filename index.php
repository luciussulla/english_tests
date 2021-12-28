<?php include('./root.php') ?>

<?php 
  include('./db_connection.php'); 
  include('./functions.php'); 
?>

<?php 
  $query = "SELECT * FROM transformations"; 
  $result = mysqli_query($connection, $query); 

  if(!$result) {
    die("Database query failerd" . mysqli_error());
  } else {
    
  }
?>

<?php include("./layouts/index-header.php") ?>
<?php include("./layouts/footer.php") ?>
<?php 
  mysqli_close($connection); 
?>