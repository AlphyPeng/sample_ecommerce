$(document).ready(function () {
  productTable();
});

$(document).ready(function () {
  $("#addProductModal").submit(function (event) {
    event.preventDefault();

    var formData = new FormData(this);

    $.ajax({
      type: "POST",
      url: "code.php",
      data: formData,
      dataType: "json",
      contentType: false,
      processData: false,
      success: function (response) {
        $("span.error").text("");
        // Add Modal START
        if (response.status == "success") {
          Swal.fire({
            icon: "success",
            title: "Success",
            text: response.message,
          }).then(function () {
            window.location.href = "product.php";
          });
        }
        if (response.errors) {
          $.each(response.errors, function (key, message) {
            $("#" + key).text(message);
          });
        }
      },
    });
  });
});

// Add product modal START
function productTable() {
  $.ajax({
    url: "code.php",
    method: "GET",
    dataType: "json",
    success: function (response) {
      var productTable = $("#productTable tbody");
      productTable.empty();

      if (response.length > 0) {
        $.each(response, function (index, product) {
          var row = ` 
                          <tr>
                              <td>${product.product_name}</td>
                              <td>${product.product_description}</td>
                              <td>${product.product_quantity}</td>
                              <td>₱ ${product.product_price}</td>
                              <td class="product_image-container">
                                 <img class="product-image " src="../../../img/products/${product.product_image}">
                              </td>
                              <td class="">
                                  <button class="btn btn-success me-3" id="editAdmin"><i class="fas fa-pen"></i></button>
                                  <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                              </td>
                          </tr>`;
          productTable.append(row);
        });
      }
      new DataTable("#productTable");
    },
  });
}
// Add product modal END
