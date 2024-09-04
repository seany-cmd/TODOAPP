<?php

// start session (we will be using session in this page)
session_start();

 // 1. collect database info
 $host = "127.0.0.1";
 $database_name = "todoapp";
 $database_user = "root";
 $database_password = "";

 //2. connect to database PDO - php database object)
 $database = new PDO(
  "mysql:host=$host;dbname=$database_name",
  $database_user,
  $database_password 
 );
 $task_name = $_POST['task_name'];

   //make sure task_name is not empty
    if ( empty( $task_name ) ) {
        echo "Please insert a task";
    } else {
        // 2. add task into todos label to table
        // sql command
        $sql = "INSERT INTO todos (`label`) VALUES (:label)";
        // 2.2 (prepare)
        $query = $database->prepare( $sql );
        // 2.3 (execute)
        $query->execute([
            'label' => $task_name
        ]);
        
        // 3. redirect the user back to index.php
        header("Location: /");
        exit;
    }


