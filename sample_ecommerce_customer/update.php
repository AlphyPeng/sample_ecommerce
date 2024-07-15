<?php
include 'config.php';
session_name("customer_session");
session_start();

if (isset($_SESSION['user_id'])) {
    $customer_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM cart WHERE customer_id = '$customer_id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $cartcount = mysqli_num_rows($result);
        echo $cartcount;
    } else {
        echo 0;
    }
}
