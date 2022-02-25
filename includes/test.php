<?php 
require_once('initialize.php'); 

class Test extends DatabaseObject {

	public $id = ""; // will serve as unique test link
	public $exercies_array  = array(); 
	public $questions_array = null;  
	public $answers_array = null; 
	
	private function questions_answers_array($db_result_set) {
		global $database; 
		// we need to build 2 arrays
		// - questions with q_id and q_content
		// $questions_array = array(); 
		// // - answers with q_id       a_content
		// $answers_array   = array();
		// both can be assigned as attributes of the test instance;  

		while($row = $database->fetch_assoc($db_result_set)) {
			// 1 - create an associative array for question 
			$new_question = array(); 
			// extract questions id 
			// extract question content 
			// build new $question assoc array 
			$new_question[$row['id']] = $row['question']; 
			// add both to $questions_array[] = $new_question; 
			$this->questions_array[] = $new_question; 

			// 2- create an associative array for answer 
			$new_answer = array(); 
			// use extracted id 
			// extract answer content 
			// build new $answer assoc array 
			$new_answer[$row['id']] = $row['answer']; 
			// add both to $answers_array[] = $new_answer; 
			$this->answers_array[] = $new_answer; 
		}

	}

	public function generate_test($exercises_ids_array) {
		global $database;
		$ids_str = implode(",", $exercises_ids_array); 
		
		$sql = "SELECT * FROM transformations WHERE id in (" . $ids_str . ")"; 
		$result = $database->query($sql); 
		$newTest = new Test(); 
		$this->questions_answers_array($result); 
		// this should retun an instance of Test class which by now is equipped with questions_array and answers_array
		return $this;  
	} 
}

// TEST 
$test = new Test(); 
$res = $test->generate_test(['11','12']); 
if ($res) {
  // var_dump($res); 
	foreach($res->answers_array as $item) {
		print_r($item); 
	}

} else {
  echo "no res"; 
}

?>