<?php 
require_once('initialize.php'); 

class Test extends DatabaseObject {
	// This class can be made simpler by creating an Exercise class that the Test class would be composed of. Exercise class could have the exercise type and could have its own html generator function since different exercises have different html structure; 

	private static $table_name = "tests"; 
	public $id = ""; //will serve as unique test link
	// public $exercies_array; // this inlcudes both questions and answers
	public static $exercises_types = ["transformations", "abcd"]; 

	public $transformations_questions_array;  //Array ( [exercise_type] => transformations [0] => Array ( [12] => Zosia (like) __TV dramas so she watches them every week ) [1] => Array ( [13] => Federer certainly (not play)__his best Tennis at the moment ) [2] => Array ( [14] => I have had it with you! You (always lose)__my keys! ) ) 
	public $transformations_answers_array;  // Array ( [exercise_type] => transformations [0] => Array ( [12] => likes ) [1] => Array ( [13] => is not playing ) [2] => Array ( [14] => are always losing ) )
	public $abcd_questions_array; 
	public $abcd_answers_array; 
	
	private function questions_answers_array($table_name, $db_result_set) {
		global $database; 
		// This function can be made simpler by creating an Exercise class that the Test class would be composed of. Exercise class could have the exercise type and could have its own html generator function since different exercises have different html structure; 
		// the first element in the questions and answers array will be the exercise type (table name) like "transformations" or "abcd" type questions;
		switch($table_name) {
			case "transformations" : 
				$this->transformations_answers_array["exercise_type"] = $table_name;
				$this->transformations_questions_array["exercise_type"] = $table_name;
			break; 
			case "abcd" :
				$this->abcd_questions_array["exercise_type"] = $table_name;
				$this->abcd_answers_array["exercise_type"] = $table_name;
			break; 
		}

		while($row = $database->fetch_assoc($db_result_set)) {
			// 1 - create general exercies array that stores both questions and answers (it may be useful); 
			// $this->exercises_array[] = $row; 

			// 2 - create an associative array for question 
			$new_question = array(); 
			// extract questions id 
			// extract question content 
			// build new $question assoc array 
			$new_question[$row['id']] = $row['question']; 

			// 3 - create an associative array for answer 
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
		return $this; 
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

	private function split_question($question_content) {
		// print_r($question_content); 
		// print_r($question_id); 
		// print_r($question_type); 
		
    $is_match = preg_match("/__/", $question_content); // quesion in db has __ where the user shuld privide his answer (blank space for user to insert answer)
    if ($is_match) {
      $two_question_parts_array =  preg_split("/__/", $question_content);
      return $two_question_parts_array;
    } else {
      // if no blank was inserted just the beginning of the question you get the question back
      // still need work here to return full question with input field
      return $question_content;  
    } 
  }
   
  private function build_question($exercise_type, $question_id, $question_content) {
		$both_question_parts = $this->split_question($question_content); 
		$question_beginning  = $both_question_parts[0]; 
		$question_end 			 = $both_question_parts[1]; 

		// print_r($question_beginning); 
		// print_r($question_end); 

    $question_input = "<p class=\"separate_question\">";
    $question_input .= $question_beginning; 
    $question_input .= " <input class=\"question_input\" type=\"text\"  name=\"{$exercise_type}[][$question_id]\" value=\"\" /> "; 
    $question_input .= 	$question_end;
    $question_input .= "</p>";
    return $question_input; 
  }

	public function generate_transformations_html() {
		// this function will be called in the view page 
		// iterate through array questions send them to splitter, what is actually being sent to the splitter? string or object? 
		$questions_array = $this->transformations_questions_array; 
		$exercise_type = array_shift($questions_array); // extracting the exercise type from the questions array;
		$questions_html = "";  		
		foreach($questions_array as $question_assoc_array) {
			// we send the question id, type and content, every question is an object so we must iterate through it
			foreach($question_assoc_array as $id=>$question_content)  {
				$questions_html .= $this->build_question($exercise_type, $id, $question_content); 
			}
		}; 
		return $questions_html; 
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

		$questions_array = array();  // this is going to be a multidimentionsal array. 
			// [
			//  transformation: [1,2,34], 
			//  abcd_question: [4,5,6]
			// ]
		$answers_array = array(); 
		// open foreach loop 
		// iterate through db tables consistent with keys (table names) and values (ids of exercises) 
		// Once we introduce the Exercise class this for loop will not be necessary
		foreach($all_questions_assoc as $table_name=>$id_array) {
			if(in_array($table_name, $this::$exercises_types)) {
				$query = "SELECT * FROM {$table_name} WHERE id IN (" . implode(",", $id_array) . ")";  
				$transformations_array = $database->query($query); 
				$test_instance_with_filled_attributes = $this->questions_answers_array($table_name, $transformations_array); 
			}
		} 
		return $test_instance_with_filled_attributes; 
	} 
}

?>