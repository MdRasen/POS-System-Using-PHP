<?php
require '../config/function.php';

$paramResultId = checkParamId('index');

if (is_numeric($paramResultId)) {
    $indexValue = validate($paramResultId);
    if (isset($_SESSION['productItemIds']) && isset($_SESSION['productItems'])) {
        unset($_SESSION['productItemsId'][$indexValue]);
        unset($_SESSION['productItems'][$indexValue]);

        redirect('order-create.php', 'Item has been removed.');
    } else {
        redirect('order-create.php', 'This item is not available in the cart.');
    }
} else {
    redirect('order-create.php', 'Something went wrong.');
}
