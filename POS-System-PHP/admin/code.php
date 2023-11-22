<?php

include("../config/function.php");

// Insert admin
if (isset($_POST['saveAdmin'])) {
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $password = validate($_POST['password']);
    $is_ban = isset($_POST['is_ban']) == true ? 1 : 0;

    if ($name != '' && $email != '') {
        $emailCheck = mysqli_query($conn, "SELECT * FROM admins WHERE email='$email'");

        if ($emailCheck) {
            if (mysqli_num_rows($emailCheck) > 0) {
                redirect('admin-create.php', 'Email already exist.');
            }
        }
        $bcrypt_password = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => $bcrypt_password,
            'is_ban' => $is_ban
        ];
        $result = insert('admins', $data);
        if ($result) {
            redirect('admins.php', 'Admin created successfully.');
        } else {
            redirect('admin-create.php', 'Something went wrong.');
        }
    } else {
        redirect('admin-create.php', 'Please fill the required fields.');
    }
}

// Update admin
if (isset($_POST['updateAdmin'])) {
    $categoryId = validate($_POST['id']);

    $categoryData = getById('admins', $categoryId);
    if ($categoryData['status'] != 200) {
        redirect('admin-edit.php?id=' . $categoryId, 'Something went wrong.');
    }

    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $password = validate($_POST['password']);
    $is_ban = isset($_POST['is_ban']) == true ? 1 : 0;

    $emailCheckQuery = "SELECT * FROM admins WHERE email='$email' AND id!='$categoryId'";
    $emailCheckResult = mysqli_query($conn, $emailCheckQuery);

    if ($emailCheckResult) {
        if (mysqli_num_rows($emailCheckResult) > 0) {
            redirect('admin-edit.php?id=' . $categoryId, 'Email already used by another user.');
        }
    }

    if ($password != "") {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    } else {
        $hashed_password = $categoryData['data']['password'];
    }

    if ($name != '' && $email != '') {
        $data = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => $hashed_password,
            'is_ban' => $is_ban
        ];
        $result = update('admins', $categoryId, $data);
        if ($result) {
            redirect('admin-edit.php?id=' . $categoryId, 'Admin details updated successfully.');
        } else {
            redirect('admin-edit.php?id=' . $categoryId, 'Something went wrong.');
        }
    } else {
        redirect('admin-edit.php?id=' . $categoryId, 'Please fill the required fields.');
    }
}

// Insert category
if (isset($_POST['saveCategory'])) {
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $status = isset($_POST['status']) == true ? 1 : 0;

    if ($name != '') {
        $nameCheck = mysqli_query($conn, "SELECT * FROM categories WHERE name='$name'");

        if ($nameCheck) {
            if (mysqli_num_rows($nameCheck) > 0) {
                redirect('category-create.php', 'Category already exist.');
            }
        }

        $data = [
            'name' => $name,
            'description' => $description,
            'status' => $status
        ];
        $result = insert('categories', $data);
        if ($result) {
            redirect('categories.php', 'Category created successfully.');
        } else {
            redirect('category-create.php', 'Something went wrong.');
        }
    } else {
        redirect('category-create.php', 'Please fill the required fields.');
    }
}

// Update category
if (isset($_POST['updateCategory'])) {
    $categoryId = validate($_POST['id']);

    $categoryData = getById('categories', $categoryId);
    if ($categoryData['status'] != 200) {
        redirect('category-edit.php?id=' . $categoryId, 'Something went wrong.');
    }

    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $status = isset($_POST['status']) == true ? 1 : 0;

    $nameCheckQuery = "SELECT * FROM categories WHERE name='$name' AND id!='$categoryId'";
    $nameCheckResult = mysqli_query($conn, $nameCheckQuery);

    if ($nameCheckResult) {
        if (mysqli_num_rows($nameCheckResult) > 0) {
            redirect('category-edit.php?id=' . $categoryId, 'Category name already exist.');
        }
    }
    if ($name != '') {
        $data = [
            'name' => $name,
            'description' => $description,
            'status' => $status
        ];
        $result = update('categories', $categoryId, $data);
        if ($result) {
            redirect('category-edit.php?id=' . $categoryId, 'Category details updated successfully.');
        } else {
            redirect('category-edit.php?id=' . $categoryId, 'Something went wrong.');
        }
    } else {
        redirect('category-edit.php?id=' . $categoryId, 'Please fill the required fields.');
    }
}

