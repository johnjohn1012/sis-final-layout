<aside id="admin-sidebar" class="admin-sidebar menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="index_admin.php" class="app-brand-link">
      <span class="app-brand-text demo menu-text fw-bolder ms-2">Admin Panel</span>
    </a>
    <a href="javascript:void(0);" class="admin-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item <?php echo ($_GET['page'] ?? '') == 'dashboard' ? 'active' : ''; ?>">
      <a href="index_admin.php?page=dashboard" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home"></i>
        <div>Dashboard</div>
      </a>
    </li>

    <!-- User Management -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">User Management</span></li>
    <li class="menu-item <?php echo ($_GET['page'] ?? '') == 'users' ? 'active' : ''; ?>">
      <a href="index_admin.php?page=users" class="menu-link">
        <i class="menu-icon tf-icons bx bx-user"></i>
        <div>Users</div>
      </a>
    </li>

    <!-- Stock Management -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Stock Management</span></li>
    <li class="menu-item has-submenu <?php echo in_array($_GET['page'] ?? '', ['category', 'products', 'ingredients', 'suppliers', 'purchase_orders', 'receiving_list', 'back_orders']) ? 'open' : ''; ?>">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-box"></i>
        <div>Stock Management</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item <?php echo ($_GET['page'] ?? '') == 'category' ? 'active' : ''; ?>">
          <a href="index_admin.php?page=category" class="menu-link">
            <i class="menu-icon tf-icons bx bx-folder"></i>
            <div>Categories</div>
          </a>
        </li>
        <li class="menu-item <?php echo ($_GET['page'] ?? '') == 'products' ? 'active' : ''; ?>">
          <a href="index_admin.php?page=products" class="menu-link">
            <i class="menu-icon tf-icons bx bx-cube"></i>
            <div>Products</div>
          </a>
        </li>
        <li class="menu-item <?php echo ($_GET['page'] ?? '') == 'ingredients' ? 'active' : ''; ?>">
          <a href="index_admin.php?page=ingredients" class="menu-link">
            <i class="menu-icon tf-icons bx bx-food-menu"></i>
            <div>Raw Ingredients</div>
          </a>
        </li>
        <li class="menu-item <?php echo ($_GET['page'] ?? '') == 'suppliers' ? 'active' : ''; ?>">
          <a href="index_admin.php?page=suppliers" class="menu-link">
            <i class="menu-icon tf-icons bx bx-store"></i>
            <div>Suppliers</div>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</aside>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".menu-toggle").forEach(function (toggle) {
      toggle.addEventListener("click", function () {
        let parent = this.closest(".menu-item");
        if (parent.classList.contains("open")) {
          parent.classList.remove("open");
        } else {
          document.querySelectorAll(".menu-item.open").forEach(function (item) {
            item.classList.remove("open");
          });
          parent.classList.add("open");
        }
      });
    });
  });
</script>
