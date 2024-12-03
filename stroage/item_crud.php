<?php

// `name` VARCHAR(45) NOT NULL,`price` INT NOT NULL,`category_id` INT NOT NULL

// for new item 
function save_item($mysqli, $name, $price, $category_id, $img)
{
    $sql = "INSERT INTO `item` (`name`,`price`,`category_id`, `img`) VALUES ('$name',$price,$category_id,'$img')";
    return $mysqli->query($sql);
}

// to get one item
function get_item_with_id($mysqli, $id)
{
    $sql = "SELECT * FROM `item` WHERE `id`=$id";
    $table = $mysqli->query($sql);
    return $table->fetch_assoc();
}

// to get all items 
function get_items($mysqli)
{
    $sql = "SELECT * FROM `item`";
    return $mysqli->query($sql);
}


function get_items_by_category_id($mysqli, $category_id)
{
    $sql = "SELECT * FROM `item` WHERE `category_id`=$category_id";
    return $mysqli->query($sql);
}
function join_with_category($mysqli, $currentPage){
    $sql =  "SELECT item.*, category.categoryName as category_NAME FROM `item` join category on item.category_id = category.id ORDER BY `id` LIMIT 5 OFFSET $currentPage";
    return $mysqli->query($sql);
   }
function update_item($mysqli, $id, $name, $price, $category_id, $img)
{
    $sql = " UPDATE `item` SET `name`= '$name' ,`price`=$price,`category_id`=$category_id, `img`= '$img' WHERE `id`= $id ";
    return $mysqli->query($sql);
}

function delete_item($mysqli, $id)
{
    $sql = "DELETE FROM `item` WHERE `id`= $id";
    return $mysqli->query($sql);
}


// for pagination

// function get_item($mysqli, $currentPage)
// {
//     $sql = "SELECT * FROM `item` ORDER BY `id` LIMIT 5 OFFSET $currentPage";
//     return $mysqli->query($sql);
// }
function get_item_pag_count($mysqli)
{
    $sql = "SELECT COUNT(`id`) AS total FROM `item`";
    $count = $mysqli->query($sql);
    $total = $count->fetch_assoc();
    $page = ceil($total['total'] / 5) ;
    return $page;
}

// for searching
function get_item_filter($mysqli, $key)
{
    $sql = "SELECT * FROM `item` WHERE `name`='$key'";
    return $mysqli->query($sql);
}

