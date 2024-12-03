<?php require_once("../layout/header.php") ?>
<?php require_once("../layout/sidebar.php") ?>
<!-- Pagination -->
<?php
$currentPage = 0;
if (isset($_GET["pageNo"])) {
  $currentPage = (int) $_GET["pageNo"];
}

$pagTotal = get_item_pag_count($mysqli);
if (isset($_GET['last'])) {
  $currentPage = ($pagTotal * 5) - 5;
}
if (isset($_GET['deleteId'])) {
  if (delete_item($mysqli, $_GET['deleteId'])) { 
    echo "<script>location.replace('./item_list.php')</script>";
    
  }
}
?>

<div class="content">
  <?php require_once("../layout/nav.php") ?>
  <div class="card m-5">
    <div class="card-body">
      <h3>Item List</h3>
      <div class="justify-content-end">
        <button class="btn btn-outline-primary" onclick="location.replace('add_item.php')">Add New Item</button>
      </div>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Item Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Category</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <!-- ?php $items = get_item($mysqli, $currentPage); ?> -->

          <!-- for searching -->
          <!-- ?php
          if (isset($_POST["search"]) && $_POST['search'] != '') {
            $users = get_item_filter($mysqli, $_POST['search']);
          } ?>
          ?php
          if (isset($_POST["search"])) {
            $i = 1;
          } else {
            $i = $currentPage + 1;
          } ?> -->
          <!-- ?php $i = 1; ?> -->

          <!-- with new function called cate name -->
          <?php $i = 1;
          $items = join_with_category($mysqli, $currentPage);
          if (isset($_POST['search'])) {
            $search = $_POST['search'];
            $items =    get_item_filter($mysqli, $_POST['search']);
            $i = 1;
          } else {
            $i = $currentPage + 1;
          };
          while ($item = $items->fetch_assoc()) { ?>


            <!-- ?php while ($item = $items->fetch_assoc()) { ?> -->
            <tr>
              <td><?= $i ?></td>
              <td><?= $item['name'] ?></td>
              <td><?= $item['price'] ?></td>
              <td>
                <img class="table-img" src="data:image/' . $type . ';base64,<?= $item['img'] ?>">
              </td>
              <td><?= $item['category_NAME'] ?></td>



              <td>
                <a href="add_item.php?id=<?= $item['id'] ?>" class="btn  btn-sm btn-primary">
                  <i class="fa fa-pen"></i>
                </a>
                <button class="btn btn-sm btn-danger deleteSelect" data-value="<?= $item['id'] ?>" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa fa-trash"></i></button>
              </td>
            </tr>
          <?php $i++;
          } ?>
        </tbody>
      </table>
      <!-- pagination for all or search -->
      <?php if (!isset($_POST['search'])) {
        require_once("../layout/pagination.php");
      } elseif (isset($_POST['search']) && $_POST['search'] == "") {
        require_once("../layout/pagination.php");
      } ?>
    </div>
  </div>
</div>

<?php require_once("../layout/footer.php") ?>