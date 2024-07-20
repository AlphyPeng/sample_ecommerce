<?php include '../../config.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $response = array('status' => '', 'message' => '', 'errors' => array());
    if (!empty($_POST['regfname']) && !empty($_POST['reglname']) && !empty($_POST['regemail']) && !empty($_POST['regusername']) && !empty($_POST['regpass']) && !empty($_POST['regconpass']) && !empty($_POST['regcontact']) && !empty($_POST['regaddress'])) {
        if ($_POST['regpass'] == $_POST['regconpass']) {

            $first_name = mysqli_real_escape_string($conn, $_POST['regfname']);
            $last_name = mysqli_real_escape_string($conn, $_POST['reglname']);
            $email = mysqli_real_escape_string($conn, $_POST['regemail']);
            $username = mysqli_real_escape_string($conn, $_POST['regusername']);
            $password = mysqli_real_escape_string($conn, $_POST['regpass']);
            $confirm_password = mysqli_real_escape_string($conn, $_POST['regconpass']);
            $contact_no = mysqli_real_escape_string($conn, $_POST['regcontact']);
            $address = mysqli_real_escape_string($conn, $_POST['regaddress']);

            $account_type = 2;

            $check_useremail = $conn->prepare("SELECT * FROM user WHERE username = ? OR email_address = ?");
            $check_useremail->bind_param("ss", $username, $email);
            $check_useremail->execute();
            $result = $check_useremail->get_result();
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['username'] == $username) {
                        $response['errors']['userExist'] = 'Username already exists';
                    }
                    if ($row['email_address'] == $email) {
                        $response['errors']['emailExist'] = 'Email already exists';
                    }
                }
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $sql = $conn->prepare("INSERT INTO user (first_name, last_name, email_address, username, password, contact, address, account_type) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $sql->bind_param("sssssisi", $first_name, $last_name, $email, $username, $hashed_password, $contact_no, $address, $account_type);
                if ($sql->execute()) {
                    $response['status'] = 'success';
                    $response['message'] = 'You successfully registered.';
                } else {
                    $response['status'] = 'error';
                    $response['message'] = "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                }
            }
        } else {
            $response['errors']['conpassNotEqual'] = 'Password and Confirm Password do not match.';
            // $response['message'] = 'Password and Confirm Password do not match.';
        }
    } else {
        if (empty($_POST['regfname']))
            $response['errors']['fnameError'] = "First name is required.";
        if (empty($_POST['reglname']))
            $response['errors']['lnameError'] = "Last name is required.";
        if (empty($_POST['regemail']))
            $response['errors']['emailError'] = "Email is required.";
        if (empty($_POST['regusername']))
            $response['errors']['unameError'] = "Username is required.";
        if (empty($_POST['regpass']))
            $response['errors']['passError'] = "Password is required.";
        if (empty($_POST['regconpass']))
            $response['errors']['conpassError'] = "Confirm Password is required.";
        if (empty($_POST['regcontact']))
            $response['errors']['contactError'] = "Contact number is required.";
        if (empty($_POST['regaddress']))
            $response['errors']['addressError'] = "Address is required.";

        $response['status'] = 'error';
    }

    echo json_encode($response);
}
?>