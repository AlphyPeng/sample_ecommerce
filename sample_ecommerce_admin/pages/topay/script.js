$(document).ready(function () {
  new DataTable("#topayTable");
  new DataTable("#viewTopay");

  viewProduct();
  viewProductss();
});

function viewProduct() {
  $(".view-product").on("click", function () {
    var get_purchaseId = $(this).data("poidv");

    $.ajax({
      url: "code.php",
      method: "POST",
      dataType: "json",
      data: { purchase_id: get_purchaseId },
      success: function (data) {
        var myTableBody = $("#tableRow");

        myTableBody.empty();
        data.forEach((pay) => {
          var tableRow = ` <tr class="nc">
                                <td class="image-container">
                                    <img class="image" src="../../../img/products/${pay.product_image}" alt="">
                                </td>
                                <td class="product">${pay.cart_product_name}</td>
                                <td class="quantity">${pay.purchase_quantity}</td>
                                <td class="total">₱ ${pay.purchase_amount}</td>
                            </tr>`;
          myTableBody.append(tableRow);
        });

        $("#viewOrder").modal("show");
      },
    });
  });
}

function viewProductss() {
  $(".view-product").on("click", function () {
    var get_purchaseId = $(this).data("poidv");

    $.ajax({
      url: "code.php",
      method: "POST",
      dataType: "json",
      data: { get_totalAmount: get_purchaseId },
      success: function (data) {
        $(".totalCost").text(data.total_purchase);
        $("#viewOrder").modal("show");
      },
    });
  });
}
