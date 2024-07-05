$(document).ready(function () {
  new DataTable("#adminTable");
  new DataTable("#customerTable");

  selectAccount();
  editAdminModal();

  $("#addAImage").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(".file-name").text(fileName);
  });
});

function selectAccount() {
  if ($("#accountType").val() == 0) {
    $(".hide-all").hide();
  }

  $("#accountType").on("change", function () {
    if (this.value === "1") {
      $(".hide").hide();
      $(".hide input").val("");
      $(".hide-all").show();
    } else if (this.value === "2") {
      $(".hide").show();
      $(".hide-all").show();
    } else {
      if (this.value === "0") {
        $(".hide-all").hide();
      }
    }
  });
}

function editAdminModal() {
  $(".edit-admin").on("click", function () {
    $("#editAFname").val($(this).data("afname"));
    $("#editALname").val($(this).data("alname"));
    $("#editAEmail").val($(this).data("aemail"));
    $("#editAUname").val($(this).data("auname"));

    // Show Edit Admin Modal
    $("#editAdminModal").modal("show");
  });
}

$(document).ready(function () {
  $("#addAccountModal").submit(function (event) {
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

        if (response.status === "success") {
          Swal.fire({
            icon: "success",
            title: "Success",
            text: response.message,
          }).then(function () {
            window.location.href = "users.php";
          });
        } else {
          if (response.errors) {
            $.each(response.errors, function (key, message) {
              $("#" + key).text(message);
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: response.message,
            });
          }
        }
      },
    });
  });
});
