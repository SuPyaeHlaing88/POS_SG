<?php

try {
    $mysqli = new mysqli("127.0.0.10", "root", "");
    $sql = "CREATE DATABASE IF NOT EXISTS `pos`";
    if ($mysqli->query($sql)) {
        if ($mysqli->select_db("pos")) {
            create_table($mysqli);
        }
    }
} catch (\Throwable $th) {
    echo "Can not connect to Database!";
    die();
}

function create_table($mysqli)
{
    $sql = "CREATE TABLE IF NOT EXISTS `user`(`id` INT AUTO_INCREMENT,`username` VARCHAR(45) NOT NULL,`email` VARCHAR(95) UNIQUE NOT NULL,`password` VARCHAR(45) NOT NULL,`role` INT NOT NULL,PRIMARY KEY(`id`))";
    if (!$mysqli->query($sql)) {
        return false;
    }
    return true;
}
