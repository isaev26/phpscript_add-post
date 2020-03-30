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

  <div class="posts">
    <div class="container">
      <div class="post_name">
        Имя
      </div>
      <div class="post_main">
        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ullam assumenda cumque, fugiat, veniam rerum atque consequuntur maxime quidem soluta laudantium at? Sapiente, quasi similique? Nisi, voluptas. Modi non explicabo error quos deserunt id cum quaerat. Cupiditate vitae iste impedit nostrum voluptas excepturi, quibusdam explicabo aperiam maiores odit est eveniet fuga iure labore laborum ad consequuntur temporibus dicta. Sequi iste non quos, provident rem enim vitae ullam tempora fugiat ipsa? Ipsam odit quidem nisi reiciendis. Impedit a voluptatibus error accusantium non beatae, aspernatur sit aliquam. Pariatur dolore vitae quis optio voluptatibus. Fugiat ducimus quia quaerat rerum minus recusandae ullam nulla molestiae.
      </div>
      <div class="post_info">
        <div class="author">author: admin</div>
        <div class="rating">rating: 15</div>
        <div class="view">view :158</div>
      </div>
    </div>
  </div>
</body>

</html>