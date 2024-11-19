<?php require_once("./auth/isLogin.php"); ?>
<?php
if ($user['role'] == 1) {
    header("location:./admin/index.html");
} elseif ($user['role'] == 2) {
    header("location:./cashier/index.html");
} elseif ($user['role'] ==  3) {
    header("location:./kitchen/index.html");
} else {
    header("location:./waiter/index.html");
}
