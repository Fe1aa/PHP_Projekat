<?php 
  require_once("config.php");

  if(!isset($_POST['submit'])) {
    header("Location: sign_up.php");
    exit();
  }

  $username = trim($_POST["username"] ?? '');
  $email = trim($_POST["email"] ?? '');
  $password = $_POST["password"] ?? '';
  $confirm_password = $_POST["confirm_password"] ?? '';

  if(empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
    die("Please fill in all fields.");
  }

  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email address.");
  }

  if($password !== $confirm_password) {
    die("Passwords do not match.");
  }

  $sql = "SELECT id FROM users WHERE username = :username OR email = :email";
  $check = $conn->prepare($sql);

  $check->execute([
    ':username' => $username,
    ':email' => $email
  ]);

  if($check->fetch()) {
    die("Username or email already exists.");
  }

  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";

  $stmt = $conn->prepare($sql);

  $stmt->execute([
    ':username' => $username,
    ':email' => $email,
    ':password' => $hashedPassword
  ]);

  header("Location: log_in.php");
  exit();
?>