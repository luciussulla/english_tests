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
        // print_r($question_assoc);
        // echo "<br/>"; 
        // echo "<p>". $question_assoc["id"] ."</p>"; 
        $html .= "<div class=\"question-edit\">";
        $html .= "<a href=\"edit.php?id={$question_assoc["id"]}\"><i class=\"far fa-edit\"></i></a>"; 
        $html .= "<i class=\"far fa-trash-alt\"></i>";
        $html .= $question_assoc["question"]; 
        $html .= "</div>"; 
    } 
    echo $html; 
?>
<?php include("../../layouts/footer.php") ?>
<?php 
  mysqli_close($connection); 
?>