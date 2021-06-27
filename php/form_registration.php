<?php 
$login = $_POST['registration-login'];
$password = $_POST['registration-password'];
$checkPassword = $_POST['registration-check-password'];

include '../module/class.php';

$db = new db('localhost', 'root', 'root', 'counter_gsm');

if ( $login && $password && $checkPassword ) {
	if ( sql::getUserByLogin($db->connection , $login) ) {
		header('Location: /registration');
	}
	if ( !sql::getUserByLogin($db->connection , $login) ) {
		sql::newUser($db->connection ,$login, $password);
		header('Location: /join');
	}
}
?>