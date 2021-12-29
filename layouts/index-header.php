<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Test Checker</title>
  <?php echo '<link rel="stylesheet" href="' . $root . 'styles/styles.css" >' ?>
</head>
<body>
<div class="container">
<div class="hero">
  <div class="menu index-menu">
    <img src="" class="logo">
    <ul class="navigation">
      <?php echo '<li><a href="' . $root . 'index.php"> Home</a></li>' ?>
      <?php echo '<li><a href="' . $root . 'questions/transformations/new.php">Add exercise</a></li>' ?>
    </ul>
  </div><!-- end menu --> 
  <h1 class="hero-center">Test your english grammar skills</h1>
  <a href="./test/show.php" class="hero-btn hero-center">Start test</a>
</div>

