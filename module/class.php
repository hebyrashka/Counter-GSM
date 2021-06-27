<?php
class db {
	public $connection;
	function __construct($server, $login, $password, $dbname) {
		$this->connection = mysqli_connect($server, $login, $password, $dbname);
	}
}
class sql {
	static function getUser($connection, $login, $password)
	{
		return mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `users` WHERE login = '$login' AND password = '$password'"));
	}
	static function getUserByLogin($connection, $login)
	{
		return mysqli_fetch_assoc(mysqli_query($connection, "SELECT * FROM `users` WHERE login = '$login'"));
	}
	static function newUser($connection, $login, $password)
	{
		return mysqli_query($connection, "INSERT INTO users ( login, password ) VALUES ( '$login', '$password' )");
	}
}
class user {
	static function setJoin($login, $password)
	{
		setcookie('login', $login, null, '/');
		setcookie('password', $password, null, '/');
	}
}
function file_download($file) {
    if (file_exists($file)) {
        if (ob_get_level()) {
            ob_end_clean();
        }
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    }
}
$db = new db('localhost', 'root', 'root', 'counter_gsm');
?>