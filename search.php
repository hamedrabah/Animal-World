<?php
include("includes/init.php");

// declare the current location, utilized in header.php
$current_page_id="search";
// open connection to database
$db = open_or_init_sqlite_db('gallery.sqlite', "init/init.sql");
$current_image_tag = $_POST['tag_name'];
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
        $records = exec_sql_query($db, "SELECT DISTINCT tag_name FROM tags")->fetchAll(PDO::FETCH_ASSOC);
      foreach($records as $record){
        echo "<a href=\"moreSearch.php?tag=".$record["tag_name"]."\">";
        echo "<p class=\"searchTags\">". $record["tag_name"]."</p>";
        echo "</a>";
        echo " ";
        // code to use if moreSearch.php would work for the extra tags
        // echo "<a href=\"moreSearch.php?tag=".$record["tag2"]."\">";
        // echo "<p class=\"searchTags\">". $record["tag2"]."</p>";
        // echo "</a>";
        // echo " ";
        // echo "<a href=\"moreSearch.php?tag=".$record["tag3"]."\">";
        // echo "<p class=\"searchTags\">". $record["tag3"]."</p>";
        // echo "</a>";
      };
      ?>
    </ul>
  </div>

  <?php include("includes/footer.php");?>

</body>

</html>
