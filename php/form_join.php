<?php 
$login = $_POST['join-login'];
$password = $_POST['join-password'];

$directory_lvl = 1;

include '../module/directory.php';

include $extra_dir . 'module/class.php';

$db = new db('localhost', 'root', 'root', 'counter_gsm');

if ( $login && $password ) {
	if ( sql::getUser($db->connection , $login, $password) ) {
		user::setJoin($login, $password);
		header('Location: /journal/index');
	}
	if ( !sql::getUser($db->connection , $login, $password) ) {
		header('Location: /join');
	}
}
if ( !$login || !$password ) {
	header('Location: /join');
}
?>