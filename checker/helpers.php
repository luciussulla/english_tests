<?php

  function save_test_results($data) {
    // need to open db connection 
    print_r($data)
    // need to close db connection 
  }

  function process_post_req($data) {
    $output = array_slice($data, 0, -2); // cutting the sumbit from the $_POST
    // make an array out of the object 
    $answers_array = array(); 
    foreach($output as $key=>$value) {
      $answers_array[] = $value; 
    }
    return $answers_array; 
  }

  function process_correct_answers_objects_array($data) {
    $correct_answers_array = array(); 
    // filling in the correct answers array 
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
?>