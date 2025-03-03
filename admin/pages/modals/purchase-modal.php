<!-- Add Purchase Order Modal -->
<div class="modal fade" id="addPurchaseModal" tabindex="-1" role="dialog" aria-labelledby="addPurchaseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPurchaseModalLabel">Add New Purchase Order</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="index_admin.php?page=purchase_orders" method="POST">
                    <div class="form-group">
                        <label for="supplier_id">Supplier</label>
                        <select name="supplier_id" id="supplier_id" class="form-control" required>
                            <option value="">Select Supplier</option>
                            <?php while($row = mysqli_fetch_assoc($supplier_result)): ?>
                                <option value="<?= $row['supplier_id']; ?>"><?= $row['supplier_name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="purchase_order_date">Order Date</label>
                        <input type="date" name="purchase_order_date" id="purchase_order_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="purchase_expected_delivery_date">Expected Delivery Date</label>
                        <input type="date" name="purchase_expected_delivery_date" id="purchase_expected_delivery_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="employee_id">Employee</label>
                        <select name="employee_id" id="employee_id" class="form-control" required>
                            <option value="">Select Employee</option>
                            <?php while($row = mysqli_fetch_assoc($employee_result)): ?>
                                <option value="<?= $row['employee_id']; ?>"><?= $row['employee_name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button type="submit" name="add_purchase" class="btn btn-primary">Add Purchase Order</button>
                </form>
            </div>
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
