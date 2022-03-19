<?php require_once('initialize.php');
      require_once('grader.php'); 

  class UserTest {

    // This class's main function is to: 
    // - store user answers in instance variable
    // - accept db answers 
    // - check user answers stored in instance var agains the db_answers sent to it 
    // - grade and save user results
    
    public $user_answers_array; 
    public $db_test_answers; 
    public $grade; 
    public $percentage; 
    public $student_name; 
    public $test_id; 
    public $max_points;
    public $scored_points; 
    public $test_result_html; 

    public function __construct($post_request) {
      global $database;

      $this->test_id =            $database->escape_value($post_request["test_id"]);  
      $this->student_name =       $database->escape_value($post_request["student_name"]); 
      $this->user_answers_array = $this->sanitize_answers($post_request["transformations"]);
    }

    public function sanitize_answers($answers) {
      global $database; 
      // echo '<pre>'; 
      // var_dump($answers);
      // echo '</pre>'; 
      $ans = array(); 
      foreach($answers as $value) {
        foreach($value as $key=>$value) {
          $ans[$key] = trim($database->escape_value($value));   
        }
      }
      return $ans;
    } 

    public function grade_test() {
      // instantiate grader class and grade the test
      $new_grader             = new Grader($this->scored_points, $this->max_points); 
      $this->percentage       = $new_grader->percentage; 
      $this->grade            = $new_grader->grade; 
      $this->test_result_html = $new_grader->result_html(); 
    }

    public function test_result_html() {
      return $this->test_result_html; 
    }

    public function check_test($db_test_instance) {

      // echo "db test answers:"; 
      // echo "<pre>"; 
      // var_dump($this->sanitize_answers($db_test_instance->transformations_answers_array)); 
      // echo "</pre>"; 

      // echo "user answers";  
      // echo "<pre>"; 
      // var_dump($this->user_answers_array); 
      // echo "</pre>"; 
      array_shift($db_test_instance->transformations_answers_array); // getting rid of the "exercise-type: trasformations";
      $this->db_test_answers = $this->sanitize_answers($db_test_instance->transformations_answers_array);  
      $this->max_points = count($this->db_test_answers); 

      //they keys in the db_test_answer and user_answers_array are the exercise numbers
      $scored_points=0; 
      foreach(array_keys($this->db_test_answers) as $key=>$value ) {
        if($this->db_test_answers[$value]==$this->user_answers_array[$value]) {
          $scored_points++; 
        }
      }
      // Import the Grade class (which has the switch for grade) and pass to it the number of correct and incorrect answers it will return percenrgag3e and grade that can be saved in the instance and saved to db. 
      $this->scored_points = $scored_points;
      // grade test 
      $this->grade_test(); 
    }
    
    public function save() {
      global $database; 
      
      $answers_json  = json_encode($this->user_answers_array); 
      // Check the test before you save it.; 

      $query = "INSERT INTO user_tests ("; 
      $query .= "test_id, student_name, answers_array, grade, percentage"; 
      $query .= ") VALUES ("; 
      $query .= "'{$this->test_id}', '{$this->student_name}', '{$answers_json}', {$this->grade}, {$this->percentage}"; 
      $query .= ")"; 

      echo $query; 
    
      $result_set = $database->query($query); 
      if($result_set) {
        echo "Test has been saved"; 
      } else {
        echo "There's been a problem, test not saved"; 
      }
    }

  }

?>  