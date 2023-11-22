<?php
include('includes/header.php');
?>

<main>
    <div class="container-fluid px-4">
        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Admins
                    <a href="admin-create.php" class="btn btn-primary float-end">Add Admin</a>
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
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $admins = getAll('admins');
                            if (mysqli_num_rows($admins) > 0) {
                                foreach ($admins as $adminItem) :
                            ?>
                                    <tr>
                                        <td><?= $adminItem['id'] ?></td>
                                        <td><?= $adminItem['name'] ?></td>
                                        <td><?= $adminItem['email'] ?></td>
                                        <td><?= $adminItem['phone'] ?></td>
                                        <td>
                                            <?php
                                            if ($adminItem['is_ban'] == 1) {
                                                echo '<span class="badge bg-danger">Banned</span>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="admin-edit.php?id=<?= $adminItem['id']; ?>" class="btn btn-sm btn-success">Edit</a>
                                            <a href="admin-delete.php?id=<?= $adminItem['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                            } else {
                                ?>
                                <tr>
                                    <td colspan="6" class="text-center">No Records Found!</td>
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