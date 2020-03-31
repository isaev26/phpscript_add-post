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
  <title>Главная</title>
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
  $posts = mysqli_query($mysqli, "SELECT * FROM `posts` ORDER BY `id_post` DESC LIMIT 5");
  ?>
  <div class="posts">
    <? while ($row = mysqli_fetch_array($posts)) { ?>
      <div class="container">
        <div class="post_name">
          <? echo $row['post_name'] ?>
        </div>
        <div class="post_main">
          <? echo $row['post'] ?>
        </div>
        <div class="post_info">
          <div class="author"><? echo $row['author'] ?></div>
          <div class="rating">rating:
            <? if ($_SESSION['like'] != 'up') { ?>
              <form action="index.php" method="POST">
                <input type="text" name="rating" value="up" hidden>
                <input type="text" name="id_post" value="<? echo $row['id_post'] ?>" hidden>
                <input type="submit" value="up">
              </form>
            <? } ?>
            <? echo $row['rating'] ?>
            <? if ($_SESSION['like'] != 'down') { ?>
              <form action="index.php" method="POST">
                <input type="text" name="rating" value="down" hidden>
                <input type="text" name="id_post" value="<? echo $row['id_post'] ?>" hidden>
                <input type="submit" value="down">
              </form>
            <? } ?>
          </div>
          <div class="view">view: <? echo $_SESSION['like'];
                                  echo $row['view']; ?></div>
        </div>

        <?
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $rating = $_POST['rating'];
          $id_post = $_POST['id_post'];
          if ($rating == "up") {
            $_SESSION['like'] = 'up';
            $rat_post = mysqli_query($mysqli, "UPDATE `posts` SET `rating`=`rating`+1 WHERE `id_post`='$id_post'");
            unset($_SESSION['like']);
          } elseif ($rating == "down") {
            $_SESSION['like'] = 'down';
            $rat_post = mysqli_query($mysqli, "UPDATE `posts` SET `rating`=`rating`-1 WHERE `id_post`='$id_post'");
            unset($_SESSION['like']);
          }
        }
        ?>
      </div>
    <? } ?>
  </div>
  <div class="add_post">
    <a href="add_post.php">Добавить пост</a>
  </div>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>