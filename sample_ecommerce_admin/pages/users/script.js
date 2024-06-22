$(document).ready(function () {
  userAccounts();
});

function userAccounts() {
  $.ajax({
    url: "code.php",
    method: "GET",
    dataType: "json",
    success: function (response) {
      // Admin table START
      var adminTableBody = $("#adminTable tbody");
      adminTableBody.empty();

      if (response.length > 0) {
        $.each(response, function (index, admin) {
          if (admin.account_type == 1) {
            var row = `
                <tr>
                    <td>${admin.first_name} ${admin.last_name}</td>
                    <td>${admin.email_address}</td>
                    <td>${admin.username}</td>
                    <td class="d-flex justify-content-center">
                        <button class="btn btn-success me-3" id="editAdmin"><i class="fas fa-pen"></i></button>
                        <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            `;
          }
          adminTableBody.append(row);
        });
      }

      new DataTable("#adminTable");
      // Admin table END

      // -----------------------------------------------------------------------------------------------------------------------------------

      // Customer table START
      var customerTableBody = $("#customerTable tbody");
      customerTableBody.empty();

      if (response.length > 0) {
        $.each(response, function (index, customer) {
          if (customer.account_type == 2) {
            var row = `
                <tr>
                    <td>${customer.first_name} ${customer.last_name}</td>
                    <td>${customer.email_address}</td>
                    <td>${customer.username}</td>
                    <td>${customer.image}</td>
                    <td>${customer.contact}</td>
                    <td>${customer.address}</td>
                    <td class="d-flex justify-content-center">
                        <button class="btn btn-success me-3" id="editCustomer"><i class="fas fa-pen"></i></button>
                        <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            `;
          }
          customerTableBody.append(row);
        });
      }

      new DataTable("#customerTable");
      // Customer table END
    },
  });
}
