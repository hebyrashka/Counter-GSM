<?php 
include '../module/class.php';

$accountId = sql::getUser($db->connection, $_COOKIE['login'], $_COOKIE['password'])['id'];

$fio = $_POST['fio'];
$position  = $_POST['position'];
$adress  = $_POST['adress'];
$phone  = $_POST['phone'];
$number_license  = $_POST['number_license'];
$number_card  = $_POST['number_card'];
$limit_card  = $_POST['limit_card'];
$norma  = $_POST['norma'];
$rate_km  = $_POST['rate_km'];
$marka_car  = $_POST['marka_car'];
$gov_number  = $_POST['gov_number'];
$type_oil  = $_POST['type_oil'];
$rasxod_km  = $_POST['rasxod_km'];

if ($_POST['fio']) {
	mysqli_query($db->connection, "UPDATE users SET fio = '$fio' WHERE id = '$accountId'");
}
if ($_POST['position']) {
	mysqli_query($db->connection, "UPDATE users SET position = '$position' WHERE id = '$accountId'");
}
if ($_POST['adress']) {
	mysqli_query($db->connection, "UPDATE users SET adress = '$adress' WHERE id = '$accountId'");
}
if ($_POST['phone']) {
	mysqli_query($db->connection, "UPDATE users SET phone = '$phone' WHERE id = '$accountId'");
}
if ($_POST['number_license']) {
	mysqli_query($db->connection, "UPDATE users SET number_license = '$number_license' WHERE id = '$accountId'");
}
if ($_POST['number_card']) {
	mysqli_query($db->connection, "UPDATE users SET number_card = '$number_card' WHERE id = '$accountId'");
}
if ($_POST['limit_card']) {
	mysqli_query($db->connection, "UPDATE users SET limit_card = '$limit_card' WHERE id = '$accountId'");
}
if ($_POST['norma']) {
	mysqli_query($db->connection, "UPDATE users SET norma = '$norma' WHERE id = '$accountId'");
}
if ($_POST['rate_km']) {
	mysqli_query($db->connection, "UPDATE users SET rate_km = '$rate_km' WHERE id = '$accountId'");
}
if ($_POST['marka_car']) {
	mysqli_query($db->connection, "UPDATE users SET marka_car = '$marka_car' WHERE id = '$accountId'");
}
if ($_POST['gov_number']) {
	mysqli_query($db->connection, "UPDATE users SET gov_number = '$gov_number' WHERE id = '$accountId'");
}
if ($_POST['type_oil']) {
	mysqli_query($db->connection, "UPDATE users SET type_oil = '$type_oil' WHERE id = '$accountId'");
}
if ($_POST['rasxod_km']) {
	mysqli_query($db->connection, "UPDATE users SET rasxod_km = '$rasxod_km' WHERE id = '$accountId'");
}
header('Location: /settings/index');
?>