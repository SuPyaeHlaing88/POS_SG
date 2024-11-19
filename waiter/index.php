<?php require_once ("../auth/isLogin.php") ?>
<?php
if (isset($_POST["logout"])) {
    setcookie("user", "", -1, "/");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Waiter page</h1>
    <form method="post">
        <button name="logout">Logout</button>
    </form>
</body>
</html>