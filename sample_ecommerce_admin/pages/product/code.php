<?php include '../../config.php'; ?>

<?php
$response = array('status' => '', 'message' => '', 'errors' => array());

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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

// Table product START
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $query = "SELECT * FROM `products`";
    $result = mysqli_query($conn, $query);

    $data = [];
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
    echo json_encode($data);
}
// Table product END
?>