$(document).ready(function () {
  incdecQty();
  $(".cart-row").each(function () {
    multiplyTotal(this);
  });
  cartTotal();

  deleteCart();

  checkOut();
});

function incdecQty() {
  $(".inc").on("click", function () {
    var quantityAmount = $(this)
      .closest(".quantity-container")
      .find(".quantity-amount");
    var currentQty = parseInt(quantityAmount.val());

    quantityAmount.attr("value", currentQty + 1).val(currentQty + 1);

    //update in realtime multiplyTotal and cartTotal
    multiplyTotal($(this).closest(".cart-row"));
    cartTotal($(this).closest(".cart-row"));
  });

  $(".dec").on("click", function () {
    var quantityAmount = $(this)
      .closest(".quantity-container")
      .find(".quantity-amount");
    var currentQty = parseInt(quantityAmount.val());

    if (currentQty > 1) {
      quantityAmount.attr("value", currentQty - 1).val(currentQty - 1);

      //update in realtime multiplyTotal cartTotal
      multiplyTotal($(this).closest(".cart-row"));
      cartTotal($(this).closest(".cart-row"));
    }
  });

  //update in realtime multiplyTotal cartTotal
  $(".quantity-amount").on("keyup", function () {
    multiplyTotal($(this).closest(".cart-row"));
    cartTotal($(this).closest(".cart-row"));
  });
}

function multiplyTotal(row) {
  var qtyAmount = parseInt($(row).find(".quantity-amount").val());
  var cost = parseInt($(row).find(".price").text());

  var amount = qtyAmount * cost;

  $(row).find(".priceTotal").text(amount);
}

function cartTotal() {
  var sum = 0;
  var totalPrice = $(".priceTotal");

  $(".priceTotal").each(function () {
    sum = sum + parseInt($(this).text());
  });

  $(".total").text(sum);
}

function deleteCart() {
  $(".delete-cart").on("click", function () {
    var delete_cart = $(this).data("deltcart");
    var cartRow = $(this).closest(".cart-row");

    $.ajax({
      type: "POST",
      url: "code.php",
      data: { cart_id: delete_cart },
      dataType: "json",
      success: function (response) {
        if (response.status == "success") {
          Swal.fire({
            icon: "success",
            title: "Success",
            text: response.message,
          }).then(function () {
            cartRow.remove();
          });
        }
      },
      error: function (xhr, status, error) {
        console.log(error);
      },
    });
  });
}

function checkOut() {
  $("#checkout").on("submit", function (e) {
    e.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
      method: "POST",
      url: "code.php",
      data: formData,
      dataType: "json",
      success: function (response) {
        if (response.status == "success") {
          Swal.fire({
            icon: "success",
            title: "Success",
            text: response.message,
          }).then(function () {
            window.location.href = "cart.php";
          });
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
      },
    });
  });
}
