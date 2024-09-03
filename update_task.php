<?php
  //backend code

  // 1. collect database info
  $host = "127.0.0.1";
  $database_name = "todoapp";
  $database_user = "root";
  $database_password = "";

  //2. connect to database PDO - PHP database object)
  $database = new PDO(
   "mysql:host=$host;dbname=$database_name",
   $database_user,
   $database_password 
  );
  $id = $_POST['task_id'];
  $completed = $_POST['completed'];

    // update the task
    if ( $completed == 1 ) {
        // sql command
        $sql = "UPDATE todos set completed = 0 WHERE id = :id";
        
    } else {
        // sql command
        $sql = "UPDATE todos set completed = 1 WHERE id = :id";
        
    }
    // prepare
    $query = $database->prepare( $sql );
    // execute
    $query->execute([
    'id' => $id
    ]);
    // redirect back to index.php
    header("Location: index.php");
    exit;
    