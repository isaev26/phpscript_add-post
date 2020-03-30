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
  <?
  $posts = mysqli_query($mysqli, "SELECT * FROM `posts`");
  ?>
  <div class="posts">
    <div class="container">
      <? while ($row = mysqli_fetch_array($posts)) { ?>
        <div class="post_name">
          <? echo $row['post_name'] ?>
        </div>
        <div class="post_main">
          <? echo $row['post'] ?>
        </div>
        <div class="post_info">
          <div class="author"><? echo $row['author'] ?></div>
          <div class="rating">rating: <? echo $row['rating'] ?></div>
          <div class="view">view: <? echo $row['view'] ?></div>
        </div>
      <? } ?>
    </div>
  </div>
</body>

</html>