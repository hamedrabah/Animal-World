<?php
include("includes/init.php");

if (isset($_GET['id'])) {
$current_image_id = (int)$_GET['id'];
} // code from Piazza

// declare the current location, utilized in header.php
$current_page_id="index";

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
    <!-- Prints the animal's information -->
      <div class="bio">
        <!-- Prints the animal's photo (and name under the photo) -->
        <ul>
          <?php
          $records = exec_sql_query($db, "SELECT * FROM gallery where id=$current_image_id")->fetchAll(PDO::FETCH_ASSOC);
          foreach($records as $record){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
              echo "";
            } else{
            echo "<figure>";
            echo "<img src=\"" . ANIMALS_UPLOADS_PATH . $record["id"] . "." . $record["file_ext"] . "\"> </img>";
            echo "<figcaption>". $record["animal"]. "</figcaption>";
            echo "</figure>";
          };};
          ?>
        </ul>
        <!-- inner join to show tags
      SELECT whatever field you want from tags FROM tags INNER JOIN image_tags
       ON tags.id = image_tags.tag_id WHERE image_tags.image_id = the image id you want;-->
    <?php
    $records = exec_sql_query($db, "SELECT * FROM gallery where id=$current_image_id")->fetchAll(PDO::FETCH_ASSOC);
    foreach($records as $record){
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        echo "<h1>Successfuly deleted, click
        <a href=\"index.php\">here
        to return home </a> </h1>";
      } else{
      echo "<h1>".$record["animal"]."</h1>";
      echo "<h2>"."Description: ".$record["description"]."</h2>";
      echo "<h5>"."Image Source: ".$record["source"]."</h5>";
      if ($record["userupload"]==NULL){$record["userupload"]="None";};
      echo "<h5>"."Uploader Username: ".$record["userupload"]."</h5>";
      /* Delete button */
      if ($current_user==$record["userupload"] AND $current_user!=NULL){
      echo "<form action=\"moreInfo.php"."?id=".$record["id"]."\"". "method=\"post\">
      <input type=\"submit\" name=\"deleteImage\" value=\"Delete Image\" />
      </form>";
      echo "<form action=\"moreInfo.php"."?id=".$record["id"]."\"". "method=\"post\">
      <input type=\"submit\" name=\"deleteTag\" value=\"Delete Tags\" />
      </form>";

    }
      else {echo "";};};};

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          //something posted
          if (isset($_POST['deleteImage'])) {
              $records = exec_sql_query($db, "DELETE FROM gallery where id=$current_image_id")->fetchAll(PDO::FETCH_ASSOC);
        };
        if (isset($_POST['deleteTag'])) {
            $records = exec_sql_query($db, "DELETE FROM imagetags where image_id=$current_image_id")->fetchAll(PDO::FETCH_ASSOC);
      };
      };
      echo "<h2>"."Tags:"."</h2>";
      $tagrecord = exec_sql_query($db, "SELECT tag_name FROM tags INNER JOIN imagetags ON tags.id = imagetags.tag_id WHERE imagetags.image_id=$current_image_id")->fetchAll(PDO::FETCH_ASSOC);
      foreach($tagrecord as $tag){
      echo "<ul>".$tag['tag_name']."</ul>";
    echo "</h2>";


    };
?>

    </div>

  <?php include("includes/footer.php");?>
</body>

</html>
