<?php 
  require_once('../includes/initialize.php');
  require('root.php');  
?>  
<?php include('../layouts/header.php');  ?>
<div class="checked-answers">
  
  <form action="sthg.php" method="post">
    <?php 
      $test = new Test(); 
      $result = $test->generate_test(8); 
      // print_r($result->transformations_questions_array);
      // print_r($result->transformations_answers_array);
	    echo $result->generate_transformations_html(); 

      // $test_html = $result->output_html(); 
      // echo $test_html; 
    ?>
    <input class="button form-button" type="submit" name="submit" value="Send" >
  </form >

</div>
<?php include('../layouts/footer.php'); ?>