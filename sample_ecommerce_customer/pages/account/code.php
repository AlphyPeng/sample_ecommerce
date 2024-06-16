<?php
include '../../config.php';
?>
<?php
session_start();

$response = array('status' => '', 'message' => '', 'errors' => array());

// Change name and address START
if (isset($_POST['editFname'], $_POST['editLname'], $_POST['editAddress'])) {
    if (!empty($_POST['editFname']) && !empty($_POST['editLname']) && !empty($_POST['editAddress'])) {
        $editFname = mysqli_real_escape_string($conn, $_POST['editFname']);
        $editLname = mysqli_real_escape_string($conn, $_POST['editLname']);
        $editAddress = mysqli_real_escape_string($conn, $_POST['editAddress']);

        $userId = $_SESSION['user_id'];
        $sql = "UPDATE `user` SET first_name = '$editFname', last_name = '$editLname', address = '$editAddress' WHERE id = '$userId'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $_SESSION['fname'] = $editFname;
            $_SESSION['lname'] = $editLname;
            $_SESSION['address'] = $editAddress;

            $response['status'] = 'success';
            $response['message'] = 'Successfully changed.';
        }
    } else {
        if (empty($_POST['editFname'])) {
            $response['errors']['fnameError'] = 'First Name is required.';
        }
        if (empty($_POST['editLname'])) {
            $response['errors']['lnameError'] = 'Last Name is required.';
        }
        if (empty($_POST['editAddress'])) {
            $response['errors']['addressError'] = 'Address is required.';
        }
    }
}
// Change name and address END

// Change personal information START
if (isset($_POST['editEmail'], $_POST['editContact'])) {
    if (!empty($_POST['editEmail']) && !empty($_POST['editContact'])) {
        $editEmail = mysqli_real_escape_string($conn, $_POST['editEmail']);
        $editContact = mysqli_real_escape_string($conn, $_POST['editContact']);

        $userId = $_SESSION['user_id'];
        $sql = "UPDATE `user` SET email_address = '$editEmail', contact = '$editContact' WHERE id = '$userId'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $_SESSION['email'] = $editEmail;
            $_SESSION['contact'] = $editContact;

            $response['status'] = 'success';
            $response['message'] = 'Successfully updated personal information.';
        }
    } else {
        if (empty($_POST['editEmail'])) {
            $response['errors']['emailError'] = 'Email is required.';
        }
        if (empty($_POST['editContact'])) {
            $response['errors']['contactError'] = 'Contact number is required.';
        }
    }
}
// Change personal information END


echo json_encode($response);
?>


