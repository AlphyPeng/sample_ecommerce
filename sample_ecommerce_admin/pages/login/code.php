<?php include '../../config.php'; ?>

<?php
session_name("admin_session");
session_start();
$response = array('status' => '', 'message' => '', 'errors' => array());

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST['loguseremail']) && !empty($_POST['logpass'])) {
        $useremail = mysqli_real_escape_string($conn, $_POST['loguseremail']);
        $password = mysqli_real_escape_string($conn, $_POST['logpass']);

        $query = $conn->prepare("SELECT * FROM user WHERE email_address = ? OR username = ?");
        $query->bind_param("ss", $useremail, $useremail);
        $query->execute();
        $result  = $query->get_result();

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            if ($row['account_type'] == 1) {
                if (password_verify($password, $row['password'])) {
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['fname'] = $row['first_name'];
                    $_SESSION['lname'] = $row['last_name'];
                    $_SESSION['email'] = $row['email_address'];

                    $response['status'] = 'success';
                    $response['message'] = 'Login successful. Redirecting...';
                } else {
                    $response['errors']['passwordError'] = 'Password is incorrect.';
                }
            } else if ($row['account_type'] == 2) {
                if (password_verify($password, $row['password'])) {
                    $response['errors']['useremailError'] = 'Username or Email is incorrect.';
                }
            } else {
                $response['errors']['useremailError'] = 'Username or Email is incorrect.';
                $response['errors']['passwordError'] = 'Password is incorrect.';
                $response['status'] = 'error';
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