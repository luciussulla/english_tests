<?php include('./root.php'); ?>

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
    // echo "Successful query <br/>"; 
  }
?>

<?php include('../layouts/header.php')?>
  <div class="checked_answers">
    <br/>
    <p>Please fill in your test and click "send"</p><br/>
    <?php 
      $answers_array = array(); // prepare JONS with correct answers and question_ids which then is send as hidden field to show for checking users answers
      $form = "<form action=\"../checker/checker.php\" method=\"post\">"; 
      $form .= "<input type=\"hidden\" name=\"test_id\" value=\"1\" >"; 
      $form .= "<p>Please enter your nickname: </p>"; 
      $form .= "<input type=\"text\" name=\"student_name\" value=\"\" >";
      while($row = mysqli_fetch_assoc($result)) {
        $answers_array[] = array('id'=>$row['id'], 'answer'=>$row['answer']); 
        // use a validation in the checker to see if the number of sent questions is the same as the number of anwers in the JSON array (make suer we are checking the right things)
        $ready_question = split_question($row);
        $form .= "<div class=\"single-question\">";
        $form .= $ready_question;   
        $form .= "</div>"; 
      }

      $answers_array_json = json_encode($answers_array); 
      // var_dump($answers_array_json);
      $form .= "<input type=\"hidden\" name=\"answers_json\" value='" . $answers_array_json . "' >";
      $form .= "<input class=\"button form-button\" type=\"submit\" name=\"submit\"/ value=\"Send\" >"; 
      $form .= "</form>"; 
      echo $form; 
    ?>
  </div><!-- checked answers -->
  <?php mysqli_free_result($result);?>

<?php mysqli_close($connection); ?>
<?php include('../layouts/footer.php')?>