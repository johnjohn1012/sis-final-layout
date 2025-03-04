<?php include 'functions/product-functions.php'; ?>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-7" style="max-width: 100%; width: 120%;">
    <h4 class="text-left">Product Management</h4>
    <br>

    <div class="row mb-4">
        <!-- Show Entries Dropdown -->
        <div class="col-md-4">
            <form method="GET" action="index_admin.php?page=product">
                <div class="form-inline">
                    <label for="limit" class="mr-2">Show</label>
                    <select name="limit" class="form-control">
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
                    <input type="text" name="search" class="form-control" placeholder="Search Products...">
                    <button type="submit" class="btn btn-primary ml-2">Search</button>
                </div>
            </form>
        </div>

        <!-- Add New Product Button -->
        <div class="col-md-4 text-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addProductModal">Add New Product</button>
        </div>
    </div>

    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Selling Price</th>
                    <th>Stock</th>
                    <th>Restock Level</th>
                    <th>Created At</th>
                    <th>Employee</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($product = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['category_name']); ?></td>
                        <td><?php echo htmlspecialchars($product['product_name']); ?></td>
                        <td>
                            <img src="uploads/products/<?php echo htmlspecialchars($product['product_image']); ?>" 
                                alt="Product Image" width="50" height="50" style="border-radius: 5px;">
                        </td>
                        <td><?php echo htmlspecialchars($product['product_selling_price']); ?></td>
                        <td style="text-align: center; font-weight: bold; 
                            <?php echo ($product['product_quantity'] < $product['product_restock_qty']) ? 'color: red;' : 'color: green;'; ?>">
                            <?php echo htmlspecialchars($product['product_quantity']); ?>
                        </td>
                        <td><?php echo htmlspecialchars($product['product_restock_qty']); ?></td>
                        <td><?php echo htmlspecialchars($product['product_created_at']); ?></td>
                        <td><?php echo htmlspecialchars($product['employee_name']); ?></td>
                        <td class="text-center">
                            <div class="btn-group">
                                <!-- View Button -->
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewProductModal" 
                                    onclick="viewProduct(<?php echo htmlspecialchars(json_encode($product)); ?>)">
                                    View
                                </button>

                                <!-- Edit Button -->
                                <button onclick="openEditForm(<?php echo htmlspecialchars(json_encode($product)); ?>)" 
                                    class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editProductModal">
                                    Edit
                                </button>

                                <!-- Delete Button 
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteProductModal" 
                                    onclick="setDeleteData(<?php echo $product['product_id']; ?>, '<?php echo htmlspecialchars(addslashes($product['product_name'])); ?>')">
                                    Delete
                                </button> -->

                                
                            </div>
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
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
function viewProduct(product) {
    document.getElementById('view-product-name').textContent = product.product_name;
    document.getElementById('view-product-selling-price').textContent = product.product_selling_price;
    document.getElementById('view-product-quantity').textContent = product.product_quantity;
    document.getElementById('view-product-restock-qty').textContent = product.product_restock_qty;
    document.getElementById('view-category-name').textContent = product.category_name;
    document.getElementById('view-employee-name').textContent = product.employee_name;
    
    // Corrected image path
    const imgElement = document.getElementById('view-product-image');
    if (product.product_image) {
        imgElement.src = "uploads/products/" + product.product_image;
        imgElement.style.display = 'block';
    } else {
        imgElement.style.display = 'none';
    }
}

    function setDeleteData(id, name) {
    document.getElementById('delete-product-id').value = id;
    document.getElementById('delete-product-name').textContent = name;
}

    function viewProduct(product) {
        document.getElementById('view-product-name').textContent = product.product_name;
        document.getElementById('view-product-selling-price').textContent = product.product_selling_price;
        document.getElementById('view-product-quantity').textContent = product.product_quantity;
        document.getElementById('view-product-restock-qty').textContent = product.product_restock_qty;
        document.getElementById('view-category-name').textContent = product.category_name;
        document.getElementById('view-employee-name').textContent = product.employee_name;
        document.getElementById('view-product-image').src = "uploads/" + product.product_image;
    }
</script>
