<?php
include('includes/header.php');
?>

<main>
    <div class="container-fluid px-4">
        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Edit Product
                    <a href="products.php" class="btn btn-primary float-end">Go Back</a>
                </h4>

            </div>
            <div class="card-body">
                <?php alertMessage() ?>
                <form action="code.php" method="POST" enctype="multipart/form-data">

                    <?php

                    if (isset($_GET['id'])) {
                        if ($_GET['id'] != "") {
                            $productId = $_GET["id"];
                        } else {
                            echo '<h5>No id found!</h5>';
                            return false;
                        }
                    } else {
                        echo '<h5>No id given in params!</h5>';
                        return false;
                    }

                    $productInfo = getById("products", $productId);
                    if ($productInfo) {
                        if ($productInfo['status'] == 200) {
                    ?>
                            <input type="hidden" name="product_id" value="<?= $productInfo['data']['id']; ?>">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="category_id">Select Category *</label>
                                    <select name="category_id" class="form-control" required>
                                        <option value="not_defined">Select category</option>
                                        <?php
                                        $categories = getAll('categories');
                                        if (mysqli_num_rows($categories) > 0) {
                                            foreach ($categories as $item) :
                                        ?>
                                                <option value="<?= $item['id'] ?>" <?= $productInfo['data']['category_id'] == $item['id'] ? "selected" : ''; ?>><?= $item['name'] ?></option>
                                        <?php
                                            endforeach;
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="name">Product Name *</label>
                                    <input type="text" name="name" class="form-control" value="<?= $productInfo['data']['name']; ?>" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="description">Description</label>
                                    <textarea name="description" class="form-control" rows="3"><?= $productInfo['data']['description']; ?></textarea>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="price">Price *</label>
                                    <input type="number" name="price" class="form-control" value="<?= $productInfo['data']['price']; ?>" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="quantity">Quantity *</label>
                                    <input type="number" name="quantity" class="form-control" value="<?= $productInfo['data']['quantity']; ?>" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" class="form-control">
                                    <img src="../<?= $productInfo['data']['image']; ?>" alt="image" style="width:40px; height:40px; padding-top:5px">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="status">Status (Unchecked = Visible; Checked=Hidden)</label>
                                    <br>
                                    <input type="checkbox" name="status" style="width: 30px; height:30px;" <?= $productInfo['data']['status'] == true ? "checked" : ""; ?>>
                                </div>
                                <div class="col-md-6 mb-3 text-end">
                                    <button type="submit" name="updateProduct" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                    <?php
                        } else {
                            echo '<h5>' . $productInfo['message'] . '</h5>';
                        }
                    } else {
                        echo '<h5>Something went wrong!</h5>';
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