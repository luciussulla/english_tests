<?php 
  
  function process_post_req() {
    // turn user answers from object into an array
    $user_answers = array_slice($_POST, 2, -2); // cutting the sumbit, name and other unnecessary data from the $_POST
    // make an array out of the object 
    $answers_array = array(); 
    foreach($user_answers as $key=>$value) {
      $answers_array[] = $value; 
    }
    return $answers_array; 
  }

  function process_correct_answers_objects_array($data) {
    // turn correct answers json into an array + correct answers is a json forma need to be processed accordingly 
    $correct_answers_array = array(); 
    foreach($data as $key => $object) {
      $answer = $object->answer;  
      $correct_answers_array[] = $answer; 
    } 
    return $correct_answers_array; 
  }

  function calculate_percentage($points, $max_points) {
    $result = round(($points/$max_points),2) * 100; 
    return $result;
  }

  function save_posted($points, $percentage_scored, $user_values_array) {
    include('../db_connection.php'); 
    // process request: 
    $student_name = $_POST["student_name"]; 
    $answers_array_json = json_encode($user_values_array); 
    $grade = 5; // calculate it on the basis of scored percentage

    // - already done in previous functions 
    // validations 
    // - to be implemented later 
    // display errors
    // to be implemented later 
    // perform query 
    
    $query =  "INSERT INTO test_results ";
    $query .= "(test_id, student_name, grade, percentage, answers_json) ";
    $query .= "VALUES (1, '{$student_name}', {$grade}, {$percentage_scored}, '{$answers_array_json}')";
    // redirect 

    $result = mysqli_query($connection, $query);
    if($result) {
      // $_SESSION["message"] = "Page created.";
      // redirect_to("manage_content.php");
      echo "saved";
    } else {
      // $_SESSION["message"] = "Page creation failed.";
      // redirect_to("new_page.php");
      echo "problem saving"; 
    }
    // handle wrong request to page 

    if(isset($connection)) { mysqli_close($connection);} 
  }

  function process_user_submission() {
    // db save side 
    $points = 0;
    $percentage_scored = 0; 
    $user_values_array = process_post_req(); 
    $correct_answers_array_of_objects = json_decode($_POST["answers_json"]); // array of objects
    $correct_answers_array = process_correct_answers_objects_array($correct_answers_array_of_objects); 
    // view side
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
    $answers_html .= "<div class=\"test_summary\">"; 
    $answers_html .= "<p>Points scored: {$points} out of " . count($correct_answers_array) . "</p>"; 
    $percentage_scored = calculate_percentage($points, count($correct_answers_array));  
    $answers_html .= "<p>Percentage scored: ". $percentage_scored ."%</p>"; 
    $answers_html .= "</div>";   
    $answers_html .= "</div>"; 
    save_posted($points, $percentage_scored, $user_values_array);
    return $answers_html; 
  }

?>