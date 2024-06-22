<?php
include '../TEMPLATES/header.php';
// include 'code.php';
?>

<div class="untree_co-section account-section">
    <div class="container">
        <h2 class="mb-4 section-title">My Account</h2>
        <div class="row align-items-start">
            <div class="col-lg-2">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</button>
                    <button class="nav-link" id="v-pills-password-tab" data-bs-toggle="pill" data-bs-target="#v-pills-password" type="button" role="tab" aria-controls="v-pills-password" aria-selected="false">Change Password</button>
                    <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab" tabindex="0">
                        <div class="tab-sub-content d-flex justify-content-between align-items-center">
                            <div class="tab-header">
                                <div class="user-img-container">
                                    <?php
                                    if (!isset($_SESSION['image']) || empty($_SESSION['image'])) {
                                        // If image is not set or is empty, show the default image
                                    ?>
                                        <img src="../../images/default-profile.png" alt="Profile Image" class="profile-picture">
                                    <?php
                                    } else {
                                        // If image is set and not empty, show the user image
                                    ?>
                                        <img src="<?php echo '../../../img/user_image/' . $_SESSION['image']; ?>" alt="<?php echo $_SESSION['image']; ?>" class="profile-picture">
                                    <?php
                                    }
                                    ?>

                                </div>
                                <div class="user-img-details">
                                    <h4 id="accname" name="accname"><?php echo $_SESSION['fname'] . " " .  $_SESSION['lname']; ?></h4>
                                    <span id="accaddress" name="accaddress"><?php echo $_SESSION['address']; ?></span>
                                </div>
                            </div>
                            <div class="edit-button">
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#profileEditModal"><i class="bi bi-pen me-2"></i>Edit</button>
                            </div>
                        </div>
                        <div class="tab-sub-content d-flex justify-content-between align-items-center">
                            <div class="tab-details">
                                <h3 class="mb-3">Personal Information</h3>
                                <p><strong>Email:</strong> <?php echo $_SESSION['email'] ?></p>
                                <p><strong>Contact:</strong> <?php echo $_SESSION['contact'] ?></p>
                            </div>
                            <div class="edit-button">
                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#personalInfoEditModal"><i class="bi bi-pen me-2"></i>Edit</button>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab" tabindex="0">
                        <div class="tab-sub-content">
                            <div class="tab-sub-content">
                                <h3>Change Password</h3>
                                <form id="change-password-form">
                                    <div class="form-group">
                                        <label for="current-password">Current Password</label>
                                        <input type="password" class="form-control" id="current-password" placeholder="Enter current password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="new-password">New Password</label>
                                        <input type="password" class="form-control" id="new-password" placeholder="Enter new password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm-new-password">Confirm New Password</label>
                                        <input type="password" class="form-control" id="confirm-new-password" placeholder="Confirm new password" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Profile Edit START -->
<div class="modal fade" id="profileEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editNameAddModal" method="POST" action="account.php" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="editFname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="editFname" name="editFname" value="<?php echo $_SESSION['fname']; ?>">
                            <span class="error text-danger" id="fnameError"></span>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="editLname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="editLname" name="editLname" value="<?php echo $_SESSION['lname']; ?>">
                            <span class="error text-danger" id="lnameError"></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="editAddress" class="form-label">Address</label>
                        <input type="text" class="form-control" id="editAddress" name="editAddress" value="<?php echo $_SESSION['address']; ?>">
                        <span class="error text-danger" id="addressError"></span>
                    </div>
                    <div class="upload-container mb-3">
                        <input type="file" class="form-control" id="uploadImage" name="uploadImage">
                        <label for="uploadImage" class="form-label">
                            <span>Upload Image</span>
                        </label>
                        <span class="file-name">No file chosen</span>
                    </div>
                    <input type="hidden" name="profileimage_path" value="<?php echo $_SESSION['image']; ?>">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Profile Edit END -->


<!-- Personal Info Edit START -->
<div class="modal fade" id="personalInfoEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Personal Information Edit</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editPersonalInfoModal" method="POST" action="account.php">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="text" class="form-control" id="editEmail" name="editEmail" value="<?php echo $_SESSION['email']; ?>">
                        <span class="error text-danger" id="emailError"></span>
                    </div>
                    <div class="mb-3">
                        <label for="editContact" class="form-label">Contact No.</label>
                        <input type="text" class="form-control" id="editContact" name="editContact" value="<?php echo $_SESSION['contact']; ?>">
                        <span class="error text-danger" id="contactError"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Personal Info Edit END -->


<script src="script.js"></script>
<?php
include '../TEMPLATES/footer.php';
?>