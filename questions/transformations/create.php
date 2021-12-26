<?php 
  include('../../db_connection.php'); 
  include('../../functions.php'); 
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
    $question_end = escape_string($_POST["question_end"]); 
    $question = $question_start . "__" . $question_end; // "__" will serve as separator for two parts of the question.
    $answer = escape_string($_POST["answer"]); 

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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tester</title>
</head>
<body>
  <p>OK</p>
  
</body>
</html>

<?php 
  mysqli_close($connection); 
?>