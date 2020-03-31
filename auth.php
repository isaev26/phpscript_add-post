<?php
if (!isset($_SESSION)) {
  session_start();
}
$mysqli = new mysqli("localhost", "root", "", "test");
/* проверяем соединение */
if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $log = $_POST['login'];
  $pass = $_POST['password'];
  $resa = mysqli_query($mysqli, "SELECT * FROM `users`");

  if (!empty($log) && !empty($pass)) {
    while ($row = mysqli_fetch_array($resa)) {
      if ($log == $row['login'] && $pass == $row['password']) {
        $_SESSION['logged_user'] = $log;
        $_SESSION['is_admin'] = $row['role'];
        // echo $row['login'], $row['password'], $row['role'];
        header('LOCATION: index.php');
        exit;
      }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="refresh" content="2; http://<? echo $_SERVER['HTTP_HOST'] ?>">
  <link rel="stylesheet" href="template/style.css">
  <title>Document</title>
</head>

<body>
  <b>Логин или парол неверный!</b>
</body>

</html>