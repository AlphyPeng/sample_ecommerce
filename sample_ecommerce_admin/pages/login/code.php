<?php include '../../config.php'; ?>

<?php
session_start();
$response = array('status' => '', 'message' => '', 'errors' => array());

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST['loguseremail']) && !empty($_POST['logpass'])) {
        $useremail = mysqli_real_escape_string($conn, $_POST['loguseremail']);
        $password = mysqli_real_escape_string($conn, $_POST['logpass']);

        $query = "SELECT * FROM user WHERE email_address='$useremail' OR username='$useremail'";
        $result  = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if ($row['account_type'] == 1) {
                if (password_verify($password, $row['password'])) {
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['fname'] = $row['first_name'];
                    $_SESSION['lname'] = $row['last_name'];
                    $_SESSION['email'] = $row['email_address'];
                    $_SESSION['image'] = $row['image'];
                    $_SESSION['contact'] = $row['contact'];
                    $_SESSION['address'] = $row['address'];

                    $response['status'] = 'success';
                    $response['message'] = 'Login successful. Redirecting...';
                } else {
                    $response['errors']['passwordError'] = 'Password is incorrect.';
                }
            } else {
                $response['errors']['useremailError'] = 'Username or Email is incorrect.';
                $response['errors']['passwordError'] = 'Password is incorrect.';
            }
        } else {
            $response['errors']['useremailError'] = 'Username or Email is incorrect.';
        }
    } else {
        if (empty($_POST['loguseremail'])) {
            $response['errors']['useremailError'] = 'Username or Email is requireds.';
        }
        if (empty($_POST['logpass'])) {
            $response['errors']['passwordError'] = 'Password is required.';
        }
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request.';
}

echo json_encode($response);
?>