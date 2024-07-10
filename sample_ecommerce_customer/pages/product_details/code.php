<?php include '../../config.php'; ?>
<?php
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
}
$query = "SELECT * FROM products WHERE id = $product_id";
$result = mysqli_query($conn, $query);

if ($result) {
    $product = mysqli_fetch_assoc($result);
}
?>