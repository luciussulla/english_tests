<?php 
  require_once('../includes/initialize.php');
  require('root.php');  
?>  

<?php 
  if(!isset($_GET["id"])) {
    redirect_to("../index.php");
    die();  
  } else {
    $test_id = $_GET["id"]; 
  }
?>

<?php include('../layouts/header.php');  ?>
<div class="checked-answers">
  
  <form class="form-box" action="../user_test/create.php" method="post"> 
    <input type="hidden" name="test_id" value="<?php echo $test_id ?>" > 
    <div>Please enter your nickname: <input type="text" name="student_name" value=""></div>
    <?php 
      $test = new Test(); 
      $result = $test->generate_test($test_id); 

	    echo $result->generate_transformations_html();  
    ?>
    <input class="button form-button" type="submit" name="submit" value="Send" >
  </form >

</div>
<?php include('../layouts/footer.php'); ?>