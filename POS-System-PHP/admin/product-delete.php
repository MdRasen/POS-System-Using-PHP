<?php
require '../config/function.php';

$paramResultId = checkParamId('id');

if (is_numeric($paramResultId)) {
    $productId = validate($paramResultId);
    $product = getById('products', $productId);
    if ($product['status'] == 200) {
        $productDeleteRes = delete('products', $productId);
        if ($productDeleteRes) {
            $deleteImage = "../" . $product['data']['image'];
            if (file_exists($deleteImage)) {
                unlink($deleteImage);
            }
            redirect('products.php', 'Prodcuct deleted successfully.');
        } else {
            redirect('products.php', 'Something went wrong.');
        }
    } else {
        redirect('products.php', $prodcut['message']);
    }
} else {
    redirect('products.php', 'Something went wrong.');
}
