
<form action="login.php" method="post">

  <div class="form-control">
    <label name="email">Email</label>
    <input type="text" name="email" value="<?php echo htmlentities($email) ?>" />
  </div>

  <div class="form-control">
    <label name="password">Password</label>
    <input type="password" name="password" value="" />
  </div>

  <input class="button form-button" name="submit" type="submit" value="Submit" />
</form>