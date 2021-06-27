<?php 
include '../module/class.php';

$account = sql::getUser($db->connection, $_COOKIE['login'], $_COOKIE['password']);
$accountId = $account['id'];

/*echo $_POST['date_trip'];
echo $_POST['start_pos'];
echo $_POST['end_pos'];
echo $_POST['routeTo'];
echo $_POST['number_query'];
echo $_POST['date_check'];
echo $_POST['how_litr'];
echo $_POST['summa'];
echo $_FILES['file_check'];*/
$route = "";
$summa = 0;
$endPosition;
$uploadsFile;
$routeto = $_POST['routeTo'];
if ( $_POST['auto'] == "on" ) {
	$dateTrip = date('Y-m-d', strtotime(htmlentities($_POST['date_trip'])));
	$startPos = $_POST['start_pos'];
	$numberQuery = $_POST['number_query'];
	$dateCheck = date('Y-m-d', strtotime(htmlentities($_POST['date_check'])));
	$howLitr = $_POST['how_litr'];
	$summaCheck = $_POST['summa'];
	if ( $_POST['date_trip'] && $_POST['start_pos'] && $_POST['routeTo'] && $_POST['number_query'] && $_POST['date_check'] && $_POST['how_litr'] && $_POST['summa'] ) {
	for ($i=0; $i < count($_POST['routeTo']); $i++) {
		$routetoId = $routeto[$i];
		$query = mysqli_query($db->connection, "SELECT * FROM routes WHERE id = '$routetoId' AND haveId = '$accountId'");
		$fetch = mysqli_fetch_assoc($query);
		if ($i == 0) {
			$route .= $fetch['from_place'] . " - " . $fetch['to_place'];
		}
		if ($i > 0) {
			$route .= ' - ' . $fetch['to_place'];
		}
		$summa += $fetch['total_km'];
	}
	$endPosition = $_POST['start_pos'] + $summa;
	if ( $_FILES['file_check']['tmp_name'][0] != null ) {
		$uploaddir = '../files/check/';
		for ($i=0; $i < count($_FILES['file_check']['tmp_name']); $i++) {
			$tempNameFile = rand(10000, 9999999);
			if ( $i <= 1 ) {
				$uploadfile = $uploaddir . $tempNameFile . '.' . pathinfo($_FILES['file_check']['name'][$i], PATHINFO_EXTENSION);
				move_uploaded_file($_FILES['file_check']['tmp_name'][$i], $uploadfile);
				$uploadsFile .= $uploaddir . $tempNameFile . '.' . pathinfo($_FILES['file_check']['name'][$i], PATHINFO_EXTENSION) . " ";
			}
		}
		mysqli_query($db->connection, "INSERT INTO trip (dateHappen, from_km, to_km, total_km, route, number_request, haveId, date_check, how_litr_check, summa_check, url_check) VALUES ('$dateTrip', '$startPos', '$endPosition', '$summa', '$route', '$numberQuery', '$accountId', '$dateCheck', '$howLitr', '$summaCheck', '$uploadsFile')");
	}
	/*print_r($_FILES['file_check']);*/
	if ( $_FILES['file_check']['tmp_name'][0] == null ) {
		mysqli_query($db->connection, "INSERT INTO trip (dateHappen, from_km, to_km, total_km, route, number_request, haveId, date_check, how_litr_check, summa_check) VALUES ('$dateTrip', '$startPos', '$endPosition', '$summa', '$route', '$numberQuery', '$accountId', '$dateCheck', '$howLitr', '$summaCheck')");
	}
	}
	$litrs = floor($summa * ($account['rasxod_km'] / 100));
	$minusLitr = $account['limit_card'] - $litrs;
	mysqli_query($db->connection, "UPDATE users SET limit_card = '$minusLitr' WHERE id = '$accountId'");
}
if ( !$_POST['auto'] ) {
	$dateTrip = date('Y-m-d', strtotime(htmlentities($_POST['date_trip'])));
	$startPos = $_POST['start_pos'];
	$numberQuery = $_POST['number_query'];
	$dateCheck = date('Y-m-d', strtotime(htmlentities($_POST['date_check'])));
	$howLitr = $_POST['how_litr'];
	$summaCheck = $_POST['summa'];
	if ( $_POST['date_trip'] && $_POST['start_pos'] && $_POST['routeTo'] && $_POST['number_query'] && $_POST['date_check'] && $_POST['how_litr'] && $_POST['summa'] ) {
	for ($i=0; $i < count($_POST['routeTo']); $i++) {
		$routetoId = $routeto[$i];
		$query = mysqli_query($db->connection, "SELECT * FROM routes WHERE id = '$routetoId' AND haveId = '$accountId'");
		$fetch = mysqli_fetch_assoc($query);
		if ($i == 0) {
			$route .= $fetch['from_place'] . " - " . $fetch['to_place'];
		}
		if ($i > 0) {
			$route .= ' - ' . $fetch['to_place'];
		}
		$summa += $fetch['total_km'];
	}
	$endPosition = $_POST['end_pos'];
	if ( $_FILES['file_check']['tmp_name'][0] != null ) {
		$uploaddir = '../files/check/';
		for ($i=0; $i < count($_FILES['file_check']['tmp_name']); $i++) {
			$tempNameFile = rand(10000, 9999999);
			if ( $i <= 1 ) {
				$uploadfile = $uploaddir . $tempNameFile . '.' . pathinfo($_FILES['file_check']['name'][$i], PATHINFO_EXTENSION);
				move_uploaded_file($_FILES['file_check']['tmp_name'][$i], $uploadfile);
				$uploadsFile .= 'files/check/' . $tempNameFile . '.' . pathinfo($_FILES['file_check']['name'][$i], PATHINFO_EXTENSION) . " ";
			}
		}
		mysqli_query($db->connection, "INSERT INTO trip (dateHappen, from_km, to_km, total_km, route, number_request, haveId, date_check, how_litr_check, summa_check, url_check) VALUES ('$dateTrip', '$startPos', '$endPosition', '$summa', '$route', '$numberQuery', '$accountId', '$dateCheck', '$howLitr', '$summaCheck', '$uploadsFile')");
	}
	if ( $_FILES['file_check']['tmp_name'][0] == null ) {
		mysqli_query($db->connection, "INSERT INTO trip (dateHappen, from_km, to_km, total_km, route, number_request, haveId, date_check, how_litr_check, summa_check) VALUES ('$dateTrip', '$startPos', '$endPosition', '$summa', '$route', '$numberQuery', '$accountId', '$dateCheck', '$howLitr', '$summaCheck')");
	}
}
$litrs = floor($summa * ($account['rasxod_km'] / 100));
	$minusLitr = $account['limit_card'] - $litrs;
	mysqli_query($db->connection, "UPDATE users SET limit_card = '$minusLitr' WHERE id = '$accountId'");
}
header('Location: /trip/index');
?>