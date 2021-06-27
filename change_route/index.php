<?php
$PAGE_NAME = "Изменение маршрута";
$directory_lvl = 1;

include '../module/directory.php';

include $extra_dir . 'module/class.php';

$accountId = sql::getUser($db->connection, $_COOKIE['login'], $_COOKIE['password'])['id'];
$account = sql::getUser($db->connection, $_COOKIE['login'], $_COOKIE['password']);

include $extra_dir . 'module/header.php';
$idChange = $_POST['idChange'];

$changeFetch = mysqli_fetch_assoc(mysqli_query($db->connection, "SELECT * FROM routes WHERE id = '$idChange' AND haveId = '$accountId'"));
?>
<nav class="navbar navbar-light bg-primary">
    <a class="navbar-brand text-light" href="/main">
        <?php echo '<h3>' . $PAGE_NAME . '</h3>'; ?>
    </a>
</nav>
<form action="<?php echo $extra_dir . "php/form_change_route.php"; ?>" method="post" id="newRoute" class="container-fluid mt-2">
<div class="form-group">
    <input name="from_place" class="form-control" placeholder="От" value="<?php echo $changeFetch['from_place']; ?>">
    <input name="to_place" class="form-control mt-1" placeholder="До" value="<?php echo $changeFetch['to_place']; ?>">
    <input name="total_km" class="form-control mt-1" placeholder="Всего км" type="number" value="<?php echo $changeFetch['total_km']; ?>">
    <input name="change_id" type="hidden" value="<?php echo $idChange; ?>">
</div>
    <button form="newRoute" class="btn btn-primary">Изменить</button>
</form>
