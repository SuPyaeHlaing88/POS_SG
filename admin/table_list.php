<?php require_once("../layout/header.php") ?>
<?php require_once("../layout/sidebar.php") ?>
<!-- Pagination -->
<?php
$currentPage = 0;
if (isset($_GET["pageNo"])) {
  $currentPage = (int) $_GET["pageNo"];
}

$pagTotal = get_table_pag_count($mysqli);
if (isset($_GET['last'])) {
  $currentPage = ($pagTotal * 5) - 5;
}
if (isset($_GET['deleteId'])) {
  if (delete_table($mysqli, $_GET['deleteId'])) {
    echo "<script>location.replace('./table_list.php')</script>";
  }
}
?>

<div class="content">
  <?php require_once("../layout/nav.php") ?>
  <div class="card m-5">
    <div class="card-body">
      <h3>Table List</h3>
      <div class="justify-content-end">
        <button class="btn btn-outline-primary" onclick="location.replace('add_table.php')">Add Table</button>
      </div>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Name</th>
            <th>Seats</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $tables = get_table($mysqli, $currentPage); ?>
          <!-- for searching -->
          <?php
          if (isset($_POST["search"]) && $_POST['search'] != '') {
            $users = get_table_filter($mysqli, $_POST['search']);
          } ?>
          <?php
          if (isset($_POST["search"])) {
            $i = 1;
          } else {
            $i = $currentPage + 1;
          } ?>
          <!-- ?php $i = 1; ?> -->

          <?php while ($t = $tables->fetch_assoc()) { ?>
            <tr>
              <td><?= $i ?></td>
              <td><?= $t['tableName'] ?></td>
              <td><?= $t['seat'] ?></td>
              <td>
                <a href="add_table.php?id=<?= $t['id'] ?>" class="btn  btn-sm btn-primary">
                  <i class="fa fa-pen"></i>
                </a>
                <button class="btn btn-sm btn-danger deleteSelect" data-value="<?= $t['id'] ?>" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa fa-trash"></i></button>
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