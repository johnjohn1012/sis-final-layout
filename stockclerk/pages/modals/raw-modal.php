<!-- Add Raw Ingredient Modal -->
<div class="modal fade" id="addRawIngredientModal" tabindex="-1" role="dialog" aria-labelledby="addRawIngredientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addRawIngredientModalLabel">Add New Raw Ingredient</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="index_admin.php?page=ingredients" method="POST">

                <div class="form-group">
                        <label for="category_id">Category</label>
                        <select name="category_id" id="category_id" class="form-control" required>
                            <option value="">Select Category</option>
                            <?php while($row = mysqli_fetch_assoc($category_result)): ?>
                                <option value="<?= $row['category_id']; ?>"><?= $row['category_name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>



                    <div class="form-group">
                        <label for="raw_name">Ingredient Name</label>
                        <input type="text" name="raw_name" id="raw_name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="raw_unit_of_measure">Unit of Measure</label>
                        <input type="text" name="raw_unit_of_measure" id="raw_unit_of_measure" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="raw_stock_quantity">Stock Quantity</label>
                        <input type="number" name="raw_stock_quantity" id="raw_stock_quantity" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="raw_cost_per_unit">Cost Per Unit</label>
                        <input type="text" name="raw_cost_per_unit" id="raw_cost_per_unit" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="raw_reorder_level">Reorder Level</label>
                        <input type="number" name="raw_reorder_level" id="raw_reorder_level" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="supplier_id">Supplier</label>
                        <select name="supplier_id" id="supplier_id" class="form-control" required>
                            <option value="">Select Supplier</option>
                            <?php while($row = mysqli_fetch_assoc($supplier_result)): ?>
                                <option value="<?= $row['supplier_id']; ?>"><?= $row['supplier_name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

          

                    <div>
                    <!-- Populate Employee Dropdown -->
                    <label for="category_id">Employee</label>
                    <select name="employee_id" id="employee_id" class="form-control" required>
                        <option value="">Select Employee</option>
                        <?php while($row = mysqli_fetch_assoc($employee_result)): ?>
                            <option value="<?= $row['employee_id']; ?>"><?= $row['employee_name']; ?></option>
                        <?php endwhile; ?>
                    </select>

                    </div>  

                    <br>
                    <button type="submit" name="add_raw_ingredient" class="btn btn-primary">Add Ingredient</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Raw Ingredient Modal -->

<div class="modal fade" id="editRawIngredientModal" tabindex="-1" role="dialog" aria-labelledby="editRawIngredientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRawIngredientModalLabel">Edit Raw Ingredient</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="index_admin.php?page=ingredients" method="POST">
                    <input type="hidden" name="raw_ingredient_id" id="edit-raw-ingredient-id">
                    <div class="form-group">
                        <label for="edit-raw-name">Ingredient Name</label>
                        <input type="text" name="raw_name" id="edit-raw-name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-raw-unit">Unit of Measure</label>
                        <input type="text" name="raw_unit_of_measure" id="edit-raw-unit" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-raw-stock">Stock Quantity</label>
                        <input type="number" name="raw_stock_quantity" id="edit-raw-stock" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-raw-cost">Cost Per Unit</label>
                        <input type="text" name="raw_cost_per_unit" id="edit-raw-cost" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-raw-reorder">Reorder Level</label>
                        <input type="number" name="raw_reorder_level" id="edit-raw-reorder" class="form-control" required>
                    </div>

                    <br>
                    <button type="submit" name="edit_raw_ingredient" class="btn btn-primary">Update Ingredient</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Raw Ingredient Modal -->
<div class="modal fade" id="deleteRawIngredientModal" tabindex="-1" role="dialog" aria-labelledby="deleteRawIngredientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteRawIngredientModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this raw ingredient?
                <form id="delete-raw-ingredient-form" action="index_admin.php?page=ingredients" method="POST">
                    <input type="hidden" name="delete" id="delete-raw-ingredient-id">
                    <div class="form-group">
                        <label for="raw-ingredient-name">Ingredient Name</label>
                        <input type="text" id="raw-ingredient-name" class="form-control" disabled>
                    </div>
                    <button type="submit" class="btn btn-danger">Delete Ingredient</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
