<?php
include("includes/init.php");

// declare the current location, utilized in header.php
$current_page_id="upload";

// open connection to database
$db = open_or_init_sqlite_db('gallery.sqlite', "init/init.sql");
$current_user = check_login();
// Set maximum file size for uploaded files.


if (isset($_POST["submit_upload"])) {
  $upload_info = $_FILES["file_name"];
  $upload_desc = filter_input(INPUT_POST, 'tag', FILTER_SANITIZE_STRING);
  $upload_description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
  $upload_source= filter_input(INPUT_POST, 'source', FILTER_SANITIZE_STRING);
  $animal= filter_input(INPUT_POST, 'animal', FILTER_SANITIZE_STRING);


  if ($upload_info['error'] == UPLOAD_ERR_OK) {
    $upload_name = basename($upload_info["name"]);
    $upload_ext = strtolower(pathinfo($upload_name, PATHINFO_EXTENSION) );

    $sql = "INSERT INTO gallery (file_name, file_ext,description,source, animal, userupload)
    VALUES (:filename, :extension, :description, :source, :animal, :userupload)";
    $params = array(
      ':extension' => $upload_ext,
      ':filename' => $upload_name,
      ':description' => $upload_description,
      ':source' => $upload_source,
      ':animal' => $animal,
      ':userupload' => $current_user
    );
    $sql = "INSERT INTO tags (tag_name)
    VALUES (:tag_name)";
    $params = array(
      ':tag_name' => $upload_desc
    );
    $result = exec_sql_query($db, $sql, $params);

    if ($result) {
      $file_id = $db->lastInsertId("id");
      if (move_uploaded_file($upload_info["tmp_name"], ANIMALS_UPLOADS_PATH . "$file_id.$upload_ext")){
        array_push($messages, "Your file has been uploaded.");
      }
    } else {
      array_push($messages, "Failed to upload file. TODO");
    }
  } else {
    array_push($messages, "Failed to upload file. TODO");
  }
};
?>
<!DOCTYPE html>
<html>

<?php include("includes/head.php");?>
<body>
  <?php include("includes/header.php");?>
  <div id="uploadPage">
    <?php
    print_messages();
    ?>
    <?php if (check_login()!=NULL){
      echo "<h2>Upload a photo of your favorite animal!</h2>";} else
      {echo "<h2>Please sign in to activate this feature!</h2>";};
    ?>

    <?php if (check_login()!=NULL){
      echo "";} else {echo "<!--";};
    ?>
    <form id="uploadFile" action="upload.php" method="post" enctype="multipart/form-data">
      <ul>
        <li>
          <label>Upload File:</label>
          <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />
          <input type=<?php if (check_login()!=NULL){
            echo "file";} else {echo "hidden";};
          ?> name="file_name" required>
        </li>

        <li>
          <label> Animal Name: </label>
          <textarea name="animal" cols="50" rows="2"></textarea>
        </li>

        <li>
          <label> Description </label>
          <textarea name="description" cols="50" rows="2"></textarea>
        </li>

        <li>
          <label>Tag:</label>
          <input type="text" name="tag"> </input>
        </li>

        <li>
          <label>Image Source:</label>
            <input type="url" name="source">
        </li>

        <li>
          <button name="submit_upload" type="submit">Upload</button>
        </li>
      </ul>
    </form>
    <?php if (check_login()!=NULL){
      echo "";} else {echo "-->";};
    ?>
  <?php include("includes/footer.php");?>
</body>

</html>
