<?php require_once ("../layout/header.php") ?>
<?php require_once ("../layout/sidebar.php") ?>  
    <div class="content">
    <nav  class="nav">
          <div>
            <form method="post">
              <div class="search-wapper">
                <div class="d-flex search">
                    <input type="text" name="search" placeholder="Search" />
                </div>
                <button class="search-icon">
                    <i class="fa fa-search"></i>
                </button>
              </div>
            </form>
          </div>
          <div class="profile-wapper">
            <div>
                User name
            </div>
            <div class="dropdown">
              <div
                type="button"
                data-bs-toggle="dropdown"
              >
                <img class="profile" src="../assets/profile/profile.png">
              </div>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Logout</a></li>
              </ul>
            </div>
          </div>
        </nav>
    </div>

<?php require_once ("../layout/footer.php") ?>
