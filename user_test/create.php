<?php 

require_once("../includes/initialize.php"); 
include("root.php");

if(!isset($_POST["submit"])) {
  redirect_to("../index.php"); 
  die(); 
}; 

// test instance 
$test_id = $database->escape_value($_POST["test_id"]);
$test_from_db  = new Test();
$test_instance = $test_from_db->generate_test($test_id);  
// print_r($test_instance->transformations_questions_array);

// user test instance 
$new_user_test = new UserTest($_POST); 
$new_user_test->check_test($test_from_db, $new_user_test); 

// $new_user_test->save(); 
// $new_user_test->show_result_html(); 

?>