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

        $query = "INSERT INTO cart (product_id, customer_id, cart_product_name) 
              VALUES ('$product_id', '$customer_id', '$name_product')";

        $result = mysqli_query($conn, $query);

        if ($result) {
            $response['status'] = 'success';
            $response['message'] = 'You successfully Add to Cart the product.';
        }
        echo json_encode($response);
    }
}
?>