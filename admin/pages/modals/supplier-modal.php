<!-- Add Supplier Modal -->
<div class="modal fade" id="addSupplierModal" tabindex="-1" role="dialog" aria-labelledby="addSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSupplierModalLabel">Add New Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="index_admin.php?page=suppliers" method="POST">
                    <div class="form-group">
                        <label for="supplier_name">Supplier Name</label>
                        <input type="text" name="supplier_name" id="supplier_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="contact_person">Contact Person</label>
                        <input type="text" name="contact_person" id="contact_person" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <button type="submit" name="add_supplier" class="btn btn-primary">Add Supplier</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Supplier Modal -->
<div class="modal fade" id="editSupplierModal" tabindex="-1" role="dialog" aria-labelledby="editSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSupplierModalLabel">Edit Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="index_admin.php?page=suppliers" method="POST">
                    <input type="hidden" name="supplier_id" id="edit-supplier-id">
                    <div class="form-group">
                        <label for="edit-supplier-name">Supplier Name</label>
                        <input type="text" name="supplier_name" id="edit-supplier-name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-contact-person">Contact Person</label>
                        <input type="text" name="contact_person" id="edit-contact-person" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-address">Address</label>
                        <input type="text" name="address" id="edit-address" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-phone">Phone</label>
                        <input type="text" name="phone" id="edit-phone" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-email">Email</label>
                        <input type="email" name="email" id="edit-email" class="form-control" required>
                    </div>
                    <button type="submit" name="edit_supplier" class="btn btn-primary">Update Supplier</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Supplier Confirmation Modal -->
<div class="modal fade" id="deleteSupplierModal" tabindex="-1" role="dialog" aria-labelledby="deleteSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteSupplierModalLabel">Confirm Deletion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this supplier?
                <form id="delete-supplier-form" action="index_admin.php?page=suppliers" method="POST">
                    <input type="hidden" name="delete" id="delete-supplier-id">
                    <div class="form-group">
                        <label for="supplier-name">Supplier Name</label>
                        <input type="text" id="supplier-name" class="form-control" disabled>
                    </div>
                    <button type="submit" class="btn btn-danger">Delete Supplier</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
