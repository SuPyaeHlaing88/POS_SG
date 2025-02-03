<?php require_once("../layout/header.php") ?>
<?php require_once("../layout/sidebar.php") ?>
<?php
$name = $nameErr = "";
$price = $priceErr = "";
$category_id = $category_idErr = "";
$img = $imgErr = "";
$imgName = "";
$tmp = "";
$invalid = "";

// for update item 
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $item =  get_item_with_id($mysqli, $id);
    $name = $item['name'];
    $price = $item['price'];
    $category_id = $item['category_id'];
}

// for new item 
if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category_id = $_POST['category_id'];
    $img = $_FILES['img'];
    $imgName = $img['name'] . date('YMDHIS');

    if (trim($name) === "") {
        $nameErr = "Item name can't be blank!";
        $invalid = "err";
    }
    if (trim($price) === "") {
        $priceErr = "Price can't be blank!";
        $invalid = "err";
    }
    //  else {
    //     if (!preg_match("\$d,$/ ", $userEmail)) {
    //         $userEmailErr = "Please enter number format!";
    //         $invalid = "err";
    //     }
    // }
    if (trim($category_id) === "") {
        $category_idErr = "Please select user role!";
        $invalid = "err";
    }
    if ($img === "") {
        $imgErr = "Image can't be blank!";
        $invalid = "err";
    }

    if (!$invalid) {
        $tmp = $img['tmp_name'];
        $imgfile = file_get_contents($tmp);
        $data = base64_encode($imgfile);

        // for updating item 
        if (isset($_GET['id'])) {
            
            $status = update_item($mysqli, $id, $name, $price, $category_id, $data);
            if ($status === true) {
                // for image's name can be save in workspace folder 
                move_uploaded_file($img['tmp_name'], '../assets/images/' . $imgName);
                echo "<script>location.replace('./item_list.php?last')</script>";
            } else {
                $invalid = $status;
            }
        } else {
        $status = save_item($mysqli, $name, $price, $category_id, $data);
        if ($status === true) {
            // for image's name can be save in workspace folder 
            move_uploaded_file($img['tmp_name'], '../assets/images/' . $imgName);
            echo "<script>location.replace('./item_list.php?last')</script>";
        } else {
            $invalid = $status;
        }
    }
}
}
?>
<div class="content">
    <?php require_once("../layout/nav.php") ?>
    <div class="card m-5">
        <div class="card-body">
            <h3>Add New Food Item</h3>
            <div class="card my-4">
                <div class="row">
                    <div class="col-3 d-none d-md-block"></div>
                    <div class="card-body col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <?php if ($invalid !== "" && $invalid !== "err") { ?>
                                    <div class="alert alert-danger"><?= $invalid ?></div>
                                <?php } ?>
                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group my-3">
                                        <label class="form-label">Item Name</label>
                                        <input type="text" name="name" class="form-control" value="<?= $name ?>">
                                        <div class="validation-message"><?= $nameErr ?></div>
                                    </div>
                                    <div class="form-group my-3">
                                        <label class="form-label">Price</label>
                                        <input type="number" name="price" class="form-control" value="<?= $price ?>">
                                        <div class="validation-message"><?= $priceErr ?></div>
                                    </div>
                                    <!-- !!!!! need to relationship for two tables -->
                                    <div class="form-group my-3">
                                        <label class="form-label">Category Type</label>
                                        <select name="category_id" class="form-select">
                                            <option value="" selected>Select Category Type</option>
                                            <?php $categories = get_categories($mysqli);
                                            while ($category = $categories->fetch_assoc()) { ?>
                                                <option value="<?= $category['id']; ?>">
                                                    <?= $category['categoryName']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                        <div class="validation-message"><?= $category_idErr ?></div>
                                    </div>
                                    <div class="form-group my-3">
                                        <label class="form-label">Image</label>
                                        <input type="file" name="img" class="form-control" value="<?= $img ?>">
                                        <div class="validation-message"><?= $imgErr ?></div>
                                    </div>
                                    <div class="form-group my-3">
                                        <input type="submit" value="Submit" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-3 d-none d-md-block"></div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php require_once("../layout/footer.php") ?>