<div class="dashboard-module">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <!-- Users Module -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <p class="card-text"><?php echo 150; ?> Users</p>
                    </div>
                </div>
            </div>

            <!-- Sales Module -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Sales</h5>
                        <p class="card-text"><?php echo '$' . number_format(12500, 2); ?> USD</p>
                    </div>
                </div>
            </div>

            <!-- Active Projects Module -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Active Projects</h5>
                        <p class="card-text"><?php echo 25; ?> Projects</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
