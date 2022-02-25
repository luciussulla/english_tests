<?php require_once('../includes/initialize.php'); ?>

<?php 
  if(!isset($_POST)) {
    redirect_to('new');
    exit(); 
  }
?>

<?php 
  // objectives 
  // create the test save it
  $question_ids_array = $_POST["question_ids"]; 
  // print_r($question_ids_array); 
  $test = new Test();
  if($test->generate_test($question_ids_array)) {
    if($test->save()) {
      echo "<br/>"; 
      echo "Test has been saved"; 
      // here we can try to print the results
    } else {
      echo "Test has not been saved"; 
    }
  } else {
    echo "Failed to generate test"; 
  } 
  // what is saved is a json format of question ids 
  // the test should have this format: 
  // the Test class should have a function that accepts the string
  // the $_POST with selected test should land here and then be parsed into JSON
?>