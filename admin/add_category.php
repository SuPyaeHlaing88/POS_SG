<?php require_once("../layout/header.php") ?>
<?php require_once("../layout/sidebar.php") ?>
<?php
$categoryName = $categoryNameErr = "";
$categoryImg = $categoryImgErr = "";
$categoryImgName = "";
$tmp = "";
$invalid = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $updCate = get_category_with_id($mysqli, $id);
    $categoryName = $updCate['categoryName'];
}

if (isset($_POST['categoryName'])) {
    $categoryName = $_POST['categoryName'];
    $categoryImg =  $_FILES['categoryImg'];

    if (trim($categoryName) === "") {
        $categoryNameErr = "Category name can't be blank!";
        $invalid = "err";
    }
    if ($categoryImg === "") {
        $categoryImgErr = "Image can't be blank!";
        $invalid = "err";
    }

    if (!$invalid) {
        $categoryImgName = $categoryImg['name'] . date('YMDHIS');
        $tmp = $categoryImg['tmp_name'];
        $img = file_get_contents($tmp);
        $data = base64_encode($img);


        // for updating category 
        if (isset($_GET['id'])) {

            $status = update_category($mysqli, $id, $categoryName, $data);
            if ($status === true) {
              // for image's name can be save in workspace folder >
              move_uploaded_file($categoryImg['tmp_name'], '../assets/images/' . $categoryImgName);
              echo "<script>location.replace('./category_list.php?last')</script>";
            } else {
                $invalid = $status;
            }
        } else {
            $status = save_category($mysqli, $categoryName, $data);
            if ($status === true) {
                // for image's name can be save in workspace folder >
                move_uploaded_file($categoryImg['tmp_name'], '../assets/images/' . $categoryImgName);
                echo "<script>location.replace('./category_list.php?last')</script>";
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
            <h3>Add New Category</h3>
            <div class="card my-4">
                <div class="row">
                    <div class="col-3 d-none d-md-block"></div>

                    <div class="card-body col-md-6">
                        <div class="card">
                            <div class="card-body">

                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group my-3">
                                        <label class="form-label">Category Name</label>
                                        <input type="text" name="categoryName" class="form-control" value="<?= $categoryName ?>">
                                        <div class="validation-message"><?= $categoryNameErr ?></div>
                                    </div>
                                    <div class="form-group my-3">
                                        <label class="form-label">Category Image</label>
                                        <input type="file" name="categoryImg" accept="assets/image/*" class="form-control" value="<?= $categoryImg ?>">
                                        <div class="validation-message"><?= $categoryImgErr ?></div>
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