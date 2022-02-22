<?php
  require_once('database_object.php'); 
  
  class Transformation extends DatabaseObject {
    // fields_names and table name
    protected static $table_name = "transformations"; 
    // attributes
    public $id; 
    public $question; 
    public $answer; 
    // find_all - inherited
    // find_by_id
    // instantiation
    public function new_transformation($request_params) {
      global $database; 
      $transformation = new Transformation(); 

      $question_start = trim($request_params["question_start"]); 
      $question_end   = trim($request_params["question_end"]); 
      $question       = $question_start . "__" . $question_end; // "__" will serve as separator for two parts of the question.
      $answer         = trim($request_params["answer"]); 

      $transformation->question = $database->escape_value($question); 
      $transformation->answer   = $database->escape_value($answer); 
      
      return $transformation; 
    }

    public function create(){   
      // this function is called on the instance returned by new_transformation function
      // that's why we can use the $this->question and answer syntax
      global $database;    
      $question = $this->question; 
      $answer   = $this->answer;   

      $sql =  "INSERT INTO ".static::$table_name." ("; 
      $sql .= "question, answer";
      $sql .= ") VALUES ("; 
      $sql .= "'{$question}', '{$answer}'"; 
      $sql .= ")"; 
      
      if($database->query($sql)) {
        $this->id = $database->insert_id(); 
        return true; 
      } else {
        return false; 
      }
    }  

    private function split_question($question_assoc) {
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
      
    private function build_question($array, $question_id) {
      $question_input = "<p>";
      $question_input .= $array[0]; 
      $question_input .= " <input type=\"text\" value=\"\" name=\"answer-{$question_id}\" /> "; 
      $question_input .= $array[1];
      $question_input .= "</p>";
      return $question_input; 
    }

    // delete 

    // update 

  }
?>