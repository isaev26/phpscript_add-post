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

if (!isset($_SESSION['logged_user'])) {
  header("LOCATION: login.php");
  exit;
}
$login = $_SESSION['logged_user'];
$is_admin = $_SESSION['is_admin'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="template/style.css">
  <link rel="stylesheet" href="template/font-awesome.css">
  <title>Document</title>
</head>

<body>

  <b>Привет, <? echo $login ?>!</b>
  <? if ($is_admin == 'admin') { ?><span id="is_admin">Вы админ</span><? } ?>

  <div class="form-exit">
    <form action="unlogin.php" method="GET">
      <input type="submit" value="Выход">
    </form>
  </div>


  <div class="home">
    <a href="index.php">Главная</a>
  </div>
</body>

</html>