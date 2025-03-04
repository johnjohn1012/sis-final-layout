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

                    <div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="raw_name_select">Ingredient Name</label>
            <select name="raw_name_select" id="raw_name_select" class="form-control" onchange="updateRawName()">
                <option value="" disabled selected>Select an ingredient</option>
                <option value="Sugar">Sugar</option>
                <option value="Salt">Salt</option>
                <option value="Flour">Flour</option>
                <option value="Oil">Oil</option>
                <option value="Butter">Butter</option>
                <option value="Eggs">Eggs</option>
                <option value="Milk">Milk</option>
                <option value="Cheese">Cheese</option>
                <option value="Baking Powder">Baking Powder</option>
                <option value="Baking Soda">Baking Soda</option>
                <option value="Yeast">Yeast</option>
                <option value="Cornstarch">Cornstarch</option>
                <option value="Vanilla Extract">Vanilla Extract</option>
                <option value="Cocoa Powder">Cocoa Powder</option>
                <option value="Chocolate Chips">Chocolate Chips</option>
                <option value="Honey">Honey</option>
                <option value="Vinegar">Vinegar</option>
                <option value="Soy Sauce">Soy Sauce</option>
                <option value="Fish Sauce">Fish Sauce</option>
                <option value="Garlic">Garlic</option>
                <option value="Onion">Onion</option>
                <option value="Tomato Paste">Tomato Paste</option>
                <option value="Olive Oil">Olive Oil</option>
                <option value="Vegetable Oil">Vegetable Oil</option>
                <option value="Coconut Milk">Coconut Milk</option>
                <option value="Pasta">Pasta</option>
                <option value="Rice">Rice</option>
                <option value="Lentils">Lentils</option>
                <option value="Chili Powder">Chili Powder</option>
                <option value="Paprika">Paprika</option>
                <option value="Cumin">Cumin</option>
                <option value="Turmeric">Turmeric</option>
                <option value="Cinnamon">Cinnamon</option>
                <option value="Nutmeg">Nutmeg</option>
                <option value="Black Pepper">Black Pepper</option>
                <option value="Oregano">Oregano</option>
                <option value="Basil">Basil</option>
                <option value="Parsley">Parsley</option>
                <option value="Thyme">Thyme</option>
                <option value="Rosemary">Rosemary</option>
                <option value="Ginger">Ginger</option>
                <option value="Lemon Juice">Lemon Juice</option>
                <option value="Mustard">Mustard</option>
                <option value="Mayonnaise">Mayonnaise</option>
                <option value="Ketchup">Ketchup</option>
                <option value="Hot Sauce">Hot Sauce</option>
                <option value="Maple Syrup">Maple Syrup</option>
            </select>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="raw_name">Or Enter a New Ingredient</label>
            <input type="text" name="raw_name" id="raw_name" class="form-control" placeholder="Enter new ingredient">
        </div>
    </div>
</div>


                    <div class="form-group">
                        <label for="raw_unit_of_measure">Unit of Measure</label>
                        <select name="raw_unit_of_measure" id="raw_unit_of_measure" class="form-control" required>
                            <option value="" disabled selected>Select a unit</option>
                            <option value="kg">Kilograms (kg)</option>
                            <option value="g">Grams (g)</option>
                            <option value="L">Liters (L)</option>
                            <option value="mL">Milliliters (mL)</option>
                            <option value="pcs">Pieces (pcs)</option>
                            <option value="packs">Packs</option>
                            <option value="bottles">Bottles</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="raw_stock_quantity">Stock Quantity</label>
                        <input type="number" name="raw_stock_quantity" id="raw_stock_quantity" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="raw_stock_quantity">Stock In</label>
                        <input type="number" name="raw_stock_quantity" id="raw_stock_in" class="form-control" disabled>
                    </div>

                    <div class="form-group">
                        <label for="raw_stock_quantity">Stock Out</label>
                        <input type="number" name="raw_stock_quantity" id="raw_stock_out" class="form-control" disabled>
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

                 

                    <!-- Raw Description -->
                    <div class="form-group">
                        <label for="edit-raw-description">Name</label>
                        <input type="text" name="raw_name" id="edit-raw-description" class="form-control" required>
                    </div>

                    <!-- Unit of Measure -->
                    <div class="form-group">
                        <label for="edit-raw-unit">Unit of Measure</label>
                        <input type="text" name="raw_unit_of_measure" id="edit-raw-unit" class="form-control" required>
                    </div>

                    <!-- Stock Quantity -->
                    <div class="form-group">
                        <label for="edit-raw-stock">Stock Quantity</label>
                        <input type="number" name="raw_stock_quantity" id="edit-raw-stock" class="form-control" required>
                    </div>

                    <!-- Stock In -->
                    <div class="form-group">
                        <label for="edit-raw-stock-in">Stock In</label>
                        <input type="number" name="raw_stock_in" id="edit-raw-stock-in" class="form-control" required>
                    </div>

                    <!-- Stock Out -->
                    <div class="form-group">
                        <label for="edit-raw-stock-out">Stock Out</label>
                        <input type="number" name="raw_stock_out" id="edit-raw-stock-out" class="form-control" required>
                    </div>

                    <!-- Cost Per Unit -->
                    <div class="form-group">
                        <label for="edit-raw-cost">Cost Per Unit</label>
                        <input type="number" step="0.01" name="raw_cost_per_unit" id="edit-raw-cost" class="form-control" required>
                    </div>

                    <!-- Reorder Level -->
                    <div class="form-group">
                        <label for="edit-raw-reorder">Reorder Level</label>
                        <input type="number" name="raw_reorder_level" id="edit-raw-reorder" class="form-control" required>
                    </div>

                    <!-- Category Selection -->
                    <div class="form-group">
                        <label for="edit-raw-category">Category</label>
                        <select name="category_id" id="edit-raw-category" class="form-control" required>
                            <?php 
                            mysqli_data_seek($category_result, 0);
                            while ($row = mysqli_fetch_assoc($category_result)): ?>
                                <option value="<?= $row['category_id']; ?>">
                                    <?= $row['category_name']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <!-- Employee Selection -->
                    <div class="form-group">
                        <label for="edit-raw-employee">Employee</label>
                        <select name="employee_id" id="edit-raw-employee" class="form-control" required>
                            <?php 
                            mysqli_data_seek($employee_result, 0);
                            while ($row = mysqli_fetch_assoc($employee_result)): ?>
                                <option value="<?= $row['employee_id']; ?>">
                                    <?= $row['employee_name']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <!-- Supplier Selection -->
                    <div class="form-group">
                        <label for="edit-raw-supplier">Supplier</label>
                        <select name="supplier_id" id="edit-raw-supplier" class="form-control" required>
                            <?php 
                            mysqli_data_seek($supplier_result, 0);
                            while ($row = mysqli_fetch_assoc($supplier_result)): ?>
                                <option value="<?= $row['supplier_id']; ?>">
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


<script>
    function updateRawName() {
        // Get selected value from dropdown
        var selectedValue = document.getElementById("raw_name_select").value;
        // Set the input field with selected value
        document.getElementById("raw_name").value = selectedValue;
    }
</script>
