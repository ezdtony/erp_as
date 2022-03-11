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
    $(document).on("click", "#reg_gasto_deducible", function () {
        console.log("reg_gasto_deducible");
    });
    $(document).on("click", "#reg_gasto_no_deducible", function () {
        console.log("reg_gasto_no_deducible");
    });
    
    $("#estado_dir").select2({
      dropdownParent: $("#registrarUsuario"),
    });
  
    $("#id_titulo").select2({
      dropdownParent: $("#registrarUsuario"),
    });
    $('#gastoDeducible').modal({backdrop: 'static', keyboard: false});
    $('#gastoNoDeducible').modal({backdrop: 'static', keyboard: false});
  });
  