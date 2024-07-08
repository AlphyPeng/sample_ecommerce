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
    $("#editAId").val($(this).data("aid"));
    $("#editAFname").val($(this).data("afname"));
    $("#editALname").val($(this).data("alname"));
    $("#editAEmail").val($(this).data("aemail"));
    $("#editAUname").val($(this).data("auname"));

    // Show Edit Admin Modal
    $("#editAdminModal").modal("show");
  });
}

$(document).ready(function () {
  // Add Account Modal START
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
  // Add Account Modal END

  // Edit Admin Account Modal START
  $("#editAForm").submit(function (e) {
    e.preventDefault();

    let formData = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "code.php",
      data: formData,
      dataType: "json",
      success: function (response) {
        $("span.error").text();

        if (response.status === "success") {
          Swal.fire({
            icon: "success",
            title: "Success",
            text: response.message,
          }).then(function () {
            window.location.href = "users.php";
          });
        }
        if (response.errors) {
          $.each(response.errors, function (key, message) {
            $("#" + key).text(message);
          });
        }
      },
      error: function (data) {
        alert(data);
      },
    });
  });
  // Edit Admin Account Modal END

  // Delete Admin Account START
  $(".delete-admin").on("click", function () {
    var delete_admin = $(this).data("deltadmin");
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    }).then(function (result) {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "code.php",
          data: {
            admin_id: delete_admin,
          },
          dataType: "json",
          success: function (response) {
            if (response.status == "success") {
              Swal.fire({
                icon: "success",
                title: "Success",
                text: response.message,
              }).then(function () {
                window.location.href = "users.php";
              });
            }
          },
        });
      }
    });
  });
  // Delete Admin Account END
});
