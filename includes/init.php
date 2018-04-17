<?php
const MAX_FILE_SIZE = 5000000;
const ANIMALS_UPLOADS_PATH = "uploads/gallery/";
// The website's title
$title = "Animal World";

// associative array mapping page 'id' to page title

$pages= array(
  "index" => "Home",
  "upload" => "Upload",
  "login" => "Sign In",
  "search" => "Search"
);

// An array to deliver messages to the user.
$messages = array();


function record_message($message) {
  global $messages;
  array_push($messages, $message);
}

// Write out any messages to the user.
function print_messages() {
  global $messages;
  foreach ($messages as $message) {
    echo "<p><strong>" . htmlspecialchars($message) . "</strong></p>\n";
  }
}

function handle_db_error($exception) {
  echo '<p><strong>' . htmlspecialchars('Exception : ' . $exception->getMessage()) . '</strong></p>';
}

function exec_sql_query($db, $sql, $params = array()) {
  try {
    $query = $db->prepare($sql);
    if ($query and $query->execute($params)) {
      return $query;
    }
  } catch (PDOException $exception) {
    handle_db_error($exception);
  }
  return NULL;
}

// TODO: 2-2
// YOU MAY COPY & PASTE THIS FUNCTION WITHOUT ATTRIBUTION.
// open connection to database
function open_or_init_sqlite_db($db_filename, $init_sql_filename) {
  if (!file_exists($db_filename)) {
    $db = new PDO('sqlite:' . $db_filename);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $db_init_sql = file_get_contents($init_sql_filename);
    if ($db_init_sql) {
      try {
        $result = $db->exec($db_init_sql);
        if ($result) {
          return $db;
        }
      } catch (PDOException $exception) {
        handle_db_error($exception);
      }
    }
  } else {
    $db = new PDO('sqlite:' . $db_filename);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $db;
  }
  return NULL;
}

$db = open_or_init_sqlite_db('gallery.sqlite', "init/init.sql");

function check_login() {
  global $db;

  if (isset($_COOKIE["session"])) {
    $session = $_COOKIE["session"];

    $sql = "SELECT * FROM users WHERE session = :session_id;";
    $params = array (
      ":session_id" => $session,
    );
    $records = exec_sql_query($db, $sql, $params)->fetchAll();
    if ($records) {
      $account = $records[0];
      return $account["username"];
    }
  }
  return NULL;
}

function log_in($username, $password) {
  global $db;

  if ($username && $password) {
    $sql = "SELECT * FROM users WHERE username = :username;";
    $params = array(
      ':username' => $username
    );
    $records = exec_sql_query($db, $sql, $params)->fetchAll();
    if ($records) {
      // Username is UNIQUE, so there should only be 1 record.
      $account = $records[0];
      if ($account['password'] == $password) {

        // Generate session
        // Warning: Not a secure method for generating a session id
        // TODO: secure session
        $session = uniqid();
        $sql = "UPDATE users SET session = :session WHERE id = :user_id;";
        $params = array (
          ":user_id" => $account['id'],
          ":session" => $session
        );
        $result = exec_sql_query($db, $sql, $params);
        if ($result) {
          // Success, session stored in DB

          // Send this back to the client
          setcookie("session", $session, time()+3600);

          record_message("Logged in as $username");
          return $username;
        }
      } else {
        record_message("Invalid username or password.");
      }
    } else {
      record_message("Invalid username or password.");
    }
  } else {
    record_message("No username or password given.");
  }
  return NULL;
}

function log_out() {
  global $current_user;
  global $db;

  if ($current_user) {
    $sql = "UPDATE users SET session = :session WHERE username = :username;";
    $params = array (
      ":username" => $current_user,
      ":session" => NULL
    );
    if (!exec_sql_query($db, $sql, $params)) {
      record_message("log out failed.");
    }

    //
    setcookie("session", "", time()-3600);
    $current_user = NULL;
  }
}

// Check if we should login the user
if (isset($_POST['login'])) {
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  $username = trim($username);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

  $current_user = log_in($username, $password);
}

// check if logged in
$current_user = check_login();
if (check_login()!=NULL){
  $pages = array(
    "index" => "Home",
    "search" => "Search",
    "upload" => "Upload",
    "logout" => "Sign Out"
  );;} else
  {$pages= array(
    "index" => "Home",
    "search" => "Search",
    "upload" => "Upload",
    "login" => "Sign In",

  );;};
