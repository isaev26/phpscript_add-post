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

  <form action="add_post.php" method="POST">
    <label for="GET-name-post">Называние:</label><br>
    <input type="text" name="pname" size="28"><br>
    <label for="GET-post">Пост:</label><br>
    <textarea name="post" cols="30" rows="10"></textarea><br>
    <button type="submit">Добавить пост</button>
  </form>
  <?
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pname = $_POST['pname'];
    $post = $_POST['post'];
    $today = date("Y-m-d");
    if (!empty($pname) && !empty($post)) {
      echo 'Post name: <b>' . $pname . '</b><br>';
      echo 'post: ' . $post . '<br>';
      echo 'author: ' . $login . '<br>';
      echo $today;
      $add_post = mysqli_query($mysqli, "INSERT INTO `posts`(`id_post`, `time`, `author`, `post_name`, `post`, `rating`, `view`) 
      VALUES (NULL,'$today','$login','$pname','$post','0','1')");
    }
  }
  ?>


  <div class="home">
    <a href="index.php">Главная</a>
  </div>
</body>

</html>