<?php 
include 'functions/product-functions.php'; 


?>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-7" style="max-width: 100%; width: 120%;">
    <h1 class="text-left">Product Management</h1>
    <br>

    <div class="row mb-4">
        <!-- Show Entries Dropdown -->
        <div class="col-md-4">
            <form method="GET" action="index_admin.php?page=product">
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
            <form method="GET" action="index_admin.php?page=product">
                <div class="form-inline w-100">
                    <input type="text" name="search" class="form-control w-75" placeholder="Search Products...">
                    <button type="submit" class="btn btn-primary ml-2">Search</button>
                </div>
            </form>
        </div>

        <!-- Add New Product Button to Trigger Modal -->
        <div class="col-md-4 text-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">Add New Product</button>
        </div>
    </div>

    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Selling Price</th>
                    <th>Stock Quantity</th>
                    <th>Reorder Level</th>
                    <th>Category Name</th>
                    <th>Created At</th>
                    <th>Employee Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($product = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($product['product_selling_price']); ?></td>
                        <td><?php echo htmlspecialchars($product['product_stock_quantity']); ?></td>
                        <td><?php echo htmlspecialchars($product['product_reorder_level']); ?></td>
                        <td><?php echo htmlspecialchars($product['category_name']); ?></td>
                        <td><?php echo htmlspecialchars($product['product_created_at']); ?></td>
                        <td><?php echo htmlspecialchars($product['employee_name']); ?></td>
                        <td>
                            <button onclick="openEditForm(<?php echo $product['product_id']; ?>, '<?php echo htmlspecialchars($product['product_name']); ?>', '<?php echo htmlspecialchars($product['product_selling_price']); ?>', '<?php echo htmlspecialchars($product['product_stock_quantity']); ?>', '<?php echo htmlspecialchars($product['product_reorder_level']); ?>', '<?php echo htmlspecialchars($product['category_id']); ?>', '<?php echo htmlspecialchars($product['product_created_at']); ?>', '<?php echo htmlspecialchars($product['employee_id']); ?>')" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editProductModal">Edit</button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteProductModal" onclick="setDeleteData(<?php echo $product['product_id']; ?>, '<?php echo htmlspecialchars($product['product_name']); ?>')">Delete</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <?php include 'modals/product-modal.php'; ?>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function openEditForm(id, name, price, stock, reorder, category, created, employee) {
        document.getElementById('edit-product-id').value = id;
        document.getElementById('edit-product-name').value = name;
        document.getElementById('edit-product-selling-price').value = price;
        document.getElementById('edit-product-stock-quantity').value = stock;
        document.getElementById('edit-product-reorder-level').value = reorder;
        document.getElementById('edit-category-id').value = category;
        document.getElementById('edit-product-created-at').value = created;
        document.getElementById('edit-employee-id').value = employee;
    }

    function setDeleteData(id, name) {
        document.getElementById('delete-product-id').value = id;
        document.getElementById('product-name').value = name;
    }
</script>