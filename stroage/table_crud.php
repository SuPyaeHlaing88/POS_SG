<?php

// `tableName` VARCHAR(45) NOT NULL,`seat` INT  NOT NULL,`taken` BOOLEAN NOT NULL

function save_table($mysqli, $tableName, $seat, $taken)
{
    $sql = "INSERT INTO `table` (`tableName`,`seat`,`taken`) VALUE ('$tableName','$seat','$taken')";
    return $mysqli->query($sql);
}

function get_table_with_id($mysqli, $id)
{
    $sql = "SELECT * FROM `table` WHERE `id`=$id ";
    $table = $mysqli->query($sql);
    return $table->fetch_assoc();
}

function get_tables($mysqli)
{
    $sql = "SELECT * FROM `table`";
    return $mysqli->query($sql);
}

function delete_table($mysqli, $id)
{
    $sql = "DELETE FROM `table` WHERE `id`= $id ";
    return $mysqli->query($sql);
}

function update_table($mysqli, $id, $tableName, $seat, $taken)
{
    $sql = "UPDATE `table` SET `tableName`='$tableName',`seat`='$seat',`taken`='$taken' WHERE `id`= $id ";
    return $mysqli->query($sql);
}

// for pagination
function get_table($mysqli, $currentPage)
{
    $sql = "SELECT * FROM `table` ORDER BY `id` LIMIT 5 OFFSET $currentPage";
    return $mysqli->query($sql);
}
function get_table_pag_count($mysqli)
{
    $sql = "SELECT COUNT(`id`) AS total FROM `table`";
    $count = $mysqli->query($sql);
    $total = $count->fetch_assoc();
    $page = ceil($total['total'] / 5) ;
    return $page;
}

// for searching
function get_table_filter($mysqli, $key)
{
    $sql = "SELECT * FROM `table` WHERE `seat`='$key'";
    return $mysqli->query($sql);
}
