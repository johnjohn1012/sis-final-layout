<?php include 'functions/product-functions.php'; ?>

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
                <th>Category Name</th>
                    <th>Product Name</th>
                    <th>Selling Price</th>
                    <th>Stock Quantity</th>
                    <th>Reorder Level</th>
                   
                    <th>Created At</th>
                    <th>Employee Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($product = mysqli_fetch_assoc($result)): ?>
                    <tr>

                    <td><?php echo $product['category_name']; ?></td>
                        <td><?php echo $product['product_name']; ?></td>
                        <td><?php echo $product['product_selling_price']; ?></td>
                        <td><?php echo $product['product_stock_quantity']; ?></td>
                        <td><?php echo $product['product_reorder_level']; ?></td>
                    
                        <td><?php echo $product['product_created_at']; ?></td>
                        <td><?php echo $product['employee_name']; ?></td>
                        <td class="text-center">
                        <div class="btn-group" role="group">
                            <!-- View Button -->
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewProductModal" 
                                onclick="viewProduct('<?php echo $product['product_id']; ?>', '<?php echo $product['product_name']; ?>', '<?php echo $product['product_selling_price']; ?>', '<?php echo $product['product_stock_quantity']; ?>', '<?php echo $product['product_reorder_level']; ?>', '<?php echo $product['category_name']; ?>', '<?php echo $product['employee_name']; ?>')" 
                                style="margin: 0 5px;">
                                View
                            </button>

                            <!-- Edit Button -->
                            <button onclick="openEditForm(<?php echo $product['product_id']; ?>, '<?php echo $product['product_name']; ?>', '<?php echo $product['product_selling_price']; ?>', '<?php echo $product['product_stock_quantity']; ?>', '<?php echo $product['product_reorder_level']; ?>', '<?php echo $product['category_name']; ?>', '<?php echo $product['employee_name']; ?>')" 
                                class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editProductModal"
                                style="margin: 0 5px;">
                                Edit
                            </button>

                            <!-- Delete Button -->
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteProductModal" 
                                onclick="setDeleteData(<?php echo $product['product_id']; ?>, '<?php echo $product['product_name']; ?>')" 
                                style="margin: 0 5px;">
                                Delete
                            </button>
                        </div>
                    </td>



                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
                    
                <nav>
                <ul class="pagination justify-content-end">
                    <!-- Previous Page Link -->
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <!-- Page Numbers -->
                    <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>

                    <!-- Next Page Link -->
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
                 </nav>

    <?php include 'modals/product-modal.php'; ?>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function openEditForm(id, name, price, stock, reorder, category, employee) {
        document.getElementById('edit-product-id').value = id;
        document.getElementById('edit-product-name').value = name;
        document.getElementById('edit-product-selling-price').value = price;
        document.getElementById('edit-product-stock-quantity').value = stock;
        document.getElementById('edit-product-reorder-level').value = reorder;
        document.getElementById('edit-category-name').value = category;
        document.getElementById('edit-employee-name').value = employee;
    }

    function setDeleteData(id, name) {
        document.getElementById('delete-product-id').value = id;
        document.getElementById('product-name').value = name;
    }



    function viewProduct(productId, productName, productSellingPrice, productStockQuantity, productReorderLevel, categoryName, employeeName) {
    // Set the modal content with the product details
    document.getElementById('view-product-id').innerText = productId;
    document.getElementById('view-product-name').innerText = productName;
    document.getElementById('view-product-selling-price').innerText = productSellingPrice;
    document.getElementById('view-product-stock-quantity').innerText = productStockQuantity;
    document.getElementById('view-product-reorder-level').innerText = productReorderLevel;
    document.getElementById('view-category-name').innerText = categoryName;
    document.getElementById('view-employee-name').innerText = employeeName;
}


</script>