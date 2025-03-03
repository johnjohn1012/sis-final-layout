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
                <form action="index_admin.php?page=products" method="POST">
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" name="product_name" id="product_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="product_selling_price">Selling Price</label>
                        <input type="number" name="product_selling_price" id="product_selling_price" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="product_stock_quantity">Stock Quantity</label>
                        <input type="number" name="product_stock_quantity" id="product_stock_quantity" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="product_reorder_level">Reorder Level</label>
                        <input type="number" name="product_reorder_level" id="product_reorder_level" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="">Select Category</option>
                            <?php while ($row = mysqli_fetch_assoc($categories)) { ?>
                                <option value="<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="employee_id">Employee</label>
                        <select name="employee_id" id="employee_id" class="form-control" required>
                            <option value="">Select Employee</option>
                            <?php while ($row = mysqli_fetch_assoc($employees)) { ?>
                                <option value="<?php echo $row['employee_id']; ?>"><?php echo $row['employee_name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <button type="submit" name="add_product" class="btn btn-primary">Add Product</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Edit Product Modal -->
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
                <form action="index_admin.php?page=products" method="POST">
                    <input type="hidden" name="product_id" id="edit-product-id">
                    <div class="form-group">
                        <label for="edit-product-name">Product Name</label>
                        <input type="text" name="product_name" id="edit-product-name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-product-selling-price">Selling Price</label>
                        <input type="number" name="product_selling_price" id="edit-product-selling-price" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-product-stock-quantity">Stock Quantity</label>
                        <input type="number" name="product_stock_quantity" id="edit-product-stock-quantity" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-product-reorder-level">Reorder Level</label>
                        <input type="number" name="product_reorder_level" id="edit-product-reorder-level" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-category-id">Category ID</label>
                        <input type="number" name="category_id" id="edit-category-id" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-employee-id">Employee ID</label>
                        <input type="number" name="employee_id" id="edit-employee-id" class="form-control" required>
                    </div>
                    <button type="submit" name="edit_product" class="btn btn-primary">Update Product</button>
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
