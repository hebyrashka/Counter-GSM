<?php 
include '../module/class.php';

$account = sql::getUser($db->connection, $_COOKIE['login'], $_COOKIE['password']);
$accountId = $account['id'];

if ( $_POST['from_place'] && $_POST['to_place'] && $_POST['total_km'] ) {
	$fromPlace = $_POST['from_place'];
	$toPlace = $_POST['to_place'];
	$totalKm = $_POST['total_km'];
	mysqli_query($db->connection, "INSERT INTO routes (from_place, to_place, total_km, haveId) VALUES ('$fromPlace', '$toPlace', '$totalKm', '$accountId')");
	header('Location: /settings/index');
}
?>