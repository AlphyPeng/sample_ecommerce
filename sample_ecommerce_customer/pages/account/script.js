$(document).ready(function () {
  // Change name and address START
  $("#editNameAddModal").on("submit", function (e) {
    e.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
      type: "POST",
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
            window.location.href = "account.php";
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
  // Change name and address END

  // Change personal information START
  $("#editPersonalInfoModal").on("submit", function (e) {
    e.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
      type: "POST",
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
            window.location.href = "account.php";
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
  // Change personal information END
});
