<?php include('includes/header.php'); ?>

<main>
    <div class="container-fluid px-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-4 shadow-sm">
                    <div class="card-header">
                        <h4 class="mb-0">Print Order
                            <a href="orders.php" class="btn btn-danger float-end">Go Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php alertMessage(); ?>
                        <div id="myBillingArea">
                            <?php
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
                                        <table style="width: 100%; margin-bottom: 20px;">
                                            <tbody>
                                                <tr>
                                                    <td style="text-align: center;" colspan="2">
                                                        <h4 style="font-size: 23px; line-height: 30px; margin: 2px; padding: 0;">Company XYZ</h4>
                                                        <p style="font-size: 16px; line-height: 24px; margin:2px; padding: 0;">#555, 1st street, 3rd cross, Dhaka, Bangladesh</p>
                                                        <p style="font-size: 16px; line-height: 24px; margin:2px; padding: 0;">company xyz pvt ltd.</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5 style="font-size: 20px; line-height: 30px; margin:0px; padding: 0;">Customer Details</h5>
                                                        <p style="font-size: 14px; line-height: 20px; margin:0px; padding: 0;">Customer Name: <?= $orderData['name'] ?> </p>
                                                        <p style="font-size: 14px; line-height: 20px; margin:0px; padding: 0;">Customer Phone: <?= $orderData['phone'] ?> </p>
                                                        <p style="font-size: 14px; line-height: 20px; margin: 0px; padding: 0;">Customer Email Id: <?= $orderData['email'] ?> </p>
                                                    <td align="end">
                                                        <h5 style="font-size: 20px; line-height: 30px; margin:0px; padding: 0;">Invoice Details</h5>
                                                        <p style="font-size: 14px; line-height: 20px; margin:0px; padding: 0;">Invoice No: <?= $orderData['invoice_no'] ?> </p>
                                                        <p style="font-size: 14px; line-height: 20px; margin:0px; padding: 0;">Invoice Date: <?= date('d M Y'); ?> </p>
                                                        <p style="font-size: 14px; line-height: 20px; margin:0px; padding: 0;">Address: #555, 1st street, 3rd cross, Dhaka, Bangladesh</p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <br>

                                        <?php
                                        $orderItemQuery = "SELECT oi.quantity as orderItemQuantity, oi.price as orderItemPrice, o.*, oi.*, p.* FROM orders as o, order_items as oi, products as p WHERE oi.order_id = o.id AND p.id = oi.product_id AND o.tracking_no='$trackingNo'";

                                        $orderItemsRes = mysqli_query($conn, $orderItemQuery);
                                        if ($orderItemsRes) {
                                            if (mysqli_num_rows($orderItemsRes) > 0) {
                                        ?>
                                                <div class="table-responsive mb-3">
                                                    <table style="width: 100%;" cellpadding="5">
                                                        <thead>
                                                            <tr>
                                                                <th align="start" style="border-bottom: 1px solid #ccc;" width="5%">ID</th>
                                                                <th align="start" style="border-bottom: 1px solid #ccc;">Product Name</th>
                                                                <th align="start" style="border-bottom: 1px solid #ccc;" width="12%">Price</th>
                                                                <th align="start" style="border-bottom: 1px solid #ccc;" width="12%">Quantity</th>
                                                                <th align="start" style="border-bottom: 1px solid #ccc;" width="15%">Total Price</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $i = 1;
                                                            $totalAmount = 0;
                                                            foreach ($orderItemsRes as $key => $row) :
                                                                $totalAmount += $row['price'] * $row['orderItemQuantity'];
                                                            ?>
                                                                <tr>
                                                                    <td align="start" style="border-bottom: 1px solid #ccc;"><?= $i++ ?></td>
                                                                    <td align="start" style="border-bottom: 1px solid #ccc;"><?= $row['name']; ?></td>
                                                                    <td align="start" style="border-bottom: 1px solid #ccc;"><?= number_format($row['price'], 0) ?></td>
                                                                    <td align="start" style="border-bottom: 1px solid #ccc;"><?= $row['orderItemQuantity']; ?></td>
                                                                    <td align="start" style="border-bottom: 1px solid #ccc;" class="fw-bold"><?= number_format($row['price'] * $row['orderItemQuantity'], 0) ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                            <tr>
                                                                <td colspan="4" align="end" style="font-weight: bold;">Grand Total:</td>
                                                                <td colspan="1" style="font-weight: bold;"><?= number_format($totalAmount, 0) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="5">Payment Mode: <?= $row['payment_mode'] ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
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
                        <div class="mt-4 text-end">
                            <button class="btn btn-info px-4 mx-1" onclick="printBillingArea()">Print</button>
                            <button class="btn btn-primary px-4 mx-1" onclick="downloadPDF('<?= $orderData['invoice_no'] ?>')">Download PDF</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>

<?php include('includes/footer.php'); ?>