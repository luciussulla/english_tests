<?php include('./root.php') ?>

<?php 
  include('../../db_connection.php'); 
  include('../../functions.php'); 
?>

<?php include('../../layouts/header.php'); ?>


<?php 
    $all_questions_array = find_all_transformations(); 
    $html = ""; 
    foreach($all_questions_array as $question_assoc ) {
      foreach($question_assoc as $key=>$value) {
        if($key == "question") {
          // echo $value; 
          $html .= "<div class=\"question-edit\" ><i class=\"far fa-edit\"></i>"; 
          $html .= "<i class=\"far fa-trash-alt\"></i>";
          $html .= $value; 
          $html .= "</div>"; 
        }
      }
    } 
    echo $html; 
?>

<?php include("../../layouts/footer.php") ?>
<?php 
  mysqli_close($connection); 
?>