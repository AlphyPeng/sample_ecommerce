<?php
include '../TEMPLATES/header.php';
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mt-4">Products</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div>
                <div>
                    <button class="btn btn-primary add-button" data-bs-toggle="modal" data-bs-target="#addProduct">
                        <i class="fas fa-plus me-2"></i>Add Products
                    </button>
                </div>
            </div>


            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-box me-1"></i>
                    Product Lists
                </div>
                <div class="card-body">
                    <table id="productTable">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Display the tr here from js -->
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="addProductModal" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="addPName" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="addPName" name="addPName">
                            <span class="error text-danger" id="pnameError"></span>
                        </div>
                        <div class="mb-3">
                            <label for="addPDescription" class="form-label">Description</label>
                            <input type="text" class="form-control" id="addPDescription" name="addPDescription">
                            <span class="error text-danger" id="pdescriptionError"></span>
                        </div>
                        <div class="mb-3">
                            <label for="addPQuantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="addPQuantity" name="addPQuantity">
                            <span class="error text-danger" id="pquantityError"></span>
                        </div>
                        <div class="mb-3">
                            <label for="addPPrice" class="form-label">Price</label>
                            <input type="number" class="form-control" id="addPPrice" name="addPPrice">
                            <span class="error text-danger" id="ppriceError"></span>
                        </div>
                        <div class="mb-3">
                            <label for="addPImage" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="addPImage" name="addPImage">
                            <span class="error text-danger" id="pimageError"></span>
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
    <script src="script.js"></script>
    <?php
    include '../TEMPLATES/footer.php';
    ?>