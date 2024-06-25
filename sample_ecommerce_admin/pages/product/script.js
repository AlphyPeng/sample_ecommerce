$(document).ready(function () {
  new DataTable("#productTable");

  // View image file name when select
  $("#editPImage").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(".file-name").text(fileName);
  });
});

$(document).ready(function () {
  // Add product modal START
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
  // Add product modal END

  // Edit product module START
  $(".edit-button").on("click", function () {
    // Get data from button
    var id = $(this).data("id");
    var name = $(this).data("name");
    var description = $(this).data("description");
    var quantity = $(this).data("quantity");
    var price = $(this).data("price");
    var image = $(this).data("image");

    // Set data to modal fields
    $("#editPId").val(id);
    $("#editPName").val(name);
    $("#editPDescription").val(description);
    $("#editPQuantity").val(quantity);
    $("#editPPrice").val(price);
    // if (image) {
    //   $("#editPImage").attr("src", image).hide();
    // } else {
    //   $("#editPImage").hide();
    // }

    // Show modal
    $("#editModal").modal("show");
  });

  // Form submission handler
  $("#editForm").submit(function (e) {
    e.preventDefault(); // Prevent actual form submission

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
        if (response.status == "uploadError") {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: response.message,
          });
        }
      },
    });
  });
  // Edit product modal END
  // Edit product module END
});
