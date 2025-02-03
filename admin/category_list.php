<?php require_once("../layout/header.php") ?>
<?php require_once("../layout/sidebar.php") ?>
<!-- Pagination -->
<?php
$currentPage = 0;
if (isset($_GET["pageNo"])) {
  $currentPage = (int) $_GET["pageNo"];
}

$pagTotal = get_category_pag_count($mysqli);
if (isset($_GET['last'])) {
  $currentPage = ($pagTotal * 5) - 5;
}
if (isset($_GET['deleteId'])) {
  if (delete_category($mysqli, $_GET['deleteId'])) {
    echo "<script>location.replace('./category_list.php')</script>";
  }
}
?>

<div class="content">
  <?php require_once("../layout/nav.php") ?>
  <div class="card m-5">
    <div class="card-body">
      <h3>Category List</h3>
      <div class="justify-content-end">
        <button class="btn btn-outline-primary" onclick="location.replace('add_category.php')">
          Add Category
        </button>
      </div>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Category Name</th>
            <th>Image</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $categories = get_category($mysqli, $currentPage); ?>
          <!-- for searching -->
          <?php
          if (isset($_POST["search"]) && $_POST['search'] != '') {
            $users = get_category_filter($mysqli, $_POST['search']);
          } ?>
          <?php
          if (isset($_POST["search"])) {
            $i = 1;
          } else {
            $i = $currentPage + 1;
          } ?>

          <?php while ($cate = $categories->fetch_assoc()) { ?>
            <tr>
              <td><?= $i ?></td>
              <td><?= $cate['categoryName'] ?></td>
              <td>
                <img class="table-img" src="data:image/' . $type . ';base64,<?= $cate['categoryImg'] ?>">
              </td>
              <td>
                <a href="add_category.php?id=<?= $cate['id'] ?>" class="btn  btn-sm btn-primary">
                  <i class="fa fa-pen"></i>
                </a>
                <button class="btn btn-sm btn-danger deleteSelect" data-value="<?= $cate['id'] ?>" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa fa-trash"></i></button>
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