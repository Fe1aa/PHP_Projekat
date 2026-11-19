<?php 
  session_start();
  require_once("config.php");

  if(!isset($_POST['submit'])) {
    header("Location: log_in.php");
    exit();
  }

  $identifier = trim($_POST["identifier"] ?? '');
  $password = $_POST["password"] ?? '';

  if(empty($identifier) || empty($password)) {
    die("Please fill in all fields.");
  }

  $sql = "SELECT * FROM users WHERE username = :identifier OR email = :identifier";

  $check = $conn->prepare($sql);

  $check->execute([
    ':identifier' => $identifier
  ]);

  $data = $check->fetch(PDO::FETCH_ASSOC);

  if(!$data) {
    die("Invalid username or password.");
  }

  if(password_verify($password, $data['password'])) {
    session_regenerate_id(true);

    $_SESSION['id'] = $data['id'];
    $_SESSION['username'] = $data['username'];
    $_SESSION['email'] = $data['email'];

    header("Location: index.php");
    exit();
  } else {
    die("Invalid username or password.");
  }
?>