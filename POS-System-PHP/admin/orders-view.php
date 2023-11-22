<?php
include('includes/header.php');
?>
<main>
    <div class="container-fluid px-4">
        <div class="card mt-4 shadow-sm">
            <div class="card-header">
                <h4 class="mb-0">Order View
                    <a href="orders-view-print.php?track=<?= $_GET['track'] ?>" class="btn mx-2 btn-sm btn-info float-end">Print</a>
                    <a href="orders.php" class="btn btn-sm btn-danger float-end">Go Back</a>
                </h4>
            </div>
            <div class="card-body">
                <?php
                alertMessage();

                if (isset($_GET['track'])) {
                    if ($_GET['track'] == "") {
                ?>
                        <div class="text-center py-5">
                            <h5>No tracking number found!</h5>
                            <div>
                                <a href="orders.php" class="btn btn-primary">Go back to orders</a>
                            </div>
                        </div>
                        <?php
                        return false;
                    }
                    $trackingNo = validate($_GET['track']);

                    $query = "SELECT o.*, c.* FROM orders o, customers c WHERE c.id = o.customer_id AND tracking_no='$trackingNo'";
                    $orders = mysqli_query($conn, $query);
                    if ($orders) {
                        if (mysqli_num_rows($orders) > 0) {
                            $orderData = mysqli_fetch_assoc($orders);
                            $orderId = $orderData['id'];
                        ?>
                            <div class="card card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Order Details</h4>
                                        <label for="trackingNo" class="mv-1">
                                            Tracking No: <span class="fw-bold"><?= $orderData['tracking_no'] ?></span>
                                        </label>
                                        <br>
                                        <label for="orderDate" class="mv-1">
                                            Order Date: <span class="fw-bold"><?= $orderData['order_date'] ?></span>
                                        </label>
                                        <br>
                                        <label for="orderStatus" class="mv-1">
                                            Order Status: <span class="fw-bold"><?= $orderData['order_status'] ?></span>
                                        </label>
                                        <br>
                                        <label for="paymentMode" class="mv-1">
                                            Payment Mode: <span class="fw-bold"><?= $orderData['payment_mode'] ?></span>
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <h4>Customer Details</h4>
                                        <label for="name" class="mv-1">
                                            Full Name: <span class="fw-bold"><?= $orderData['name'] ?></span>
                                        </label>
                                        <br>
                                        <label for="phone" class="mv-1">
                                            Phone: <span class="fw-bold"><?= $orderData['phone'] ?></span>
                                        </label>
                                        <br>
                                        <label for="email" class="mv-1">
                                            Email: <span class="fw-bold"><?= $orderData['email'] ?></span>
                                        </label>
                                        <br>
                                        <label for="address" class="mv-1">
                                            Address: <span class="fw-bold"><?= $orderData['address'] ?></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <?php
                            $orderItemQuery = "SELECT oi.quantity as orderItemQuantity, oi.price as orderItemPrice, o.*, oi.*, p.* FROM orders as o, order_items as oi, products as p WHERE oi.order_id = o.id AND p.id = oi.product_id AND o.tracking_no='$trackingNo'";

                            $orderItemsRes = mysqli_query($conn, $orderItemQuery);
                            if ($orderItemsRes) {
                                if (mysqli_num_rows($orderItemsRes) > 0) {
                            ?>
                                    <h4 class="mt-3">Order Items Details</h4>
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($orderItemsRes as $orderItemRow) : ?>
                                                <tr>
                                                    <td>
                                                        <img src="<?= $orderItemRow['image'] != '' ? '../' . $orderItemRow['image'] : '../assets/images/no-img.jpg' ?>" alt="image" style="width:50px; height:50px">
                                                        <?= $orderItemRow['name'] ?>
                                                    </td>
                                                    <td style="width: 15%;"><?= number_format($orderItemRow['orderItemPrice']) ?></td>
                                                    <td style="width: 15%;"><?= number_format($orderItemRow['orderItemQuantity']) ?></td>
                                                    <td style="width: 15%;"><?= number_format($orderItemRow['orderItemPrice'] * $orderItemRow['orderItemQuantity']) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td colspan="2" class="text-end fw-bold">Total Price:</td>
                                                <td colspan="3" class=" text-center fw-bold">Tk: <?= number_format($orderItemRow['total_amount']); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                            <?php
                                } else {
                                    echo "<h5>Something went wrong.</h5>";
                                }
                            } else {
                                echo "<h5>Something went wrong.</h5>";
                            }
                            ?>
                    <?php
                        } else {
                            echo "<h5>No data found.</h5>";
                            return false;
                        }
                    } else {
                        echo "<h5>Something went wrong.</h5>";
                    }
                } else {
                    ?>
                    <div class="text-center py-5">
                        <h5>No tracking number found!</h5>
                        <div>
                            <a href="orders.php" class="btn btn-primary">Go back to orders</a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</main>

<?php
include('includes/footer.php');
?>