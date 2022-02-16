<?php include('root.php'); ?>
<?php require($root . 'includes/initialize.php') ?>
<?php include($root . 'db_connection.php'); ?>
<?php include($root . 'session/session.php'); ?>
<?php include($root . 'functions.php'); ?>
<?php include($root . 'layouts/header.php'); ?>

<?php $email="" // goes into the form?> 

<?php if(isset($_POST["submit"])) { 
    $password = $_POST["password"]; 
    $email    = $_POST["email"]; 
    $user  = attempt_login($password, $email); 
    
    if($user) {
      $_SESSION["message"] = "You are logged in"; 
      $_SESSION["username"] = $user["first_name"]; 
      $_SESSION["user_id"] = $user["id"]; 
      redirect_to($root . 'questions/transformations/question_list.php');
    } else {

      $_SESSION["message"] = "Login failed"; 
    } 
  }
?>

<div class="checked_answers">
  <div class="instructions">
    <h1>Login as teacher</h1>
    <?php include('_form.php'); ?>  
  </div>
</div>

<?php include($root . 'layouts/footer.php'); ?>

