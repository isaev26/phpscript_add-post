<?php
if (!isset($_SESSION)) {
  session_start();
}

if (!isset($_SESSION['logged_user'])) {
  echo "Вы не вошли систему. Пожадуста введите логин и парол!";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="template/style.css">
  <title>Вход</title>
</head>

<body>
  <form action="auth.php" method="POST">
    <label>Логин: </label>
    <input type="text" name="login">
    <label>Парол: </label>
    <input type="password" name="password">
    <input type="submit" value="Войти">
  </form>
  <a href="reg.php">Регистрация</a>
</body>

</html>