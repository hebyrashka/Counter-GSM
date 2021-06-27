<?php

$PAGE_NAME = "Настройки";
$directory_lvl = 1;

include '../module/directory.php';

include $extra_dir . 'module/class.php';

if ( !sql::getUser($db->connection, $_COOKIE['login'], $_COOKIE['password']) ) {
	header('Location: /join');
}

$accountId = sql::getUser($db->connection, $_COOKIE['login'], $_COOKIE['password'])['id'];
$account = sql::getUser($db->connection, $_COOKIE['login'], $_COOKIE['password']);

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
    <form action='/php/form_settings' method='post' id='form-change-settings'>
        <div class="flex-settings">
            <div class="label-column">
                <label for='fio'>ФИО:</label>
                <input value='<?php echo $account['fio']; ?>' id='fio' name='fio'>
            </div>
            <div class="label-column">
                <label for='position'>Должность:</label>
                <input value='<?php echo $account['position']; ?>' id='position' name='position'>
            </div>
            <div class="label-column">
                <label for='adress'>Адрес:</label>
                <input value='<?php echo $account['adress']; ?>' id='adress' name='adress'>
            </div>
            <div class="label-column">
                <label for='phone'>Телефон:</label>
                <input type='number' value='<?php echo $account['phone']; ?>' id='phone' name='phone'>
            </div>
        </div>
        <div class="flex-settings">
            <div class="label-column">
                <label for='numberLicense'>Номер вод. удостоверения:</label>
                <input type='number' value='<?php echo $account['number_license']; ?>' id='numberLicense' name='number_license'>
            </div>
            <div class="label-column">
                <label for='numberCard'>Номер топливной карты:</label>
                <input value='<?php echo $account['number_card']; ?>' id='numberCard' name='number_card'>
            </div>
            <div class="label-column">
                <label for='limitCard'>Лимит по карте:</label>
                <input value='<?php echo $account['limit_card']; ?>' id='limitCard' name='limit_card'>
            </div>
            <div class="label-column">
                <label for='limitCard'>Тариф за километр:</label>
                <input value='<?php echo $account['rate_km']; ?>' id='limitCard' name='rate_km'>
            </div>
            <h5>Норма расхода:</h5>
            <div class="norma-option-flex">
                <div>
                    <input <?php if ($account['norma'] == 'summer') { echo 'checked'; } ?> value='summer' type='radio' id='summer' name='norma'>
                    <label for='summer'>Летняя</label>
                </div>
                <div>
                    <input <?php if ($account['norma'] == 'winter') { echo 'checked'; } ?> value='winter' type='radio' id='winter' name='norma'>
                    <label for='winter'>Зимняя</label>
                </div>
            </div>
        </div>
        <div class="flex-settings">
            <div class="label-column">
                <label for='fio'>Марка автомобиля:</label>
                <input value='<?php echo $account['marka_car']; ?>' id='fio' name='marka_car'>
            </div>
            <div class="label-column">
                <label for='position'>Гос. номер:</label>
                <input value='<?php echo $account['gov_number']; ?>' id='position' name='gov_number'>
            </div>
            <div class="label-column">
                <label for='adress'>Вид топлива:</label>
                <input value='<?php echo $account['type_oil']; ?>' id='adress' name='type_oil'>
            </div>
            <div class="label-column">
                <label for='phone'>Расход топлива по минтрансу:</label>
                <input value='<?php echo $account['rasxod_km']; ?>' id='phone' name='rasxod_km'>
            </div>
        </div>
    </form>
    <div>
        <button form="form-change-settings" type='submit'>Применить</button>
    </div>
    <div>
        <table class="table-route">
            <thead>
            <tr>
                <th scope="col">От, место</th>
                <th scope="col">До, место</th>
                <th scope="col">Километраж, Км.</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            <form action="../change_route/index.php" method="post" id="form-change-route">
                <?php
                $journalQuery = mysqli_query( $db->connection, "SELECT * FROM `routes` WHERE haveId = '$accountId'" );
                $journalQueryCheck = mysqli_query( $db->connection, "SELECT * FROM `routes` WHERE haveId = '$accountId'" );
                $journalFetchCheck = mysqli_fetch_assoc( $journalQueryCheck );
                if ( !$journalFetchCheck ) {
                    echo "<tr>
                        <td scope='row' colspan='7' class='not-route'>Нет поездок</td>
                    </tr>";
                }
                while ( $journalFetch = mysqli_fetch_assoc($journalQuery) ) {
                    echo "<tr>
            				<td>" . $journalFetch['from_place'] . "</td>
            				<td>" . $journalFetch['to_place'] . "</td>
            				<td>" . $journalFetch['total_km'] . "</td>
            				<td><p class='mx-auto'><input type='radio' name='idChange' class='form-check-input mx-auto idChange' value='" . $journalFetch['id'] . "'></p></td>
        				</tr>";
                }
                ?>
            </form>
            </tbody>
        </table>
    </div>
    <div class="form-group">
        <button type="button" id="btn-modal-open-route">Добавить</button>
        <button type="submit" form="form-change-route">Редактировать</button>
        <button type="button" class="btn-delete-route">Удалить</button>
    </div>
</div>
<div class="modal-wrapper">
    <div class="modal-content">
        <div class="modal-header">
            <h4>Новый маршрут</h4>
            <h4>X</h4>
        </div>
        <form action="<?php echo $extra_dir . "php/form_add_route.php"; ?>" method="post" id="newRoute">
            <div>
                <input placeholder="От" name="from_place">
                <input placeholder="До" name="to_place">
                <input type="number" placeholder="Всего км" name="total_km">
            </div>
            <button class="btn-add-route">Добавить</button>
        </form>
    </div>
</div>
    <script type="text/javascript" src="<?php echo $extra_dir . "js/settings.js"; ?>"></script>
    <script type="text/javascript" src="<?php echo $extra_dir . "js/hamburger.js"; ?>"></script>
<?php 
include $extra_dir . 'module/footer.php';
?>