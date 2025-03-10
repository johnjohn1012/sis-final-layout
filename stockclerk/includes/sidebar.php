<!-- Include Bootstrap CDN -->



<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="index_admin.php" class="app-brand-link">
      <span class="app-brand-text demo menu-text fw-bolder ms-2">SIS DASHBOARD</span>
    </a>
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboard -->
    <li class="menu-item <?php echo (isset($_GET['page']) && $_GET['page'] == 'dashboard') ? 'active' : ''; ?>">
      <a href="index_admin.php?page=dashboard" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div>Dashboard</div>
      </a>
    </li>

    <!-- Stock Management Section -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Inventory Management</span></li>

    <!-- Stock Management Dropdown -->
    <li class="menu-item <?php echo (isset($_GET['page']) && in_array($_GET['page'], ['category', 'products', 'ingredients', 'suppliers','item_list','purchase_orders', 'receiving_list', 'back_orders','return_orders'])) ? 'open' : ''; ?>">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-package"></i>
        <div>Inventory Management</div>
      </a>

      <ul class="menu-sub">
        <li class="menu-item <?php echo (isset($_GET['page']) && $_GET['page'] == 'category') ? 'active' : ''; ?>">
          <a href="index_admin.php?page=category" class="menu-link">
            <i class="menu-icon tf-icons bx bx-folder"></i>
            <div>Category</div>
          </a>
        </li>
      
        <li class="menu-item <?php echo (isset($_GET['page']) && $_GET['page'] == 'suppliers') ? 'active' : ''; ?>">
          <a href="index_admin.php?page=suppliers" class="menu-link">
            <i class="menu-icon tf-icons bx bx-store-alt"></i>
            <div>Suppliers List</div>
          </a>
        </li>

        <li class="menu-item <?php echo (isset($_GET['page']) && $_GET['page'] == 'item_list') ? 'active' : ''; ?>">
          <a href="index_admin.php?page=item_list" class="menu-link">
            <i class="menu-icon tf-icons bx bx-store-alt"></i>
            <div>Item List</div>
          </a>
        </li>

        <li class="menu-item <?php echo (isset($_GET['page']) && $_GET['page'] == 'products') ? 'active' : ''; ?>">
          <a href="index_admin.php?page=products" class="menu-link">
            <i class="menu-icon tf-icons bx bx-cube-alt"></i>
            <div>Products List</div>
          </a>
        </li>

        <li class="menu-item <?php echo (isset($_GET['page']) && $_GET['page'] == 'ingredients') ? 'active' : ''; ?>">
          <a href="index_admin.php?page=ingredients" class="menu-link">
            <i class="menu-icon tf-icons bx bx-food-menu"></i>
            <div>Raw Ingredients</div>
          </a>
        </li>

        <li class="menu-item <?php echo (isset($_GET['page']) && $_GET['page'] == 'purchase_orders') ? 'active' : ''; ?>">
          <a href="index_admin.php?page=purchase_orders" class="menu-link">
            <i class="menu-icon tf-icons bx bx-cart"></i>
            <div>Purchase Orders</div>
          </a>
        </li>
        <li class="menu-item <?php echo (isset($_GET['page']) && $_GET['page'] == 'receiving_list') ? 'active' : ''; ?>">
          <a href="index_admin.php?page=receiving_list" class="menu-link">
            <i class="menu-icon tf-icons bx bx-package"></i>
            <div>Receiving List</div>
          </a>
        </li>

        <li class="menu-item <?php echo (isset($_GET['page']) && $_GET['page'] == 'back_orders') ? 'active' : ''; ?>">
          <a href="index_admin.php?page=back_orders" class="menu-link">
            <i class="menu-icon tf-icons bx bx-arrow-back"></i>
            <div>Back Orders List</div>
          </a>
        </li>

        <li class="menu-item <?php echo (isset($_GET['page']) && $_GET['page'] == 'return_orders') ? 'active' : ''; ?>">
          <a href="index_admin.php?page=return_orders" class="menu-link">
            <i class="menu-icon tf-icons bx bx-arrow-back"></i>
            <div>Return Orders List</div>
          </a>
        </li>

      </ul>
    </li>

    <!-- Reports Section -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Reports Management</span></li>
    <li class="menu-item <?php echo (isset($_GET['page']) && in_array($_GET['page'], ['inventory_reports', 'sales_reports', 'order_reports', 'supplier_reports', 'back_order_reports', 'raw_ingredients_reports'])) ? 'open' : ''; ?>">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-line-chart"></i>
        <div>Reports</div>
      </a>
      <ul class="menu-sub">
        <li class="menu-item <?php echo (isset($_GET['page']) && $_GET['page'] == 'inventory_reports') ? 'active' : ''; ?>">
          <a href="index_admin.php?page=inventory_reports" class="menu-link">
            <i class="menu-icon tf-icons bx bx-line-chart"></i>
            <div>Inventory Reports</div>
          </a>
        </li>
        <li class="menu-item <?php echo (isset($_GET['page']) && $_GET['page'] == 'sales_reports') ? 'active' : ''; ?>">
          <a href="index_admin.php?page=sales_reports" class="menu-link">
            <i class="menu-icon tf-icons bx bx-trending-up"></i>
            <div>Sales Reports</div>
          </a>
        </li>
        <li class="menu-item <?php echo (isset($_GET['page']) && $_GET['page'] == 'order_reports') ? 'active' : ''; ?>">
          <a href="index_admin.php?page=order_reports" class="menu-link">
            <i class="menu-icon tf-icons bx bx-receipt"></i>
            <div>Order Reports</div>
          </a>
        </li>
        <li class="menu-item <?php echo (isset($_GET['page']) && $_GET['page'] == 'supplier_reports') ? 'active' : ''; ?>">
          <a href="index_admin.php?page=supplier_reports" class="menu-link">
            <i class="menu-icon tf-icons bx bx-package"></i>
            <div>Supplier Reports</div>
          </a>
        </li>
        <li class="menu-item <?php echo (isset($_GET['page']) && $_GET['page'] == 'back_order_reports') ? 'active' : ''; ?>">
          <a href="index_admin.php?page=back_order_reports" class="menu-link">
            <i class="menu-icon tf-icons bx bx-arrow-back"></i>
            <div>Back Order Reports</div>
          </a>
        </li>
        <li class="menu-item <?php echo (isset($_GET['page']) && $_GET['page'] == 'raw_ingredients_reports') ? 'active' : ''; ?>">
          <a href="index_admin.php?page=raw_ingredients_reports" class="menu-link">
            <i class="menu-icon tf-icons bx bx-food-menu"></i>
            <div>Ingredients Reports</div>
          </a>
        </li>
      </ul>
    </li>
  </ul>
</aside>

<script>
document.addEventListener("DOMContentLoaded", function () {
  let sidebar = document.getElementById("layout-menu");
  let toggleBtn = document.querySelector(".layout-menu-toggle");

  if (localStorage.getItem("sidebarOpen") === "true") {
    sidebar.classList.add("menu-open");
  }

  toggleBtn.addEventListener("click", function () {
    sidebar.classList.toggle("menu-open");
    localStorage.setItem("sidebarOpen", sidebar.classList.contains("menu-open"));
  });
});
</script>


        <!-- Inside includes/header.php or a similar file -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
          // Prevent right-click and F12 shortcuts
          document.addEventListener("contextmenu", function (e) {
            e.preventDefault();
          });

          document.addEventListener("keydown", function (e) {
            if (e.key === "F12" || (e.ctrlKey && e.shiftKey && (e.key === "I" || e.key === "i"))) {
              e.preventDefault();
              Swal.fire({
                icon: 'warning',
                title: 'Access Denied',
                text: 'This page is protected from inspection.',
                confirmButtonText: 'OK'
              });
            }
          });  

          
        </script>