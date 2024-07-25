<?php
include '../TEMPLATES/header.php';
include 'code.php';
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mt-4">To Pay</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">To Pay</li>
                    </ol>
                </div>
            </div>


            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-box me-1"></i>
                    To Pay Lists
                </div>
                <div class="card-body">
                    <table id="topayTable">
                        <thead>
                            <tr>
                                <th>Purchase No.</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Total Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../../config.php';

                            $sql = $conn->prepare("SELECT * FROM total_amount_purchase
                        INNER JOIN user ON user.id = total_amount_purchase.customer_id
                        WHERE status = 'pay'");
                            $sql->execute();
                            $result = $sql->get_result();
                            ?>
                            <?php
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $row['purchase_id']; ?></td>
                                    <td><?php echo $row['first_name'] . " " . $row['last_name']; ?></td>
                                    <td><?php echo $row['email_address']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td><?php echo $row['contact']; ?></td>
                                    <td>₱ <?php echo $row['total_purchase']; ?></td>
                                    <td>
                                        <button class="btn btn-info me-3 text-white view-product"
                                            data-poidv="<?php echo $row['purchase_id']; ?>">
                                            <i class="fas fa-eye"></i>
                                        </button>

                                        <button class="btn btn-danger delete-customer" data-deltcustomer=""><i
                                                class="fas fa-trash"></i></button>

                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>


    <div class="modal fade" id="viewOrder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Products</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="tableRow">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <div class="fw-bold">Total: ₱ <span class="totalCost"></span></div>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <?php
    include '../TEMPLATES/footer.php';
    ?>