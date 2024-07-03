$(document).ready(function () {
  new DataTable("#adminTable");
  new DataTable("#customerTable");

  selectAccount();
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

// function userAccounts() {
//   $.ajax({
//     url: "code.php",
//     method: "GET",
//     dataType: "json",
//     success: function (response) {
//       // Admin table START
//       var adminTableBody = $("#adminTable tbody");
//       adminTableBody.empty();

//       if (response.length > 0) {
//         $.each(response, function (index, admin) {
//           if (admin.account_type == 1) {
//             var row = `
//                 <tr>
//                     <td>${admin.first_name} ${admin.last_name}</td>
//                     <td>${admin.email_address}</td>
//                     <td>${admin.username}</td>
//                     <td class="d-flex justify-content-center">
//                         <button class="btn btn-success me-3" id="editAdmin"><i class="fas fa-pen"></i></button>
//                         <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
//                     </td>
//                 </tr>
//             `;
//           }
//           adminTableBody.append(row);
//         });
//       }

//       new DataTable("#adminTable");
//       // Admin table END

//       // -----------------------------------------------------------------------------------------------------------------------------------

//       // Customer table START
//       var customerTableBody = $("#customerTable tbody");
//       customerTableBody.empty();

//       if (response.length > 0) {
//         $.each(response, function (index, customer) {
//           if (customer.account_type == 2) {
//             var row = `
//                 <tr>
//                     <td>${customer.first_name} ${customer.last_name}</td>
//                     <td>${customer.email_address}</td>
//                     <td>${customer.username}</td>
//                     <td>${customer.image}</td>
//                     <td>${customer.contact}</td>
//                     <td>${customer.address}</td>
//                     <td class="d-flex justify-content-center">
//                         <button class="btn btn-success me-3" id="editCustomer"><i class="fas fa-pen"></i></button>
//                         <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
//                     </td>
//                 </tr>
//             `;
//           }
//           customerTableBody.append(row);
//         });
//       }

//       new DataTable("#customerTable");
//       // Customer table END
//     },
//   });
// }
