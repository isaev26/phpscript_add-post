<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="date.php" method="POST">
    <input type="date" name="date" id="">
    <input type="submit" value="Отправить">
  </form>
</body>

</html>

<?
$arrdate = array('09.04.2020', '10.04.2020', '13.04.2020');
$flag = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $date = $_POST['date'];
}
$date = date("d.m.Y", strtotime($date));
echo 'Сегодня: ' . $date . '<br>';


echo 'Праздники:<br>';
foreach ($arrdate as $indate) {
  echo $indate . '<br>';
}
echo '<br><br>';

while ($flag) {
  foreach ($arrdate as $indate) {
    if ($indate == $date) {
      echo $date . ' Совпадение с правдником!<br>';
      $date = date("d.m.Y", strtotime($date . ' +1 days'));
      echo '+1 день теперь дата->' . $date . '<br>';
    } else {
      $week = date("D", strtotime($date));
      if (in_array($week, ['Sat', 'Sun'])) {
        echo $date . ' суб или вос<br>';
        $date = date("d.m.Y", strtotime($date . ' +1 days'));
        echo '+1 день теперь дата->' . $date . '<br>';
      } else {
        echo $date . ' не суб и не вос!<br>';
        $flag = false;
      }
    }
  }
}
echo '<br><br>';
echo $date . '- не выходной или не праздник, можно на работу!'


?>