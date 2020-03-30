<?php
session_start();
unset($_SESSION['logged_user']);
unset($_SESSION['role']);
unset($_SESSION['like']);
session_destroy();

if (!isset($_SESSION['logged_user'])) {
  header("LOCATION: login.php");
  exit;
}
