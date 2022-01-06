<?php include('root.php') ?>
<?php include($root . 'db_connection.php'); ?>
<?php include('helpers.php')?>
<?php include('../../functions.php'); ?>

<?php 
  if(isset($_POST['submit'])) {
    echo "update form was submitted<br/>"; 

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
    $question_id    = $_POST["id"]; 
    $question       = $question_start . "__" . $question_end; // "__" will serve as separator for two parts of the question.
    $answer         = escape_string($_POST["answer"]);  

    $query  = "UPDATE transformations ";
    $query .= "SET question='{$question}', answer='{$answer}' ";
    $query .= "WHERE id={$question_id}"; 

    $result = mysqli_query($connection, $query); 

    if($result) {
      echo "<p>Success</p>"; 
      redirect_to('question_list.php'); 
    } else { 
      die("Database query failed " . mysqli_error($connection)); 
    }

  } else {
    // probably a get request
    echo "blabla wrong something not post "; 
    // redirect_to("edit.php"); 
  }
?>

<?php 
  mysqli_close($connection); 
?>