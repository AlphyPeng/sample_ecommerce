<?php
include '../TEMPLATES/header.php';
include 'code.php';
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Users</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Products</li>
            </ol>

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Admin Accounts
                </div>
                <div class="card-body">
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
                                        <tr>
                                            <td><?php echo $user['first_name'], $user['last_name'] ?></td>
                                            <td><?php echo $user['email_address'] ?></td>
                                            <td><?php echo $user['username'] ?></td>
                                            <td class="">
                                                <button class="btn btn-success me-3 edit-button">
                                                    <i class="fas fa-pen"></i>
                                                </button>

                                                <button class="btn btn-danger delete-button"><i class="fas fa-trash"></i></button>

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

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Customer Accounts
                </div>
                <div class="card-body">
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
                                            <td><?php echo $user['first_name'], $user['last_name'] ?></td>
                                            <td><?php echo $user['email_address'] ?></td>
                                            <td><?php echo $user['username'] ?></td>
                                            <td class="image-container">
                                                <img class="image " src="../../../img/user_image/<?php echo $user['image'] ?>">
                                            </td>
                                            <td><?php echo $user['contact'] ?></td>
                                            <td><?php echo $user['address'] ?></td>
                                            <td class="">
                                                <button class="btn btn-success me-3 edit-button">
                                                    <i class="fas fa-pen"></i>
                                                </button>

                                                <button class="btn btn-danger delete-button"><i class="fas fa-trash"></i></button>

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
    </main>
    <script src="script.js"></script>
    <?php
    include '../TEMPLATES/footer.php';
    ?>