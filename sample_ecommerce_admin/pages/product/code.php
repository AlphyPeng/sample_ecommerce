<?php include '../../config.php'; ?>

<?php
$response = array('status' => '', 'message' => '', 'errors' => array());

// Add product START
if (isset($_POST['addPName'], $_POST['addPDescription'], $_POST['addPQuantity'], $_POST['addPPrice'], $_FILES['addPImage']['name'])) {
    if (!empty($_POST['addPName']) && !empty($_POST['addPDescription']) && !empty($_POST['addPQuantity']) && !empty($_POST['addPPrice']) && !empty($_FILES['addPImage']['name'])) {

        $product_name = mysqli_real_escape_string($conn, $_POST['addPName']);
        $product_description = mysqli_real_escape_string($conn, $_POST['addPDescription']);
        $product_quantity = mysqli_real_escape_string($conn, $_POST['addPQuantity']);
        $product_price = mysqli_real_escape_string($conn, $_POST['addPPrice']);

        $product_image = $_FILES["addPImage"]["name"];
        $tempname = $_FILES["addPImage"]["tmp_name"];
        $folder = "../../../img/products/" . $product_image;

        move_uploaded_file($tempname, $folder);

        $sql = "INSERT INTO `products` (`product_name`, `product_description`, `product_quantity`, `product_price`, `product_image`) 
     VALUES ('$product_name', '$product_description', '$product_quantity', '$product_price', '$product_image')";

        if (mysqli_query($conn, $sql)) {
            $response['status'] = 'success';
            $response['message'] = 'You successfully added the product.';
        }
    } else {
        if (empty($_POST['addPName'])) {
            $response['errors']['pnameError'] = "Product name is required.";
        }
        if (empty($_POST['addPDescription'])) {
            $response['errors']['pdescriptionError'] = "Description is required.";
        }
        if (empty($_POST['addPQuantity'])) {
            $response['errors']['pquantityError'] = "Quantity is required.";
        }
        if (empty($_POST['addPPrice'])) {
            $response['errors']['ppriceError'] = "Quantity is required.";
        }
        if (empty($_POST['addPImage'])) {
            $response['errors']['pimageError'] = "Product image is required.";
        }
    }
    echo json_encode($response);
}
// Add product END

// Edit product START
if (isset($_POST['editPId'], $_POST['editPName'], $_POST['editPDescription'], $_POST['editPQuantity'], $_POST['editPPrice'])) {
    if (!empty($_POST['editPId']) && !empty($_POST['editPName']) && !empty($_POST['editPDescription']) && !empty($_POST['editPQuantity']) && !empty($_POST['editPPrice'])) {

        $id = $_POST['editPId'];
        $product_name = mysqli_real_escape_string($conn, $_POST['editPName']);
        $product_description = mysqli_real_escape_string($conn, $_POST['editPDescription']);
        $product_quantity = mysqli_real_escape_string($conn, $_POST['editPQuantity']);
        $product_price = mysqli_real_escape_string($conn, $_POST['editPPrice']);

        $update_image = "";
        if (!empty($_FILES['editPImage']['name'])) {
            $product_image = $_FILES["editPImage"]["name"];
            $tempname = $_FILES["editPImage"]["tmp_name"];

            $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
            $file_type = mime_content_type($tempname);

            if (!in_array($file_type, $allowed_types)) {
                $response['status'] = 'uploadError';
                $response['message'] = 'Only .jpg, .jpeg, and .png files are allowed.';
                echo json_encode($response);
                exit();
            }
            $folder = "../../../img/products/" . $product_image;

            move_uploaded_file($tempname, $folder);
            $update_image = ", product_image='$product_image'";
        }

        $sql = "UPDATE products SET product_name='$product_name',
                product_description='$product_description',
                product_quantity='$product_quantity',
                product_price='$product_price'
                $update_image
              WHERE id='$id'";

        if (mysqli_query($conn, $sql)) {
            $response['status'] = 'success';
            $response['message'] = 'You successfully added the product.';
        }
    } else {
        if (empty($_POST['editPId'])) {
            $response['errors']['xpnameError'] = "Product name is required.";
        }
        if (empty($_POST['editPName'])) {
            $response['errors']['xpnameError'] = "Product name is required.";
        }
        if (empty($_POST['editPDescription'])) {
            $response['errors']['xpdescriptionError'] = "Description is required.";
        }
        if (empty($_POST['editPQuantity'])) {
            $response['errors']['xpquantityError'] = "Quantity is required.";
        }
        if (empty($_POST['editPPrice'])) {
            $response['errors']['xppriceError'] = "Quantity is required.";
        }
    }
    echo json_encode($response);
}
// Edit product END
?>