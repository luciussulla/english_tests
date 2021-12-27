<?php 
  include('../db_connection.php'); 
  include('../functions.php'); 
?>

<?php 
  $query = "SELECT * FROM transformations"; 
  $result = mysqli_query($connection, $query); 

  if(!$result) {
    die("Database query failerd" . mysqli_error());
  } else {
    echo "Successful query <br/>"; 
    
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

  <?php 
    $answers_array = array(); // prepare JONS with correct answers and question_ids which then is send as hidden field to show for checking users answers
    $form = "<form action=\"../checker/checker.php\" method=\"post\">"; 
    while($row = mysqli_fetch_assoc($result)) {
      $answers_array[] = array('id'=>$row['id'], 'answer'=>$row['answer']); 
      // use a validation in the checker to see if the number of sent questions is the same as the number of anwers in the JSON array (make suer we are checking the right things)
      $ready_question = split_question($row);
      $form .= "<div>";
      $form .= $ready_question;   
      $form .= "</div>"; 
    }

    $answers_array_json = json_encode($answers_array); 
    var_dump($answers_array_json);
    $form .= "<input type=\"hidden\" name=\"answers_json\" value='" . $answers_array_json . "' >";
    $form .= "<input type=\"submit\" name=\"submit\"/ value=\"Send\" >"; 
    $form .= "</form>"; 
    echo $form
  ?>
  <?php mysqli_free_result($result);?>

</body>
</html>
<?php 
  mysqli_close($connection); 
?>