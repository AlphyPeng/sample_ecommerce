$(document).ready(function () {
  getProductList();
});

function getProductList() {
  $.ajax({
    url: "code.php",
    method: "GET",
    dataType: "json",
    success: function (response) {
      var productList = $("#productList");

      if (response.length > 0) {
        $.each(response, function (index, product) {
          var pList = `
                    <div class="col-12 col-md-4 col-lg-3 mb-5">
                    <a class="product-item" href="../product_details/product_details.php?id=${product.id}" target=”_blank”>
                        <img src="../../../img/products/${product.product_image}" class="img-fluid product-thumbnail">
                        <h3 class="product-title">${product.product_name}</h3>
                        <p>${product.product_description}</p>
                        <strong class="product-price">₱ ${product.product_price}</strong>

                        <span class="icon-cross">
                            <img src="../../images/cross.svg" class="img-fluid">
                        </span>
                    </a>
                </div>
                `;
          productList.append(pList);
        });
      }
    },
  });
}