// Insert product
if (isset($_POST['saveProduct'])) {
    $category_id = validate($_POST['category_id']);
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $price = validate($_POST['price']);
    $quantity = validate($_POST['quantity']);
    $status = isset($_POST['status']) == true ? 1 : 0;

    if ($category_id == 'not_defined') {
        redirect('product-create.php', 'Please select a category.');
    }

    // To check if the image is selected or not
    if ($_FILES['image']['size'] > 0) {
        $path = "../assets/uploads/products/";
        // Get image extention
        $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        // Generate file name
        $fileName = time() . '.' . $image_ext;
        // Move the uploaded image
        move_uploaded_file($_FILES['image']['tmp_name'], $path . $fileName);
        $finalImage = "assets/uploads/products/" . $fileName;
    } else {
        $finalImage = "";
    }

    $data = [
        'category_id' => $category_id,
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'quantity' => $quantity,
        'image' => $finalImage,
        'status' => $status
    ];
    $result = insert('products', $data);
    if ($result) {
        redirect('products.php', 'Product created successfully.');
    } else {
        redirect('product-create.php', 'Something went wrong.');
    }
}

// Update product
if (isset($_POST['updateProduct'])) {
    $product_id = validate($_POST['product_id']);
    $productData = getById("products", $product_id);
    if (!$productData) {
        redirect('product-edit.php?id=' . $product_id, 'No product found.');
    }

    $category_id = validate($_POST['category_id']);
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $price = validate($_POST['price']);
    $quantity = validate($_POST['quantity']);
    $status = isset($_POST['status']) == true ? 1 : 0;

    if ($category_id == 'not_defined') {
        redirect('product-edit.php?id=' . $product_id, 'Please select a category.');
    }

    // To check if the image is selected or not
    if ($_FILES['image']['size'] > 0) {
        $path = "../assets/uploads/products/";
        // Get image extention
        $image_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        // Generate file name
        $fileName = time() . '.' . $image_ext;
        // Move the uploaded image
        move_uploaded_file($_FILES['image']['tmp_name'], $path . $fileName);
        $finalImage = "assets/uploads/products/" . $fileName;

        $deleteImage = "../" . $productData['data']['image'];
        if (file_exists($deleteImage)) {
            unlink($deleteImage);
        }
    } else {
        $finalImage = $productData['data']['image'];
    }

    $data = [
        'category_id' => $category_id,
        'name' => $name,
        'description' => $description,
        'price' => $price,
        'quantity' => $quantity,
        'image' => $finalImage,
        'status' => $status
    ];
    $result = update('products', $product_id, $data);
    if ($result) {
        redirect('product-edit.php?id=' . $product_id, 'Product updated successfully.');
    } else {
        redirect('product-edit.php?id=' . $product_id, 'Something went wrong.');
    }
}

// Insert customer
if (isset($_POST['saveCustomer'])) {
    $name = validate($_POST['name']);
    $phone = validate($_POST['phone']);
    $email = validate($_POST['email']);
    $address = validate($_POST['address']);
    $status = isset($_POST['status']) == true ? 1 : 0;

    if ($email != "") {
        $emailCheck = mysqli_query($conn, "SELECT * FROM customers WHERE email='$email'");

        if ($emailCheck) {
            if (mysqli_num_rows($emailCheck) > 0) {
                redirect('customer-create.php', 'Email already exist.');
            }
        }
    }

    $data = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'address' => $address,
        'status' => $status
    ];
    $result = insert('customers', $data);
    if ($result) {
        redirect('customers.php', 'Customer created successfully.');
    } else {
        redirect('customer-create.php', 'Something went wrong.');
    }
}

// Update customer
if (isset($_POST['updateCustomer'])) {
    $customer_id = validate($_POST['customer_id']);
    $name = validate($_POST['name']);
    $phone = validate($_POST['phone']);
    $email = validate($_POST['email']);
    $address = validate($_POST['address']);
    $status = isset($_POST['status']) == true ? 1 : 0;

    if ($email != "") {
        $emailCheckQuery = "SELECT * FROM customers WHERE email='$email' AND id!='$customer_id'";
        $emailCheckResult = mysqli_query($conn, $emailCheckQuery);

        if ($emailCheckResult) {
            if (mysqli_num_rows($emailCheckResult) > 0) {
                redirect('customer-edit.php?id=' . $customer_id, 'Email already used by another customer.');
            }
        }
    }

    $data = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'address' => $address,
        'status' => $status
    ];
    $result = update('customers', $customer_id, $data);
    if ($result) {
        redirect('customer-edit.php?id=' . $customer_id, 'Customer updated successfully.');
    } else {
        redirect('customer-edit.php?id=' . $customer_id, 'Something went wrong.');
    }
}
