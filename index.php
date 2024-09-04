<?php
// start session
session_start();

   /*
    simple routing system -> decide what page to load depending the url the user visit

    localhost:9000/ -> home.php
    localhost:9000/login -> login.php
    localhost:9000/signup -> signup.php
    localhost:9000/logout -> logout.php
  */

  // figure out the url the user is visiting
  $path = $_SERVER["REQUEST_URI"];

  // once you figure out the path the user is visiting, load relevant content
  if ( $path == '/login' ) {
    require 'login.php';
  } else if ( $path == '/signup' ) {
    require 'signup.php';
  } else if ( $path == '/logout' ) {
    require 'logout.php';
  } else {
    require 'home.php';
  }