<?php 
include '../module/class.php';

$account = sql::getUser($db->connection, $_COOKIE['login'], $_COOKIE['password']);
$accountId = $account['id'];

$routeTo = $_POST['routeTo']; 

$idTrip = $_POST['id_trip'];

$route = "";
$summa = 0;

$startPos = $_POST['start_pos'];
$endPos = $_POST['end_pos'];
$numberQuery = $_POST['number_query'];
$howLitr = $_POST['how_litr'];
$summaCheck = $_POST['summa'];

$dateTrip = date('Y-m-d', strtotime(htmlentities($_POST['date_trip'])));
$dateCheck = date('Y-m-d', strtotime(htmlentities($_POST['date_check'])));

for ($i=0; $i < count($routeTo); $i++) {
	$routeToId = $routeTo[$i];
	$query = mysqli_query($db->connection, "SELECT * FROM routes WHERE id = '$routeToId' AND haveId = '$accountId'");
	$fetch = mysqli_fetch_assoc($query);
	if ($i == 0) {
		$route .= $fetch['from_place'] . " - " . $fetch['to_place'];
	}
	if ($i > 0) {
		$route .= ' - ' . $fetch['to_place'];
	}
	$summa += $fetch['total_km'];
}
$uploaddir = '../files/check/';
if ( $_FILES['file_check']['tmp_name'] != null ) {
	for ($i=0; $i < count($_FILES['file_check']['tmp_name']); $i++) {
		$tempNameFile = rand(10000, 9999999);
		if ( $i <= 1 ) {
			$uploadfile = $uploaddir . $tempNameFile . '.' . pathinfo($_FILES['file_check']['name'][$i], PATHINFO_EXTENSION);
			move_uploaded_file($_FILES['file_check']['tmp_name'][$i], $uploadfile);
			$uploadsFile .= 'files/check/' . $tempNameFile . '.' . pathinfo($_FILES['file_check']['name'][$i], PATHINFO_EXTENSION) . " ";
		}
	}
	mysqli_query($db->connection, "UPDATE trip SET dateHappen = '$dateTrip', from_km = '$startPos', to_km = '$endPos', total_km = '$summa', route = '$route', number_request = '$numberQuery', haveId = '$accountId', date_check = '$dateCheck', how_litr_check = '$howLitr', summa_check = '$summaCheck', url_check = '$uploadsFile' WHERE id = '$idTrip'");
}
if ( $_FILES['file_check']['tmp_name'] == null ) {
	mysqli_query($db->connection, "UPDATE trip SET dateHappen = '$dateTrip', from_km = '$startPos', to_km = '$endPos', total_km = '$summa', route = '$route', number_request = '$numberQuery', haveId = '$accountId', date_check = '$dateCheck', how_litr_check = '$howLitr', summa_check = '$summaCheck' WHERE id = '$idTrip'");
}
header('Location: /journal/index');
?>