<!-- Add Purchase Item Modal -->
<div class="modal fade" id="addPurchaseItemModal" tabindex="-1" role="dialog" aria-labelledby="addPurchaseItemModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPurchaseItemModalLabel">Add New Purchase Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="index_admin.php?page=purchase_items">
                <div class="modal-body">
                    <!-- Select Purchase Order -->
                    <div class="form-group">
                        <label for="purchase_order_id">Purchase Order</label>
                        <select name="purchase_order_id" class="form-control" required>
                            <?php
                            // Fetch purchase orders from the database
                            $query = "SELECT * FROM tbl_purchase_order_list";
                            $result = mysqli_query($conn, $query);
                            while ($order = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $order['purchase_order_id'] . "'>" . "Order #" . $order['purchase_order_id'] . " - " . $order['purchase_order_date'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Select Raw Ingredient -->
                    <div class="form-group">
                        <label for="raw_ingredient_id">Raw Ingredient</label>
                        <select name="raw_ingredient_id" class="form-control" required>
                            <?php
                            // Fetch raw ingredients from the database
                            $query = "SELECT * FROM tbl_raw_ingredients";
                            $result = mysqli_query($conn, $query);
                            while ($ingredient = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $ingredient['raw_ingredient_id'] . "'>" . $ingredient['ingredient_name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Quantity Ordered -->
                    <div class="form-group">
                        <label for="quantity_ordered">Quantity Ordered</label>
                        <input type="number" name="quantity_ordered" class="form-control" required min="1">
                    </div>

                    <!-- Quantity Received -->
                    <div class="form-group">
                        <label for="quantity_received">Quantity Received</label>
                        <input type="number" name="quantity_received" class="form-control" min="0">
                    </div>

                    <!-- Back Ordered Quantity -->
                    <div class="form-group">
                        <label for="back_ordered_quantity">Back Ordered Quantity</label>
                        <input type="number" name="back_ordered_quantity" class="form-control" min="0">
                    </div>

                    <!-- Select Employee (Stock Clerk) -->
                    <div class="form-group">
                        <label for="employee_id">Employee (Stock Clerk)</label>
                        <select name="employee_id" class="form-control" required>
                            <?php
                            // Fetch employees from the database
                            $query = "SELECT * FROM tbl_employee";
                            $result = mysqli_query($conn, $query);
                            while ($employee = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $employee['employee_id'] . "'>" . $employee['first_name'] . " " . $employee['last_name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create Purchase Item</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Purchase Order Modal -->
<div class="modal fade" id="editPurchaseModal" tabindex="-1" role="dialog" aria-labelledby="editPurchaseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPurchaseModalLabel">Edit Purchase Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="index_admin.php?page=purchase_orders" method="POST">
                    <input type="hidden" name="purchase_order_id" id="edit-purchase-id">
                    <div class="form-group">
                        <label for="edit-supplier-id">Supplier</label>
                        <select name="supplier_id" id="edit-supplier-id" class="form-control" required>
                            <?php while($row = mysqli_fetch_assoc($supplier_result)): ?>
                                <option value="<?= $row['supplier_id']; ?>"><?= $row['supplier_name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit-purchase-order-date">Order Date</label>
                        <input type="date" name="purchase_order_date" id="edit-purchase-order-date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-purchase-expected-delivery-date">Expected Delivery Date</label>
                        <input type="date" name="purchase_expected_delivery_date" id="edit-purchase-expected-delivery-date" class="form-control" required>
                    </div>
                    <button type="submit" name="edit_purchase" class="btn btn-primary">Update Purchase Order</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Purchase Order Confirmation Modal -->
<div class="modal fade" id="deletePurchaseModal" tabindex="-1" role="dialog" aria-labelledby="deletePurchaseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deletePurchaseModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this purchase order?
                <form id="delete-purchase-form" action="index_admin.php?page=purchase_orders" method="POST">
                    <input type="hidden" name="delete" id="delete-purchase-id">
                    <button type="submit" class="btn btn-danger">Delete Purchase Order</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
