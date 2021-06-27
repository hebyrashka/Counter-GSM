<?php

$PAGE_NAME = "Регистрация";
$directory_lvl = 0;

include 'module/directory.php';

include $extra_dir . 'module/class.php';

if ( sql::getUser($db->connection, $_COOKIE['login'], $_COOKIE['password']) ) {
	header('Location: /main');
}

include $extra_dir . 'module/header.php';
?>
    <div class="registration-wrapper">
        <form method="post" action="php/form_registration.php" id="form-registration">
            <input name="registration-login" placeholder="Логин" id="input-registration-login" type="text">
            <input name="registration-password" placeholder="Пароль" id="input-registration-password" type="password">
            <input name="registration-check-password" placeholder="Подтвердите пароль" id="input-registration-check-password" type="password">
            <button type="submit" id="btn-registration-submit">Зарегистрироваться</button>
        </form>
    </div>
    <div class="footer-link">
        <a class="a-join" href="/join">Вход</a>
        <a class="a-registration" href="/registration">Регистрация</a>
    </div>
<script src="<?php echo $extra_dir; ?>js/registration.js"></script>
<?php 
include 'module/footer.php';
?>