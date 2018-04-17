<?php
include("includes/init.php");

// declare the current location, utilized in header.php
$current_page_id="index";
// open connection to database
$db = open_or_init_sqlite_db('gallery.sqlite', "init/init.sql");

?>
<!DOCTYPE html>
<html>
<?php include("includes/head.php");?>
<body> 
  <?php include("includes/header.php");?>
  <div id="content-wrap">
    <?php
    print_messages();
    ?>
    <ul>
      <?php
      $records = exec_sql_query($db, "SELECT * FROM gallery")->fetchAll(PDO::FETCH_ASSOC);
      foreach($records as $record){
        echo "<figure>";
        echo "<a href=\"moreInfo.php?id=".$record["id"]."\">";
        echo "<img src=\"" . ANIMALS_UPLOADS_PATH . $record["id"] . "." . $record["file_ext"] . "\"> </img>";
        echo "</a>";
        echo "<figcaption>". $record["animal"]. "</figcaption>";
        echo "</figure>";
      }
      ?>
    </ul>
  </div>

  <?php include("includes/footer.php");?>

</body>

</html>
