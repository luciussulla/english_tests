<?php 

  function redirect_to($new_location='') {
    header('Location: '.$new_location); 
    exit;
  }

  function find_all_transformations() {
    global $connection; 
    $query = "SELECT * FROM transformations"; 
    $result = mysqli_query($connection, $query); 
    if($result) {
      // echo "all questions fetched"; 
      // print_r($result); 
      return $result; 
      // redirect_to('question_list');
    } else {
      // echo "all questions fetched"; 
      die("Database query failerd" . mysqli_error());
    }
    return $result; 
  }

?>  