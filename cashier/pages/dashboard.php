<?php
    require('./includes/connection.php');
?>



<div class="dashboard-module">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Transactions Module -->
            <div class="col-md-4">
                <a href="index_cashier.php?page=transaction" class="card-link">
                    <div class="card shadow-sm hover-effect">
                        <div class="card-body">
                            <h5 class="card-title">Total Transactions</h5>
                            <p class="card-text"><?php echo $transactions; ?> Transactions</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Sales Module -->
            <div class="col-md-4">
                <a href="index_cashier.php?page=sales" class="card-link">
                    <div class="card shadow-sm hover-effect">
                        <div class="card-body">
                            <h5 class="card-title">Total Sales</h5>
                            <p class="card-text"><?php echo '$' . number_format($sales, 2); ?> USD</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Pending Orders Module -->
            <div class="col-md-4">
                <a href="index_cashier.php?page=pending_orders" class="card-link">
                    <div class="card shadow-sm hover-effect">
                        <div class="card-body">
                            <h5 class="card-title">Pending Orders</h5>
                            <p class="card-text"><?php echo $pending_orders; ?> Orders</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-effect {
        transition: transform 0.3s ease-in-out;
    }
    .hover-effect:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .card-link {
        text-decoration: none;
        color: inherit;
    }
</style>