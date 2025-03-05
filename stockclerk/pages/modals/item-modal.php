<!-- Add Item Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addItemModalLabel">Add New Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="index_admin.php?page=item_list" method="POST">
                    <div class="form-group">
                        <label for="item_name">Item Name</label>
                        <input type="text" name="name" id="item_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="item_description">Description</label>
                        <input type="text" name="description" id="item_description" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="supplier_id">Supplier</label>
                                              <!-- Supplier Dropdown -->
                    <select name="supplier_id" id="supplier_id" class="form-control" required>
                        <?php while ($supplier = mysqli_fetch_assoc($supplier_result)): ?>
                            <option value="<?php echo $supplier['supplier_id']; ?>"><?php echo $supplier['supplier_name']; ?></option>
                        <?php endwhile; ?>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="employee_id">Employee</label>
                       
                    <!-- Employee Dropdown -->
                    <select name="employee_id" id="employee_id" class="form-control" required>
                        <?php while ($employee = mysqli_fetch_assoc($employee_result)): ?>
                            <option value="<?php echo $employee['employee_id']; ?>"><?php echo $employee['first_name'] . ' ' . $employee['last_name']; ?></option>
                        <?php endwhile; ?>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="category_id">Category</label>



                        <!-- Category Dropdown -->
                        <select name="category_id" id="category_id" class="form-control" required>
                            <?php while ($category = mysqli_fetch_assoc($category_result)): ?>
                                <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                            <?php endwhile; ?>
                        </select>

                    </div>
                    <div class="form-group">
                        <label for="cost">Cost</label>
                        <input type="number" name="cost" id="cost" class="form-control" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" name="add_item" class="btn btn-primary">Add Item</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Edit Item Modal -->
<div class="modal fade" id="editItemModal" tabindex="-1" role="dialog" aria-labelledby="editItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editItemModalLabel">Edit Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="index_admin.php?page=item_list" method="POST">
                    <!-- Hidden field for item ID -->
                    <input type="hidden" name="item_id" id="edit_item_id">

                    <div class="form-group">
                        <label for="edit_item_name">Item Name</label>
                        <input type="text" name="name" id="edit_item_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_item_description">Description</label>
                        <input type="text" name="description" id="edit_item_description" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_supplier_id">Supplier</label>
                        <select name="supplier_id" id="edit_supplier_id" class="form-control" required>
                            <?php 
                            $supplierQuery = "SELECT supplier_id, supplier_name FROM tbl_suppliers ORDER BY supplier_name ASC";
                            $supplierResult = mysqli_query($conn, $supplierQuery);
                            while ($supplier = mysqli_fetch_assoc($supplierResult)): ?>
                                <option value="<?php echo $supplier['supplier_id']; ?>"><?php echo $supplier['supplier_name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="edit_employee_id">Employee</label>
                        <select name="employee_id" id="edit_employee_id" class="form-control" required>
                            <?php 
                            $employeeQuery = "SELECT employee_id, first_name, last_name FROM tbl_employee ORDER BY first_name ASC";
                            $employeeResult = mysqli_query($conn, $employeeQuery);
                            while ($employee = mysqli_fetch_assoc($employeeResult)): ?>
                                <option value="<?php echo $employee['employee_id']; ?>">
                                    <?php echo $employee['first_name'] . ' ' . $employee['last_name']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="edit_category_id">Category</label>
                        <select name="category_id" id="edit_category_id" class="form-control" required>
                            <?php 
                            $categoryQuery = "SELECT category_id, category_name FROM tbl_categories ORDER BY category_name ASC";
                            $categoryResult = mysqli_query($conn, $categoryQuery);
                            while ($category = mysqli_fetch_assoc($categoryResult)): ?>
                                <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="edit_cost">Cost</label>
                        <input type="number" name="cost" id="edit_cost" class="form-control" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_status">Status</label>
                        <select name="status" id="edit_status" class="form-control" required>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>

                    <button type="submit" name="edit_item" class="btn btn-success">Update Item</button>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Delete Item Modal -->
<div class="modal fade" id="deleteItemModal" tabindex="-1" role="dialog" aria-labelledby="deleteItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteItemModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="index_admin.php?page=item_list" method="POST">
                    <input type="hidden" name="item_id" id="delete_item_id">
                    
                    <p>Are you sure you want to delete <strong id="delete_item_name"></strong>?</p>
                    
                    <div class="text-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="delete_item" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
