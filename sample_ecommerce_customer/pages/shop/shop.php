<?php
include '../TEMPLATES/header.php';
include '../../config.php';
?>

<!-- Start Hero Section -->
<div class="hero">
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-lg-5">
				<div class="intro-excerpt">
					<h1>Shop</h1>
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
		<div class="row" id="productList">
			<?php
			$query = "SELECT * FROM products";
			$products = mysqli_query($conn, $query);

			if (mysqli_num_rows($products) > 0) {
				foreach ($products as $product) {

			?>
					<div class="col-12 col-md-4 col-lg-3 mb-5">
						<div class="product-item">
							<a href="../product_details/product_details.php?id=<?php echo $product['id'] ?>" target=”_blank”>
								<img src="../../../img/products/<?php echo $product['product_image'] ?>" class="img-fluid product-thumbnail">
							</a>
							<h3 class="product-title"><?php echo $product['product_name'] ?></h3>
							<p><?php echo $product['product_description'] ?></p>
							<strong class="product-price">₱ <?php echo $product['product_price'] ?></strong>
							<span class="icon-cross">
								<button type="button" class="shadow btn custom-btn add-to-cart" data-pro-id="<?php echo $product['id'] ?>" data-pro-name="<?php echo $product['product_name'] ?>">Add to cart</button>
							</span>
						</div>
					</div>

			<?php }
			} ?>
		</div>
	</div>
</div>

<script src="script.js"></script>
<?php
include '../TEMPLATES/footer.php';
?>