<?php
include("includes/init.php");

// declare the current location, utilized in header.php
$current_page_id="login";
?>
<!DOCTYPE html>
<html>

<html>
<?php include("includes/head.php");?>
<body>
  <?php include("includes/header.php");?>

  <div id="content-wrap">

  <?php
    print_messages();
  ?>
    <h2>Sign In to gain upload privileges</h2>
    <form id="loginForm" action="login.php" method="post">
      <ul>
        <li>
          <label>Username:</label>
          <input type="text" name="username" required/>
        </li>
        <li>
          <label>Password:</label>
          <input type="password" name="password" required/>
        </li>
        <li>
          <button name="login" type="submit">Log In</button>
        </li>
      </ul>
    </form>

  <?php include("includes/footer.php");?>
</body>

</html>
