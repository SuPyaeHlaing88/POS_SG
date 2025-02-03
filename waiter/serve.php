<?php

session_start();

$item_array = [];
$table_id = 0;

if (isset($_SESSION["table"])) {
    $table_id = $_SESSION["table"];
}

if (isset($_SESSION["item_list"])) {
    $item_array = $_SESSION["item_list"];
}

$category_id = 0;

$select_table = "";

if (isset($_GET['tableId'])) {
    $table_id = $_GET['tableId'];
    $_SESSION["table"] = $table_id;
}


if (isset($_GET['catId'])) {
    $category_id = $_GET['catId'];
}

if (isset($_GET['itemId'])) {
    if ($table_id == 0) {
        $select_table = "Please choose table first!";
    } else {
        $item = get_item_with_id($mysqli, $_GET['itemId']);
        $isHave = true;
        for ($i = 0; $i < count($item_array); $i++) {
            if ($item_array[$i]['id'] == $item['id'] && $table_id  == $item_array[$i]['table_id']) {
                $isHave = false;
                $item_array[$i]['count']++;
            }
        }
        if ($isHave) {
            array_push($item_array, ['id' => $item['id'], 'name' => $item['name'], 'price' => $item['price'], 'count' => 1, 'table_id' => $table_id]);
        }
        $_SESSION["item_list"] = $item_array;
        header("Location:?catId=$category_id");
    }
}

if (isset($_GET['remove'])) {
    array_splice($item_array, $_GET['remove'], 1);
    $_SESSION['item_list'] = $item_array;
    header("Location:?catId=$category_id");
}

if (isset($_GET['add'])) {
    $add = $_GET['add'];
    for ($i = 0; $i < count($item_array); $i++) {
        if ($add == $i) {
            $item_array[$i]['count']++;
        }
    }
    $_SESSION['item_list'] = $item_array;
    header("Location:?catId=$category_id");
}

if (isset($_GET['minus'])) {
    $minus = $_GET['minus'];
    $count = 0;
    for ($i = 0; $i < count($item_array); $i++) {
        if ($minus == $i) {
            $count = --$item_array[$i]['count'];
        }
    }
    if ($count < 1) {
        array_splice($item_array, $minus, 1);
    }
    $_SESSION['item_list'] = $item_array;
    header("Location:?catId=$category_id");
}

if (isset($_GET['order'])) {
    $invoice_id = save_invoice($mysqli, $table_id);
    $remain_array = [];
    foreach ($item_array as $index => $item) {
        if ($item['table_id'] != $table_id) {
            array_push($remain_array, $item);
        } else {
            save_order($mysqli, $item['id'], $invoice_id, $item['count']);
        }
    }
    $_SESSION['item_list'] = $remain_array;
    taken_table($mysqli, $table_id);
    header("Location:?");
}
