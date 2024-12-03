<?php
// `categoryName` VARCHAR(45) NOT NULL,`categoryImg` LONGTEXT NOT NULL

function save_category($mysqli, $categoryName, $categoryImg)
{
    $sql = "INSERT INTO `category` (`categoryName`,`categoryImg`) VALUE ('$categoryName','$categoryImg')";
    return $mysqli->query($sql);
}

function get_category_with_id($mysqli, $id)
{
    $sql = "SELECT * FROM `category` WHERE `id`=$id";
    $table = $mysqli->query($sql);
    return $table->fetch_assoc();
}

function get_categories($mysqli)
{
    $sql = "SELECT * FROM `category`";
    return $mysqli->query($sql);
}

function update_category($mysqli, $id, $categoryName, $categoryImg)
{
    $sql = "UPDATE `category` SET `categoryName`='$categoryName', `categoryImg`='$categoryImg' WHERE `id`= $id ";
    return $mysqli->query($sql);
}

function delete_category($mysqli, $id)
{
    $sql = "DELETE FROM `category` WHERE `id`= $id";
    return $mysqli->query($sql);
}


// for pagination
function get_category($mysqli, $currentPage)
{
    $sql = "SELECT * FROM `category` ORDER BY `id` LIMIT 5 OFFSET $currentPage";
    return $mysqli->query($sql);
}
function get_category_pag_count($mysqli)
{
    $sql = "SELECT COUNT(`id`) AS total FROM `category`";
    $count = $mysqli->query($sql);
    $total = $count->fetch_assoc();
    $page = ceil($total['total'] / 5) ;
    return $page;
}

// for searching
function get_category_filter($mysqli, $key)
{
    $sql = "SELECT * FROM `category` WHERE `categoryName`='$key'";
    return $mysqli->query($sql);
}

