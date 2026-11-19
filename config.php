<?php
  $user = "root";
  $pass = "";
  $server = "localhost";
  $dbname = "video_game_store";

  try {
    $conn = new PDO("mysql:host=$server;dbname=$dbname;charset=utf8mb4", $user, $pass);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    die("Database connection failed.");
  }
?>