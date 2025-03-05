<?php
include 'functions/category-functions.php';
include 'functions/pagination.php';

?>

<div class="container my-7" style="max-width: 100%; width: 120%;">
    <h4 class="text-left">Category Management</h4>
    <br>

    <div class="row mb-4 align-items-center">
        <!-- Show Entries Dropdown -->
        <div class="col-md-3">
            <form method="GET" action="index_admin.php">
                <input type="hidden" name="page" value="category">
                <input type="hidden" name="search" value="<?= htmlspecialchars($search) ?>">
                <div class="form-inline">
                    <label for="limit" class="mr-2">Show</label>
                    <select name="limit" class="form-control" onchange="this.form.submit()">
                    <?php foreach (array(5, 10, 20, 50) as $option): ?>
                    <option value="<?= $option ?>" <?= $limit == $option ? 'selected' : '' ?>>
                        <?= $option ?>
                    </option>
                <?php endforeach; ?>

                    </select>
                    <label class="ml-2">entries</label>
                </div>
            </form>
        </div>

        <!-- Search Bar -->
        <div class="col-md-5">
            <form method="GET" action="index_admin.php">
                <input type="hidden" name="page" value="category">
                <input type="hidden" name="limit" value="<?= $limit ?>">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" 
                           placeholder="Search Categories..." 
                           value="<?= htmlspecialchars($search) ?>">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Print Button -->
        <div class="col-md-2 text-right">
            <button class="btn btn-secondary btn-sm" onclick="window.print()">
                <i class="fas fa-print"></i> Print
            </button>
        </div>

        <!-- Add New Category Button -->
        <div class="col-md-2 text-right">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal">
                Add New Category
            </button>
        </div>
    </div>
    <hr>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Category_Name</th>
                    <th>Description</th>
                    <th>Created_At</th>
                    <th>Updated_At</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(mysqli_num_rows($result) > 0): ?>
                    <?php while ($category = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= htmlspecialchars($category['category_name']) ?></td>
                            <td><?= htmlspecialchars($category['category_description']) ?></td>
                            <td><?= htmlspecialchars($category['created_at']) ?></td>
                            <td><?= htmlspecialchars($category['updated_at']) ?></td>
                            
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-info btn-sm" 
                                        data-toggle="modal" data-target="#viewCategoryModal"
                                        onclick="viewCategory(<?= htmlspecialchars(json_encode($category), ENT_QUOTES) ?>)"
                                        style="margin-right: 5px;">
                                        View
                                    </button>

                                    <button class="btn btn-warning btn-sm"
                                        data-toggle="modal" data-target="#editCategoryModal"
                                        onclick="openEditForm(<?= htmlspecialchars(json_encode($category), ENT_QUOTES) ?>)"
                                        style="margin-right: 5px;">
                                        Edit
                                    </button>

                                    <button type="button" class="btn btn-danger btn-sm" 
                                        data-toggle="modal" data-target="#deleteCategoryModal"
                                        onclick="setDeleteData(<?= $category['category_id'] ?>, <?= htmlspecialchars(json_encode($category['category_name']), ENT_QUOTES) ?>)">
                                        Delete
                                    </button>
                                </div>
                            </td>

                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No categories found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if ($totalPages > 1): ?>
    <nav>
        <ul class="pagination justify-content-end">
            <!-- Previous Page Link -->
            <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="index_admin.php?page=category&limit=<?= $limit ?>&search=<?= urlencode($search) ?>&page=<?= max(1, $page - 1) ?>" aria-label="Previous">
                    &laquo;
                </a>
            </li>

            <!-- Page Numbers -->
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                    <a class="page-link" href="index_admin.php?page=category&limit=<?= $limit ?>&search=<?= urlencode($search) ?>&page=<?= $i ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>

            <!-- Next Page Link -->
            <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                <a class="page-link" href="index_admin.php?page=category&limit=<?= $limit ?>&search=<?= urlencode($search) ?>&page=<?= min($totalPages, $page + 1) ?>" aria-label="Next">
                    &raquo;
                </a>
            </li>
        </ul>
    </nav>
<?php endif; ?>


    <?php include 'modals/category-modal.php'; ?>
</div>

<?php include 'js-functions/js-category.php'; ?>

<style>
    @media print {
        body * {
            visibility: hidden;
        }
        .table-responsive, .table-responsive * {
            visibility: visible;
        }
        .table-responsive {
            position: absolute;
            left: 0;
            top: 0;
        }
    }
</style>