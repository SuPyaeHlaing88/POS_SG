<?php require_once("../layout/header.php") ?>
<?php require_once("server_O.php") ?>
<?php
$order_result = get_order_for_waiter($mysqli, $table_id);
?>


<div class="content">
    <div class="inner-container">

        <div class="invoice-container">
            <div class="waiter-profile">
                <img src="../assets/profile/<?= $user['profile'] ?>">
                <div class="waiter-profile-name">

                    <h3><?= $user['username'] ?></h3>
                    <span><?= $user['email'] ?></span>
                    <form method="post">
                        <div class="dropdown">
                            <div style="outline: none; border: none;" class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-vertical"></i>
                            </div>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item">Profile</a></li>
                                <li><button name="logout" class="dropdown-item">Logout</button></li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
            <div class="order-invoice table-responsive">
                <?php if ($select_table) { ?>
                    <div class="alert alert-danger"><?= $select_table ?></div>
                <?php } ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Action</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- for ordered items  -->
                        <?php $Total = 0; ?>
                        <?php $show = false; ?>

                        <?php while ($ordered = $order_result->fetch_assoc()) { ?>
                            <?php $eachTotal = $ordered['price'] * $ordered['qty'] ?>
                            <?php $Total += $eachTotal ?>
                            <tr>
                                <td><?= $ordered['name'] ?></td>
                                <td><?= $ordered['price'] ?></td>
                                <td><?= $ordered['qty'] ?></td>
                                <td><?php if ($ordered['status'] == 0) { ?>
                                        <span class="text-primary">Ordered</span>
                                    <?php } ?>
                                </td>
                                <td><?= $eachTotal ?></td>
                            </tr>
                        <?php } ?>

                        <!-- for selected items  -->
                        <?php $eachTotal =  0;
                        foreach ($item_array as $index => $item) { ?>
                            <?php if ($table_id == $item['table_id']) { ?>
                                <?php $show = true; ?>
                                <tr>
                                    <td><?= $item['name'] ?></td>
                                    <td><?= $item['price'] ?></td>
                                    <td><?= $item['count'] ?></td>
                                    <td class="invoice-action">
                                        <a href="?minus=<?= $index ?>&catID=<?= $category_id ?>" class="btn btn-secondary btn-sm">
                                            <i class="fa fa-minus"></i>
                                        </a>
                                        <a href="?add=<?= $index ?>&catID=<?= $category_id ?>" class="btn btn-primary btn-sm">
                                            <i class="fa fa-plus"></i>
                                        </a>
                                        <a href="?remove=<?= $index ?>&catID=<?= $category_id ?>" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                    <?php $eachTotal = (int)$item['price'] * $item['count'] ?>
                                    <td><?= $eachTotal ?></td>
                                </tr>
                            <?php $Total += $eachTotal;
                            } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="invoice-footer">
                <h3>Total</h3>
                <h3>
                    <?php if ($show) { ?>
                        <a href="?order" class="btn btn-sm btn-success">Order</a>
                    <?php } ?>
                    <?= $Total ?> MMK
                </h3>
            </div>
        </div>
        <!-- End Invoice  -->

        <!-- Start Main -->
        <div class="main-content">
            <h6>Tables</h6>
            <div class="customer-table">
                <?php $tables = get_tables($mysqli); ?>
                <?php while ($table = $tables->fetch_assoc()) { ?>
                    <a href="?tableID=<?= $table['id'] ?>"
                        class="c-table
                              <?php if ($table['taken']) {
                                    echo "taken";
                                } else {
                                    echo "free-table";
                                }
                                if ($table['id'] == $table_id) {
                                    echo " active-table";
                                }
                                ?>
                    ">
                        <?= $table['tableName'] ?>
                        <br>
                        <i class="fa fa-chair"></i>&nbsp;&nbsp;
                        <?= $table['seat'] ?>
                    </a>
                <?php } ?>
            </div>

            <h6>Categories</h6>
            <div class="category-container">
                <a class="select-category" href="?catID=0">
                    <img src="../assets/items/allItem.png">
                    <p>All Items</p>
                </a>
                <?php $categories = get_categories($mysqli); ?>
                <?php while ($category = $categories->fetch_assoc()) { ?>
                    <a class="select-category" href="?catID=<?= $category['id'] ?>">
                        <img src="data:image/' . $type . ';base64,<?= $category['categoryImg'] ?>">
                        <p><?= $category['categoryName'] ?></p>
                    </a>
                <?php } ?>
            </div>


            <h5>Menu Items</h5>
            <div class="item-container">
                <?php $items = get_items($mysqli); ?>
                <?php
                if ($category_id != 0) {
                    $items =   get_items_by_category_id($mysqli, $category_id);
                }
                ?>
                <?php while ($item = $items->fetch_assoc()) { ?>

                    <a class="select-item" href="?catID=<?= $category_id ?>& itemID=<?= $item['id'] ?>">
                        <img src="data:image/' . $type . ';base64,<?= $item['img'] ?>">
                        <div class="item-text">
                            <span><?php
                                    if (strlen($item['name']) > 10) {
                                        echo substr($item['name'], 0, 10) . "...";
                                    } else {
                                        echo $item['name'];
                                    }
                                    ?></span>
                            <span><?= $item['price'] ?> MMK</span>
                        </div>
                    </a>

                <?php } ?>
            </div>
        </div>
        <!-- End Main -->

    </div>
</div>
<?php require_once("../layout/footer.php") ?>