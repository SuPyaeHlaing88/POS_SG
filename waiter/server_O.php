<?php
session_start();

// $category_id = 0;
// if (isset ($_GET['id'])){
//     $category_id = $_GET['id'];
// }

 $item_array = [];


 if(isset ($_SESSION ["item_list"])){
    $item_array =$_SESSION["item_list"];
 }

$table_id = 0;
if (isset($_SESSION["table"])) {
    $table_id = $_SESSION["table"];
}

$select_table = "";
if (isset($_GET['tableID'])) {
    $table_id = $_GET['tableID'];
    $_SESSION["table"] = $table_id;
}

$category_id = 0;
if (isset($_GET['catID'])) {
    $category_id = $_GET['catID'];
}


// if (isset($_GET['id'])){
//     $item =get_item_with_id($mysqli, $_GET['id']) ;
//     array_push($item_array, $item);
//     $_SESSION["item_list"] = $item_array;
// }

if (isset($_GET['itemID'])) {
    if ($table_id == 0) {
        $select_table = "Please choose table first!";
    } else {
        // FOR PLUS NEW ITEMS
        $item = get_item_with_id($mysqli, $_GET['itemID']);
        $isHave = true;
        for ($i = 0; $i < count($item_array);$i++) {
            if ($item_array[$i]['id'] == $item['id']) {
                $isHave = false;
                $item_array[$i]['count']++;
            }
        }
        if ($isHave) {
            array_push($item_array, ['id' => $item['id'],'name' => $item['name'],'price' => $item['price'],'count' => 1]);
        }
        $_SESSION["item_list"] = $item_array;
        header("Location:?catID=$category_id");
    }
}

if (isset($_GET['remove'])) {
    array_splice($item_array, $_GET['remove'], 1);
    $_SESSION['item_list'] = $item_array;
    header("Location:?catID=$category_id");
}

if (isset($_GET['add'])) {
    $add = $_GET['add'];
    for ($i = 0;$i < count($item_array);$i++) {
        if ($add == $i) {
            $item_array[$i]['count']++;
        }
    }
    $_SESSION['item_list'] = $item_array;
    header("Location:?catID=$category_id");
}

if (isset($_GET['minus'])) {
    $minus = $_GET['minus'];
    $count = 0;
    for ($i = 0;$i < count($item_array);$i++) {
        if ($minus == $i) {
            $count = --$item_array[$i]['count'];
        }
    }
    if ($count < 1) {
        array_splice($item_array, $minus, 1);
    }
    $_SESSION['item_list'] = $item_array;
    header("Location:?catID=$category_id");
}
