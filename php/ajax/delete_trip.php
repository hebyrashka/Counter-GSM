<?php
$directory_lvl = 2;

include '../../module/directory.php';

include $extra_dir . 'module/class.php';

$account = sql::getUser($db->connection, $_COOKIE['login'], $_COOKIE['password']);
$accountId = $account['id'];

$idChange = $_POST['id'];

mysqli_query($db->connection, "DELETE FROM trip WHERE id = '$idChange' AND haveId = '$accountId'");
// mysqli_query($db->connection, "UPDATE users SET card_limit = ");
header("Location: /journal/index");
?>