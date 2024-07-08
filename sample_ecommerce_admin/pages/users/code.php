<?php include '../../config.php'; ?>

<?php
$response = array('status' => '', 'message' => '', 'errors' => array());

if (isset($_POST['addAFname'], $_POST['addALname'], $_POST['addALname'], $_POST['addAEmail'], $_POST['addAUsername'], $_POST['addAPassword'], $_POST['accountType'])) {
    if (!empty($_POST['addAFname']) && !empty($_POST['addALname']) && !empty($_POST['addAEmail']) && !empty($_POST['addAUsername']) && !empty($_POST['addAPassword'])) {
        $utype = mysqli_real_escape_string($conn, $_POST['accountType']);
        $fname = mysqli_real_escape_string($conn, $_POST['addAFname']);
        $lname = mysqli_real_escape_string($conn, $_POST['addALname']);
        $email = mysqli_real_escape_string($conn, $_POST['addAEmail']);
        $uname = mysqli_real_escape_string($conn, $_POST['addAUsername']);
        $pass = mysqli_real_escape_string($conn, $_POST['addAPassword']);
        $contact = isset($_POST['addAContact']) ? mysqli_real_escape_string($conn, $_POST['addAContact']) : null;
        $addr = isset($_POST['addAAddress']) ? mysqli_real_escape_string($conn, $_POST['addAAddress']) : null;

        $add_image = "";
        if (!empty($_FILES['addAImage']['name'])) {
            $profile_image = $_FILES["addAImage"]["name"];
            $tempname = $_FILES["addAImage"]["tmp_name"];

            $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
            $file_type = mime_content_type($tempname);

            if (!in_array($file_type, $allowed_types)) {
                $response['status'] = 'addError';
                $response['message'] = 'Only .jpg, .jpeg, and .png files are allowed.';
                echo json_encode($response);
                exit();
            }

            $folder = "../../../img/user_image/" . $profile_image;

            move_uploaded_file($tempname, $folder);
            $add_image = $profile_image;
        }

        $check_useremail = "SELECT * FROM user WHERE username='$uname' OR email_address='$email'";
        $result = mysqli_query($conn, $check_useremail);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                if ($row['username'] === $uname) {
                    $response['errors']['usernameError'] = 'Username already exists';
                }
                if ($row['email_address'] === $email) {
                    $response['errors']['emailError'] = 'Email already exists';
                }
            }
        } else {
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
            if ($utype == 1) {
                $sql = "INSERT INTO user(first_name, last_name, email_address, username, password, account_type) 
                        VALUES('$fname', '$lname','$email', '$uname', '$hashed_password', '$utype')";
            } elseif ($utype == 2) {
                $sql = "INSERT INTO user(first_name, last_name, email_address, username, password, image, contact, address, account_type) 
                        VALUES('$fname', '$lname','$email', '$uname', '$hashed_password', '$add_image', '$contact', '$addr', '$utype')";
            }
            if (mysqli_query($conn, $sql)) {
                $response['status'] = 'success';
                $response['message'] = 'You successfully registered.';
            } else {
                $response['status'] = 'error';
                $response['message'] = "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
            }
        }
    } else {
        if ($_POST['accountType'] == 1) {
            if (empty($_POST['addAFname'])) {
                $response['errors']['fnameError'] = 'First name is required.';
            }
            if (empty($_POST['addALname'])) {
                $response['errors']['lnameError'] = 'Last name is required.';
            }
            if (empty($_POST['addAEmail'])) {
                $response['errors']['emailError'] = 'Email is required.';
            }
            if (empty($_POST['addAUsername'])) {
                $response['errors']['usernameError'] = 'Username is required.';
            }
            if (empty($_POST['addAPassword'])) {
                $response['errors']['passwordError'] = 'Password is required.';
            }
        } else if ($_POST['accountType'] == 2) {
            if (empty($_POST['addAFname'])) {
                $response['errors']['fnameError'] = 'First name is required.';
            }
            if (empty($_POST['addALname'])) {
                $response['errors']['lnameError'] = 'Last name is required.';
            }
            if (empty($_POST['addAEmail'])) {
                $response['errors']['emailError'] = 'Email is required.';
            }
            if (empty($_POST['addAUsername'])) {
                $response['errors']['usernameError'] = 'Username is required.';
            }
            if (empty($_POST['addAPassword'])) {
                $response['errors']['passwordError'] = 'Password is required.';
            }
            if (empty($_POST['addAContact'])) {
                $response['errors']['contactError'] = 'Contact is required.';
            }
            if (empty($_POST['addAAddress'])) {
                $response['errors']['addrError'] = 'Address is required.';
            }
        }
    }
    echo json_encode($response);
}

// Update Admin START
if (isset($_POST['editAId'], $_POST['editAFname'], $_POST['editALname'], $_POST['editAEmail'], $_POST['editAUname'], $_POST['editAPass'])) {
    if (!empty($_POST['editAFname']) && !empty($_POST['editALname']) && !empty($_POST['editAEmail']) && !empty($_POST['editAUname'])) {
        $aID = $_POST['editAId'];
        $eAFname = mysqli_real_escape_string($conn, $_POST['editAFname']);
        $eALname = mysqli_real_escape_string($conn, $_POST['editALname']);
        $eAEmail = mysqli_real_escape_string($conn, $_POST['editAEmail']);
        $eAUname = mysqli_real_escape_string($conn, $_POST['editAUname']);
        $eAPass = password_hash($_POST['editAPass'], PASSWORD_BCRYPT);

        if (!empty($_POST['editAPass'])) {
            $sql = "UPDATE `user` SET `first_name`='$eAFname',`last_name`='$eALname',`email_address`='$eAEmail',`username`='$eAUname',`password`='$eAPass',`image`= NULL, `contact`=NULL, `address`=NULL,`account_type`= 1 WHERE `id` = '$aID'";
            mysqli_query($conn, $sql);
            $response['status'] = 'success';
            $response['message'] = 'You successfully updated the user.';
        } else {
            $sql = "UPDATE `user` SET `first_name`='$eAFname', `last_name`='$eALname', `email_address`='$eAEmail', `username`='$eAUname', `image`= NULL, `contact`=NULL, `address`=NULL, `account_type`= 1 WHERE `id` = '$aID'";
            mysqli_query($conn, $sql);
            $response['status'] = 'success';
            $response['message'] = 'You successfully updated the user.';
        }
    } else {
        if (empty($_POST['editAFname'])) {
            $response['errors']['xafnameError'] = 'First Name is required.';
        }
        if (empty($_POST['editALname'])) {
            $response['errors']['xalnameError'] = 'Last Name is required.';
        }
        if (empty($_POST['editAEmail'])) {
            $response['errors']['xaemailError'] = 'Email is required.';
        }
        if (empty($_POST['editAUname'])) {
            $response['errors']['xaunameError'] = 'Username is required.';
        }
    }
    echo json_encode($response);
}
// Update Admin END

// Delete Admin START
if (isset($_POST['admin_id'])) {
    $admin = $_POST['admin_id'];
    $result = mysqli_query($conn, "DELETE FROM `user` WHERE `id` = $admin");

    if ($result) {
        $response['status'] = 'success';
        $response['message'] = 'You successfully deleted the user.';
    }
    echo json_encode($response);
}
// Delete Admin END

?>


