<?php
include('includes/header.php');
?>
<main>
    <div class="container-fluid px-4">
        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-4">
                        <h4 class="mb-0">Orders</h4>
                    </div>
                    <div class="col-md-8 ">
                        <form action="" method="GET">
                            <div class="row g-1">
                                <div class="col-md-4">
                                    <input type="date" name="date" class="form-control" value="<?= isset($_GET['date']) == true ? $_GET['date'] : '' ?>">
                                </div>
                                <div class="col-md-4">
                                    <select name="payment_mode" class="form-control">
                                        <option value="">Select Payment Mode</option>
                                        <option value="Cash Payment" <?= isset($_GET['payment_mode']) == true ? ($_GET['payment_mode'] == 'Cash Payment' ? 'selected' : '') : '' ?>>Cash Payment</option>
                                        <option value="Online Payment" <?= isset($_GET['payment_mode']) == true ? ($_GET['payment_mode'] == 'Online Payment' ? 'selected' : '') : '' ?>>Online Payment</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                    <a href="orders.php" class="btn btn-danger">Reset</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-item-center justify-content-center">
                        <thead>
                            <tr>
                                <th>Tracking No.</th>
                                <th>C Name</th>
                                <th>C Phone</th>
                                <th>Order Date</th>
                                <th>Order Status</th>
                                <th>Payment Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if (isset($_GET['date']) || isset($_GET['payment_mode'])) {
                                $orderDate = validate($_GET['date']);
                                $paymentMode = validate($_GET['payment_mode']);
                                if ($orderDate != '' && $paymentMode != '') {
                                    $query = "SELECT o.*, c.* FROM orders o, customers c WHERE c.id = o.customer_id AND o.order_date='$orderDate' AND o.payment_mode='$paymentMode' ORDER BY o.id DESC";
                                } elseif ($orderDate != '' && $paymentMode == '') {
                                    $query = "SELECT o.*, c.* FROM orders o, customers c WHERE c.id = o.customer_id AND o.order_date='$orderDate' ORDER BY o.id DESC";
                                } else {
                                    $query = "SELECT o.*, c.* FROM orders o, customers c WHERE c.id = o.customer_id AND o.payment_mode='$paymentMode' ORDER BY o.id DESC";
                                }
                            } else {
                                $query = "SELECT o.*, c.* FROM orders o, customers c WHERE c.id = o.customer_id ORDER BY o.id DESC";
                            }
                            $orders = mysqli_query($conn, $query);
                            if ($orders) {
                                if (mysqli_num_rows($orders)) {
                                    foreach ($orders as $orderItem) :
                            ?>
                                        <tr>
                                            <td class="fw-bold"><?= $orderItem['tracking_no'] ?></td>
                                            <td><?= $orderItem['name'] ?></td>
                                            <td><?= $orderItem['phone'] ?></td>
                                            <td><?= date('d M, y', strtotime($orderItem['order_date'])) ?></td>
                                            <td><?= $orderItem['order_status'] ?></td>
                                            <td><?= $orderItem['payment_mode'] ?></td>
                                            <td>
                                                <a href="orders-view.php?track=<?= $orderItem['tracking_no'] ?>" class="btn btn-info mb-0 px-2 btn-sm">View</a>
                                                <a href="orders-view-print.php?track=<?= $orderItem['tracking_no'] ?>" class="btn btn-primary mb-0 px-2 btn-sm">Print</a>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No record available.</td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="7" class="text-center">Something went wrong.</td>
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