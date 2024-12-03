<?php require_once("../layout/header.php") ?>
<?php require_once("../layout/sidebar.php") ?>

<?php
$tableName = $tableNameErr = "";
$seat = $seatErr = "";
$invalid = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $updTable = get_table_with_id($mysqli, $id);
    $tableName = $updTable['tableName'];
    $seat = $updTable['seat'];
}

if (isset($_POST['tableName'])) {

    $tableName = $_POST['tableName'];
    $seat = $_POST['seat'];

    if (trim($tableName) === "") {
        $tableNameErr = "Table number can't be blank!";
        $invalid = "err";
    }

    if (trim($seat) === "") {
        $seatErr = "Seat quantity can't be blank!";
        $invalid = "err";
    } elseif (!is_numeric($seat)) {
        $seatErr = "Seat quantity must be a number!";
        $invalid = "err";
    } elseif ($seat <= 0) {
        $seatErr = "Seat quantity must be greater than 0!";
        $invalid = "err";
    }

    if (!$invalid) {
        // for updating item 
        if (isset($_GET['id'])) {

            $status = update_table($mysqli, $id, $tableName, $seat, $taken);
            if ($status === true) {
                echo "<script>location.replace('./table_list.php?last')</script>";
            } else {
                $invalid = $status;
            }
        } else {
            $status =  save_table($mysqli, $tableName, $seat, $taken);
            if ($status === true) {
                // header("Location:./table_list.php");
                echo "<script>location.replace('./table_list.php?last')</script>";
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
            <h3>Add New Table</h3>
            <div class="card my-4">
                <div class="row">
                    <div class="col-3 d-none d-md-block"></div>
                    <div class="card-body col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <?php if ($invalid !== "" && $invalid !== "err") { ?>
                                    <div class="alert alert-danger"><?= $invalid ?></div>
                                <?php } ?>
                                <form method="post">
                                    <div class="form-group my-3">
                                        <label class="form-label">Table Number</label>
                                        <input type="text" name="tableName" class="form-control" value="<?= $tableName ?>">
                                        <div class="validation-message"> <?= $tableNameErr ?></div>
                                    </div>
                                    <div class="form-group my-3">
                                        <label class="form-label">Seat Qty</label>
                                        <input type="number" name="seat" class="form-control" value="<?= htmlspecialchars($seat, ENT_QUOTES, 'UTF-8') ?>">
                                        <div class="validation-message"> <?= $seatErr ?></div>
                                    </div>
                                    <div class="form-group my-3">
                                        <input type="submit" value="Submit" class="btn btn-primary">
                                    </div>
                                    <div class="card-body">
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