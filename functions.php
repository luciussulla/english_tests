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
      return $question_assoc["question"]; 
    } 
  } 
  
  function correct_answers_into_json($query_result) {
    global $connection; 
    // var_dump($query_result); 
    // echo $query_result; 

    $question_answer_array = array(); 
    while($assoc = mysqli_fetch_assoc($query_result)) {
      var_dump($assoc); 
      echo "dupa"; 
      // echo $assoc; 
      $question_answer_array[] = array('id'=>$assoc["id"], 'answer'=>$assoc["answer"]);
      // array_push($question_answer_array, $obj); 
    }
    // mysqli_free_result($query_result); 
    // var_dump($question_answer_array); 
    return $question_answer_array; 
  }

?>  