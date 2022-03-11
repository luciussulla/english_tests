<?php require_once('initialize.php');

  class UserTest extends DatabaseObject {

    public $answers_array; 
    public $grade; 
    public $percentages; 
    public $student_name; 
    public $test_id; 

    // make sure the user answers can be saved in the instance in the same (or similar ) format to the Test class's questions_array 
    // Array ([]exercise_type => "transformations",  ????
    //          Array(id=>answers),
    //          Array(id=>answer),    
    //       )
    // so: 
    // type of question should be indicated 
    // array of answers 

    public function __construct($post_request) {
      global $database;

      $this->test_id =       $database->escape_value($post_request["test_id"]);  
      $this->student_name =  $database->escape_value($post_request["student_name"]); 
      $this->answers_array = $post_request["transformations"];
    }

    public function check_test($db_test_instance, $user_test_instance) {
      // foreach($db_test_instance->transformations_answers_array as $key=>$value) {
        
      //   print_r($key); 
      //   echo "<br.>"; 
      //   print_r($value); 
      //   echo "<br/>"; 
      // }

      // echo "<br/>";
      // foreach($user_test_instance->answers_array as $key=>$value) {
      //   print_r($key); 
      //   echo "<br.>"; 
      //   print_r($value); 
      //   echo "<br/>"; 
      // }

      // remove the exercie type object from the db_test_instance's answers array - it will be later removed once the Exercise class is created
      $db_test_answers_array = $db_test_instance->transformations_answers_array; 
      array_shift($db_test_answers_array); 
      
      // iterate through the proper answers and user answers and see if they are all correct and matching. 
      $proper_answers_array = []; 
      $user_answers_array   = []; 

      for($i = 0; $i<count($db_test_answers_array); $i++) {
        foreach($db_test_answers_array[$i] as $question_id => $queston_content) {
          $proper_answers_array[] = $queston_content; 
        }
        foreach($user_test_instance->answers_array[$i] as $id => $answer) {
          $user_answers_array[] = $answer; 
        }
      }

      // now we just need to compare the answers 
      // BUT THERE"S A BUG the answers do not have the question ID!!! Find out why it is missing. 
      
      return " "; 
    }
    
    public function save($post_request) {
      global $database; 
      
      $this->answers_array;  
      $answers_json  = json_encode($answers_array); 
      // Check the test before you save it.; 

      $query = "INSERT INTO user_tests ("; 
      $query .= "test_id, student_name, answers_array"; 
      $query .= ") VALUES ("; 
      $query .= "'{$test_id}', '{$student_name}', '{$answers_json}'"; 
      $query .= ")";
    
      $result_set = $database->query($query); 
      if($result_set) {
        echo "Test has been saved"; 
      } else {
        echo "There's been a problem, test not saves"; 
      }
    }
  }

?>  