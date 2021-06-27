<?php
$directory_lvl = 2;

include '../../module/directory.php';

include $extra_dir . 'module/class.php';

$account = sql::getUser($db->connection, $_COOKIE['login'], $_COOKIE['password']);
$accountId = $account['id'];

$idChange = $_POST['id'];

echo $idChange;
echo $accountId;

mysqli_query($db->connection, "DELETE FROM routes WHERE id = '$idChange' AND haveId = '$accountId'");

?>