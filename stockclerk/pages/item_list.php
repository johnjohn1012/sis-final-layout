<?php include 'functions/item-function.php'; ?>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-7" style="max-width: 100%; width: 120%;">
    <h4 class="text-left">Item Management</h4>
    <br>

    <div class="row mb-4">
        <!-- Show Entries Dropdown -->
        <div class="col-md-4">
            <form method="GET" action="index_admin.php?page=item_list">
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
            <form method="GET" action="index_admin.php?page=item_list">
                <div class="form-inline w-100">
                    <input type="text" name="search" class="form-control w-75" placeholder="Search Items...">
                    <button type="submit" class="btn btn-primary ml-2">Search</button>
                </div>
            </form>
        </div>

        <!-- Add New Item Button to Trigger Modal -->
        <div class="col-md-4 text-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addItemModal">Add New Item</button>
        </div>
    </div>

    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Description</th>
                    <th>Supplier</th>
                    <th>Employee</th>
                    <th>Category</th>
                    <th>Cost</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php while ($item = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $item['name']; ?></td>
                        <td><?php echo $item['description']; ?></td>
                        <td><?php echo $item['supplier_name']; ?></td> <!-- Supplier name -->
                        <td><?php echo $item['employee_name']; ?></td> <!-- Employee name -->
                        <td><?php echo $item['category_name']; ?></td> <!-- Category name -->
                        <td><?php echo $item['cost']; ?></td>
                        <td><?php echo $item['status']; ?></td>
                        <td><?php echo $item['date_created']; ?></td>
                        <td class="text-center">
                            <!-- View Button -->
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewItemModal" 
                                onclick="viewItem(<?php echo $item['item_id']; ?>, '<?php echo $item['name']; ?>', '<?php echo $item['description']; ?>', '<?php echo $item['supplier_id']; ?>', '<?php echo $item['employee_id']; ?>', '<?php echo $item['category_id']; ?>', '<?php echo $item['cost']; ?>', '<?php echo $item['status']; ?>')">
                                View
                            </button>

                            <!-- Edit Button -->
                            <button onclick="openEditForm(<?php echo $item['item_id']; ?>, '<?php echo $item['name']; ?>', '<?php echo $item['description']; ?>', '<?php echo $item['supplier_id']; ?>', '<?php echo $item['employee_id']; ?>', '<?php echo $item['category_id']; ?>', '<?php echo $item['cost']; ?>', '<?php echo $item['status']; ?>')" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editItemModal">
                                Edit
                            </button>

                            <!-- Delete Button -->
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteItemModal" onclick="setDeleteData(<?php echo $item['item_id']; ?>, '<?php echo $item['name']; ?>')">
                                Delete
                            </button>
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

    <?php include 'modals/item-modal.php'; ?>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
function openEditForm(product_id, product_name, product_selling_price, product_quantity, 
                     product_restock_qty, category_id, employee_id, product_image) {
    // Populate input fields
    document.getElementById('edit-product-id').value = product_id;
    document.getElementById('edit-product-name').value = product_name;
    document.getElementById('edit-product-selling-price').value = product_selling_price;
    document.getElementById('edit-product-quantity').value = product_quantity;
    document.getElementById('edit-product-restock-qty').value = product_restock_qty;

    // Set selected values for dropdowns
    document.getElementById('edit-category-id').value = category_id;
    document.getElementById('edit-employee-id').value = employee_id;

    // Update product image preview
    const imgPreview = document.getElementById('edit-current-image');
    if (product_image) {
        imgPreview.src = "uploads/products/" + product_image;
        imgPreview.style.display = 'block';
    } else {
        imgPreview.style.display = 'none';
    }

    // Show the modal
    $('#editProductModal').modal('show');
}


function setDeleteData(id, name) {
    $("#delete_item_id").val(id);
    $("#delete_item_name").text(name);
    $("#deleteItemModal").modal("show");
}

</script>
