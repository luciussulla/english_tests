<?php 
require_once('./includes/initialize.php'); 
require_once('./includes/functions.php'); 
?>
<?php include('./root.php') ?>
<?php include('./db_connection.php'); ?>

<?php include("./layouts/index-header.php"); ?>
<?php include("./layouts/footer.php") ?>

<?php 
  mysqli_close($connection); 
?>