<?php 
include '../../module/class.php';

$account = sql::getUser($db->connection, $_COOKIE['login'], $_COOKIE['password']);
$accountId = $account['id'];

$params = array();
parse_str($_POST['form3'], $params);
$routeTo = $params['routeTo'];
$totalKm = 0;
if ( $routeTo != null ) {
    for ($i=0; $i < count($routeTo); $i++) {
        $routeToFor = $routeTo[$i];
        $query = mysqli_query($db->connection, "SELECT total_km FROM routes WHERE id = '$routeToFor' AND haveId = '$accountId'");
        $fetch = mysqli_fetch_assoc($query);
        $totalKm += $fetch['total_km'];
    }
    if ( $account['norma'] == 'summer' ) {
        echo floor($totalKm * ($account['rasxod_km'] / 100));
    }
    if ( $account['norma'] == 'winter' ) {
        echo floor($totalKm * ($account['rasxod_km'] * 1.15 / 100));
    }
}
?>