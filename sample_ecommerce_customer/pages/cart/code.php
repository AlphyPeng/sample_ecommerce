<?php include '../../config.php'; ?>
<?php
$response = array('status' => '', 'message' => '', 'errors' => array());

// Delete Cart
if (isset($_POST['cart_id'])) {
    $cartId = $_POST['cart_id'];
    $query = "DELETE FROM `cart` WHERE `id` = $cartId";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $response['status'] = 'success';
        $response['message'] = 'You successfully deleted the product.';
    }
    echo json_encode($response);
}


// checkout
session_name("customer_session");
session_start();
if (isset($_SESSION["user_id"])) {
    if (isset($_POST['cartId'], $_POST['purchaseQty'])) {

        for ($i = 0; $i < count($_POST['cartId']); $i++) {
            $cartId = $_POST['cartId'][$i];
            $purchaseQty = $_POST['purchaseQty'][$i];
            $query = "INSERT INTO purchase (cart_id, purchase_quantity, status) VALUES ('$cartId', '$purchaseQty', 'pay')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                $response['status'] = 'success';
                $response['message'] = 'You successfully checkout the products.';
            }
        }
        echo json_encode($response);
    }
}

?>