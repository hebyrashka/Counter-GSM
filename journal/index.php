<?php
$PAGE_NAME = "Журнал";
$directory_lvl = 1;

include '../module/directory.php';

include $extra_dir . 'module/class.php';

if ( !sql::getUser($db->connection, $_COOKIE['login'], $_COOKIE['password']) ) {
  header('Location: /join');
}

$accountId = sql::getUser($db->connection, $_COOKIE['login'], $_COOKIE['password'])['id'];

include $extra_dir . 'module/header.php';
?>
    <header>
        <div class='hamburger-wrapper'>
            <button id="btn-hamburger"><img class="icon-navbar" src="<?php echo $extra_dir . 'img/hamburger.png';?>"></button>
        </div>
        <div class="navbar-content">
            <a href="/journal/index"><div class="item-navbar">Журнал</div></a>
            <a href="/"><div class="item-navbar">Быстрый расчёт</div></a>
            <a href="/trip/index"><div class="item-navbar">Новая поездка</div></a>
            <a href="/settings/index"><div class="item-navbar">Настройки</div></a>
        </div>
    </header>
    <div class="wrapper">
<div>
	<form method="get">
		<div>
			<input type="date" name="filter_date" placeholder="Дата">
			<input name="route_discription" placeholder="Описание маршрута">
			<input name="number_query" placeholder="Номер заявки">
			<button class="btn-filter">Применить</button>
            <a href="/journal/index">Сбросить</a>
		</div>
	</form>
	<table>
  		<thead>
    		<tr>
      			<th scope="col">Дата</th>
      			<th scope="col">Начало, км</th>
      			<th scope="col">Конец, км</th>
      			<th scope="col">Пробег, км</th>
      			<th scope="col">Описание маршрута</th>
      			<th scope="col">Номер заявки</th>
            <th scope="col"></th>
    		</tr>
  		</thead>
  		<tbody>
        <form action="/change_trip/index" method="post" id="changeTrip">
        <input type="hidden" id="type-action" name="type_action" value="">
        <?php
        $queryTrip = "SELECT * FROM `trip` WHERE haveId = '$accountId'";
        if ($_GET['filter_date']) {
        	$filterDate = $_GET['filter_date'];
        	$queryTrip .= " AND dateHappen = '$filterDate'";
        }
        if ($_GET['route_discription']) {
        	$routeDiscription = $_GET['route_discription'];
        	$queryTrip .= " AND route LIKE '%$routeDiscription%'";
        }
        if ($_GET['number_query']) {
        	$numberQuery = $_GET['number_query'];
        	$queryTrip .= " AND number_request LIKE '%$numberQuery%'";
        }

        $journalQuery = mysqli_query( $db->connection, $queryTrip );

        $checkQuery = mysqli_query( $db->connection, "SELECT * FROM `trip` WHERE haveId = '$accountId'" );

        $checkFetch = mysqli_fetch_assoc($checkQuery);
        if (!$checkFetch) {
          echo "<tr>
            <th scope='row' colspan='7' class='text-center'>Нет поездок</th>
          </tr>";
        }

        while ( $journalFetch = mysqli_fetch_assoc($journalQuery) ) {
          echo "<tr>
            <td scope='row'>" . $journalFetch['dateHappen'] . "</td>
            <td>" . $journalFetch['from_km'] . "</td>
            <td>" . $journalFetch['to_km'] . "</td>
            <td>" . $journalFetch['total_km'] . "</td>
            <td>" . $journalFetch['route'] . "</td>
            <td>" . $journalFetch['number_request'] . "</td>
            <td><input type='radio' name='idChange' class='idChange' value='" . $journalFetch['id'] . "'></td>
        </tr>";
        }
        ?>
        </form>
  		</tbody>
	</table>
<div>
		<form action="../php/form_excel.php" method="post" class="form-excel">
            <div id="inline-input">
			    <div>
				    <label for="excel-from" class="h6 mr-2">C</label>
				    <input type="date" id="excel-from" name="create-excel-from">
			    </div>
			    <div class="input-excel-to">
				    <label for="excel-to">ПО</label>
				    <input type="date" id="excel-to" name="create-excel-to">
			    </div>
            </div>
			<div class="btn-create-excel">
                <input type="hidden" value="" name="action" id="excel-action">
				<button type="button" class="btn-excel-card">Карта держателя</button>
                <button type="button" class="btn-excel-list">Пут. лист</button>
			</div>
            <div class="action-with-trip">
                <button type="button" id="btn-delete">Удалить</button>
                <button id="btn-change" form="changeTrip">Изменить</button>
            </div>
		</form>
</div>
</div>
    <script type="text/javascript" src="<?php echo $extra_dir . "js/hamburger.js"; ?>"></script>
    <script type="text/javascript" src="<?php echo $extra_dir . "js/journal.js"; ?>"></script>
<?php 
include $extra_dir . 'module/footer.php';
?>