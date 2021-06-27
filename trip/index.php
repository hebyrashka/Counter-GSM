<?php
$PAGE_NAME = "Новая поездка";
$directory_lvl = 1;

include '../module/directory.php';

include $extra_dir . 'module/class.php';

$account = sql::getUser($db->connection, $_COOKIE['login'], $_COOKIE['password']);
$accountId = $account['id'];

$totalSelectQuery = mysqli_query($db->connection, "SELECT * FROM routes WHERE haveId = '$accountId'");
$totalSelectQueryTo = mysqli_query($db->connection, "SELECT * FROM routes WHERE haveId = '$accountId'");

$lastStartPos = mysqli_fetch_assoc(mysqli_query($db->connection, "SELECT to_km FROM trip WHERE haveId = '$accountId' ORDER BY whenAdd DESC LIMIT 1"));

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
<div class="new-trip wrapper">
  <form enctype="multipart/form-data" method="post" action="../php/form_add_trip" id="form-trip">
      <div id="new-trip__form-trip">
      	<h3>Поездка:</h3>
        <div class="new-trip__inputs">
					<label for="date_trip">Дата:</label>
					<input type="date" id="date_trip" name="date_trip">
				</div>
				<div class="new-trip__inputs">
					<label for="start_pos">Нач. показания:</label>
					<input value="<?php echo $lastStartPos['to_km']; ?>" id="start_pos" name="start_pos">
				</div>
				<div class="new-trip__input-with-checkbox">
					<div class="new-trip__inputs">
						<label for="end_pos">Кон. показания:</label>
						<input id="end_pos" name="end_pos">
					</div>
					<div id="new-trip__checkbox-auto">
				    	<input type="checkbox" name="auto" id="auto">
				    	<label for="auto">Auto</label>
					</div>
				</div>
        <div class="select-route">
  				<div id="routes">
  					<div class='selectRoutes'>
  						<select name='routeTo[]' class='select-route routes-select'>
  							<?php
  							while ( $totalSelectFetch = mysqli_fetch_assoc($totalSelectQuery) ) {
  							    if ( $totalSelectFetch ) {
                      echo "<option value='" . $totalSelectFetch['id'] . "'>" . $totalSelectFetch['from_place'] . " - " . $totalSelectFetch['to_place'] . "</option>";
                    }
  							}
  							?>
  						</select>
  						<button type='button' class='deleteButton'>+</button>
  					</div>
  				</div>
  			</div>
        <div class="new-trip__inputs">
  				<label for="number_query">Номера заявок:</label>
  				<input id="number_query" name="number_query">
  			</div>
      </div>
      <div id="new-trip__form-check">
        	<h3>Чек:</h3>
    			<div>
    				<div class="new-trip__inputs">
    					<label for="date_check">Дата:</label>
    					<input type="date" id="date_check" name="date_check">
    				</div>
    				<div class="new-trip__inputs">
    					<label for="how_litr">Кол-во литров:</label>
    					<input id="how_litr" name="how_litr">
    				</div>
    				<div class="new-trip__inputs">
    					<label for="summa">Сумма:</label>
    					<input type="number" id="summa" step="0.01" name="summa">
    				</div>
    			</div>
    			<h5 class="title-custom-file">Приложить чек:</h5>
    			<div class="new-trip__file">
      				<input type="file" multiple="multiple" name="file_check[]" class="custom-file-input" id="customFile">
      				<label class="custom-file-label" for="customFile">Выбрать фото</label>
    			</div>
    		</div>
    </form>
    <div class="new-trip__info">
      	<div class="new-trip__km">
      		<h5>Общее кол-во км.</h5>
      		<p class="km">?</p>
      	</div>
      	<div class="new-trip__litr">
      		<h5>Литры ГСМ</h5>
      		<p class="litr">?</p>
      	</div>
      	<div class="new-trip__ost-litr">
      		<h5>Остаток по карте</h5>
      		<p class="ost-litr">?</p>
      	</div>
      </div>
       <div class="new-trip__buttons">
  			<button form="form-trip" id="submit-trip" type="button">ДОБАВИТЬ</button>
  			<a href="/main">НАЗАД</a>
  		</div>
  	</div>
<div class="wrapper trip">
	<form enctype="multipart/form-data" method="post" action="../php/form_add_trip" id="form-trip">

	</form>
		<div>
		</div>
</div>
<div id="warning"></div>
<script type="text/javascript" src="<?php echo $extra_dir . "js/hamburger.js"; ?>"></script>
<script type="text/javascript" src="<?php echo $extra_dir . "js/trip.js"; ?>"></script>
<?php
include $extra_dir . 'module/footer.php';
?>
