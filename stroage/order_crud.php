<?php


function save_order($mysqli, $item_id, $invoice_id, $qty)
{
    $sql = "INSERT INTO `order` (`item_id`,`invoice_id`,`qty`,`status`) VALUE ($item_id,$invoice_id,$qty,0)";
    return $mysqli->query($sql);
}

function get_order_for_waiter($mysqli, $table_id)
{
    $sql = "SELECT i.name,i.price,o.qty,o.status FROM `order` o INNER JOIN `item` i on i.id=o.item_id INNER JOIN `invoice` iv on iv.id=o.invoice_id WHERE iv.table_id=$table_id AND iv.paid=0";
    return $mysqli->query($sql);
}

function get_order_with_invoice($mysqli, $invoice_id)
{
    $sql = "SELECT `order`.id,`order`.invoice_id,`item`.name,`order`.qty,`order`.status FROM `order` INNER JOIN `item` ON `order`.item_id=`item`.id WHERE `invoice_id`=$invoice_id AND `status`!=9 AND `status`!=2 ";
    return $mysqli->query($sql);
}

function ots($mysqli, $order_id)
{
    $sql = "UPDATE `order` SET `status`=9 WHERE `id`=$order_id";
    return $mysqli->query($sql);
}

function accept_order($mysqli, $order_id)
{
    $sql = "UPDATE `order` SET `status`=1 WHERE `id`=$order_id";
    return $mysqli->query($sql);
}
function done_order($mysqli, $order_id)
{
    $sql = "UPDATE `order` SET `status`=2 WHERE `id`=$order_id";
    return $mysqli->query($sql);
}
