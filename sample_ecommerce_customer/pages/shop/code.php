<?php include '../../config.php'; ?>

<?php
$response = array('status' => '', 'message' => '', 'errors' => array());

$query = "SELECT * FROM `products`";
$result = mysqli_query($conn, $query);

$data = [];

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo json_encode([]);
}
?>