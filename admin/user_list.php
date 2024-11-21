<?php require_once ("../layout/header.php") ?>
<?php require_once ("../layout/sidebar.php") ?>  
    <div class="content">
      <?php require_once ("../layout/nav.php") ?>  
      <div class="card m-5">
        <div class="card-body">
          <h3>User List</h3>
          <table class="table table-bordered table-stripe">
            <thead>
              <tr>
                <th>No</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>User Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php $users = get_users($mysqli);
$i = 1;?>
              <?php while ($u = $users->fetch_assoc()) { ?>
                <tr>
                  <td><?= $i ?></td>
                  <td><?= $u['username'] ?></td>
                  <td><?= $u['email'] ?></td>
                  <td>
                    <?php if ($u['role'] == 1) {
                        echo "Admin";
                    } elseif ($u['role'] == 2) {
                        echo "Casher";
                    } elseif ($u['role'] == 3) {
                        echo "Kitchen";
                    } else {
                        echo "Waiter";
                    }
                  ?>
                  </td>
                  <th>
                    <?php if ($u['id'] === $user['id']) { ?>
                      <button class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></button>
                    <?php } else { ?>
                      <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                    <?php } ?>
                  </th>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

<?php require_once ("../layout/footer.php") ?>