$(document).ready(function () {
  // Change name and address START
  $("#editNameAddModal").on("submit", function (e) {
    e.preventDefault();

    var formData = new FormData(this);

    $.ajax({
      type: "POST",
      url: "code.php",
      data: formData,
      dataType: "json",
      contentType: false,
      processData: false,
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
        if (response.status == "uploadError") {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: response.message,
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

  //Upload Profile Image START
  $("#uploadImage").on("change", function () {
    var imageName;

    if (this.files.length > 0) {
      imageName = this.files[0].name;
    } else {
      imageName = "No image chosen";
    }

    var imageNameDisplay = $(".file-name");
    imageNameDisplay.text(imageName);
  });
  //Upload Profile Image END
});
