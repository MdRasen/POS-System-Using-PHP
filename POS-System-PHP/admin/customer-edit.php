<?php
include('includes/header.php');
?>

<main>
    <div class="container-fluid px-4">
        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Edit Customer
                    <a href="customers.php" class="btn btn-primary float-end">Go Back</a>
                </h4>

            </div>
            <div class="card-body">
                <?php alertMessage() ?>
                <form action="code.php" method="POST">
                    <?php
                    if (isset($_GET['id'])) {
                        if ($_GET['id'] != "") {
                            $customerId = $_GET["id"];
                        } else {
                            echo '<h5>No id found!</h5>';
                            return false;
                        }
                    } else {
                        echo '<h5>No id given in params!</h5>';
                        return false;
                    }

                    $customerInfo = getById("customers", $customerId);
                    if ($customerInfo) {
                        if ($customerInfo['status'] == 200) {
                    ?>
                            <input type="hidden" name="customer_id" value="<?= $customerInfo['data']['id'] ?>">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name">Name *</label>
                                    <input type="text" name="name" class="form-control" value="<?= $customerInfo['data']['name'] ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone">Phone *</label>
                                    <input type="number" name="phone" class="form-control" value="<?= $customerInfo['data']['phone'] ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" value="<?= $customerInfo['data']['email'] ?>">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="address">Address</label>
                                    <textarea name="address" class="form-control" rows="3"><?= $customerInfo['data']['address'] ?></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="status">Status (Unchecked = Visible; Checked=Hidden)</label>
                                    <br>
                                    <input type="checkbox" name="status" style="width: 30px; height:30px;" <?= $customerInfo['data']['status'] == true ? "checked" : "" ?>>
                                </div>
                                <div class="col-md-6 mb-3 text-end">
                                    <button type="submit" name="updateCustomer" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                    <?php
                        } else {
                            echo '<h5>' . $customerInfo['message'] . '</h5>';
                        }
                    } else {
                        echo '<h5>Something went wrong2!</h5>';
                        return false;
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</main>

<?php
include('includes/footer.php');
?>