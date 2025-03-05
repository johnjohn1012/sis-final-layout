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
                    <!-- Ingredient Name Dropdown -->
                    <div class="form-group">
                        <label for="item_name">Ingredient Name</label>
                        <select name="item_id" id="item_name" class="form-control" onchange="updateIngredientDetails()" required>
                            <option value="">Select Ingredient</option>
                            <?php foreach ($items as $item): ?>
                                <option value="<?= htmlspecialchars($item['item_id']) ?>"
                                    <?= $selected_item_id == $item['item_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($item['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Auto-filled Details -->
                    <div class="form-group">
                        <label for="category_name">Category Name</label>
                        <input type="text" name="category_name" id="category_name" class="form-control" 
                               value="<?= htmlspecialchars($category_name) ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="supplier_name">Supplier Name</label>
                        <input type="text" name="supplier_name" id="supplier_name" class="form-control" 
                               value="<?= htmlspecialchars($supplier_name) ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="employee_name">Employee Name</label>
                        <input type="text" name="employee_name" id="employee_name" class="form-control" 
                               value="<?= htmlspecialchars($employee_name) ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="raw_cost_per_unit">Cost Per Unit</label>
                        <input type="text" name="raw_cost_per_unit" id="raw_cost_per_unit" class="form-control" 
                               value="<?= htmlspecialchars($cost_per_unit) ?>" readonly>
                    </div>

                    <!-- Editable Fields -->
                    <div class="form-group">
                        <label for="raw_unit_of_measure">Unit of Measure</label>
                        <select name="raw_unit_of_measure" id="raw_unit_of_measure" class="form-control" required>
                            <option value="" disabled <?= !isset($_POST['raw_unit_of_measure']) ? 'selected' : '' ?>>Select a unit</option>
                            <option value="kg" <?= isset($_POST['raw_unit_of_measure']) && $_POST['raw_unit_of_measure'] === 'kg' ? 'selected' : '' ?>>Kilograms (kg)</option>
                            <option value="g" <?= isset($_POST['raw_unit_of_measure']) && $_POST['raw_unit_of_measure'] === 'g' ? 'selected' : '' ?>>Grams (g)</option>
                            <option value="L" <?= isset($_POST['raw_unit_of_measure']) && $_POST['raw_unit_of_measure'] === 'L' ? 'selected' : '' ?>>Liters (L)</option>
                            <option value="mL" <?= isset($_POST['raw_unit_of_measure']) && $_POST['raw_unit_of_measure'] === 'mL' ? 'selected' : '' ?>>Milliliters (mL)</option>
                            <option value="pcs" <?= isset($_POST['raw_unit_of_measure']) && $_POST['raw_unit_of_measure'] === 'pcs' ? 'selected' : '' ?>>Pieces (pcs)</option>
                            <option value="packs" <?= isset($_POST['raw_unit_of_measure']) && $_POST['raw_unit_of_measure'] === 'packs' ? 'selected' : '' ?>>Packs</option>
                            <option value="bottles" <?= isset($_POST['raw_unit_of_measure']) && $_POST['raw_unit_of_measure'] === 'bottles' ? 'selected' : '' ?>>Bottles</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="raw_stock_quantity">Stock Quantity</label>
                        <input type="number" name="raw_stock_quantity" id="raw_stock_quantity" class="form-control" 
                               value="<?= isset($_POST['raw_stock_quantity']) ? htmlspecialchars($_POST['raw_stock_quantity']) : '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="raw_reorder_level">Reorder Level</label>
                        <input type="number" name="raw_reorder_level" id="raw_reorder_level" class="form-control" 
                               value="<?= isset($_POST['raw_reorder_level']) ? htmlspecialchars($_POST['raw_reorder_level']) : '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="raw_stock_in">Stock In</label>
                        <input type="number" name="raw_stock_in" id="raw_stock_in" class="form-control" disabled>
                    </div>

                    <div class="form-group">
                        <label for="raw_stock_out">Stock Out</label>
                        <input type="number" name="raw_stock_out" id="raw_stock_out" class="form-control" disabled>
                    </div>

                    <button type="submit" name="add_raw_ingredient" class="btn btn-primary">Add Ingredient</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function updateIngredientDetails() {
    const itemId = document.getElementById('item_name').value;
    if (itemId) {
        window.location.href = `index_admin.php?page=ingredients&item_id=${itemId}#addRawIngredientModal`;
    }
}

// Auto-open modal when URL contains the hash
document.addEventListener('DOMContentLoaded', function() {
    if (window.location.hash === '#addRawIngredientModal') {
        new bootstrap.Modal(document.getElementById('addRawIngredientModal')).show();
    }
});

// Ensure the modal can be closed
document.querySelector('.close').addEventListener('click', function() {
    var modal = new bootstrap.Modal(document.getElementById('addRawIngredientModal'));
    modal.hide();
});
</script>



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
                <p><strong>Stock Quantity In:</strong> <span id="view-raw-ingredient-stock-in"></span></p>
                <p><strong>Stock Quantity Out:</strong> <span id="view-raw-ingredient-stock-out"></span></p>
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




<!-- Stock In Modal -->
<div class="modal fade" id="stockInModal" tabindex="-1" role="dialog" aria-labelledby="stockInModalLabel" aria-hidden="true" style="max-width: 100vw;">
    <div class="modal-dialog" role="document" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="stockInModalLabel">Stock In - <span id="stockInIngredientName"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="stockInForm" action="index_admin.php?page=ingredients" method="POST">
                    <input type="hidden" name="ingredient_id" id="stockInIngredientId">
                    <input type="hidden" name="action" value="in">
                    <div class="form-group">
                        <label for="stock_in_quantity">Quantity</label>
                        <input type="number" class="form-control" name="quantity" id="stock_in_quantity" required>
                    </div>
                    <button type="submit" class="btn btn-success">Confirm Stock In</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Stock Out Modal -->
<div class="modal fade" id="stockOutModal" tabindex="-1" role="dialog" aria-labelledby="stockOutModalLabel" aria-hidden="true" style="max-width: 100vw;">
    <div class="modal-dialog" role="document" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="stockOutModalLabel">Stock Out - <span id="stockOutIngredientName"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="stockOutForm" action="index_admin.php?page=ingredients" method="POST">
                    <input type="hidden" name="ingredient_id" id="stockOutIngredientId">
                    <input type="hidden" name="action" value="out">
                    <div class="form-group">
                        <label for="stock_out_quantity">Quantity</label>
                        <input type="number" class="form-control" name="quantity" id="stock_out_quantity" required>
                    </div>
                    <button type="submit" class="btn btn-secondary">Confirm Stock Out</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to Update Modal Content -->
<script>
    function stockIn(id, name) {
        document.getElementById("stockInIngredientId").value = id;
        document.getElementById("stockInIngredientName").textContent = name;
    }

    function stockOut(id, name) {
        document.getElementById("stockOutIngredientId").value = id;
        document.getElementById("stockOutIngredientName").textContent = name;
    }
</script>



