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
    
    if($question) {
      // print_r($question); 
      return $question; 
    } else {
      echo "Db connection error";
    }
  }

 
  function generate_salt($length) {
    $unique_random_string = md5(uniqid(mt_rand(), true)); 
    $base64_string = base64_encode($unique_random_string); 
    $modified_base64_string = str_replace('+', '.', $base64_string);
    $salt = substr($modified_base64_string, 0, $length); 
    echo "\n Salt is: {$salt} \n";
    return $salt;  
  } 

  function password_encrypt($password){ 
    $hash_format = "$2y$10$"; 
    $salt_length = 22; 
    $salt = generate_salt($salt_length);
    // $salt = "Salt22CharactersOrMore";  
    $format_and_salt = $hash_format . $salt; 
    $hash = crypt($password, $format_and_salt); 
    return $hash; 
  }
  
  function password_check($password, $existing_hash) {
    $hash = crypt($password, $existing_hash); 
    if($hash === $existing_hash) {
      return true; 
    } else {
      return false;
    }
  }

  function find_user($email) {
    global $connection; 
    $user   = ''; 
    $query  =  "SELECT * FROM teachers "; 
    $query .=  "WHERE email = '{$email}' ";
    $query .=  "LIMIT 1"; 
    $result = mysqli_query($connection, $query); 
    if($result) {
      // echo "\n teacher found"; 
      $user = mysqli_fetch_assoc($result); 
      if ($user) {
        return $user; 
      } else {
        return false; 
      }
    } else {
      return false; 
    }
  }

  function attempt_login($password, $email) {
    $user = find_user($email); 
    if($user) {
      // echo "\n Teacher's name is: {$user['first_name']}"; 
      $db_password = $user["password"]; 
      // echo "\n db password is: {$db_password}"; 
      // echo "\n user provided password is: {$password}"; 
      $hash_provided_password = password_encrypt($password); 
      // echo "\n encrypted user provided pass is: {$hash_provided_password}";
      if(password_check($password, $db_password)) {
        // echo "\n password correct"; 
        return $user; 
      } else {
        return false; 
      }
    } else {
      return false; 
    }
  }
  
  function logged_in()  {
    return isset($_SESSION["user_id"]); 
  }

  function confirmed_logged_in($root="") {
    // global $root; 
    if(!logged_in()) {
      redirect_to($root.'login/login.php'); 
    } 
  }

 ?>  