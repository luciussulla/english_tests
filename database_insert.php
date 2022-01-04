<?php 
  include('./db_connection.php'); 
  include('./functions.php'); 
?>

<?php 
  // $question = $_POST["question"]; 
  // $answer = $_POST["answer"]; 
  $question = "aa"; 
  $answer = "bb"; 

  $query  = "INSERT INTO transformations (";
  $query .= "question, answer"; 
  $query .= ") VALUES (";
  $query .= " '{$question}','{$answer}' ";
  $query .=  ")"; 

  $result = mysqli_query($connection, $query); 

  if($result) {
    echo "<p>Success</p>"; 
  } else { 
    die("Database query failed " . mysqli_error($connection)); 
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