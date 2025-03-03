<?php include 'functions/purchase-functions.php'; ?>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-7" style="max-width: 100%; width: 120%;">
    <h1 class="text-left">Purchase Order Management</h1>
    <br>

    <div class="row mb-4">
        <!-- Show Entries Dropdown -->
        <div class="col-md-4">
            <form method="GET" action="index_admin.php?page=purchase_order">
                <div class="form-inline w-100">
                    <label for="limit" class="mr-2">Show</label>
                    <select name="limit" class="form-control ml-2">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                    </select>
                    <label for="limit" class="ml-2">entries</label>
                </div>
            </form>
        </div>
        
        <!-- Search Bar -->
        <div class="col-md-4">
            <form method="GET" action="index_admin.php?page=purchase_order">
                <div class="form-inline w-100">
                    <input type="text" name="search" class="form-control w-75" placeholder="Search Purchase Orders...">
                    <button type="submit" class="btn btn-primary ml-2">Search</button>
                </div>
            </form>
        </div>

        <!-- Add New Purchase Order Button to Trigger Modal -->
        <div class="col-md-4 text-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addPurchaseItemModal">Add New Purchase Order</button>
        </div>
    </div>

    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Purchase Order ID</th>
                    <th>Supplier Name</th>
                    <th>Order Date</th>
                    <th>Expected Delivery</th>
                    <th>Status</th>
                    <th>Employee Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($order = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $order['purchase_order_id']; ?></td>
                        <td><?php echo $order['supplier_name']; ?></td>
                        <td><?php echo $order['purchase_order_date']; ?></td>
                        <td><?php echo $order['purchase_expected_delivery_date']; ?></td>
                        <td><?php echo $order['status']; ?></td>
                        <td><?php echo $order['employee_name']; ?></td>
                        <td>
                            <button onclick="openEditForm(<?php echo $order['purchase_order_id']; ?>, '<?php echo $order['supplier_id']; ?>', '<?php echo $order['purchase_order_date']; ?>', '<?php echo $order['purchase_expected_delivery_date']; ?>', '<?php echo $order['status']; ?>', '<?php echo $order['employee_id']; ?>')" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editPurchaseModal">Edit</button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletePurchaseModal" onclick="setDeleteData(<?php echo $order['purchase_order_id']; ?>, '<?php echo $order['supplier_name']; ?>')">Delete</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <nav>
        <ul class="pagination justify-content-end">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <li class="page-item active">
                <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">3</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>

    <?php include 'modals/purchase-modal.php'; ?>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function openEditForm(id, supplierId, orderDate, deliveryDate, status, employeeId) {
        document.getElementById('edit-purchase-order-id').value = id;
        document.getElementById('edit-supplier-id').value = supplierId;
        document.getElementById('edit-purchase-order-date').value = orderDate;
        document.getElementById('edit-purchase-expected-delivery').value = deliveryDate;
        document.getElementById('edit-status').value = status;
        document.getElementById('edit-employee-id').value = employeeId;
    }

    function setDeleteData(id, supplier) {
        document.getElementById('delete-purchase-order-id').value = id;
        document.getElementById('supplier-name').value = supplier;
    }
</script>
