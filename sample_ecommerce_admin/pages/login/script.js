$(document).ready(function () {
  $("#loginForm").on("submit", function (e) {
    e.preventDefault();

    let formData = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "code.php",
      data: formData,
      dataType: "json",
      success: function (response) {
        $("span.error").text("");
        if (response.status === "success") {
          window.location.href = "../dashboard/dashboard.php";
        } else if (response.status === "error") {
          window.location.href = "login.php";
        } else {
          if (response.errors) {
            $.each(response.errors, function (key, message) {
              $("#" + key).text(message);
            });
          }
        }
      },
    });
  });
});
