<?php
include('includes/header.php');
?>

<main>
    <div class="container-fluid px-4">
        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Edit Admin
                    <a href="admins.php" class="btn btn-danger float-end">Go Back</a>
                </h4>

            </div>
            <div class="card-body">
                <?php alertMessage() ?>
                <form action="code.php" method="POST">
                    <?php
                    if (isset($_GET['id'])) {
                        if ($_GET['id'] != "") {
                            $adminId = $_GET["id"];
                        } else {
                            echo '<h5>No id found!</h5>';
                            return false;
                        }
                    } else {
                        echo '<h5>No id given in params!</h5>';
                        return false;
                    }

                    $adminInfo = getById("admins", $adminId);
                    if ($adminInfo) {
                        if ($adminInfo['status'] == 200) {
                    ?>
                            <input type="hidden" name="id" value="<?= $adminInfo['data']['id']; ?>">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name">Name *</label>
                                    <input type="text" name="name" class="form-control" value="<?= $adminInfo['data']['name']; ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email">Email *</label>
                                    <input type="email" name="email" class="form-control" value="<?= $adminInfo['data']['email']; ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="phone">Phone</label>
                                    <input type="number" name="phone" class="form-control" value="<?= $adminInfo['data']['phone']; ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="password">Password *</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="is_ban">Ban *</label>
                                    <br>
                                    <input type="checkbox" name="is_ban" style="width: 30px; height:30px;" <?= $adminInfo['data']['is_ban'] == true ? "checked" : "" ?>>
                                </div>
                                <div class="col-md-3 mb-3 text-end">
                                    <button type="submit" name="updateAdmin" class="btn btn-primary">Update</button>
                                </div>
                            </div>

                    <?php
                        } else {
                            echo '<h5>' . $adminInfo['message'] . '</h5>';
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