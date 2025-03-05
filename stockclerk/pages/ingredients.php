<?php 
include 'functions/ingredients-functions.php'; 
?>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-4" style="max-width: 100%;">

    <h4 class="text-left">Raw Ingredients Management</h4>
    <br>

    <!-- Align the button to the top-right corner -->
    <div class="row mb-4">
        <div class="col-md-12 text-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addRawIngredientModal">Add New Ingredient</button>
        </div>
    </div>

    <hr>
    <div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Category</th>
                <th>Name</th>
                <th>Unit</th>
                <th>Quantity</th>
                <th>StockIn</th>
                <th>StockOut</th>
                <th>Cost/Unit</th>
                <th>Reorder Level</th>
                <th>Supplier</th>
                <th>Employee</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result): ?>
                <?php while ($ingredient = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($ingredient['category_name']); ?></td>
                        <td><?php echo htmlspecialchars($ingredient['raw_name']); ?></td>
                        <td><?php echo htmlspecialchars($ingredient['raw_unit_of_measure']); ?></td>
                        <td style="text-align: center; font-weight: bold; 
                            <?php echo ($ingredient['raw_stock_quantity'] < $ingredient['raw_reorder_level']) ? 'color: red; background-color: #ffe6e6; border-radius: 5px; padding: 5px;' : 'color: black;'; ?>">
                            <?php echo htmlspecialchars($ingredient['raw_stock_quantity']); ?>
                            <?php if ($ingredient['raw_stock_quantity'] < $ingredient['raw_reorder_level']): ?>
                                <span style="display: block; font-size: 12px; background: red; color: white; padding: 3px 6px; border-radius: 5px; margin-top: 3px;">
                                    Low Stock
                                </span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo htmlspecialchars($ingredient['raw_stock_in']); ?></td>
                        <td><?php echo htmlspecialchars($ingredient['raw_stock_out']); ?></td>
                        <td><?php echo htmlspecialchars($ingredient['item_cost']); ?></td>
                        <td><?php echo htmlspecialchars($ingredient['raw_reorder_level']); ?></td>
                        <td><?php echo htmlspecialchars($ingredient['supplier_name']); ?></td>
                        <td><?php echo htmlspecialchars($ingredient['employee_name']); ?></td>
                        <td class="text-center">
                            <a href="edit_ingredient.php?id=<?php echo htmlspecialchars($ingredient['raw_ingredient_id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_ingredient.php?id=<?php echo htmlspecialchars($ingredient['raw_ingredient_id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this ingredient?')">Delete</a>

                        <!-- Stock In Button -->
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#stockInModal" onclick="stockIn(<?php echo $ingredient['raw_ingredient_id']; ?>, '<?php echo htmlspecialchars($ingredient['raw_name']); ?>')">
                                Stock In
                            </button>

                            <!-- Stock Out Button -->
                            <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#stockOutModal" onclick="stockOut(<?php echo $ingredient['raw_ingredient_id']; ?>, '<?php echo htmlspecialchars($ingredient['raw_name']); ?>')">
                                Stock Out
                            </button>

                        </td>

                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="11" class="text-center">No ingredients found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    </div>

    <?php include 'modals/ingredients-modal.php'; ?>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
