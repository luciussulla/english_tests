<?php 
  require_once('../includes/initialize.php');
  require('root.php');  
?>  
<?php include('../layouts/header.php');  ?>

<form action="create.php" method="post">
<?php 
  $all_transformations = Transformation::find_all(); 
  $html = ""; 
  foreach($all_transformations as $question_assoc) {
      $html .= "<div class=\"question-edit\">";
      $html .= "<input type=\"checkbox\" id={$question_assoc["id"]} name=\"question_ids\" value={$question_assoc["id"]} /> "; 
      $html .= "<label for={$question_assoc["id"]} >". $question_assoc["question"] ."</label>"; 
      $html .= "</div>"; 
  } 
  echo $html; 
?>
<input class="button form-button" type="submit" name="submit" value="Send" >
</form >
<?php include('../layouts/footer.php'); ?>