<?php
  require_once("config.php");
  session_start();

  if(!isset($_SESSION["id"])) {
    header("Location: log_in.php");
    exit();
  }

  if(!isset($_POST['submit'])) {
    header("Location: index.php");
    exit();
  }

  if(!isset($_POST["game"])) {
    die("No game id given.");
  }

  $game_id = $_POST["game"];
  $user_id = $_SESSION["id"];

  $addSql = "INSERT INTO user_games(user_id, game_id) VALUES (:user_id, :game_id)";

  $stmt = $conn->prepare($addSql);

  $stmt->execute([":user_id"=>$user_id, ":game_id"=>$game_id]);

  header("Location: index.php?genre=RPG#games");
  exit();
?>