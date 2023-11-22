<?php
include('includes/header.php');
?>

<main>
    <div class="container-fluid px-4">
        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Edit Category
                    <a href="categories.php" class="btn btn-danger float-end">Go Back</a>
                </h4>

            </div>
            <div class="card-body">
                <?php alertMessage() ?>
                <form action="code.php" method="POST">

                    <?php
                    if (isset($_GET['id'])) {
                        if ($_GET['id'] != "") {
                            $categoryId = $_GET["id"];
                        } else {
                            echo '<h5>No id found!</h5>';
                            return false;
                        }
                    } else {
                        echo '<h5>No id given in params!</h5>';
                        return false;
                    }

                    $categoryInfo = getById("categories", $categoryId);
                    if ($categoryInfo) {
                        if ($categoryInfo['status'] == 200) {
                    ?>
                            <input type="hidden" name="id" value="<?= $categoryInfo['data']['id']; ?>">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name">Name *</label>
                                    <input type="text" name="name" class="form-control" value="<?= $categoryInfo['data']['name']; ?>" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="col-md-12 mb-3">
                                        <label for="description">Description</label>
                                        <textarea name="description" class="form-control" rows="3"><?= $categoryInfo['data']['description']; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="status">Status (Unchecked = Visible; Checked=Hidden)</label>
                                    <br>
                                    <input type="checkbox" name="status" style="width: 30px; height:30px;" <?= $categoryInfo['data']['status'] == true ? "checked" : "" ?>>
                                </div>
                                <div class="col-md-6 mb-3 text-end">
                                    <button type="submit" name="updateCategory" class="btn btn-primary">Update</button>
                                </div>
                            </div>

                    <?php
                        } else {
                            echo '<h5>' . $categoryInfo['message'] . '</h5>';
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