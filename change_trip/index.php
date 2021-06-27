<?php
$PAGE_NAME = "Изменить поездку";
$directory_lvl = 1;

include '../module/directory.php';

include $extra_dir . 'module/class.php';

$account = sql::getUser($db->connection, $_COOKIE['login'], $_COOKIE['password']);

$typeAction = $_POST['type_action'];
$idChange = $_POST['idChange'];

$accountId = $account['id'];

include $extra_dir . 'module/header.php';

$changeFetch = mysqli_fetch_assoc(mysqli_query($db->connection, "SELECT * FROM trip WHERE id = '$idChange'"));

$howFileUpload = count(explode(' ', $changeFetch['url_check']));
?>
<nav class="navbar navbar-light bg-primary">
  <a class="navbar-brand text-light" href="/main">
    <?php echo '<h3>' . $PAGE_NAME . '</h3>'; ?>
  </a>
</nav>
<form enctype="multipart/form-data" method="post" action="../php/form_change_trip" id="form-trip-' . $i . '" class="row mx-1 form-trip">
	<input type="hidden" value="<?php echo $idChange; ?>" name="id_trip">
	<div class="col-lg-6">
		<h3 class="text-left mt-2">Поездка:</h3>
		<input value="<?php echo $idChange; ?>" type="hidden" name="idChange">
			<div class="form-row">
				<div class="form-group col-lg-4">
					<label for="date_trip" class="h6 mr-2">Дата:</label>
					<input class="form-control" value="<?php echo $changeFetch['dateHappen']; ?>" type="date" id="date_trip" name="date_trip">
				</div>
				<div class="form-group col-lg-4">
					<label for="start_pos" class="h6 mr-2">Нач. показания:</label>
					<input class="form-control" value="<?php echo $changeFetch['from_km']; ?>" id="start_pos" name="start_pos">
				</div>
				<div class="form-group col-lg-4">
					<label for="end_pos" class="h6 mr-2">Кон. показания:</label>
					<input class="form-control" value="<?php echo $changeFetch['to_km']; ?>" id="end_pos" name="end_pos">
				</div>
			</div>
			<div class="form-row">
				<div id="routes" class="form-group col-lg-12">
					<p>Текущий маршрут: </p> 
					<p><?php echo $changeFetch["route"]; ?></p>
					<div class="d-flex mt-1 selectRoutes">
						<select name="routeTo[]" id="route" class="form-control select-route ml-1 routes-select">
						<?php 
							$totalSelectQuery = mysqli_query($db->connection, "SELECT * FROM routes WHERE haveId = '$accountId'");
							while ( $totalSelectFetch = mysqli_fetch_assoc($totalSelectQuery) ) {
								echo "<option value='" . $totalSelectFetch['id'] . "'>" . $totalSelectFetch["from_place"] . " - " . $totalSelectFetch["to_place"] . "</option>";
							}
						?>
						echo '</select>
						<button type="button" class="btn btn-primary ml-1 deleteButton">+</button>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="number_query" class="h6 mr-2">Номера заявок:</label>
				<input class="form-control" value="<?php echo $changeFetch['number_request']; ?>" id="number_query" name="number_query">
			</div>
	</div>
	<div class="col-lg-6">
		<h3 class="text-left mt-2">Чек:</h3>
			<div class="form-row mt-1">
				<div class="form-group col-lg-4">
					<label for="date_check" class="h6 mr-2">Дата:</label>
					<input class="form-control" value="<?php echo $changeFetch['date_check']; ?>" type="date" id="date_check" name="date_check">
				</div>
				<div class="form-group col-lg-4">
					<label for="how_litr" class="h6 mr-2">Кол-во литров:</label>
					<input class="form-control" value="<?php echo $changeFetch['how_litr_check']; ?>" id="how_litr" name="how_litr">
				</div>
				<div class="form-group col-lg-4">
					<label for="summa" class="h6 mr-2">Сумма:</label>
					<input class="form-control" value="<?php echo $changeFetch['summa_check']; ?>" id="summa" name="summa">
				</div>
			</div>
			<h5 class="text-left mt-2">Приложить чек:</h5>
			<div class="custom-file mb-2">
  				<input type="file" multiple="multiple" name="file_check[]" class="custom-file-input" id="customFile">
  				<label class="custom-file-label" for="customFile">Выбрать фото</label>
			</div>
			<p>Загружено файлов: <?php echo $howFileUpload; ?></p>
		<form>
	</div>
</form>
</div>
<div class="col-lg-12 d-flex ml-1">
	<div class="ml-auto">
		<button form="form-trip-' . $i . '" type="submit" id="submit-trip" class="btn btn-primary mr-1">Изменить</button>
		<a href="/journal/index" class="btn btn-primary mr-auto">НАЗАД</a>
	</div>
</div>
<div id="warning"></div>
<script type="text/javascript" src="<?php echo $extra_dir . "js/change_trip.js"; ?>"></script>
<?php
include $extra_dir . 'module/footer.php';
?>