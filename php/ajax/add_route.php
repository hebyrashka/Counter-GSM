<?php
$directory_lvl = 2;

include '../../module/directory.php';

include $extra_dir . 'module/class.php';

$account = sql::getUser($db->connection, $_COOKIE['login'], $_COOKIE['password']);
$accountId = $account['id'];

parse_str($_POST['form'], $params);
$routeTo = $params['routeTo'];

$fromInput = $routeTo[count($routeTo) - 1];
$querySelect = mysqli_query($db->connection, "SELECT * FROM routes WHERE id = '$fromInput' AND haveId = '$accountId'");
$fetchSelect = mysqli_fetch_assoc($querySelect);
$toSelect = $fetchSelect['to_place'];

$toSelectQuery = mysqli_query($db->connection, "SELECT * FROM routes WHERE from_place = '$toSelect' AND haveId = '$accountId'");
$checkBeRouteQuery = mysqli_query($db->connection, "SELECT * FROM routes WHERE from_place = '$toSelect' AND haveId = '$accountId'");
$checkBeRouteFetch = mysqli_fetch_assoc($checkBeRouteQuery);
if ($checkBeRouteFetch != null) {
	echo "<div class='d-flex mt-1 selectRoutes'>
			<select name='routeTo[]' class='form-control select-route ml-1 routes-select'>";
			while ($toSelectFetch = mysqli_fetch_assoc($toSelectQuery)) {
				echo "<option value='" . $toSelectFetch['id'] . "'>" . $toSelectFetch['from_place'] . " - " . $toSelectFetch['to_place'] . "</option>";
			}
	echo "</select>
			<button type='button' class='btn btn-primary ml-1 deleteButton'>+</button>
			<button type='button' class='btn btn-primary ml-1 removeButton'>-</button>
		</div>";
}
?>