<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="index_admin.php?page=products" method="POST" enctype="multipart/form-data">
                    <!-- Product Name -->
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" name="product_name" id="product_name" class="form-control" required>
                    </div>

                    <!-- Selling Price -->
                    <div class="form-group">
                        <label for="product_selling_price">Selling Price</label>
                        <input type="number" name="product_selling_price" id="product_selling_price" 
                               class="form-control" step="0.01" min="0" required>
                    </div>

                    <!-- Product Image -->
                    <div class="form-group">
                        <label for="product_image">Product Image</label>
                        <input type="file" name="product_image" id="product_image" class="form-control-file"
                               accept="image/*">
                        <small class="form-text text-muted">Allowed formats: JPG, PNG, GIF</small>
                    </div>

                    <!-- Stock Quantity -->
                    <div class="form-group">
                        <label for="product_quantity">Initial Stock Quantity</label>
                        <input type="number" name="product_quantity" id="product_quantity" 
                               class="form-control" min="0" value="0" required>
                    </div>

                    <!-- Restock Quantity -->
                    <div class="form-group">
                        <label for="product_restock_qty">Restock Level</label>
                        <input type="number" name="product_restock_qty" id="product_restock_qty" 
                               class="form-control" min="0" value="0" required>
                    </div>

                    <!-- Category Selection -->
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="">Select Category</option>
                            <?php 
                            // Reset pointer and loop through categories again
                            mysqli_data_seek($category_result, 0);
                            while($row = mysqli_fetch_assoc($category_result)): ?>
                                <option value="<?= $row['category_id']; ?>">
                                    <?= htmlspecialchars($row['category_name']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <!-- Employee Selection -->
                    <div class="form-group">
                        <label for="employee_id">Responsible Employee</label>
                        <select name="employee_id" id="employee_id" class="form-control" required>
                            <option value="">Select Employee</option>
                            <?php 
                            // Reset pointer and loop through employees again
                            mysqli_data_seek($employee_result, 0);
                            while($row = mysqli_fetch_assoc($employee_result)): ?>
                                <option value="<?= $row['employee_id']; ?>">
                                    <?= htmlspecialchars($row['employee_name']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="add_product" class="btn btn-primary">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="index_admin.php?page=products" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="product_id" id="edit-product-id">
                    
                    <!-- Current Image Preview -->
                    <div class="form-group">
                        <label>Current Image</label>
                        <img id="edit-current-image" src="" class="img-thumbnail" style="max-width: 200px; display: block;">
                        <small class="form-text text-muted">Current product image</small>
                    </div>

                    <!-- Product Name -->
                    <div class="form-group">
                        <label for="edit-product-name">Product Name</label>
                        <input type="text" name="product_name" id="edit-product-name" class="form-control" required>
                    </div>

                    <!-- Selling Price -->
                    <div class="form-group">
                        <label for="edit-product-selling-price">Selling Price</label>
                        <input type="number" step="0.01" min="0" name="product_selling_price" 
                               id="edit-product-selling-price" class="form-control" required>
                    </div>

                    <!-- New Image Upload -->
                    <div class="form-group">
                        <label for="edit-product-image">New Image (optional)</label>
                        <input type="file" name="product_image" id="edit-product-image" 
                               class="form-control-file" accept="image/*">
                        <small class="form-text text-muted">Allowed formats: JPG, PNG, GIF</small>
                    </div>

                    <!-- Stock Quantity -->
                    <div class="form-group">
                        <label for="edit-product-quantity">Stock Quantity</label>
                        <input type="number" min="0" name="product_quantity" 
                               id="edit-product-quantity" class="form-control" required>
                    </div>

                    <!-- Restock Level -->
                    <div class="form-group">
                        <label for="edit-product-restock-qty">Restock Level</label>
                        <input type="number" min="0" name="product_restock_qty" 
                               id="edit-product-restock-qty" class="form-control" required>
                    </div>

                    <!-- Category Selection -->
                    <div class="form-group">
                        <label for="edit-category-id">Category</label>
                        <select name="category_id" id="edit-category-id" class="form-control" required>
                            <?php
                            mysqli_data_seek($category_result, 0);
                            while ($row = mysqli_fetch_assoc($category_result)):
                            ?>
                                <option value="<?= htmlspecialchars($row['category_id']) ?>">
                                    <?= htmlspecialchars($row['category_name']) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <!-- Employee Selection -->
                    <div class="form-group">
                        <label for="edit-employee-id">Responsible Employee</label>
                        <select name="employee_id" id="edit-employee-id" class="form-control" required>
                            <?php
                            mysqli_data_seek($employee_result, 0);
                            while ($row = mysqli_fetch_assoc($employee_result)):
                            ?>
                                <option value="<?= htmlspecialchars($row['employee_id']) ?>">
                                    <?= htmlspecialchars($row['employee_name']) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="edit_product" class="btn btn-primary">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Delete Product Confirmation Modal -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" role="dialog" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProductModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this product?
                <form id="delete-product-form" action="index_admin.php?page=products" method="POST">
                    <input type="hidden" name="delete" id="delete-product-id">
                    <div class="form-group">
                        <label for="product-name">Product Name</label>
                        <input type="text" id="product-name" class="form-control" disabled>
                    </div>
                    <button type="submit" class="btn btn-danger">Delete Product</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View Product Modal -->
<div class="modal fade" id="viewProductModal" tabindex="-1" role="dialog" aria-labelledby="viewProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewProductModalLabel">View Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Product ID:</strong> <span id="view-product-id"></span></p>
                <p><strong>Product Name:</strong> <span id="view-product-name"></span></p>
                <p><strong>Selling Price:</strong> <span id="view-product-selling-price"></span></p>
                <p><strong>Category:</strong> <span id="view-category-name"></span></p>
                <p><strong>Employee:</strong> <span id="view-employee-name"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
