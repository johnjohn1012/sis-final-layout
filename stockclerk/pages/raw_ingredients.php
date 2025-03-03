<?php include 'functions/raw-ingredients-functions.php'; ?>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-7" style="max-width: 100%; width: 120%;">
    <h1 class="text-left">Raw Ingredients Management</h1>
    <br>

    <div class="row mb-4">
        <!-- Show Entries Dropdown -->
        <div class="col-md-4">
            <form method="GET" action="index_admin.php?page=raw_ingredients">
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
            <form method="GET" action="index_admin.php?page=raw_ingredients">
                <div class="form-inline w-100">
                    <input type="text" name="search" class="form-control w-75" placeholder="Search Raw Ingredients...">
                    <button type="submit" class="btn btn-primary ml-2">Search</button>
                </div>
            </form>
        </div>

        <!-- Add New Raw Ingredient Button to Trigger Modal -->
        <div class="col-md-4 text-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addRawIngredientModal">Add New Raw Ingredient</button>
        </div>
    </div>

    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Unit of Measure</th>
                    <th>Stock Quantity</th>
                    <th>Cost per Unit</th>
                    <th>Reorder Level</th>
                    <th>Supplier</th>
                    <th>Category</th>
                    <th>Created At</th>
                    <th>Employee</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($ingredient = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $ingredient['raw_name']; ?></td>
                        <td><?php echo $ingredient['raw_description']; ?></td>
                        <td><?php echo $ingredient['raw_unit_of_measure']; ?></td>
                        <td><?php echo $ingredient['raw_stock_quantity']; ?></td>
                        <td><?php echo $ingredient['raw_cost_per_unit']; ?></td>
                        <td><?php echo $ingredient['raw_reorder_level']; ?></td>
                        <td><?php echo $ingredient['raw_supplier_id']; ?></td>
                        <td><?php echo $ingredient['category_id']; ?></td>
                        <td><?php echo $ingredient['raw_created_at']; ?></td>
                        <td><?php echo $ingredient['employee_id']; ?></td>
                        <td>
                            <button onclick="openEditForm(<?php echo $ingredient['raw_ingredient_id']; ?>, '<?php echo $ingredient['raw_name']; ?>', '<?php echo $ingredient['raw_description']; ?>', '<?php echo $ingredient['raw_unit_of_measure']; ?>', '<?php echo $ingredient['raw_stock_quantity']; ?>', '<?php echo $ingredient['raw_cost_per_unit']; ?>', '<?php echo $ingredient['raw_reorder_level']; ?>', '<?php echo $ingredient['raw_supplier_id']; ?>', '<?php echo $ingredient['category_id']; ?>', '<?php echo $ingredient['employee_id']; ?>')" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editRawIngredientModal">Edit</button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteRawIngredientModal" onclick="setDeleteData(<?php echo $ingredient['raw_ingredient_id']; ?>, '<?php echo $ingredient['raw_name']; ?>')">Delete</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <?php include 'modals/raw-ingredients-modal.php'; ?>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function openEditForm(id, name, description, unit, stock, cost, reorder, supplier, category, employee) {
        document.getElementById('edit-raw-ingredient-id').value = id;
        document.getElementById('edit-raw-name').value = name;
        document.getElementById('edit-raw-description').value = description;
        document.getElementById('edit-raw-unit-of-measure').value = unit;
        document.getElementById('edit-raw-stock-quantity').value = stock;
        document.getElementById('edit-raw-cost-per-unit').value = cost;
        document.getElementById('edit-raw-reorder-level').value = reorder;
        document.getElementById('edit-raw-supplier-id').value = supplier;
        document.getElementById('edit-category-id').value = category;
        document.getElementById('edit-employee-id').value = employee;
    }

    function setDeleteData(id, name) {
        document.getElementById('delete-raw-ingredient-id').value = id;
        document.getElementById('delete-raw-name').value = name;
    }
</script>
