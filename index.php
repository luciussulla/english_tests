<?php 
  include('./db_connection.php'); 
  include('./functions.php'); 
?>

<?php 
  $query = "SELECT * FROM transformations"; 
  $result = mysqli_query($connection, $query); 

  if(!$result) {
    die("Database query failerd" . mysqli_error());
  } else {
    echo "Successful query"; 
    
  }
?>

<?php include("./layouts/header.php") ?>

  <?php 
    while($row = mysqli_fetch_assoc($result)) {
      // var_dump($row); 
      // echo "<p>".$row["question"]."</p>";
      $split_result =  split_question($row);
      echo "<hr/>"; 
      echo $split_result; 
      // var_dump($split_result);
      echo "<hr/>"; 
    }
  ?>
  <?php
    mysqli_free_result($result); 
  ?>
  <a href="./questions/transformations/new.php">Create new transformation</a><br/>
  <a href="./test/show.php">Start test</a>

<?php include("./layouts/footer.php") ?>
<?php 
  mysqli_close($connection); 
?>