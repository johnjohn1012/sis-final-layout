<?php 
include 'functions/ingredients-functions.php'; 
?>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-7" style="max-width: 100%; width: 120%;">
    <h1 class="text-left">Raw Ingredients Management</h1>
    <br>

    <div class="row mb-4">
        <!-- Show Entries Dropdown -->
        <div class="col-md-4">
            <form method="GET" action="index_admin.php?page=raw-ingredients">
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
            <form method="GET" action="index_admin.php?page=raw-ingredients">
                <div class="form-inline w-100">
                    <input type="text" name="search" class="form-control w-75" placeholder="Search Raw Ingredients...">
                    <button type="submit" class="btn btn-primary ml-2">Search</button>
                </div>
            </form>
        </div>

        <!-- Add New Raw Ingredient Button -->
        <div class="col-md-4 text-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addRawIngredientModal">Add New Ingredient</button>
        </div>
    </div>

    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                      <th>Category</th>
                    <th>Ingredient Name</th>
                    <th>Unit of Measure</th>
                    <th>Stock Quantity</th>
                    <th>Cost per Unit</th>
                    <th>Reorder Level</th>
                    <th>Supplier</th>
                   
                    <th>Employee</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result): ?>
                    <?php while ($ingredient = mysqli_fetch_assoc($result)): ?>
    <tr>
        <!-- Category Name -->
        <td><?php echo $ingredient['category_name']; ?></td>

        <!-- Raw Name -->
        <td><?php echo $ingredient['raw_name']; ?></td>

        <!-- Unit of Measure -->
        <td><?php echo $ingredient['raw_unit_of_measure']; ?></td>

        <!-- Stock Quantity -->
        <td><?php echo $ingredient['raw_stock_quantity']; ?></td>

        <!-- Cost Per Unit -->
        <td><?php echo $ingredient['raw_cost_per_unit']; ?></td>

        <!-- Reorder Level -->
        <td><?php echo $ingredient['raw_reorder_level']; ?></td>

        <!-- Supplier Name -->
        <td><?php echo $ingredient['supplier_name']; ?></td>

        <!-- Employee Name -->
        <td><?php echo $ingredient['employee_name']; ?></td>

        <td class="text-center">
            <div class="btn-group" role="group">
                <!-- View Button -->
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewRawIngredientModal" 
                    onclick="viewRawIngredient('<?php echo $ingredient['raw_ingredient_id']; ?>', 
                                               '<?php echo $ingredient['raw_name']; ?>', 
                                               '<?php echo $ingredient['raw_unit_of_measure']; ?>', 
                                               '<?php echo $ingredient['raw_stock_quantity']; ?>', 
                                               '<?php echo $ingredient['raw_cost_per_unit']; ?>', 
                                               '<?php echo $ingredient['raw_reorder_level']; ?>', 
                                               '<?php echo $ingredient['supplier_name']; ?>', 
                                               '<?php echo $ingredient['employee_name']; ?>')" 
                    style="margin: 0 5px;">
                    View
                </button>

                <!-- Edit Button -->
                <button onclick="openEditForm(
                    <?php echo $ingredient['raw_ingredient_id']; ?>, 
                    '<?php echo $ingredient['category_name']; ?>', 
                    '<?php echo $ingredient['raw_name']; ?>', 
                    '<?php echo $ingredient['raw_unit_of_measure']; ?>', 
                    '<?php echo $ingredient['raw_stock_quantity']; ?>', 
                    '<?php echo $ingredient['raw_cost_per_unit']; ?>', 
                    '<?php echo $ingredient['raw_reorder_level']; ?>', 
                    '<?php echo $ingredient['supplier_name']; ?>', 
                    '<?php echo $ingredient['employee_name']; ?>')"
                    class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editRawIngredientModal"
                    style="margin: 0 5px;">
                    Edit
                </button>

                <!-- Delete Button -->
                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteRawIngredientModal"
                    onclick="setDeleteData(<?php echo $ingredient['raw_ingredient_id']; ?>, '<?php echo $ingredient['raw_name']; ?>')"
                    style="margin: 0 5px;">
                    Delete
                </button>
            </div>
        </td>
    </tr>
<?php endwhile; ?>

                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center">Error fetching raw ingredients: <?php echo mysqli_error($conn); ?></td>
                    </tr>
                <?php endif; ?>
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
            <li class="page-item active">
                <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">2</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">3</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>

    <?php include 'modals/ingredients-modal.php'; ?>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // JavaScript function to populate the modal with data for editing
function openEditForm(id, name, description, unit, stock, cost, reorder, category, employee, supplier) {
    // Set the values in the modal fields
    document.getElementById('edit-raw-ingredient-id').value = id;
    document.getElementById('edit-raw-name').value = name;
    document.getElementById('edit-raw-description').value = description;
    document.getElementById('edit-raw-unit').value = unit;
    document.getElementById('edit-raw-stock').value = stock;
    document.getElementById('edit-raw-cost').value = cost;
    document.getElementById('edit-raw-reorder').value = reorder;
    document.getElementById('edit-raw-category').value = category;
    document.getElementById('edit-raw-employee').value = employee;
    document.getElementById('edit-raw-supplier').value = supplier;
}


    function setDeleteData(id, name) {
    document.getElementById('delete-raw-ingredient-id').value = id;
    document.getElementById('raw-ingredient-name').value = name;
}



    function viewRawIngredient(id, name, unit, stock, cost, reorderLevel, supplier, employee) {
    // Populate the modal with raw ingredient data
    document.getElementById('view-raw-ingredient-id').innerText = id;
    document.getElementById('view-raw-ingredient-name').innerText = name;
    document.getElementById('view-raw-ingredient-unit').innerText = unit;
    document.getElementById('view-raw-ingredient-stock').innerText = stock;
    document.getElementById('view-raw-ingredient-cost').innerText = cost;
    document.getElementById('view-raw-ingredient-reorder-level').innerText = reorderLevel;
    document.getElementById('view-raw-ingredient-supplier').innerText = supplier;
    document.getElementById('view-raw-ingredient-employee').innerText = employee;


     
}

</script>
