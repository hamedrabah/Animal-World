<?php
include("includes/init.php");

// declare the current location, utilized in header.php
$current_page_id="logout";

log_out();
if (!$current_user) {
  record_message("You've been successfully logged out.");
}
?>
<!DOCTYPE html>
<html>

<html>
<?php include("includes/head.php");?>
<body>
  <?php include("includes/header.php");?>

  <div id="content-wrap">
    <h1>Log Out</h1>

    <?php
    print_messages();
    ?>
  </div>

  <?php include("includes/footer.php");?>
</body>

</html>
