//|console.log("load_creditos");
$(document).ready(function () {
  $(document).on("click", ".btn_agregarSaldo", function () {
    var id_credito = $(this).attr("id");
    $(".guardar_saldo_extra").attr("id", id_credito);

    $.ajax({
      url: "php/controllers/credits_controller.php",
      method: "POST",
      data: {
        mod: "getInfoCredit",
        id_credito: id_credito,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);

        if (data.response == true) {
          Swal.close();
          $("#titulo_agregarSaldo").text(data.data[0].proveedor);
        } else {
          Swal.fire({
            icon: "error",
            title: "Ocurrió un error al consultar la información",
          });
        }
        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {
        Swal.fire({
          title: "Error!",
          text: "Algo salió mal",
          icon: "info",
        });
      });
  });
  $(document).on("click", ".guardar_saldo_extra", function () {
    
    var id_credito = $(this).attr("id");
    var fecha_pago = $("#fecha_deposito").val();
    var cantidad = $("#cantidad").val();
console.log(fecha_pago);
console.log(cantidad);
    const img_payment = document.querySelector("#img_pago_extra");
    //const pdf_payment = document.querySelector("#pdf_pago");
    //const xml_payment = document.querySelector("#xml_pago");

    if (
      fecha_pago != "" &&
      cantidad != ""
    ) {
      
      /* if (
        img_payment.files.length > 0 &&
        pdf_payment.files.length > 0 &&
        xml_payment.files.length > 0
      )  */
      if (
        img_payment.files.length > 0
      ) {
        let formData = new FormData();
        formData.append("img_payment", img_payment.files[0]);
        //formData.append("pdf_payment", pdf_payment.files[0]);
        //formData.append("xml_payment", xml_payment.files[0]);

        formData.append("id_credito", id_credito);
        formData.append("fecha_pago", fecha_pago);
        formData.append("cantidad", cantidad);
        //formData.append("fecha_pago", fecha_pago);
        //formData.append("monto_pago", monto_pago);

        fetch("php/controllers/save_credits_saldo_extra.php", {
          method: "POST",
          mod: "savePaymentVoucher",
          body: formData,
        })
          .then((respuesta) => respuesta.json())
          .then((decodificado) => {
            console.log(decodificado.last_id);
            Swal.fire({
              title: "Saldo agregado!",
              text: decodificado.message,
              icon: "success",
              timer: 1500,
            }).then((result) => {
              location.reload();
            });
          });
      } else {
        Swal.fire({
          title: "Error",
          text: "Debe seleccionar todos los archivos",
          img: "error",
          confirmButtonText: "Ok",
        });
      }
    } else {
      Swal.fire({
        title: "Error",
        text: "Debe llenar todos los campos",
        icon: "error",
        confirmButtonText: "Ok",
      });
    }
  });

  $(document).on("click", ".save_credit", function () {
    console.log("save_credit");
    var proveedor = $("#proveedor").val();
    var fiscal_code = $("#fiscal_code").val();
    var fecha_pago = $("#fecha_pago").val();
    var monto_pago = $("#monto_pago").val();

    const img_payment = document.querySelector("#img_pago");
    const pdf_payment = document.querySelector("#pdf_pago");
    const xml_payment = document.querySelector("#xml_pago");

    if (
      proveedor != "" &&
      fiscal_code != "" &&
      fecha_pago != "" &&
      monto_pago != ""
    ) {
      if (
        img_payment.files.length > 0 &&
        pdf_payment.files.length > 0 &&
        xml_payment.files.length > 0
      ) {
        let formData = new FormData();
        formData.append("img_payment", img_payment.files[0]);
        formData.append("pdf_payment", pdf_payment.files[0]);
        formData.append("xml_payment", xml_payment.files[0]);

        formData.append("proveedor", proveedor);
        formData.append("fiscal_code", fiscal_code);
        formData.append("fecha_pago", fecha_pago);
        formData.append("fecha_pago", fecha_pago);
        formData.append("monto_pago", monto_pago);

        fetch("php/controllers/save_credits_documents_info.php", {
          method: "POST",
          mod: "savePaymentVoucher",
          body: formData,
        })
          .then((respuesta) => respuesta.json())
          .then((decodificado) => {
            console.log(decodificado.last_id);
            Swal.fire({
              title: "¡Archivo guardado!",
              text: "Se  registro el nuevo crédito correctamente!!!",
              icon: "success",
              timer: 1500,
            }).then((result) => {
              location.reload();
            });
          });
      } else {
        Swal.fire({
          title: "Error",
          text: "Debe seleccionar todos los archivos",
          img: "error",
          confirmButtonText: "Ok",
        });
      }
    } else {
      Swal.fire({
        title: "Error",
        text: "Debe llenar todos los campos",
        icon: "error",
        confirmButtonText: "Ok",
      });
    }
  });

  graficarDatos();

  function graficarDatos() {
    var limpiar = "";
    //$("#grafica_dona").empty();

    $.ajax({
      url: "php/controllers/graphics_controller.php",
      method: "POST",
      data: {
        mod: "getCreditsChartData",
      },
      dataType: "json",
    })
      .done(function (chart_data) {
        console.log(chart_data);

        var tipo = [];
        var gasto = [];
        var colores = [];

        var coloresDinamicos = function () {
          var r = Math.round(Math.random() * 255);
          var g = Math.round(Math.random() * 255);
          var b = Math.round(Math.random() * 255);
          return "rgba(" + r + "," + g + "," + b + "," + "0.75)";
        };

        //console.log(number);
        if (chart_data.length == 0) {
          $("#div_graficas").hide();
          $("#div_graficas_vacias").show();
        }
        console.log("fuera");
        for (var i = 0; i < chart_data.data.length; i++) {
          console.log("dentro");

          var id_credito = chart_data.data[i].id_credito;
          var canvas_grafica = "credito_" + id_credito;
          var monto = chart_data.data[i].monto;
          var saldo = chart_data.data[i].saldo;
          var diferencia = monto - saldo;
          colores.push(coloresDinamicos());

          var ctx = document.getElementById(canvas_grafica).getContext("2d");
          var myChart = new Chart(ctx, {
            type: "doughnut",
            data: {
              labels: ["Gastado", "Disponible"],
              datasets: [
                {
                  label: "Cantidad",
                  data: [diferencia, saldo],
                  backgroundColor: ["rgb(128, 135, 129)", "rgb(0, 209, 17)"],
                  borderColor: ["rgba(255, 255, 255, 1)"],
                  borderWidth: 1,
                  hoverOffset: 30,
                },
              ],
            },
            responsive: true,
            maintainAspectRatio: true,
          });
        }
      })
      .fail(function (message) {
        console.log(message);
        Swal.fire({
          title: "Datos no registrados!",
          text: "Ocurrió un error al guardar la información",
          icon: "info",
        });
      });
  }

  $("#estado_dir").select2({
    dropdownParent: $("#registrarUsuario"),
  });

  $("#id_titulo").select2({
    dropdownParent: $("#registrarUsuario"),
  });
});
