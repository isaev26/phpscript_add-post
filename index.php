<?php
if (!isset($_SESSION)) {
  session_start();
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
  <title>Document</title>
</head>

<body>

  <b>Привет, <? echo $login ?>!</b>
  <? if ($is_admin == 'admin') { ?><span>Вы админ</span><? } ?>

  <form action="unlogin.php" method="GET">
    <input type="submit" value="Выход">
  </form>
</body>

</html>