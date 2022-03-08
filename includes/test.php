<?php 
require_once('initialize.php'); 

class Test extends DatabaseObject {

	private static $table_name = "tests"; 
	public $id = ""; //will serve as unique test link
	// public $exercies_array; // this inlcudes both questions and answers
	public static $exercises_types = ["transformations", "abcd"]; 

	public $transformations_questions_array;  
	public $transformations_answers_array; 
	public $abcd_questions_array; 
	public $abcd_answers_array; 
	
	private function questions_answers_array($table_name, $db_result_set) {
		global $database; 

		while($row = $database->fetch_assoc($db_result_set)) {
			// 1 - create general exercies array that stores both questions and answers (it may be useful); 
			// $this->exercises_array[] = $row; 

			// 2 - create an associative array for question 
			$new_question = array(); 
			// extract questions id 
			// extract question content 
			// build new $question assoc array 
			$new_question[$row['id']] = $row['question']; 

			// 3- create an associative array for answer 
			$new_answer = array(); 
			// use extracted id 
			// extract answer content 
			// build new $answer assoc array 
			$new_answer[$row['id']] = $row['answer']; 

			// 4 - add both answers and questions to the attributes
			switch($table_name) {
				case "transformations" : 
					$this->transformations_answers_array[] = $new_answer; 
					$this->transformations_questions_array[] = $new_question;
				break; 
				case "abcd" :
					$this->abcd_questions_array[] = $new_question;
					$this->abcd_answers_array[] = $new_question;
				break; 
			}
		}
	}

	public function save($question_ids_array) {	
		global $database; 

		$test_exercises_assoc = array(); 
		$test_exercises_assoc['transformations'] = $question_ids_array; 
		$test_exercises_json = json_encode($test_exercises_assoc); 
		
		$sql = "INSERT INTO " . self::$table_name . "("; 
		$sql .= "questions_array"; 
		$sql .= ") VALUES (";
		$sql .= "'{$test_exercises_json}'"; 
		$sql .= ")"; 
		
		$result = $database->query($sql);
		return $result ? $this : false;
	}

	public function generate_transformations_html() {
		return; 
	}

	public function generate_test($test_id) {
		$this->id = (int) $test_id; 
		global $database;
		// extract the test from db 
		$query = "SELECT * FROM tests WHERE id={$test_id}"; 
		$result_set = $database->query($query); 
		$result = $database->fetch_assoc($result_set); 
		$all_questions = $result["questions_array"]; 
		$all_questions_assoc = json_decode($all_questions);  // [transformations: array [0]=>1, [2]=>3, abcd: array [0]=>4, [1]=>7] this is basically an object with array as value
		// we need to iteratively send select requests, the table names are the keys in the test stored in db as json
		// create questions array 
		$questions_array = array();  // this is going to be a multidimentionsal array. 
			// [
			//  transformation: [1,2,34], 
			//  abcd_question: [4,5,6]
			// ]
		$answers_array = array(); 
		// open foreach loop 
		// iterate through db tables consistent with keys (table names) and values (ids of exercises) 
		foreach($all_questions_assoc as $table_name=>$id_array) {
			if(in_array($table_name, $this::$exercises_types)) {
					$query = "SELECT * FROM {$table_name} WHERE id IN (" . implode(",", $id_array) . ")";  
					$result_set = $database->query($query); 
					$this->questions_answers_array($table_name, $result_set); 
			}
		}


		// store the exercises also as Test class instance variable - one variable will do - it will be iterated on the show test page
		// close loop 
		// return test instance

		// $ids_str = implode(",", $exercises_ids_array); 
		
		// $sql = "SELECT * FROM transformations WHERE id in (" . $ids_str . ")"; 
		// $result = $database->query($sql); 
		// $newTest = new Test(); 
		// $this->questions_answers_array($result); 
		// this should retun an instance of Test class which by now is equipped with questions_array and answers_array
		// return $all_questions; 
		return $this; 
	} 

}

?>