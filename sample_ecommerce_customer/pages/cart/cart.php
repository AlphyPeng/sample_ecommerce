<?php
include '../TEMPLATES/header.php';
?>
<!-- Start Hero Section -->
<div class="hero">
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-lg-5">
				<div class="intro-excerpt">
					<h1>Cart</h1>
				</div>
			</div>
			<div class="col-lg-7">

			</div>
		</div>
	</div>
</div>
<!-- End Hero Section -->

<div class="untree_co-section before-footer-section">
	<form id="checkout" method="POST">
		<div class="container">
			<div class="row mb-5">
				<div class="col-md-12">
					<div class="site-blocks-table">
						<table class="table">
							<thead>
								<tr>
									<th class="product-thumbnail">Image</th>
									<th class="product-name">Product</th>
									<th class="product-price">Price</th>
									<th class="product-quantity">Quantity</th>
									<th class="product-total">Total</th>
									<th class="product-remove">Remove</th>
								</tr>
							</thead>
							<tbody>
								<?php
								include '../../config.php';

								$query = "SELECT 
									cart.id AS cart_id, 
									products.product_image, 
									products.product_price,
									cart.cart_product_name, 
									cart.cart_quantity, 
									user.id AS user_id
								FROM cart 
								INNER JOIN products ON cart.product_id = products.id
								INNER JOIN user ON cart.customer_id = user.id";

								$products = mysqli_query($conn, $query);

								if (mysqli_num_rows($products) > 0) {

									foreach ($products as $product) {
										if (isset($_SESSION['user_id'])) {
											if ($_SESSION['user_id'] == $product['user_id']) {
												?>
												<tr class="cart-row">
													<td class="product-thumbnail">
														<img src="../../../img/products/<?php echo $product['product_image'] ?>"
															alt="Image" class="img-fluid">
														<input type="hidden" name="cartId[]" value="<?php echo $product['cart_id'] ?>">
													</td>
													<td class="product-name">
														<h2 class="h5 text-black"><?php echo $product['cart_product_name'] ?></h2>
													</td>
													<td>₱ <span class="price"><?php echo $product['product_price'] ?></span></td>
													<td>
														<div class="input-group mb-3 d-flex align-items-center quantity-container"
															style="max-width: 120px;">
															<div class="input-group-prepend">
																<button class="btn btn-outline-black dec" type="button">&minus;</button>
															</div>
															<input type="text" class="form-control text-center quantity-amount"
																name="purchaseQty[]" value="<?php echo $product['cart_quantity'] ?>"
																placeholder="" aria-label="Example text with button addon"
																aria-describedby="button-addon1">
															<div class="input-group-append">
																<button class="btn btn-outline-black inc" type="button">&plus;</button>
															</div>
														</div>
													</td>
													<td class="ptotal">₱ <span class="priceTotal"></span>
														<input type="hidden" class="amount" name="amount[]" value="">
													</td>
													<td>
														<p class="btn btn-black btn-sm delete-cart"
															data-deltcart="<?php echo $product['cart_id'] ?>">X</p>
													</td>
												</tr>
												<?php
											}
										} else { ?>
											<script>
												$(document).ready(function () {
													loginLoc();
												});
												function loginLoc() {
													window.location.assign("../login/login.php")
												}
											</script>
										<?php }
									}
								} else { ?>
									<tr>
										<td colspan="6">No Data Listed.</td>
									</tr>
								<?php }
								?>

							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="row mb-5">
						<div class="col-md-6 mb-3 mb-md-0">
							<button class="btn btn-black btn-sm btn-block">Update Cart</button>
						</div>
						<div class="col-md-6">
							<button class="btn btn-outline-black btn-sm btn-block">Continue Shopping</button>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<label class="text-black h4" for="coupon">Coupon</label>
							<p>Enter your coupon code if you have one.</p>
						</div>
						<div class="col-md-8 mb-3 mb-md-0">
							<input type="text" class="form-control py-3" id="coupon" placeholder="Coupon Code">
						</div>
						<div class="col-md-4">
							<button class="btn btn-black">Apply Coupon</button>
						</div>
					</div>
				</div>
				<div class="col-md-6 pl-5">
					<div class="row justify-content-end">
						<div class="col-md-7">
							<div class="row">
								<div class="col-md-12 text-right border-bottom mb-5">
									<h3 class="text-black h4 text-uppercase">Cart Totals</h3>
								</div>
							</div>
							<div class="row mb-5">
								<div class="col-md-6">
									<span class="text-black">Total</span>
								</div>
								<div class="col-md-6 text-right">
									<strong class="text-black">₱ <span class="total"></span></strong>
									<input type="hidden" id="totalAmount" name="total" value="">
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<button type="submit" class="btn btn-black btn-lg py-3 btn-block"
										name="checkout">Proceed To Checkout</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<?php
include '../TEMPLATES/footer.php';
?>
<script src="script.js"></script>