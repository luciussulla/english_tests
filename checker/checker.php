<?php include('helpers.php'); ?>
<?php 
  // 1 - turn $_POST["answers_json] in an associative array
  // $answer_json = $_POST["answers_json"]; 
  // print_r($answer_json); 
  
  if(isset($_POST["submit"])) {
    $user_values_array = process_post_req($_POST); 
    $correct_answers_array_of_objects = json_decode($_POST["answers_json"]); // array of objects
    $correct_answers_array = process_correct_answers_objects_array($correct_answers_array_of_objects); 
    // print_r($correct_answers_array);
    // print_r($user_values_array); 
    // echo "<br/><br/>"; 
    // echo "<hr/>"; 
  } else {
    redirect_to('../index.php'); 
  }
  // 3 - display both arrays and the completed sentence 
  // question + answer user
  // if correct mark it green if not mark it red
?>  

<?php 
include("../layouts/header.php");

$points = 0;
$answers_html = "<div class=\"checked_answers\">"; 
for($i=0; $i<=count($correct_answers_array)-1; $i++) {
  $correct = false; 
  if($correct_answers_array[$i]===$user_values_array[$i]) {
    $points++; 
    $correct = true; 
  }
  $answers_html .= "<div class=\"single_answer\">";
    $answers_html .= "<p>Correct answer: {$correct_answers_array[$i]}</p>";
    $answers_html .= "<p class="; 
    if ($correct) { $answers_html .= "correct"; } else { $answers_html .= "incorrect"; }
    $answers_html .= ">User answer: {$user_values_array[$i]}</p>";
  $answers_html .= "</div><br/>"; 
}
$answers_html .= "</div>"; 

$answers_html .= "<div class=\"test_summary\">"; 
  $answers_html .= "<p>Points scored: {$points} out of " . count($correct_answers_array) . "</p>"; 
  // 4 - compare both arrays and calculate the percentage of correct answers 
  $percentage_scored = calculate_percentage(count($correct_answers_array), $points);  
  $answers_html .= "<p>Percentage scored: ". $percentage_scored ."%</p>"; 
$answers_html .= "</div>";   
// 5 - compare the percentage to a scale 

echo $answers_html;   
?>  

<?php include("../layouts/footer.php");?>