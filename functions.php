<?php 

  function escape_string($string) {
    global $connection; 
    $escaped_string = mysqli_real_escape_string($connection, $string); 
    return $escaped_string; 
  }

  function redirect_to($new_location='') {
    header('Location: '.$new_location); 
    exit;
  }

  function build_question($array, $question_id) {
    $question_input = "<p>";
    $question_input .= $array[0]; 
    $question_input .= " <input type=\"text\" value=\"\" name=\"answer-{$question_id}\" /> "; 
    $question_input .= $array[1];
    $question_input .= "</p>";

    return $question_input; 
  }

  function split_question($question_assoc) {
    // split question uses the build_question function

    $is_match = preg_match("/__/", $question_assoc["question"]); 
    if ($is_match) {
      $array =  preg_split("/__/", $question_assoc["question"]);
      $question_input = build_question($array, $question_assoc["id"]); // the question is built and the input is inserted instead of "__";
      return $question_input; 
    } else {
      // if no blank was inserted just the beginning of the question you get the question back
      // still need work here to return full question with input field
      return $q; 
    } 
  }  

?>  