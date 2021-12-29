<?php include('./root.php') ?>

<?php 
  include('./db_connection.php'); 
  include('./functions.php'); 
?>

<?php include("./layouts/index-header.php") ?>
<?php include("./layouts/footer.php") ?>
<?php 
  mysqli_close($connection); 
?>