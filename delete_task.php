<?php

// start session (we will be using session in this page)
session_start();

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
 $id = $_POST["task_id"];

    // delete the task from the table
    // sql command 
    $sql = "DELETE FROM todos where id = :id";
    // prepare 
    $query = $database->prepare( $sql );
    // execute
    $query->execute([
        'id' => $id
    ]);

    // redirect back to index.php
    header("Location: /");
    exit;