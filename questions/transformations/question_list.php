<?php include('./root.php') ?>

<?php 
  include('../../db_connection.php'); 
  include('../../functions.php'); 
?>

<?php include('../../layouts/header.php'); ?>
<?php include("../../layouts/footer.php") ?>

<?php 
    $all_questions_array = find_all_transformations(); 
    $html = ""; 
    foreach($all_questions_array as $question_assoc ) {
      foreach($question_assoc as $key=>$value) {
        if($key == "question") {
          // echo $value; 
          $html .= "<p>"; 
          $html .= $value; 
          $html .= "</p>"; 
        }
      }
    } 
    echo $html; 
?>

<?php 
  mysqli_close($connection); 
?>