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

    if (fecha_pago != "" && cantidad != "") {
      /* if (
          img_payment.files.length > 0 &&
          pdf_payment.files.length > 0 &&
          xml_payment.files.length > 0
        )  */
      if (img_payment.files.length > 0) {
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
  $(document).on("click", "#reg_gasto_deducible", function () {
    console.log("reg_gasto_deducible");
  });
  $(document).on("click", "#reg_gasto_no_deducible", function () {
    console.log("reg_gasto_no_deducible");
  });

  $(document).on("change", "#id_area", function () {
    const id_area = $(this).val();
    $.ajax({
      url: "php/controllers/personal/personal_controller.php",
      method: "POST",
      data: {
        mod: "getAreaLevelsByAreaID",
        id_area: id_area,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);

        if (data.response == true) {
          $("#id_area_level").empty();
          $("#id_area_level").prop("disabled", false);
          $("#id_area_level").append(
            '<option value="">Seleccione un puesto *</option>'
          );
          for (var i = 0; i < data.data.length; i++) {
            $("#id_area_level").append(
              '<option value="' +
                data.data[i].id_niveles_areas +
                '">' +
                data.data[i].descripcion_niveles_areas +
                "</option>"
            );
          }
        } else {
          Swal.fire({
            icon: "error",
            title: "Verifique los datos ingresados",
          });
        }

        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {
        VanillaToasts.create({
          title: "Error",
          text: "Ocurrió un error, intentelo nuevamente",
          type: "error",
          timeout: 1200,
          positionClass: "topRight",
        });
      });
  });
  $(document).on("change", "#id_estado", function () {
    var id_estado = this.value;
    $.ajax({
      url: "php/controllers/directions_controller.php",
      method: "POST",
      data: {
        mod: "getMunicipios",
        id_estado: id_estado,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);
        $("#id_municipio").prop("disabled", false);
        if (data.response == true) {
          $("#id_municipio").empty();
          $("#id_municipio").append(
            '<option value="">Seleccione un municipio</option>'
          );
          for (var i = 0; i < data.data.length; i++) {
            $("#id_municipio").append(
              '<option value="' +
                data.data[i].id +
                '">' +
                data.data[i].municipio +
                "</option>"
            );
          }
        } else {
          Swal.fire({
            icon: "error",
            title: "Verifique los datos ingresados",
          });
        }

        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {
        VanillaToasts.create({
          title: "Error",
          text: "Ocurrió un error, intentelo nuevamente",
          type: "error",
          timeout: 1200,
          positionClass: "topRight",
        });
      });
  });
  $(document).on("click", "#generate_password", function () {
    $("#password").val(autoCreate(6));
  });
  $("#id_area").select2({
    dropdownParent: $("#registrarUsuario"),
  });
  $("#id_genero").select2({
    dropdownParent: $("#registrarUsuario"),
  });
  $("#id_area_level").select2({
    dropdownParent: $("#registrarUsuario"),
  });
  $("#id_academic_level").select2({
    dropdownParent: $("#registrarUsuario"),
  });

  $("#id_estado").select2({
    dropdownParent: $("#registrarUsuario"),
  });

  $("#id_municipio").select2({
    dropdownParent: $("#registrarUsuario"),
  });

  $("#registrarUsuario").modal({ backdrop: "static", keyboard: false });
  $("#id_academic_level").modal({ backdrop: "static", keyboard: false });

  function autoCreate(plength) {
    var chars =
      "abcdefghijklmnopqrstubwsyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    var password = "";
    for (i = 0; i < plength; i++) {
      password += chars.charAt(Math.floor(Math.random() * chars.length));
    }

    return password;
  }
});
