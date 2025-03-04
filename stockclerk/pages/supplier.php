<?php include 'functions/supplier-functions.php'; ?>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-7" style="max-width: 100%; width: 120%;">
    <h4 class="text-left">Supplier Management</h4>
    <br>

    <div class="row mb-4">
        <!-- Show Entries Dropdown -->
        <div class="col-md-4">
            <form method="GET" action="index_admin.php?page=supplier">
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
            <form method="GET" action="index_admin.php?page=supplier">
                <div class="form-inline w-100">
                    <input type="text" name="search" class="form-control w-75" placeholder="Search Suppliers...">
                    <button type="submit" class="btn btn-primary ml-2">Search</button>
                </div>
            </form>
        </div>

        <!-- Add New Supplier Button to Trigger Modal -->
        <div class="col-md-4 text-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addSupplierModal">Add New Supplier</button>
        </div>
    </div>

    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Supplier Name</th>
                    <th>Contact Person</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($supplier = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $supplier['supplier_name']; ?></td>
                        <td><?php echo $supplier['contact_person']; ?></td>
                        <td><?php echo $supplier['address']; ?></td>
                        <td><?php echo $supplier['phone']; ?></td>
                        <td><?php echo $supplier['email']; ?></td>
                        <td><?php echo $supplier['created_at']; ?></td>
                        <td>
                            <button onclick="openEditForm(<?php echo $supplier['supplier_id']; ?>, '<?php echo $supplier['supplier_name']; ?>', '<?php echo $supplier['contact_person']; ?>', '<?php echo $supplier['address']; ?>', '<?php echo $supplier['phone']; ?>', '<?php echo $supplier['email']; ?>')" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editSupplierModal">Edit</button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteSupplierModal" onclick="setDeleteData(<?php echo $supplier['supplier_id']; ?>, '<?php echo $supplier['supplier_name']; ?>')">Delete</button>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
                        
                <nav>
                <ul class="pagination justify-content-end">
                    <!-- Previous Page Link -->
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>

                    <!-- Page Numbers -->
                    <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>

                    <!-- Next Page Link -->
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
                 </nav>
    <?php include 'modals/supplier-modal.php'; ?>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function openEditForm(id, name, contact, address, phone, email) {
        document.getElementById('edit-supplier-id').value = id;
        document.getElementById('edit-supplier-name').value = name;
        document.getElementById('edit-contact-person').value = contact;
        document.getElementById('edit-address').value = address;
        document.getElementById('edit-phone').value = phone;
        document.getElementById('edit-email').value = email;
    }

    function setDeleteData(id, name) {
        document.getElementById('delete-supplier-id').value = id;
        document.getElementById('supplier-name').value = name;
    }
</script>
