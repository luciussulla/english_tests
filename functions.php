<?php 

  function redirect_to($new_location='') {
    header('Location: '.$new_location); 
    exit;
  }

  function escape_string($string) {
    global $connection; 
    $escaped_string = mysqli_real_escape_string($connection, $string); 
    return $escaped_string; 
  }

  function find_all_transformations() {
    global $connection; 
    $query = "SELECT * FROM transformations"; 
    $result = mysqli_query($connection, $query); 
    if($result) {
      // echo "all questions fetched"; 
      // print_r($result); 
      return $result; 
      // redirect_to('question_list');
    } else {
      // echo "all questions fetched"; 
      die("Database query failerd" . mysqli_error());
    }
    return $result; 
  }

  function split_question($question_assoc) {
    // split question uses the build_question function
    $question_from_db = $question_assoc["question"]; 
    $is_match = preg_match("/__/", $question_from_db); // quesion in db has __ where the user shuld privide his answer (blank space for user to insert answer)
    if ($is_match) {
      $array =  preg_split("/__/", $question_from_db);
      $question_with_input = build_question($array, $question_assoc["id"]); // the question is built and the input field is inserted instead of "__";
      return $question_with_input; 
    } else {
      // if no blank was inserted just the beginning of the question you get the question back
      // still need work here to return full question with input field
      return $question_from_db;  
    } 
  }
    
  function build_question($array, $question_id) {
    $question_input = "<p>";
    $question_input .= $array[0]; 
    $question_input .= " <input type=\"text\" value=\"\" name=\"answer-{$question_id}\" /> "; 
    $question_input .= $array[1];
    $question_input .= "</p>";
    return $question_input; 
  }

  function find_question_by_id($id) {
    global $connection; 
    $query  = "SELECT * FROM transformations "; 
    $query .= "WHERE id={$id} "; 
    $query .= "LIMIT 1"; 
  
    $result   = mysqli_query($connection, $query); 
    $question = mysqli_fetch_assoc($result); 
    mysqli_free_result($result);
    
    if($question) {
      // print_r($question); 
      return $question; 
    } else {
      echo "Db connection error"; 
    }
  }

?>  