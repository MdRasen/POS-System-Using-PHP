<?php
include('includes/header.php');
?>

<main>
    <div class="container-fluid px-4">
        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Categories
                    <a href="category-create.php" class="btn btn-primary float-end">Add Category</a>
                </h4>

            </div>
            <div class="card-body">
                <?php alertMessage() ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $categories = getAll('categories');
                            if (mysqli_num_rows($categories) > 0) {
                                foreach ($categories as $item) :
                            ?>
                                    <tr>
                                        <td><?= $item['id'] ?></td>
                                        <td><?= $item['name'] ?></td>
                                        <td><?= $item['description'] ?></td>
                                        <td>
                                            <?php
                                            if ($item['status'] == 1) {
                                                echo '<span class="badge bg-danger">Hidden</span>';
                                            } else {
                                                echo '<span class="badge bg-primary">Visible</span>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="category-edit.php?id=<?= $item['id']; ?>" class="btn btn-sm btn-success">Edit</a>
                                            <a href="category-delete.php?id=<?= $item['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                            } else {
                                ?>
                                <tr>
                                    <td colspan="4" class="text-center">No Records Found!</td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
include('includes/footer.php');
?>