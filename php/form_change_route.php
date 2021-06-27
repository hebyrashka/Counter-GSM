<?php
$directory_lvl = 1;

include '../module/directory.php';

include $extra_dir . 'module/class.php';

$accountId = sql::getUser($db->connection, $_COOKIE['login'], $_COOKIE['password'])['id'];
$account = sql::getUser($db->connection, $_COOKIE['login'], $_COOKIE['password']);

$fromPlace = $_POST['from_place'];
$toPlace = $_POST['to_place'];
$totalKm = $_POST['total_km'];
$changeId = $_POST['change_id'];
mysqli_query($db->connection, "UPDATE routes SET from_place = '$fromPlace', to_place = '$toPlace', total_km = '$totalKm' WHERE id = '$changeId' AND haveId = '$accountId'");
header("Location: /settings/index");
?>