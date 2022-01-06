<?php include('root.php') ?>
<?php include($root . 'db_connection.php'); ?>
<?php include('helpers.php')?>
<?php include($root . 'layouts/header.php'); ?>
<?php 
  $question_id = (int)$_GET["id"]; 
  $question = find_question_by_id($question_id); 
  $question_content = $question["question"]; 
  $answer = $question["answer"]; 

  $sentence_start = proces_question_from_db($start=true,  $question_content); 
  $sentence_end   = proces_question_from_db($start=false, $question_content); 
?>
<div class="checked_answers">

  <form class="form" action="update.php" method="post">
    <input type="hidden" name="id" value="<?php echo $question_id ?>"/>
    <p class="form-control">
      <label>Beginning of the sentnece</label>
      <input class="question_input" type="text" name="question_start" value="<?php echo $sentence_start ?>" placeholder="" />
    </p>
    <p class="form-control">
      <label>Ending of the sentnece (leave blank if you do not need it)</label>
      <input class="question_input" type="text" name="question_end"   value="<?php echo $sentence_end ?>" placeholder="" />
    </p>
    <p class="form-control">
      <label>Answer</label>
      <input class="question_input" type="text" name="answer" value="<?php echo $answer ?>" placeholder=""/>
    </p>
    <p>
      <input class="button form-button" type="submit" name="submit" value="Update question" />
    </p>
  </form>
  <br/>
  <a class="button link-button" href="../../index.php">Back</a>

</div>  
<script src="javascript.js"></script>
<?php include($root . 'layouts/footer.php'); ?>
<?php mysqli_close($connection); ?>