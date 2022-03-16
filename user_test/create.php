<?php require_once("../includes/initialize.php"); ?>
<?php include("root.php"); ?>
<?php 

if(!isset($_POST["submit"])) {
  redirect_to("../index.php"); 
  die(); 
}; 

// retrieve test from db
$test_id = $database->escape_value($_POST["test_id"]);
$test_from_db  = new Test();
$db_test_instance = $test_from_db->generate_test($test_id); 

// process user answers
$new_user_test = new UserTest($_POST);

// check user test 
$new_user_test->check_test($db_test_instance); 
$max_points     = $new_user_test->max_points; 
$scored_points  = $new_user_test->scored_points; 
$new_grader     = new Grader($scored_points, $max_points); 

// save test results; 
$new_user_test->save($new_grader); 
?>

<?php include('../layouts/header.php');  ?>
  <div class="checked_answers">
    <?php $new_grader->result_html(); ?>
  </div>
<?php include('../layouts/footer.php'); ?>