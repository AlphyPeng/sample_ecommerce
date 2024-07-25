<?php include '../../config.php'; ?>
<?php
session_name("customer_session");
session_start();

$response = array('status' => '', 'message' => '', 'errors' => array());

if (isset($_SESSION['user_id'])) {
    if (isset($_POST['product_id'])) {

        $product_id = $_POST['product_id'];
        $customer_id = $_SESSION['user_id'];
        $name_product = $_POST['product_name'];

        $query = "SELECT * FROM cart WHERE product_id = '$product_id' AND customer_id = '$customer_id' AND status = 1";

        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        if (mysqli_num_rows($result) > 0) {
            $response['status'] = 'error';
            $response['message'] = 'You already Add to Cart the product.';
        } else {
            $sql = "INSERT INTO cart (product_id, customer_id, cart_product_name, cart_quantity, status) 
            VALUES ('$product_id', '$customer_id', '$name_product', 1, 1)";

            $sql_result = mysqli_query($conn, $sql);

            if ($sql_result) {
                $response['status'] = 'success';
                $response['message'] = 'You successfully Add to Cart the product.';
            }
        }
        echo json_encode($response);
    }
} else {
    $response['status'] = 'login';
    $response['message'] = 'You need to login.';

    echo json_encode($response);
}

?>