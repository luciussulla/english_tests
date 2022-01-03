<?php include('./root.php'); ?>
<?php include('./helpers.php'); ?>
<?php include('../functions.php'); ?>

<?php 
  // 1 - turn $_POST["answers_json] in an associative array
  // $answer_json = $_POST["answers_json"]; 
  // print_r($answer_json); 
  
  if(isset($_POST["submit"])) {
    // there we check the answers save all the data in test result 
    // since we are not saving the answers in the proper way we just need immediately in the same file show the test to the student 
    // so basically checker will both be a save and show page, which should be separated later 
    $answers_html = process_user_submission(); // nie trzeba przekazywać $_POST
  } else {
    redirect_to('../index.php'); 
  }
?>  

<?php 
include("../layouts/header.php");
// 5 - compare the percentage to a scale
echo $answers_html;   
?>  

<?php include("../layouts/footer.php");?>