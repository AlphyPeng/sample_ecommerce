<?php
include '../TEMPLATES/header.php';
include 'code.php';
?>
<!-- Start Hero Section -->
<div class="hero">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-5">
                <div class="intro-excerpt">
                    <h1>Prduct Details</h1>
                </div>
            </div>
            <div class="col-lg-7">
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->


<div class="untree_co-section product-section before-footer-section">
    <div class="container">
        <div class="row product-details" id="productList">
            <?php if ($product) ?>
            <div class="row">
                <div class="col-md-5">
                    <div class="main-img bg-white">
                        <img class="img-fluid" src="../../../img/products/<?php echo $product['product_image'] ?>" alt="ProductS">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="main-description">
                        <h1 class="product-title text-bold my-3">
                            <?php echo $product['product_name'] ?>
                        </h1>
                        <h1>₱ <?php echo $product['product_price'] ?></h1>
                        <p>Total Quantity: <?php echo $product['product_quantity'] ?></p>
                        <div class="buttons d-flex my-3">
                            <div class="me-3">
                                <button class="shadow btn custom-btn">Add to cart</button>
                            </div>
                            <div>
                                <input type="number" class="form-control" id="cart_quantity" value="1" min="1" max="10" name="cart_quantity">
                            </div>
                        </div>
                    </div>
                    <div class="my-4">
                        <h4>Product Description</h4>
                        <p class="description">
                            <?php echo $product['product_description'] ?>
                        </p>
                    </div>

                    <div class="row questions bg-light p-3">
                        <div class="col-md-1 icon">
                            <i class="fa-brands fa-rocketchat questions-icon"></i>
                        </div>
                        <div class="col-md-11 text">
                            Have a question about our products at E-Store? Feel free to contact our representatives via live chat or email.
                        </div>
                    </div>

                    <div class="delivery my-4">
                        <p class="font-weight-bold mb-0"><span><i class="fa-solid fa-truck"></i></span> <b>Delivery done in 3 days from date of purchase</b> </p>
                        <p class="text-secondary">Order now to get this product delivery</p>
                    </div>
                    <div class="delivery-options my-4">
                        <p class="font-weight-bold mb-0"><span><i class="fa-solid fa-filter"></i></span> <b>Delivery options</b> </p>
                        <p class="text-secondary">View delivery options here</p>
                    </div>
                </div>
            </div>
            <?php ?>
        </div>
    </div>
</div>

<script src="script.js"></script>
<?php
include '../TEMPLATES/footer.php';
?>