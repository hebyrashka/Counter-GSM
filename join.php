<?php
$PAGE_NAME = "Вход";
$directory_lvl = 0;

include 'module/directory.php';

include $extra_dir . 'module/class.php';

if ( sql::getUser($db->connection, $_COOKIE['login'], $_COOKIE['password']) ) {
	header('Location: /main');
}

include $extra_dir . 'module/header.php';
?>
<div class="join-wrapper">
    <form method="post" action="php/form_join" id="form-join">
        <input name="join-login" placeholder="Логин" id="input-join-login" type="text">
        <input name="join-password" placeholder="Пароль" id="input-join-password" type="password">
        <button type="submit" id="btn-join-submit">Войти</button>
    </form>
</div>
<div class="footer-link">
    <a class="a-join" href="/join">Вход</a>
    <a class="a-registration" href="/registration">Регистрация</a>
</div>
<script src="<?php echo $extra_dir; ?>js/join.js"></script>
<?php
include $extra_dir . 'module/footer.php';
?>
