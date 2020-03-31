<?php
if (!isset($_SESSION)) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="template/style.css">
  <title>Регистрация</title>
</head>

<body>
  <?
  if (isset($_SESSION['logged_user'])) {
    echo $_SESSION['logged_user'] . ' вы уже вошли';
  ?>
    <a href="index.php">Главная</a>
  <?
  } else {
  ?>
    <form action="reg.php" method="POST">
      <label for="GET-login">Логин: </label>
      <input type="text" name="login">
      <label for="GET-about">Инфо: </label>
      <input type="text" name="about">
      <label for="GET-password">Парол: </label>
      <input type="password" name="password" min="3">
      <input type="submit" value="Регистрация">
    </form>
  <? } ?>
  <?
  $mysqli = new mysqli("localhost", "root", "", "test");
  /* проверяем соединение */
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $log = $_POST['login'];
    $pass = $_POST['password'];
    $about = $_POST['about'];
    $result = mysqli_query($mysqli, "SELECT * FROM `users` WHERE `login` = '$log' and `password` = '$pass' ");

    if (!empty($log) && !empty($pass)) {
      $check = mysqli_fetch_row($result);
      if ($check[0] <= 0) {
        $query = "INSERT INTO `users` (`id_user`, `about`, `login`, `password`, `role`) VALUES (NULL, '$about', '$log', '$pass', 'user');";
        $mysqli->query($query);
        $_SESSION['logged_user'] = $log;
        $_SESSION['is_admin'] = $row['role'];
        echo "Вы прошли регистрацию";
  ?>
        <a href="index.php">Главная</a>
  <?
      } else {
        $result = mysqli_query($mysqli, "SELECT * FROM `users` WHERE `login` = '$log' and `password` = '$pass' ");
        while ($row = mysqli_fetch_array($result)) {
          echo 'Пользовател с ' . $row['login'] . ' таким логином уже есть';
        }
      }
    } else {
      echo 'Логин или парол пусто!';
    }
  }
  ?>
</body>

</html>