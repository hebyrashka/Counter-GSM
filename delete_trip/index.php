<?php 
$idTrip = $_POST['idChange'];

$extra_dir;

if ( $DIRECTORY == false ) {
	$extra_dir = "../";
}
if ( $DIRECTORY == true ) {
	$extra_dir = "";
}

include $extra_dir . 'module/class.php';

$account = sql::getUser($db->connection, $_COOKIE['login'], $_COOKIE['password']);
$accountId = $account['id'];

mysqli_query($db->connection, "DELETE FROM trip WHERE id = '$idTrip'");
header('Location: /journal/index');
?>