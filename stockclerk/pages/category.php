<?php include 'functions/category-functions.php'; ?>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-7" style="max-width: 100%; width: 120%;">
    <h1 class="text-left">Category Management</h1>

    <br>


                <div class="row mb-4">


                      <!-- Show Entries Dropdown -->
                      <div class="col-md-4">
                    <form method="GET" action="index_admin.php?page=category">
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
                    <form method="GET" action="index_admin.php?page=category">
                        <div class="form-inline w-100">
                            <input type="text" name="search" class="form-control w-75" placeholder="Search Categories...">
                            <button type="submit" class="btn btn-primary ml-2">Search</button>
                        </div>
                    </form>
                </div>

          

                <!-- Add New Category Button to Trigger Modal -->
                <div class="col-md-4 text-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">Add New Category</button>
                </div>
            </div>

    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Category Name</th>
                    <th>Description</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($category = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $category['category_name']; ?></td>
                        <td><?php echo $category['category_description']; ?></td>
                        <td><?php echo $category['created_at']; ?></td>
                        <td><?php echo $category['updated_at']; ?></td>
                        <td>
                            <!-- Edit and Delete Actions -->
                            <button onclick="openEditForm(<?php echo $category['category_id']; ?>, '<?php echo $category['category_name']; ?>', '<?php echo $category['category_description']; ?>')" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editCategoryModal">Edit</button>

                            <!-- Delete Button to Trigger Modal -->
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteCategoryModal" onclick="setDeleteData(<?php echo $category['category_id']; ?>, '<?php echo $category['category_name']; ?>')">Delete</button>
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


    <?php include 'modals/category-modal.php'; ?>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script>
    function openEditForm(id, name, description) {
        document.getElementById('edit-category-id').value = id;
        document.getElementById('edit-category-name').value = name;
        document.getElementById('edit-category-description').value = description;
    }

    function setDeleteData(id, name) {
    // Set the category ID in the hidden input field
    document.getElementById('delete-category-id').value = id;
    
    // Set the category name in the input field (readonly)
    document.getElementById('category-name').value = name;
}

</script>
