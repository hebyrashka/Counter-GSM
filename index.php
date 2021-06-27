<?php 
include 'module/class.php';

if ( sql::getUser($db->connection, $_COOKIE['login'], $_COOKIE['password']) ) {
	header('Location: /journal/index');
}
if ( !sql::getUser($db->connection, $_COOKIE['login'], $_COOKIE['password']) ) {
	header('Location: /join');
}

?>