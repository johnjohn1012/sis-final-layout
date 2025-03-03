<?php

// Include database connection
include('functions/connection.php');


?>



<div class="container-fluid">
    <div class="row">

        <!-- Purchase Order Card -->
        <div class="col-md-3 mb-3">
            <a href="index_admin.php?page=purchase_orders" style="text-decoration: none; color: inherit;">
                <div class="card border-left-primary shadow h-100 py-2 custom-card">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-0">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Purchase Orders</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    <?php 
                                        echo $conn->query("SELECT * FROM `tbl_purchase_order_list`")->num_rows; 
                                    ?>
                                    Record(s)
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-invoice fa-3x" style="color: #007bff;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Receiving Records Card -->
        <div class="col-md-3 mb-3">
            <a href="receiving.php" style="text-decoration: none; color: inherit;">
                <div class="card border-left-warning shadow h-100 py-2 custom-card">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-0">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Receiving Records</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    <?php echo $conn->query("SELECT * FROM `tbl_receiving_list`")->num_rows; ?>
                                    Record(s)
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-box-open fa-3x" style="color: #ffc107;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Back Orders Card -->
        <div class="col-md-3 mb-3">
            <a href="back_order.php" style="text-decoration: none; color: inherit;">
                <div class="card border-left-primary shadow h-100 py-2 custom-card">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-0">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Back Orders</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    <?php echo $conn->query("SELECT * FROM `tbl_back_order_list`")->num_rows; ?>
                                    Record(s)
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-3x" style="color: #007bff;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Suppliers Card -->
        <div class="col-md-3 mb-3">
            <a href="index_admin.php?page=suppliers" style="text-decoration: none; color: inherit;">
                <div class="card border-left-primary shadow h-100 py-2 custom-card">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-0">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Suppliers</div>
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    <?php echo $conn->query("SELECT * FROM `tbl_suppliers`")->num_rows; ?>
                                    Supplier(s)
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-truck-moving fa-3x" style="color: #007bff;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>

<?php include 'includes/footer.php'; ?>

<style>
    .custom-card {
        transition: 0.3s ease-in-out;
    }

    .custom-card:hover {
        background-color: rgb(11, 102, 57) !important;
        color: white !important;
        box-shadow: 0px 0px 20px rgba(4, 243, 56, 0.8);
        transform: scale(1.05);
    }

    .custom-card:hover .text-primary,
    .custom-card:hover .h6,
    .custom-card:hover i {
        color: white !important;
    }
</style>
