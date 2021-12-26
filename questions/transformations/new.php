<?php 
  include('../../db_connection.php'); 
  include('../../functions.php'); 
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
<div>
<form action="./create.php" method="post">
<div>
<p>Please enter questions as follows:</p>
<p>e.g: A sentence like: "I am constantly losing my keys" should be entered as follows:</p>
<p>Beginning: I am constantly (lose)
<p>Ending: my keys</p>
<p>Answer: losing</p>
<p>It will be presented like so: "I am constantly (lose) ...... my keys"; 
</div>
<p>
  <label>Beginning of the sentnece</label>
  <input type="text" name="question_start" value="" placeholder="question" />
</p>
<p>
  <label>Ending of the sentnece (leave blank if you do not need it)</label>
  <input type="text" name="question_end" value="" placeholder="question" />
</p>
<p>
  <label>Please provide answer</label>
  <input type="text" name="answer" value="" placeholder="answer"/>
</p>
<p>
  <input type="submit" name="submit" value="Create question" />
</p>
</form>
<a href="../../index.php">Back</a>
</div>
</body>
</html>
<?php 
  mysqli_close($connection); 
?>