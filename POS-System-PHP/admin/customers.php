<?php
include('includes/header.php');
?>

<main>
    <div class="container-fluid px-4">
        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Customers
                    <a href="customer-create.php" class="btn btn-primary float-end">Add Customer</a>
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
                            $customers = getAll('customers');
                            if (mysqli_num_rows($customers) > 0) {
                                foreach ($customers as $item) :
                            ?>
                                    <tr>
                                        <td><?= $item['id'] ?></td>
                                        <td><?= $item['name'] ?></td>
                                        <td><?= $item['email'] ?></td>
                                        <td><?= $item['phone'] ?></td>
                                        <td>
                                            <?php
                                            if ($item['status'] == 1) {
                                                echo '<span class="badge bg-danger">Banned</span>';
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="customer-edit.php?id=<?= $item['id']; ?>" class="btn btn-sm btn-success">Edit</a>
                                            <a href="customer-delete.php?id=<?= $item['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
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