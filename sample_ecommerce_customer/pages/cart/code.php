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

        $purchaseId = uniqid('purchase_');

        for ($i = 0; $i < count($_POST['cartId']); $i++) {
            $cartId = $_POST['cartId'][$i];
            $purchaseQty = $_POST['purchaseQty'][$i];
            $amountPrice = $_POST['amount'][$i];
            $query = "INSERT INTO purchase (purchase_id, cart_id, purchase_quantity, purchase_amount, status) VALUES ('$purchaseId', '$cartId', '$purchaseQty', '$amountPrice', 'pay')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                $queryDel = "DELETE FROM `cart` WHERE `id` = '$cartId' ";
                mysqli_query($conn, $queryDel);

                $response['status'] = 'success';
                $response['message'] = 'You successfully checkout the products.';


            }
        }

        $user_id = $_SESSION["user_id"];
        $totalAmount = $_POST["total"];
        $query = "INSERT INTO total_amount_purchase (purchase_id, customer_id, total_purchase) VALUES ('$purchaseId', '$user_id', '$totalAmount')";
        mysqli_query($conn, $query);

        echo json_encode($response);
    }
}

?>