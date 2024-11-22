<div id="sidebar" class="sidebar extend">
    <!-- <div style="position: fixed;"> -->
        <div class="sidebar-header">
            <i class="fas fa-store"></i>
            <h5 class="sidebar-label">JO JO Hotpot</h5>
        </div>
       <div class="divition"></div>
       <div class="sidebar-menu"  data-bs-toggle="collapse" data-bs-target="#user-menu">
            <div>
                <i class="fa fa-users"></i>
                <a  style="width: 100%;"> User </a> 
            </div> 
            <i  class="fa fa-angle-down"></i>
       </div>
       <div class="sidebar-sub-menu collapse" id="user-menu">
        <div onclick="location.replace('./add_user.php')" class="sidebar-menu">
               <div>
                    <i class="fa fa-user-plus"></i>
                    <a href="./add_user.php"> Add User </a>
               </div>
        </div>
        <div class="sidebar-menu">
            <div>
                <i class="fa fa-list"></i>
                <a href="./user_list.php"> User List </a>
            </div>
        </div>
       </div>
       <div class="sidebar-menu"  data-bs-toggle="collapse" data-bs-target="#table-menu">
            <div>
                <i class="fa-solid fa-chair"></i>
                <a  style="width: 100%;"> Table </a> 
            </div> 
            <i class="fa fa-angle-down"></i>
       </div>
       <div class="sidebar-sub-menu collapse" id="table-menu">
        <div class="sidebar-menu">
               <div>
                    <i class="fa fa-plus"></i>
                    <a href="./add_table.php"> Add Table </a>
               </div>
        </div>
        <div class="sidebar-menu">
            <div>
                <i class="fa fa-list"></i>
                <a href="./table_list.php"> Table List </a>
            </div>
        </div>
       </div>
       <div class="sidebar-menu"  data-bs-toggle="collapse" data-bs-target="#category-menu">
            <div>
                <i class="fa-solid fa-sitemap"></i>
                <a  style="width: 100%;"> Category </a> 
            </div> 
            <i class="fa fa-angle-down"></i>
       </div>
       <div class="sidebar-sub-menu collapse" id="category-menu">
        <div class="sidebar-menu">
               <div>
                    <i class="fa fa-plus"></i>
                    <a href="./add_category.php"> Add Category </a>
               </div>
        </div>
        <div class="sidebar-menu">
            <div>
                <i class="fa fa-list"></i>
                <a href="./category_list.php"> Category List </a>
            </div>
        </div>
       </div>
       <div class="sidebar-menu"  data-bs-toggle="collapse" data-bs-target="#item-menu">
            <div>
                <i class="fas fa-utensils"></i>
                <a  style="width: 100%;"> Food Item </a> 
            </div> 
            <i class="fa fa-angle-down"></i>
       </div>
       <div class="sidebar-sub-menu collapse" id="item-menu">
        <div class="sidebar-menu">
               <div>
                    <i class="fa fa-plus"></i>
                    <a href="./add_item.php"> Add Food Item </a>
               </div>
        </div>
        <div class="sidebar-menu">
            <div>
                <i class="fa fa-list"></i>
                <a href="./item_list.php"> Food Item List </a>
            </div>
        </div>
       </div>
       
       <div class="divition"></div>
       <div class="toggle">
            <i id="sidebar-toggle" class="fa fa-angle-left"></i>
       </div>
    <!-- </div> -->
</div>