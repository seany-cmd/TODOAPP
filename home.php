<?php
 
  // 1. collect database info
  $host = "127.0.0.1";
  $database_name = "todoapp"; 
  $database_user = "root";
  $database_password = "";

  
  $database = new PDO(
    "mysql:host=$host;dbname=$database_name",
    $database_user,
    $database_password 
  );
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

  //load the data
  // 3.1 SQL command(recipe)
  $sql = "SELECT * FROM todos";
  // 3.2 - prepare SQL query (prepare your material)
  $query = $database->prepare($sql);
  // 3.3 - execute SQL query (to cook)
  $query->execute();
  // 3.4 - fetch all  (eat)
  $tasks = $query->fetchALL();

  ?><!DOCTYPE html>
  <html>
    <head>
      <title>TODO App</title>
      <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
        crossorigin="anonymous"
      />
      <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
      />
      <style type="text/css">
        body {
          background: #f1f1f1;
        }
      </style>
    </head>
    <body>
      <div
        class="card rounded shadow-sm"
        style="max-width: 500px; margin: 60px auto 20px auto;"
      >
        <div class="card-body">
          <h3 class="card-title mb-3">My Todo List</h3>
          <?php if ( isset( $_SESSION['user'] ) ) : ?>
          <!-- logged in user -->
           <p>Welcome back, <?= $_SESSION['user']['name']; ?> (<?= $_SESSION['user']['email']; ?>)</p>
          <ul class="list-group">
          <?php foreach ( $tasks as $task ) : ?>
            <li
              class="list-group-item d-flex justify-content-between align-items-center"
            >
              <div>
                  <form method="POST" action="/update_task">
                      <input type="hidden" name="task_id" value="<?= $task['id']; ?>" />
                      <input type="hidden" name="completed" value="<?= $task['completed']; ?>" />
                      <?php if ( $task['completed'] == 1 ) : ?>
                          <button class="btn btn-sm btn-success">
                              <i class="bi bi-check-square"></i>
                          </button>
                          <span class="ms-2"><?= $task['label']; ?></span>
                      <?php else : ?>
                          <button class="btn btn-sm btn-light">
                              <i class="bi bi-square"></i>
                          </button>
                          <span class="ms-2"><?= $task['label']; ?></span>
                      <?php endif; ?>
                  </form>
              </div>
              <div>
                  <form method="POST" action="/delete_task">
                      <input type="hidden" name="task_id" value="<?= $task['id']; ?>" />
                      <button class="btn btn-sm btn-danger">
                          <i class="bi bi-trash"></i>
                      </button>
                  </form>
              </div>
            </li>
            <?php endforeach; ?>
  
          </ul>
          <div class="mt-4">
            <form 
              method="POST"
              action="/add_task"
              class="d-flex justify-content-between align-items-center">
              <input
                type="text"
                class="form-control"
                placeholder="Add new item..."
                name="task_name"
                required
              />
              <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
            </form>
          </div>
        <?php else : ?>
          <!-- not logged in user -->
          <p>Please login to continue</p>
          <a href="/login">Login</a>
          <a href="/signup">Sign Up</a>
        <?php endif; ?>
        </div>
      </div>
  
      <!-- only show logout link if user is logged in -->
      <?php if ( isset( $_SESSION['user'] ) ) : ?>
        <div class="text-center">
          <a href="/logout">Logout</a>
        </div>
      <?php endif; ?>
  
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
  </html>


