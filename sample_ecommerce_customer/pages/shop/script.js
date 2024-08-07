$(document).ready(function () {
  addToCart();
});

function addToCart() {
  $(document).on("click", ".add-to-cart", function (e) {
    e.preventDefault();

    var prod_id = $(this).data("pro-id");
    var prod_name = $(this).data("pro-name");

    $.ajax({
      url: "code.php",
      method: "POST",
      data: {
        product_id: prod_id,
        product_name: prod_name,
      },
      dataType: "json",
      success: function (response) {
        if (response.status == "success") {
          Swal.fire({
            icon: "success",
            title: "Success",
            text: response.message,
          });
        } else if (response.status == "error") {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: response.message,
          });
        } else if (response.status == "error") {
          Swal.fire({
            icon: "login",
            title: "Error",
            text: response.message,
          }).then(function () {
            window.location.href = "../login/login.php";
          });
        }
      },
      // error: function () {
      //   window.location.href = "../login/login.php";
      // },
    });
  });
}
