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

  $(document).on("click", "#guardarUsuario", function () {
    /* Info general */
    loading();
    var id_area_level = $("#id_area_level").val();
    var id_academic_level = $("#id_academic_level").val();
    var id_genero = $("#id_genero").val();
    var nombre = $("#nombre").val();
    var ap_paterno = $("#ap_paterno").val();
    var ap_materno = $("#ap_materno").val();
    var curp = $("#curp").val();
    var nss = $("#nss").val();
    var fecha_nacimiento = $("#fecha_nacimiento").val();
    var rfc = $("#rfc").val();
    var id_estado_civil = $("#id_estado_civil").val();

    /* Info domicilio */
    var calle = $("#calle").val();
    var numero = $("#numero").val();
    var colonia = $("#colonia").val();
    var cp = $("#cp").val();
    var id_municipio = $("#id_municipio option:selected").text();
    var id_estado = $("#id_estado option:selected").text();

    /* Info de contacto */
    var telefono_pricnipal = $("#telefono_pricnipal").val();
    var telefono_secundario = $("#telefono_secundario").val();
    var correo_personal = $("#correo_personal").val();
    var telefono_familiar_pricnipal = $("#telefono_familiar_pricnipal").val();
    var telefono_familiar_secundario = $("#telefono_familiar_secundario").val();

    /* Info de login */
    var email_login = $("#email_login").val();
    var password_login = $("#password").val();

    if (
      id_area_level == "" ||
      id_academic_level == "" ||
      id_genero == "" ||
      fecha_nacimiento == "" ||
      nombre == "" ||
      ap_paterno == "" ||
      ap_materno == "" ||
      curp == "" ||
      id_estado_civil == "" ||
      calle == "" ||
      numero == "" ||
      colonia == "" ||
      cp == "" ||
      id_municipio == "" ||
      id_estado == "" ||
      telefono_pricnipal == "" ||
      correo_personal == "" ||
      telefono_familiar_pricnipal == "" ||
      email_login == "" ||
      password_login == ""
    ) {
      Swal.close();
      Swal.fire({
        title: "Atención!",
        text: "Debe llenar todos los campos",
        icon: "error",
        confirmButtonText: "Ok",
      });
    } else {
      $.ajax({
        url: "php/controllers/personal/personal_controller.php",
        method: "POST",
        data: {
          mod: "saveNewUser",
          id_area_level: id_area_level,
          id_academic_level: id_academic_level,
          id_genero: id_genero,
          nombre: nombre,
          ap_paterno: ap_paterno,
          ap_materno: ap_materno,
          curp: curp,
          nss: nss,
          fecha_nacimiento: fecha_nacimiento,
          rfc: rfc,
          id_estado_civil: id_estado_civil,
          calle: calle,
          numero: numero,
          colonia: colonia,
          cp: cp,
          id_municipio: id_municipio,
          id_estado: id_estado,
          telefono_pricnipal: telefono_pricnipal,
          telefono_secundario: telefono_secundario,
          correo_personal: correo_personal,
          telefono_familiar_pricnipal: telefono_familiar_pricnipal,
          telefono_familiar_secundario: telefono_familiar_secundario,
          email_login: email_login,
          password_login: password_login,
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          Swal.close();
          if (data.response == true) {
            Swal.fire({
              title: "¡Registro exitoso!",
              html:
                "CORREO DE USUARIO: <strong>" +
                data.user_email +
                "</strong><br>" +
                "CÓDIGO DE USUARIO: <strong>" +
                data.user_code +
                "</strong><br>" +
                "CONTRASEÑA: <strong>" +
                data.user_password +
                "</strong>",
              icon: "success",
              //timer: 1500,
            }).then((result) => {
              location.reload();
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Verifique los datos ingresados",
              text: "Error al iniciar sesión",
            });
          }
          //--- --- ---//
          //--- --- ---//
        })
        .fail(function (message) {
          Swal.close();
          Swal.fire({
            title: "Datos no registrados!",
            text: "Ocurrió un error al guardar la información",
            icon: "info",
          });
        });
    }
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

  $(".change_user_status").change(function () {
    var id_user = $(this).attr("id");
    if (this.checked) {
      $.ajax({
        url: "php/controllers/personal/personal_controller.php",
        method: "POST",
        data: {
          mod: "changeStatusUser",
          id_user: id_user,
          status: 1,
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          if (data.response == true) {
            $.NotificationApp.send(
              data.message,
              "",
              "top-left",
              "#06996f",
              "success"
            );
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
    } else {
      $.ajax({
        url: "php/controllers/personal/personal_controller.php",
        method: "POST",
        data: {
          mod: "changeStatusUser",
          id_user: id_user,
          status: 0,
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          if (data.response == true) {
            $.NotificationApp.send(
              data.message,
              "",
              "top-left",
              "#06996f",
              "success"
            );
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
    }
  });
  $(".send_viatics_mail").change(function () {
    var id_user = $(this).attr("data-id-user");
    loading();
    if (this.checked) {
      $.ajax({
        url: "php/controllers/personal/personal_controller.php",
        method: "POST",
        data: {
          mod: "changeSendViaticsMail",
          id_user: id_user,
          status: 1,
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          if (data.response == true) {
            Swal.close();
            $.NotificationApp.send(
              data.message,
              "",
              "top-left",
              "#06996f",
              "success"
            );
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
          Swal.close();
          VanillaToasts.create({
            title: "Error",
            text: "Ocurrió un error, intentelo nuevamente",
            type: "error",
            timeout: 1200,
            positionClass: "topRight",
          });
        });
    } else {
      $.ajax({
        url: "php/controllers/personal/personal_controller.php",
        method: "POST",
        data: {
          mod: "changeSendViaticsMail",
          id_user: id_user,
          status: 0,
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          if (data.response == true) {
            Swal.close();
            $.NotificationApp.send(
              data.message,
              "",
              "top-left",
              "#06996f",
              "success"
            );
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
          Swal.close();
          VanillaToasts.create({
            title: "Error",
            text: "Ocurrió un error, intentelo nuevamente",
            type: "error",
            timeout: 1200,
            positionClass: "topRight",
          });
        });
    }
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
  $("#id_estado_civil").select2({
    dropdownParent: $("#registrarUsuario"),
  });
  $("#id_genero").select2({
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
  function loading() {
    $(document).ready(function () {
      Swal.fire({
        title: "Cargando...",
        html: '<img src="images/loading.gif" width="300" height="175">',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showCloseButton: false,
        showCancelButton: false,
        showConfirmButton: false,
      });
    });
  }
});
