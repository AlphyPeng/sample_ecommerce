<?php
include '../TEMPLATES/header.php';
include 'code.php';
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
                                <th>No.</th>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM products";
                            $products = mysqli_query($conn, $query);

                            if (mysqli_num_rows($products) > 0) {

                                foreach ($products as $product) {
                            ?>
                                    <tr>
                                        <td><?php echo $product['id'] ?> </td>
                                        <td><?php echo $product['product_name'] ?></td>
                                        <td><?php echo $product['product_description'] ?></td>
                                        <td><?php echo $product['product_quantity'] ?></td>
                                        <td>₱ <?php echo $product['product_price'] ?></td>
                                        <td class="product_image-container">
                                            <img class="product-image " src="../../../img/products/<?php echo $product['product_image'] ?>">
                                        </td>
                                        <td class="">
                                            <button class="btn btn-success me-3 edit-button" data-id="<?php echo $product['id'] ?>" data-name="<?php echo $product['product_name'] ?>" data-description="<?php echo $product['product_description'] ?>" data-quantity="<?php echo $product['product_quantity'] ?>" data-price="<?php echo $product['product_price'] ?>" data-image="<?php echo $product['product_image'] ?>">
                                                <i class="fas fa-pen"></i>
                                            </button>

                                            </button> <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

    <!-- Add Product Modal START -->
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
    <!-- Add Product Modal END -->


    <!-- Edit Product Modal START -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" id="editPId" name="editPId">
                        <div class="mb-3">
                            <label for="editPName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editPName" name="editPName">
                            <span class="error text-danger" id="xpnameError"></span>
                        </div>
                        <div class="mb-3">
                            <label for="editPDescription" class="form-label">Description</label>
                            <input type="text" class="form-control" id="editPDescription" name="editPDescription">
                            <span class="error text-danger" id="xpdescriptionError"></span>
                        </div>
                        <div class="mb-3">
                            <label for="editPQuantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="editPQuantity" name="editPQuantity">
                            <span class="error text-danger" id="xpquantityError"></span>
                        </div>
                        <div class="mb-3">
                            <label for="editPPrice" class="form-label">Price</label>
                            <input type="text" class="form-control" id="editPPrice" name="editPPrice">
                            <span class="error text-danger" id="xppriceError"></span>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="editPImage" class="form-label">Product Image</label>
                            <input type="file" class="form-control" id="editPImage" name="editPImage">
                            <span class="error text-danger" id="xpimageError"></span>
                        </div> -->
                        <div class="upload-container mb-3">
                            <input type="file" class="form-control" id="editPImage" name="editPImage">
                            <label for="editPImage" class="form-label">
                                <span>Upload Image</span>
                            </label>
                            <span class="file-name">No File chosen</span>
                            <span class="error text-danger" id="xpimageError"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveChanges">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Product Modal END -->

    <script src="script.js"></script>
    <?php
    include '../TEMPLATES/footer.php';
    ?>