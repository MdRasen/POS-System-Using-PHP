<?php
include('includes/header.php');
?>

<main>
    <div class="container-fluid px-4">
        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Add Admin
                    <a href="admins.php" class="btn btn-primary float-end">Go Back</a>
                </h4>

            </div>
            <div class="card-body">
                <?php alertMessage() ?>
                <form action="code.php" method="POST">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name">Name *</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email">Email *</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone">Phone</label>
                            <input type="number" name="phone" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="password">Password *</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="is_ban">Ban *</label>
                            <br>
                            <input type="checkbox" name="is_ban" style="width: 30px; height:30px;">
                        </div>
                        <div class="col-md-3 mb-3 text-end">
                            <button type="submit" name="saveAdmin" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php
include('includes/footer.php');
?>