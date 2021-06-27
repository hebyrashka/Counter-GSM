<?php 
include '../../module/class.php';

$account = sql::getUser($db->connection, $_COOKIE['login'], $_COOKIE['password']);
$accountId = $account['id'];

$params = array();
parse_str($_POST['form4'], $params);
$routeTo = $params['routeTo'];
$totalKm = 0;
$lirts;
if ( $routeTo != null ) {
    for ($i=0; $i < count($routeTo); $i++) {
        $routeToFor = $routeTo[$i];
        $query = mysqli_query($db->connection, "SELECT total_km FROM routes WHERE id = '$routeToFor' AND haveId = '$accountId'");
        $fetch = mysqli_fetch_assoc($query);
        while ( $fetch = mysqli_fetch_assoc($query) ) {
            $totalKm += $fetch['total_km'];
        }
    }
    if ( $account['norma'] == 'summer' ) {
        $lirts = $account['limit_card'] - floor($totalKm * ($account['rasxod_km'] / 100));
        echo $lirts;
    }
    if ( $account['norma'] == 'winter' ) {
        $lirts = $account['limit_card'] - floor($totalKm * ($account['rasxod_km'] * 1.15 / 100));
        echo $lirts;
    }
}
?>