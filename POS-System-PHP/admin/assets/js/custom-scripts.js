$(document).ready(function () {
  alertify.set("notifier", "position", "top-right");

  //
  $(document).on("click", ".increment", function () {
    var $quantityInput = $(this).closest(".qtyBox").find(".qty");
    var $product_id = $(this).closest(".qtyBox").find(".prodId").val();
    var currentValue = parseInt($quantityInput.val());

    if (!isNaN(currentValue)) {
      var qtyVal = currentValue + 1;
      $quantityInput.val(qtyVal);
      quantityIncDec($product_id, qtyVal);
    }
  });

  //
  $(document).on("click", ".decrement", function () {
    var $quantityInput = $(this).closest(".qtyBox").find(".qty");
    var $product_id = $(this).closest(".qtyBox").find(".prodId").val();
    var currentValue = parseInt($quantityInput.val());

    if (!isNaN(currentValue) && currentValue > 1) {
      var qtyVal = currentValue - 1;
      $quantityInput.val(qtyVal);
      quantityIncDec($product_id, qtyVal);
    }
  });

  //
  function quantityIncDec(prodId, qty) {
    $.ajax({
      type: "POST",
      url: "orders-code.php",
      data: {
        productIncdec: true,
        product_id: prodId,
        quantity: qty,
      },
      success: function (response) {
        var res = JSON.parse(response);
        if (res.status == 200) {
          // window.location.reload();
          // To reload specific area
          $("#productArea").load(" #productContent");
          alertify.success(res.message);
        } else {
          $("#productArea").load(" #productContent");
          alertify.error(res.message);
        }
      },
    });
  }

  // Procced to place order button click
  $(document).on("click", ".proceedToPlace", function () {
    var payment_mode = $("#payment_mode").val();
    var cphone = $("#cphone").val();
    if (payment_mode == "") {
      swal("Select Payment Mode", "Please select your payment mode", "warning");
      return false;
    }

    if (cphone == "" && !$.isNumeric(cphone)) {
      swal(
        "Enter Phone Number",
        "Please enter a valid phone number",
        "warning"
      );
      return false;
    }

    var data = {
      proccedToPlaceBtn: true,
      payment_mode: payment_mode,
      cphone: cphone,
    };
    $.ajax({
      type: "POST",
      url: "orders-code.php",
      data: data,
      success: function (response) {
        var res = JSON.parse(response);
        if (res.status == 200) {
          window.location.href = "order-summary.php";
        } else if (res.status == 404) {
          swal("Customer not found.", res.message, res.status_type, {
            buttons: {
              catch: {
                text: "Add Customer",
                value: "catch",
              },
              cancel: "Cancel",
            },
          }).then((value) => {
            switch (value) {
              case "catch":
                // console.log("Modal");
                $("#c_phone").val(cphone);
                $("#addCustomerModal").modal("show");
                break;
              default:
            }
          });
        } else {
          swal("Something went wrong", res.message, res.status_type);
        }
      },
    });
  });

  // Add customer to customer's table
  $(document).on("click", ".saveCustomer", function () {
    var c_name = $("#c_name").val();
    var c_phone = $("#c_phone").val();
    var c_email = $("#c_email").val();
    var c_address = $("#c_address").val();

    if (c_name != "" && c_phone != "") {
      if ($.isNumeric(c_phone)) {
        var data = {
          saveCustomerBtn: true,
          name: c_name,
          phone: c_phone,
          email: c_email,
          address: c_address,
        };

        $.ajax({
          type: "POST",
          url: "orders-code.php",
          data: data,
          success: function (response) {
            var res = JSON.parse(response);
            if (res.status == 200) {
              swal("", res.message, res.status_type);
              $("#addCustomerModal").modal("hide");
            } else if (res.status == 500) {
              swal("Something went wrong.", res.message, res.status_type);
            } else {
              swal("Something went wrong.", res.message, res.status_type);
            }
          },
        });
      } else {
        swal("Enter valid phone number", "", "warning");
      }
    } else {
      swal("Please fill the required fields", "", "warning");
    }
  });

  // On customer's order save
  $(document).on("click", "#saveOrder", function () {
    $.ajax({
      type: "POST",
      url: "orders-code.php",
      data: {
        saveOrder: true,
      },
      success: function (response) {
        var res = JSON.parse(response);
        if (res.status == 200) {
          swal(res.message, res.message, res.status_type);
          $("#orderPlaceSuccess").text(res.message);
          $("#orderSuccessModal").modal("show");
        } else {
          swal(res.message, res.message, res.status_type);
        }
      },
    });
  });
});

// Print billing area
function printBillingArea() {
  var divContents = document.getElementById("myBillingArea").innerHTML;
  var a = window.open("", "");
  a.document.write("<html><title>POS System in PHP</title>");
  a.document.write('<body style="font-family: fangsong;">');
  a.document.write(divContents);
  a.document.write("</body</html>");
  a.document.close();
  a.print();
}

// Downlaod pdf
window.jsPDF = window.jspdf.jsPDF;
var docPDF = new jsPDF();

function downloadPDF(invoiceNo) {
  var elementHTML = document.querySelector("#myBillingArea");
  docPDF.html(elementHTML, {
    callback: function () {
      docPDF.save(invoiceNo + ".pdf");
    },
    x: 15,
    y: 15,
    width: 170,
    windowWidth: 650,
  });
}
