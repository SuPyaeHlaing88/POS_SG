<nav >
            <ul class="pagination pagination-sm">
              <?php for ($i = 0;$i < $pagTotal;$i++) { ?>
                <?php if ($currentPage == $i * 2) { ?>
                <li class="page-item active">
                  <a class="page-link"><?= $i + 1 ?></a>
                </li>
                <?php } else { ?>
                  <li class="page-item">
                  <a class="page-link" href="?pageNo=<?= $i * 2 ?>"><?= $i + 1 ?></a>
                </li>
              <?php }
                } ?>
            </ul>
          </nav>