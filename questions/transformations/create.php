<?php 
  include('../../db_connection.php'); 
  include('../../functions.php'); 
  require_once($root . 'session/session.php'); 
  confirmed_logged_in($root);
?>

<?php 
  if(isset($_POST['submit'])) {
    echo "form was submitted<br/>"; 

    // if(isset($_POST['question'])) {
    //   $question = escape_string($_POST['question']); 
    // } else {
    //   $question = ""; 
    // } 

    // if(isset($_POST['answer'])) {
    //   $answer = escape_string($_POST['answer']); 
    // } else {
    //   $answer = "";
    // } 
    
    $question_start = escape_string($_POST["question_start"]); 
    $question_end   = escape_string($_POST["question_end"]); 
    $question       = $question_start . "__" . $question_end; // "__" will serve as separator for two parts of the question.
    $answer         = escape_string($_POST["answer"]); 

    $query  = "INSERT INTO transformations (";
    $query .= "question, answer"; 
    $query .= ") VALUES (";
    $query .= " '{$question}','{$answer}' ";
    $query .=  ")"; 

    $result = mysqli_query($connection, $query); 

    if($result) {
      echo "<p>Success</p>"; 
      redirect_to('../../index.php'); 
    } else { 
      die("Database query failed " . mysqli_error($connection)); 
    }

  } else {
    // probably a get request
    redirect_to("../../index.php"); 
  }

?>

<?php 
  mysqli_close($connection); 
?>