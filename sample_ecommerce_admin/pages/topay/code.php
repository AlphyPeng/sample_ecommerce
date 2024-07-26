<?php
include '../../config.php';
?>

<?php
$response = array('status' => '', 'message' => '', 'errors' => array());

if (isset($_POST['purchase_id'])) {
    $purchase_id = $_POST['purchase_id'];
    $query = $conn->prepare("SELECT * FROM total_amount_purchase 
    INNER JOIN purchase ON purchase.purchase_id = total_amount_purchase.purchase_id
    INNER JOIN cart ON cart.id = purchase.cart_id 
    INNER JOIN products ON products.id = cart.product_id
    WHERE purchase.purchase_id = ?");
    $query->bind_param("s", $purchase_id);
    $query->execute();
    $result = $query->get_result();

    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    echo json_encode($rows);
}

if (isset($_POST["get_totalAmount"])) {
    $getcustomer_id = $_POST['get_totalAmount'];
    $query = "SELECT * FROM total_amount_purchase WHERE purchase_id = '$getcustomer_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
    echo json_encode($row);
}


?>