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
    <li class="menu-item active">
      <a href="index_admin.php?page=dashboard" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div>Dashboard</div>
      </a>
    </li>

    <!-- Stock Management Section -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Stock Management</span></li>

    <!-- Stock Management Dropdown -->
    <li class="menu-item">
      <a href="javascript:void(0);" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-package"></i>
        <div>Stock Management</div>
      </a>

      <ul class="menu-sub">
                <!-- Category -->
            <li class="menu-item">
            <a href="index_admin.php?page=category" class="menu-link">
                <i class="menu-icon tf-icons bx bx-folder"></i> <!-- Another alternative icon -->
                <div>Category</div>
            </a>
            </li>


        <!-- Products -->
        <li class="menu-item">
          <a href="index_admin.php?page=products" class="menu-link">
            <i class="menu-icon tf-icons bx bx-cube-alt"></i>
            <div>Products</div>
          </a>
        </li>

                <!-- Raw Ingredients -->
                <li class="menu-item">
                <a href="index_admin.php?page=raw_ingredients" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-food-menu"></i>
                    <div>Raw Ingredients</div>
                </a>
                </li>

                <!-- Suppliers -->
                <li class="menu-item">
                <a href="index_admin.php?page=suppliers" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-store-alt"></i>
                    <div>Suppliers</div>
                </a>
                </li>

        <!-- Purchase Orders -->
        <li class="menu-item">
          <a href="index_admin.php?page=purchase_orders" class="menu-link">
            <i class="menu-icon tf-icons bx bx-cart"></i>
            <div>Purchase Orders</div>
          </a>
        </li>

        <!-- Receiving List -->
        <li class="menu-item">
          <a href="index_admin.php?page=receiving_list" class="menu-link">
            <i class="menu-icon tf-icons bx bx-package"></i>
            <div>Receiving List</div>
          </a>
        </li>

        <!-- Back Orders -->
        <li class="menu-item">
          <a href="index_admin.php?page=back_orders" class="menu-link">
            <i class="menu-icon tf-icons bx bx-arrow-back"></i>
            <div>Back Orders</div>
          </a>
        </li>
      </ul>
    </li>

            <!-- Reports Section -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Reports Management</span></li>
            <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-line-chart"></i>
                <div>Reports</div>
            </a>
            <ul class="menu-sub">
                <!-- Inventory Reports -->
                <li class="menu-item">
                <a href="index_admin.php?page=inventory_reports" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-line-chart"></i>
                    <div>Inventory Reports</div>
                </a>
                </li>

                <!-- Sales Reports -->
                <li class="menu-item">
                <a href="index_admin.php?page=sales_reports" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-trending-up"></i>
                    <div>Sales Reports</div>
                </a>
                </li>

                <!-- Order Reports -->
                <li class="menu-item">
                <a href="index_admin.php?page=order_reports" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-receipt"></i>
                    <div>Order Reports</div>
                </a>
                </li>
                <!-- Supplier Reports -->
                <li class="menu-item">
                <a href="index_admin.php?page=supplier_reports" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-package"></i> <!-- Another alternative icon -->
                    <div>Supplier Reports</div>
                </a>
                </li>


                <!-- Back Order Reports -->
                <li class="menu-item">
                <a href="index_admin.php?page=back_order_reports" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-arrow-back"></i>
                    <div>Back Order Reports</div>
                </a>
                </li>

                <!-- Raw Ingredients Reports -->
                <li class="menu-item">
                <a href="index_admin.php?page=raw_ingredients_reports" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-food-menu"></i>
                    <div>Ingredients Reports</div>
                </a>
                </li>
            </ul>
            </li>

  </ul>
</aside>
