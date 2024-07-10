<?php
include '../TEMPLATES/header.php';
include 'code.php';
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mt-4">Users</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div>
                <div>
                    <button class="btn btn-primary add-button" data-bs-toggle="modal" data-bs-target="#addAccount">
                        <i class="fas fa-plus me-2"></i>Add Accounts
                    </button>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Admin Accounts
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="adminTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email Address</th>
                                    <th>Username</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM user";
                                $users = mysqli_query($conn, $query);

                                if (mysqli_num_rows($users) > 0) {
                                    foreach ($users as $user) {
                                        if ($user['account_type'] == 1) {
                                ?>
                                            <tr class="del<?php echo $user['id'] ?>">
                                                <td><?php echo $user['first_name'] . " " . $user['last_name'] ?></td>
                                                <td><?php echo $user['email_address'] ?></td>
                                                <td><?php echo $user['username'] ?></td>
                                                <td class="">
                                                    <button class="btn btn-success me-3 edit-admin" data-aid="<?php echo $user['id'] ?>" data-afname="<?php echo $user['first_name'] ?>" data-alname="<?php echo $user['last_name'] ?>" data-aemail="<?php echo $user['email_address'] ?>" data-auname="<?php echo $user['username'] ?>">
                                                        <i class="fas fa-pen"></i>
                                                    </button>

                                                    <button class="btn btn-danger delete-admin" data-deltadmin="<?php echo $user['id'] ?>"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Customer Accounts
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="customerTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email Address</th>
                                    <th>Username</th>
                                    <th>Image</th>
                                    <th>Contact</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM user";
                                $users = mysqli_query($conn, $query);

                                if (mysqli_num_rows($users) > 0) {
                                    foreach ($users as $user) {
                                        if ($user['account_type'] == 2) {
                                ?>
                                            <tr>
                                                <td><?php echo $user['first_name'] . " " . $user['last_name'] ?></td>
                                                <td><?php echo $user['email_address'] ?></td>
                                                <td><?php echo $user['username'] ?></td>
                                                <td class="image-container">
                                                    <img class="image " src="../../../img/user_image/<?php echo $user['image'] ?>">
                                                </td>
                                                <td><?php echo $user['contact'] ?></td>
                                                <td><?php echo $user['address'] ?></td>
                                                <td class="">
                                                    <button class="btn btn-success me-3 edit-customer" data-cid="<?php echo $user['id'] ?>">
                                                        <i class="fas fa-pen"></i>
                                                    </button>

                                                    <button class="btn btn-danger delete-customer" data-deltcustomer="<?php echo $user['id'] ?>"><i class="fas fa-trash"></i></button>

                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Add Account Modal START -->
    <div class="modal fade" id="addAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addAccountModal" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Select Account to Create</label>
                            <select class="form-select" id="accountType" name="accountType" aria-label="Default select example">
                                <option selected value="0">Select Account Type</option>
                                <option value="1">Admin</option>
                                <option value="2">User</option>
                            </select>
                        </div>
                        <div class="hide-all">
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label for="addAFname" class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="addAFname" name="addAFname">
                                    <span class="error text-danger" id="fnameError"></span>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="addALname" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="addALname" name="addALname">
                                    <span class="error text-danger" id="lnameError"></span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="addAEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="addAEmail" name="addAEmail">
                                <span class="error text-danger" id="emailError"></span>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label for="addAUsername" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="addAUsername" name="addAUsername">
                                    <span class="error text-danger" id="usernameError"></span>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="addAPassword" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="addAPassword" name="addAPassword">
                                    <span class="error text-danger" id="passwordError"></span>
                                </div>
                            </div>
                            <div class="mb-3 hide">
                                <label for="addAContact" class="form-label">Contact</label>
                                <input type="number" class="form-control" id="addAContact" name="addAContact">
                                <span class="error text-danger" id="contactError"></span>
                            </div>
                            <div class="mb-3 hide">
                                <label for="addAAddress" class="form-label">Address</label>
                                <input type="text" class="form-control" id="addAAddress" name="addAAddress">
                                <span class="error text-danger" id="addrError"></span>
                            </div>
                            <!-- <div class="mb-3 hide">
                                <label for="addAImage" class="form-label">Image</label>
                                <input type="file" class="form-control" id="addAImage" name="addAImage">
                                <span class="error text-danger" id="pimageError"></span>
                            </div> -->
                            <div class="upload-container mb-3 hide">
                                <input type="file" class="form-control" id="addAImage" name="addAImage">
                                <label for="addAImage" class="form-label">
                                    <span>Upload Image</span>
                                </label>
                                <span class="file-name">No File chosen</span>
                                <span class="error text-danger" id="xAimageError"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Account Modal END -->

    <!-- Edit Account Admin Modal START -->
    <div class="modal fade" id="editAdminModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editAForm" method="POST">
                    <div class="modal-body">
                        <input type="hidden" id="editAId" name="editAId">
                        <div class="mb-3">
                            <label for="editAFname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="editAFname" name="editAFname">
                            <span class="error text-danger" id="xafnameError"></span>
                        </div>
                        <div class="mb-3">
                            <label for="editALname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="editALname" name="editALname">
                            <span class="error text-danger" id="xalnameError"></span>
                        </div>
                        <div class="mb-3">
                            <label for="editAEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editAEmail" name="editAEmail">
                            <span class="error text-danger" id="xaemailError"></span>
                        </div>
                        <div class="mb-3">
                            <label for="editAUname" class="form-label">Username</label>
                            <input type="text" class="form-control" id="editAUname" name="editAUname">
                            <span class="error text-danger" id="xaunameError"></span>
                        </div>
                        <div class="mb-3">
                            <label for="editAPass" class="form-label">Password</label>
                            <input type="text" class="form-control" id="editAPass" name="editAPass" placeholder="Change the Password">
                            <span class="error text-danger" id="xapassError"></span>
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
    <!-- Edit Account Admin Modal END -->


    <!-- Edit Account Customer Modal START -->
    <div class="modal fade" id="editCustomerModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editCForm" method="POST">
                    <div class="modal-body">
                        <input type="text" id="editCId" name="editCId">
                        <div class="mb-3">
                            <label for="editCFname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="editCFname" name="editCFname">
                            <span class="error text-danger" id="xcfnameError"></span>
                        </div>
                        <div class="mb-3">
                            <label for="editCLname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="editCLname" name="editCLname">
                            <span class="error text-danger" id="xclnameError"></span>
                        </div>
                        <div class="mb-3">
                            <label for="editCEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editCEmail" name="editCEmail">
                            <span class="error text-danger" id="xcemailError"></span>
                        </div>
                        <div class="mb-3">
                            <label for="editCUname" class="form-label">Username</label>
                            <input type="text" class="form-control" id="editCUname" name="editCUname">
                            <span class="error text-danger" id="xcunameError"></span>
                        </div>
                        <div class="mb-3">
                            <label for="editCContact" class="form-label">Contact</label>
                            <input type="num" class="form-control" id="editCContact" name="editCContact">
                            <span class="error text-danger" id="xccontactError"></span>
                        </div>
                        <div class="mb-3">
                            <label for="editCAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="editCAddress" name="editCAddress">
                            <span class="error text-danger" id="xcaddressError"></span>
                        </div>
                        <div class="mb-3">
                            <label for="editCPass" class="form-label">Password</label>
                            <input type="text" class="form-control" id="editCPass" name="editCPass" placeholder="Change the Password">
                            <span class="error text-danger" id="xcpassError"></span>
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
    <!-- Edit Account Customer Modal END -->

    <script src="script.js"></script>
    <?php
    include '../TEMPLATES/footer.php';
    ?>