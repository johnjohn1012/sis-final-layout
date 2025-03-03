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
                    <!-- Hidden field for raw ingredient ID -->
                    <input type="hidden" name="raw_ingredient_id" id="edit-raw-ingredient-id" value="<?= $ingredient['raw_ingredient_id']; ?>">

                    <!-- Ingredient Name -->
                    <div class="form-group">
                        <label for="edit-raw-name">Ingredient Name</label>
                        <input type="text" name="raw_name" id="edit-raw-name" class="form-control" value="<?= $ingredient['raw_name']; ?>" required>
                    </div>

                    <!-- Raw Description -->
                    <div class="form-group">
                        <label for="edit-raw-description">Description</label>
                        <input type="text" name="raw_description" id="edit-raw-description" class="form-control" value="<?= $ingredient['raw_description']; ?>" required>
                    </div>

                    <!-- Unit of Measure -->
                    <div class="form-group">
                        <label for="edit-raw-unit">Unit of Measure</label>
                        <input type="text" name="raw_unit_of_measure" id="edit-raw-unit" class="form-control" value="<?= $ingredient['raw_unit_of_measure']; ?>" required>
                    </div>

                    <!-- Stock Quantity -->
                    <div class="form-group">
                        <label for="edit-raw-stock">Stock Quantity</label>
                        <input type="number" name="raw_stock_quantity" id="edit-raw-stock" class="form-control" value="<?= $ingredient['raw_stock_quantity']; ?>" required>
                    </div>

                    <!-- Cost Per Unit -->
                    <div class="form-group">
                        <label for="edit-raw-cost">Cost Per Unit</label>
                        <input type="number" name="raw_cost_per_unit" id="edit-raw-cost" class="form-control" value="<?= $ingredient['raw_cost_per_unit']; ?>" required>
                    </div>

                    <!-- Reorder Level -->
                    <div class="form-group">
                        <label for="edit-raw-reorder">Reorder Level</label>
                        <input type="number" name="raw_reorder_level" id="edit-raw-reorder" class="form-control" value="<?= $ingredient['raw_reorder_level']; ?>" required>
                    </div>

                    <!-- Category Selection -->
                    <div class="form-group">
                        <label for="edit-raw-category">Category</label>
                        <select name="category_id" id="edit-raw-category" class="form-control" required>
                            <?php while ($row = mysqli_fetch_assoc($category_result)): ?>
                                <option value="<?= $row['category_id']; ?>" <?= $row['category_id'] == $ingredient['category_id'] ? 'selected' : ''; ?>>
                                    <?= $row['category_name']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <!-- Employee Selection -->
                    <div class="form-group">
                        <label for="edit-raw-employee">Employee</label>
                        <select name="employee_id" id="edit-raw-employee" class="form-control" required>
                            <?php while ($row = mysqli_fetch_assoc($employee_result)): ?>
                                <option value="<?= $row['employee_id']; ?>" <?= $row['employee_id'] == $ingredient['employee_id'] ? 'selected' : ''; ?>>
                                    <?= $row['employee_name']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <!-- Supplier Selection -->
                    <div class="form-group">
                        <label for="edit-raw-supplier">Supplier</label>
                        <select name="supplier_id" id="edit-raw-supplier" class="form-control" required>
                            <?php while ($row = mysqli_fetch_assoc($supplier_result)): ?>
                                <option value="<?= $row['supplier_id']; ?>" <?= $row['supplier_id'] == $ingredient['supplier_id'] ? 'selected' : ''; ?>>
                                    <?= $row['supplier_name']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
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
                    <input type="hidden" name="delete_raw_ingredient" id="delete-raw-ingredient-id">
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


<!-- View Raw Ingredient Modal -->
<div class="modal fade" id="viewRawIngredientModal" tabindex="-1" role="dialog" aria-labelledby="viewRawIngredientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewRawIngredientModalLabel">View Raw Ingredient</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Raw Ingredient ID:</strong> <span id="view-raw-ingredient-id"></span></p>
                <p><strong>Raw Name:</strong> <span id="view-raw-ingredient-name"></span></p>
                <p><strong>Unit of Measure:</strong> <span id="view-raw-ingredient-unit"></span></p>
                <p><strong>Stock Quantity:</strong> <span id="view-raw-ingredient-stock"></span></p>
                <p><strong>Cost per Unit:</strong> <span id="view-raw-ingredient-cost"></span></p>
                <p><strong>Reorder Level:</strong> <span id="view-raw-ingredient-reorder-level"></span></p>
                <p><strong>Supplier:</strong> <span id="view-raw-ingredient-supplier"></span></p>
                <p><strong>Employee:</strong> <span id="view-raw-ingredient-employee"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
