<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sample_ecommerce";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn) {
    if ($_GET['id']) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM user WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header('Content-Type: application/json');
            $rows = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row;
            }
            echo json_encode($rows, JSON_PRETTY_PRINT);
        }
    } else {
        echo "No ID";
    }
}
