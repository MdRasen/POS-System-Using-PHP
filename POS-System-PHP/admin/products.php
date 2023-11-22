<?php
include('includes/header.php');
?>

<main>
    <div class="container-fluid px-4">
        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Products
                    <a href="product-create.php" class="btn btn-primary float-end">Add Product</a>
                </h4>

            </div>
            <div class="card-body">
                <?php alertMessage() ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Price(Tk)</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $products = getAll('products');
                            if (mysqli_num_rows($products) > 0) {
                                foreach ($products as $item) :
                            ?>
                                    <tr>
                                        <td><?= $item['id'] ?></td>
                                        <td><img src="../<?= $item['image'] ?>" alt="image" style="width:50px; height:50px"></td>
                                        <td><?= $item['name'] ?></td>
                                        <td><?= $item['price'] ?></td>
                                        <td><?= $item['quantity'] ?></td>
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
                                            <a href="product-edit.php?id=<?= $item['id']; ?>" class="btn btn-sm btn-success">Edit</a>
                                            <a href="product-delete.php?id=<?= $item['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
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