<?php
include("includes/init.php");

if (isset($_GET['tag'])) {
$current_image_tag = $_GET['tag'];

} // code from Piazza

// declare the current location, utilized in header.php
$current_page_id="search";

// open connection to database
$db = open_or_init_sqlite_db('gallery.sqlite', "init/init.sql");
$current_user = check_login();
?>
<!DOCTYPE html>
<html>
<?php include("includes/head.php");?>
<body>

  <?php include("includes/header.php");?>


    <?php
    print_messages();
    ?>
      <div class="bio">
        <!-- Prints the animal's photo (and name under the photo) -->
        <ul>

          <?php
          $imageIds = exec_sql_query($db, "SELECT DISTINCT image_id FROM tags INNER JOIN imagetags ON tags.id = imagetags.tag_id WHERE tag_name LIKE '%$current_image_tag%' ")->fetchAll(PDO::FETCH_ASSOC);
          $animalRecords = exec_sql_query($db, "SELECT * FROM gallery") ->fetchAll(PDO::FETCH_ASSOC);
          foreach($imageIds as $imageId){
            echo "<figure>";
            echo "<a href=\"moreInfo.php?id=".$imageId["image_id"]."\">";
            echo "<img src=\"" . ANIMALS_UPLOADS_PATH . $imageId["image_id"] . "." .$animalRecords[$imageId["image_id"]-1]["file_ext"] . "\"> </img>";
            echo "</a>";
            echo "<figcaption>". $animalRecords[$imageId["image_id"]-1]["animal"]. "</figcaption>";
            echo "</figure>";
          };
          ?>
        </ul>
    </div>

  <?php include("includes/footer.php");?>
</body>

</html>
