//|console.log("load_creditos");
$(document).ready(function () {
  $(document).on("change", "#destinatario", function () {
    loading();
    var id_user = this.value;
    $("#proyecto").empty();
    $.ajax({
      url: "php/controllers/personal/personal_controller.php",
      method: "POST",
      data: {
        mod: "getUserProyects",
        id_user: id_user,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);

        if (data.response == true) {
          Swal.close();
          $("#proyecto").empty();
          $("#proyecto").append(
            '<option  value="" disabled selected>Elija una opción</option><optgroup label="Proyecto">'
          );
          for (var i = 0; i < data.data.length; i++) {
            $("#proyecto").append(
              '<option codigo_proyecto = "' +
                data.data[i].codigo_proyecto +
                '" value="' +
                data.data[i].id_proyectos +
                '">' +
                data.data[i].nombre_proyecto +
                "</option>"
            );
          }
          $("#proyecto").append("</optgroup>");
          $("#proyecto").prop("disabled", false);
        } else {
          Swal.close();
          $("#proyecto").prop("disabled", true);
          Swal.fire({
            icon: "error",
            title: "Al parecer este usuario no tiene proyectos asignados",
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

  $(document).on("change", "#edit_destinatario", function () {
    var id_user = this.value;
    $("#edit_proyecto").empty();
    $.ajax({
      url: "php/controllers/personal/personal_controller.php",
      method: "POST",
      data: {
        mod: "getUserProyects",
        id_user: id_user,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);

        if (data.response == true) {
          $("#edit_proyecto").empty();
          $("#edit_proyecto").append(
            '<option value"" disabled selected>Elija una opción</option><optgroup label="Proyecto">'
          );
          for (var i = 0; i < data.data.length; i++) {
            $("#edit_proyecto").append(
              '<option value="' +
                data.data[i].id_proyectos +
                '">' +
                data.data[i].nombre_proyecto +
                "</option>"
            );
          }
          $("#edit_proyecto").append("</optgroup>");
          $("#edit_proyecto").prop("disabled", false);
        } else {
          $("#edit_proyecto").prop("disabled", true);
          $("#edit_proyecto").empty();
          Swal.fire({
            icon: "error",
            title: "Al parecer este usuario no tiene proyectos asignados",
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

  $(document).on("click", "#guardar_deposito", function () {
    loading();
    var id_user = $("#destinatario").val();
    var fecha = $("#fecha_deposito").val();
    var id_asingacion = $("#proyecto").val();
    var txt_proyecto = $("#proyecto option:selected").text();
    var cod_proyecto = $("#proyecto option:selected").attr("codigo_proyecto");
    var sitio = $("#sitio").val();
    var tipos_gasto = $("#tipos_gasto").val();
    var importe = $("#importe").val();
    var id_author = $("#id_autor").val();
    var id_proyecto = $("#proyecto").val();

    console.log("id_user: " + id_user);
    console.log("fecha: " + fecha);
    console.log("id_asingacion: " + id_asingacion);
    console.log("sitio: " + sitio);
    console.log("tipos_gasto: " + tipos_gasto);
    console.log("importe: " + importe);
    if (
      id_user == null ||
      fecha == null ||
      id_asingacion == null ||
      tipos_gasto == null ||
      importe == null ||
      importe == ""
    ) {
      Swal.fire({
        icon: "info",
        title: "Atención",
        text: "Ingrese todos los datos requeridos",
      });
    } else {
      loading();
      $.ajax({
        url: "php/controllers/viaticos/viaticos_controller.php",
        method: "POST",
        data: {
          mod: "saveDeposit",
          id_user: id_user,
          fecha: fecha,
          id_asingacion: id_asingacion,
          sitio: sitio,
          tipos_gasto: tipos_gasto,
          id_author: id_author,
          importe: importe,
          id_proyecto: id_proyecto,
          txt_proyecto: txt_proyecto,
          cod_proyecto: cod_proyecto,
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          console.log(data);
          if (data.response == true) {
            Swal.fire({
              icon: "success",
              title: "Éxito",
              html: data.message,
            }).then((result) => {
              loading();
              location.reload();
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: data.message,
              timer: 2000,
            });
          }
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
  $(document).on("click", ".btnEditDeposits", function () {
    var id_deposit = $(this).attr("id");
    $("#edit_id_deposito").val(id_deposit);
  });
  $(document).on("click", ".deleteDeposit", function () {
    var id_deposit = $(this).attr("id");

    Swal.fire({
      title: "¿Estás seguro?",
      text: "Una vez eliminado, no podrás recuperar este registro",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, eliminar",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.value) {
        loading();
        $.ajax({
          url: "php/controllers/viaticos/viaticos_controller.php",
          method: "POST",
          data: {
            mod: "deleteDeposit",
            id_deposit: id_deposit,
          },
        })

          .done(function (data) {
            var data = JSON.parse(data);
            console.log(data);
            if (data.response == true) {
              Swal.fire({
                icon: "success",
                title: "Éxito",
                text: data.message,
                timer: 2000,
              }).then((result) => {
                location.reload();
              });
            } else {
              Swal.fire({
                icon: "error",
                title: "Error",
                text: data.message,
                timer: 2000,
              });
            }
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
  });
  $(document).on("click", "#guardar_edit_deposito", function () {
    var id_user = $("#edit_destinatario").val();
    var fecha = $("#edit_fecha_deposito").val();
    var id_asingacion = $("#edit_proyecto").val();
    var sitio = $("#edit_sitio").val();
    var tipos_gasto = $("#edit_tipos_gasto").val();
    var importe = $("#edit_importe").val();
    var id_author = $("#id_autor").val();
    var id_deposit = $("#edit_id_deposito").val();
    var id_proyecto = $("#edit_proyecto").val();
    if (
      id_user == null ||
      fecha == null ||
      id_asingacion == null ||
      tipos_gasto == null ||
      importe == null ||
      importe == "" ||
      id_proyecto == null
    ) {
      Swal.fire({
        icon: "info",
        title: "Atención",
        text: "Ingrese todos los datos requeridos",
      });
    } else {
      loading();
      $.ajax({
        url: "php/controllers/viaticos/viaticos_controller.php",
        method: "POST",
        data: {
          mod: "editDeposit",
          id_user: id_user,
          fecha: fecha,
          id_asingacion: id_asingacion,
          sitio: sitio,
          tipos_gasto: tipos_gasto,
          id_author: id_author,
          importe: importe,
          id_deposit: id_deposit,
          id_proyecto: id_proyecto,
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          console.log(data);
          if (data.response == true) {
            Swal.fire({
              icon: "success",
              title: "Éxito",
              text: data.message,
              timer: 2000,
            }).then((result) => {
              location.reload();
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: data.message,
              timer: 2000,
            });
          }
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

  $(document).on("change", "#estado_proyecto", function () {
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

        if (data.response == true) {
          $("#municipio_proyecto").empty();
          $("#municipio_proyecto").append(
            '<option value="">Seleccione un municipio</option>'
          );
          for (var i = 0; i < data.data.length; i++) {
            $("#municipio_proyecto").append(
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
            title: "Al parecer este estado no tiene municipios",
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

  $(document).on("click", ".unassign_personal", function () {
    var id_asingacion = $(this).attr("id");
    $.ajax({
      url: "php/controllers/proyectos/proyects_controller.php",
      method: "POST",
      data: {
        mod: "unassignPersonal",
        id_asingacion: id_asingacion,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);

        if (data.response == true) {
          $("#li_" + id_asingacion).remove();
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });

          Toast.fire({
            icon: "info",
            title: "Se realizó la petición con éxito!!",
          });
        } else {
        }

        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {});
  });

  $(document).on("change", "#check_factura", function () {
    if (this.checked) {
      $("#div-folio-fiscal").show();
      $("#guardar_gasto").prop("disabled", false);
    } else {
      $("#div-folio-fiscal").hide();
      $("#guardar_gasto").prop("disabled", false);
    }
  });

  $(document).on("click", ".btnEditDeposits", function () {
    var id_gasto = $(this).attr("id");
    $("#id_gasto_editar").val(id_gasto);
    $("#lbl_folio_editar").text("");
    $("#lbl_folio_editar").text("Está editando el folio: #" + id_gasto);
  });

  $("input[type=radio][name=clasificacion_gasto]").change(function () {
    if (this.value == "1") {
      $("#div-deducibles").show();
      $("#guardar_gasto").prop("disabled", false);
    } else if (this.value == "2") {
      $("#div-deducibles").hide();
      $("#guardar_gasto").prop("disabled", false);
    }
  });
  $(document).on("click", "#guardar_gasto", function () {
    loading();
    var clasificacion_gasto = $(
      "input[type=radio][name=clasificacion_gasto]:checked"
    ).val();
    console.log(clasificacion_gasto);

    var fecha_compra = $("#fecha_compra").val();
    var id_asignacion = $("#proyecto_gasto").val();
    var id_proyecto = $("#proyecto_gasto")
      .find("option:selected")
      .attr("id-proyecto");
    var id_author = $("#id_autor").val();
    var sitio_gasto = $("#sitio_gasto").val();
    var tipos_gasto = $("#tipos_gasto_gasto").val();
    var importe_gasto = $("#importe_gasto").val();
    const img_payment = document.querySelector("#fotografia_ticket_gasto");
    comentario_gasto = $("#comentario_gasto").val();
    console.log("comentario_gasto: " + comentario_gasto);
    var coordenadas_gasto = $("#coordenadas").val();
    console.log("coordenadas_gasto: " + coordenadas_gasto);
    console.log("id_proyecto: " + id_proyecto);
    /*  
    console.log("id_asignacion: " + id_asignacion);
    
    console.log("id_author: " + id_author);
    console.log("sitio_gasto: " + sitio_gasto);
    console.log("tipos_gasto: " + tipos_gasto);
    console.log("importe_gasto: " + importe_gasto);
    console.log("img_payment: " + img_payment.files.length); */
    if (
      fecha_compra != "" &&
      id_asignacion != "" &&
      id_proyecto != undefined &&
      id_author != "" &&
      sitio_gasto != "" &&
      tipos_gasto != "" &&
      importe_gasto != "" &&
      img_payment.files.length != 0
    ) {
      if (clasificacion_gasto == 1) {
        // ACCIONES DEDUCIBLES
        //var check_factura = $("#check_factura");
        if ($("#check_factura").is(":checked")) {
          //ACCIONES DEDUCIBLE CON FACTURA
          var folio_fiscal = $("#folio_fiscal").val();
          const factura = document.querySelector("#factura");

          console.log("folio_fiscal: " + folio_fiscal);
          console.log("factura: " + factura.files.length);

          if (folio_fiscal != "" && factura.files.length != 0) {
            registrarDeducible(
              fecha_compra,
              id_asignacion,
              id_proyecto,
              id_author,
              sitio_gasto,
              tipos_gasto,
              importe_gasto,
              folio_fiscal,
              comentario_gasto,
              coordenadas_gasto
            );
          } else {
            Swal.fire({
              icon: "success",
              title: "Error!!",
              text: "Debe ingresar el folio fiscal y adjuntar la factura",
            });
          }
          //          registrarDeducibleNoPendiente();
        } else {
          //ACCIONES DEDUCIBLE SIN FACTURA
          registrarDeduciblePendiente(
            fecha_compra,
            id_asignacion,
            id_proyecto,
            id_author,
            sitio_gasto,
            tipos_gasto,
            importe_gasto,
            comentario_gasto,
            coordenadas_gasto
          );
        }
      } else if (clasificacion_gasto == 2) {
        // ACCIONES NO DEDUCIBLES
        loading();

        registrarGastoNoDeducible(
          fecha_compra,
          id_asignacion,
          id_proyecto,
          id_author,
          sitio_gasto,
          tipos_gasto,
          importe_gasto,
          comentario_gasto,
          coordenadas_gasto
        );
      }
    } else {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Verifica que todos los campos esten llenos",
      });
    }
  });
  $(document).on("change", "#tipos_gasto_gasto", function () {
    var id_tipo_gasto = $(this).val();
    if (id_tipo_gasto == "99") {
      $("#div_comentario_gasto").show();
      $("#comentario_gasto").prop("required", true);
    } else {
      $("#div_comentario_gasto").hide();
      $("#comentario_gasto").prop("required", false);
    }
  });
  $(document).on("click", "#guardar_gasto_editar", function () {
    var fecha_compra = $("#fecha_compra_editar").val();
    var id_asignacion = $("#proyecto_gasto_editar option:selected").val();
    var id_proyecto = $("#proyecto_gasto_editar")
      .find("option:selected")
      .attr("id");
    var id_author = $("#id_autor_editar").val();
    var sitio_gasto = $("#sitio_gasto_editar").val();
    var tipos_gasto = $("#tipos_gasto_gasto_editar").val();
    var importe_gasto = $("#importe_gasto_editar").val();
    var id_gasto = $("#id_gasto_editar").val();

    /*  console.log("fecha_compra: " + fecha_compra);
    console.log("id_asignacion: " + id_asignacion);
    console.log("id_proyecto: " + id_proyecto);
    console.log("id_author: " + id_author);
    console.log("sitio_gasto: " + sitio_gasto);
    console.log("tipos_gasto: " + tipos_gasto);
    console.log("importe_gasto: " + importe_gasto);
    console.log("img_payment: " + img_payment.files.length); */
    if (
      fecha_compra != "" &&
      id_asignacion != "" &&
      id_proyecto != "" &&
      id_author != "" &&
      sitio_gasto != "" &&
      tipos_gasto != "" &&
      importe_gasto != ""
    ) {
      $.ajax({
        url: "php/controllers/viaticos/viaticos_controller.php",
        method: "POST",
        data: {
          mod: "updateSpent",
          fecha_compra: fecha_compra,
          id_asignacion: id_asignacion,
          id_proyecto: id_proyecto,
          id_author: id_author,
          sitio_gasto: sitio_gasto,
          tipos_gasto: tipos_gasto,
          importe_gasto: importe_gasto,
          id_gasto: id_gasto,
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          console.log(data);

          if (data.response == true) {
            Swal.fire({
              icon: "success",
              title: "Éxito",
              text: "Gasto editado correctamente",
              timer: 2000,
            }).then(function () {
              location.reload();
            });
          } else {
          }

          //--- --- ---//
          //--- --- ---//
        })
        .fail(function (message) {});
    } else {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Verifica que todos los campos esten llenos",
      });
    }
  });
  $(document).on("click", ".check_ap_contabilidad", function () {
    var id_gasto = $(this).attr("id-gasto");
    var column_name = "ap_contabilidad";
    if (this.checked) {
      var status = 1;
    } else {
      var status = 0;
    }

    $.ajax({
      url: "php/controllers/viaticos/viaticos_controller.php",
      method: "POST",
      data: {
        mod: "approveSpent",
        id_gasto: id_gasto,
        status: status,
        column_name: column_name,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);
        var id_status_type = data.id_status_type;
        if (data.response == true) {
          $.NotificationApp.send(
            "Éxito",
            "Se actualizó la propiedad del gasto",
            "top-right",
            "#ffffff",
            "info"
          );
          console.log(id_status_type);
          $("#status_gasto" + id_gasto)
            .val(id_status_type)
            .prop("selected", true);

          $("#txt_status_gasto" + id_gasto).empty();
          var html_txt_status =
            '<i class="mdi mdi-circle text-' +
            data.clase_css +
            '"></i><p id="txt_status' +
            id_gasto +
            '">' +
            data.txt_status +
            "</p>";
          $("#txt_status_gasto" + id_gasto).append(html_txt_status);
        } else {
        }

        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {});
  });
  $(document).on("click", ".check_ap_coordinacion", function () {
    var id_gasto = $(this).attr("id-gasto");
    var column_name = "ap_coordinacion";
    if (this.checked) {
      var status = 1;
    } else {
      var status = 0;
    }

    $.ajax({
      url: "php/controllers/viaticos/viaticos_controller.php",
      method: "POST",
      data: {
        mod: "approveSpent",
        id_gasto: id_gasto,
        status: status,
        column_name: column_name,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);
        var id_status_type = data.id_status_type;
        if (data.response == true) {
          $.NotificationApp.send(
            "Éxito",
            "Se actualizó la propiedad del gasto",
            "top-right",
            "#ffffff",
            "info"
          );
          console.log(id_status_type);
          $("#status_gasto" + id_gasto)
            .val(id_status_type)
            .prop("selected", true);
          $("#txt_status_gasto" + id_gasto).empty();
          var html_txt_status =
            '<i class="mdi mdi-circle text-' +
            data.clase_css +
            '"></i><p id="txt_status' +
            id_gasto +
            '">' +
            data.txt_status +
            "</p>";
          $("#txt_status_gasto" + id_gasto).append(html_txt_status);
        } else {
        }

        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {});
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
  $(document).on("click", ".addFactura", function () {
    var id_gastos = $(this).attr("id");
    var codigo_proyecto = $(this).attr("proyect-code");

    console.log(id_gastos);
    console.log(codigo_proyecto);
    $("#input_id_gastos").val(id_gastos);
    $("#input_codigo_proyecto").val(codigo_proyecto);
  });
  $(document).on("click", ".addFotografia", function () {
    var id_gastos = $(this).attr("id");
    var codigo_proyecto = $(this).attr("proyect-code");

    console.log(id_gastos);
    console.log(codigo_proyecto);
    $("#input_id_gastos_foto").val(id_gastos);
    $("#input_codigo_proyecto_foto").val(codigo_proyecto);
  });

  $(document).on("click", "#guardar_factura", function () {
    loading();
    var last_id = $("#input_id_gastos").val();
    var codigo_proyecto = $("#input_codigo_proyecto").val();
    saveLateFacturaDocument(last_id, codigo_proyecto);

    console.log(last_id);
    console.log(codigo_proyecto);
    $("#input_id_gastos").val(last_id);
  });
  $(document).on("click", "#guardar_fotografia", function () {
    var last_id = $("#input_id_gastos_foto").val();
    var codigo_proyecto = $("#input_codigo_proyecto_foto").val();
    saveLateFotoDocument(last_id, codigo_proyecto);

    console.log(last_id);
    console.log(codigo_proyecto);
    $("#input_id_gastos").val(last_id);
  });
  $(document).on("click", ".deleteGasto", function () {
    var id_gasto = $(this).attr("id");

    if (id_gasto == null) {
      Swal.fire({
        icon: "info",
        title: "Atención",
        text: "Ocurrió un error al intentar eliminar el registro",
      });
    } else {
      loading();
      $.ajax({
        url: "php/controllers/viaticos/viaticos_controller.php",
        method: "POST",
        data: {
          mod: "deleteGasto",
          id_gasto: id_gasto,
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          console.log(data);
          if (data.response == true) {
            Swal.fire({
              icon: "success",
              title: "Éxito",
              text: data.message,
              timer: 2000,
            }).then((result) => {
              $("#trGasto" + id_gasto).remove();
              //  location.reload();
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: data.message,
              timer: 2000,
            });
          }
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
  $(document).on("click", ".nuevoGasto", function () {
    loading();
    function positionSuccess(position) {
      Swal.close();
      //alert("Coordenadas obtenidas");
      /* document.getElementById("coordenadas").value =
        position.coords.latitude + " " + position.coords.longitude; */
      //console.log(position);
      $("#coordenadas").val(
        position.coords.latitude + ", " + position.coords.longitude
      );
    }
    function setCoorenadas(lat, lon) {}
    function positionError(error) {
      Swal.close();
      switch (error.code) {
        case error.PERMISSION_DENIED:
          document.getElementById("theError").innerHTML = Swal.fire({
            icon: "error",
            title: "Error",
            text: "No se ha permitido obtener la ubicación",
            timer: 2000,
          });
          break;
        case error.POSITION_UNAVAILABLE:
          document.getElementById("theError").innerHTML = Swal.fire({
            icon: "error",
            title: "Error",
            text: "La ubicación no está disponible",
            timer: 2000,
          });
          break;
        case error.TIMEOUT:
          document.getElementById("theError").innerHTML = Swal.fire({
            icon: "error",
            title: "Error",
            text: "El tiempo de espera ha expirado",
            timer: 2000,
          });
          break;
        case error.UNKNOWN_ERROR:
          Swal.fire({
            icon: "error",
            title: "Error",
            text: "Ha ocurrido un error desconocido",
            timer: 2000,
          });
          break;
      }
    }
    navigator.geolocation.getCurrentPosition(positionSuccess, positionError);
  });
  $(document).on("click", ".addSeguimientoGasto", function () {
    loading();
    $(".chatSeguimientoGasto").empty();
    var id_gasto = $(this).attr("data-id-gasto");
    var user_commentary = $("#user_commentary").val();
    $(".enviarComentarioSeguimiento").attr("data-id-gasto", id_gasto);
    $("#seguimientoGastoLabel").text(
      "Seguimiento de Gasto. Folio: " + id_gasto
    );
    html = "";

    $(".chatSeguimientoGasto").append(html);

    $.ajax({
      url: "php/controllers/viaticos/viaticos_controller.php",
      method: "POST",
      data: {
        mod: "getSeguimientoGasto",
        id_gasto: id_gasto,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);
        //--- --- ---//
        $(".chatSeguimientoGasto").html(data.html);
        //--- --- ---//
      })
      .fail(function (message) {});

    Swal.close();
  });
  $(document).on("click", ".enviarComentarioSeguimiento", function () {
    loading();
    var id_gasto = $(this).attr("data-id-gasto");
    var comentario_gasto = $(".comentario_gasto").val();
    var user_commentary = $("#user_commentary").val();
    var today = new Date();

    var time =
      today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var date =
      today.getDate() +
      " / " +
      (today.getMonth() + 1) +
      " / " +
      today.getFullYear();

    if (comentario_gasto.length > 0) {
      $.ajax({
        url: "php/controllers/viaticos/viaticos_controller.php",
        method: "POST",
        data: {
          mod: "saveSeguimientoGasto",
          id_gasto: id_gasto,
          comentario_gasto: comentario_gasto,
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          //console.log(data);
          var id_seguimiento_gastos_log = data.id_seguimiento_gastos;
          //--- --- ---//
          html = "";
          html +=
            '<li class="clearfix odd" id="divComentario' +
            id_seguimiento_gastos_log +
            ">";
          html += '<div class="chat-avatar">';
          html +=
            '<img src="images/user_default_chat.png" class="rounded" alt="dominic">';
          html += "</div>";
          html += '<div class="conversation-text">';
          html += '<div class="ctext-wrap">';
          html += "<i>" + user_commentary + "</i>";
          html += "<p>";
          html += comentario_gasto;
          html += "</p><br>";
          html +=
            '<figcaption class="blockquote-footer">' +
            date +
            "  " +
            time +
            "</figcaption>";
          html += "</div>";
          html += "</div>";
          html += '<div class="conversation-actions dropdown">';
          html +=
            '<button class="btn btn-sm btn-link" data-bs-toggle="dropdown" aria-expanded="false"><i class="uil uil-ellipsis-v"></i></button>';
          html += '<div class="dropdown-menu">';
         /*  html +=
            '<a data-id-comentario="' +
            id_seguimiento_gastos_log +
            '" class="dropdown-item editarCommentarioGasto">Editar</a>'; */
          html +=
            '<a data-id-comentario="' +
            id_seguimiento_gastos_log +
            '" class="dropdown-item borrarCommentarioGasto">Borrar</a>';
          html += "</div>";
          html += "</div>";
          html += "</li>";
          $(".chatSeguimientoGasto").append(html);
          $(".comentario_gasto").val("");

          //--- --- ---//
        })
        .fail(function (message) {});
    } else {
      Swal.fire({
        icon: "error",
        title: "Por favor ingrese un comentario...",
      });
    }
    /* $.ajax({
      url: "php/controllers/viaticos/viaticos_controller.php",
      method: "POST",
      data: {
        mod: "getSeguimientoGasto",
        id_gasto: id_gasto,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);
        //--- --- ---//
        $(".chatSeguimientoGasto").html(data.html);
        //--- --- ---//
      })
      .fail(function (message) {}); */

    Swal.close();
  });

  $(document).on("click", ".borrarCommentarioGasto", function () {
    var id_comentario = $(this).attr("data-id-comentario");
    Swal.fire({
      title: "¿Está seguro de eliminar este registro?",
      text: "No podrá revertir esta acción",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, eliminar",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.value) {
        loading();
        $.ajax({
          url: "php/controllers/viaticos/viaticos_controller.php",
          method: "POST",
          data: {
            mod: "deleteSeguimientoGasto",
            id_comentario: id_comentario,
          },
        })
          .done(function (data) {
            $("#divComentario" + id_comentario).remove();
            Swal.close();
          })
          .fail(function (message) {});
      }
    });
  });
  $(document).on("click", ".editarCommentarioGasto", function () {
    var id_comentario = $(this).attr("data-id-comentario");
    var html = "";
    html += '<div class="row">';
    html += '    <div class="col mb-2 mb-sm-0">';
    html +=
      '        <input type="text" class="form-control border-0 comentario_gasto" placeholder="Ingrese un comentario" id="comentario_gasto" required>';
    html += '        <div class="invalid-feedback">';
    html += "            Por favor escriba un comentario";
    html += "        </div>";
    html += "    </div>";
    html += '    <div class="col-sm-auto">';
    html += '        <div class="btn-group">';
    html += '            <div class="d-grid">';
    html +=
      '                <a class="btn btn-info enviarComentarioSeguimiento"><i class="fa-regular fa-floppy-disk"></i></a>';
    html += "            </div>";
    html += "        </div>";
    html += "    </div>";
    html += "</div>";
    $(".chatSeguimientoGasto").append(html);

    /*  Swal.fire({
      title: "¿Está seguro de eliminar este registro?",
      text: "No podrá revertir esta acción",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, eliminar",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.value) {
        loading();
        $.ajax({
          url: "php/controllers/viaticos/viaticos_controller.php",
          method: "POST",
          data: {
            mod: "deleteSeguimientoGasto",
            id_comentario: id_comentario,
          },
        })
          .done(function (data) {
            $("#divComentario" + id_comentario).remove();
            Swal.close();
          })
          .fail(function (message) {});
      }
    }); */
  });

  $(document).on("change", ".select_status_gasto", function () {
    var id_gasto = $(this).attr("id-gasto");

    var column_name = "id_status_type";
    var status = $(this).val();
    console.log(status);

    $.ajax({
      url: "php/controllers/viaticos/viaticos_controller.php",
      method: "POST",
      data: {
        mod: "changeSpentStatus",
        id_gasto: id_gasto,
        status: status,
        column_name: column_name,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);
        var id_status_type = data.id_status_type;
        if (data.response == true) {
          $.NotificationApp.send(
            "Éxito",
            "Se actualizó la propiedad del gasto",
            "top-right",
            "#ffffff",
            "info"
          );
          console.log(id_status_type);
          $("#status_gasto" + id_gasto)
            .val(id_status_type)
            .prop("selected", true);
          $("#txt_status_gasto" + id_gasto).empty();
          var html_txt_status =
            '<i class="mdi mdi-circle text-' +
            data.clase_css +
            '"></i><p id="txt_status' +
            id_gasto +
            '">' +
            data.txt_status +
            "</p>";
          $("#txt_status_gasto" + id_gasto).append(html_txt_status);
        } else {
        }

        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {});
  });

  function saveTicketDocument(last_id) {
    const img_payment = document.querySelector("#fotografia_ticket_gasto");
    const user_name = $("#user_name_gasto").val();
    const proyecto = $("#proyecto_gasto option:selected").text();
    if (img_payment.files.length > 0) {
      let formData = new FormData();
      formData.append("img_payment", img_payment.files[0]);
      formData.append("user_name", user_name);
      formData.append("last_id", last_id);
      formData.append("proyecto", proyecto);

      fetch("php/controllers/viaticos/saveTicketDocument.php", {
        method: "POST",
        body: formData,
      })
        .then((respuesta) => respuesta.json())
        .then((decodificado) => {
          Swal.close();
          console.log(decodificado.last_id);
          Swal.fire({
            icon: "success",
            title: "Éxito",
            text: "Registro guardado exitosamente!!!",
            timer: 3000,
          }).then((result) => {
            location.reload();
          });
        });
    }
  }
  function saveTicketDocumentAndFactura(last_id) {
    const img_payment = document.querySelector("#fotografia_ticket_gasto");
    const user_name = $("#user_name_gasto").val();
    const proyecto = $("#proyecto_gasto option:selected").text();
    if (img_payment.files.length > 0) {
      let formData = new FormData();
      formData.append("img_payment", img_payment.files[0]);
      formData.append("user_name", user_name);
      formData.append("last_id", last_id);
      formData.append("proyecto", proyecto);

      fetch("php/controllers/viaticos/saveTicketDocument.php", {
        method: "POST",
        body: formData,
      })
        .then((respuesta) => respuesta.json())
        .then((decodificado) => {
          loading();
          saveFacturaDocument(last_id);
        });
    }
  }

  function saveFacturaDocument(last_id) {
    const factura = document.querySelector("#factura");
    const user_name = $("#user_name_gasto").val();
    const proyecto = $("#proyecto_gasto option:selected").text();
    if (factura.files.length > 0) {
      let formData = new FormData();
      formData.append("factura", factura.files[0]);
      formData.append("user_name", user_name);
      formData.append("last_id", last_id);
      formData.append("proyecto", proyecto);

      fetch("php/controllers/viaticos/saveFacturaDocument.php", {
        method: "POST",
        body: formData,
      })
        .then((respuesta) => respuesta.json())
        .then((decodificado) => {
          Swal.close();
          console.log(decodificado.last_id);
          Swal.fire({
            icon: "success",
            title: "Éxito",
            text: "Registro guardado exitosamente",
            timer: 3000,
          }).then((result) => {
            location.reload();
          });
        });
    }
  }
  function saveLateFacturaDocument(last_id, proyect) {
    const factura = document.querySelector("#factura_late");
    const user_name = $("#user_name_gasto").val();
    const folio_fiscal_late = $("#folio_fiscal_late").val();
    const proyecto = proyect;
    if (factura.files.length > 0) {
      let formData = new FormData();
      formData.append("factura", factura.files[0]);
      formData.append("user_name", user_name);
      formData.append("last_id", last_id);
      formData.append("proyecto", proyecto);
      formData.append("folio_fiscal_late", folio_fiscal_late);

      fetch("php/controllers/viaticos/saveLateFactura.php", {
        method: "POST",
        body: formData,
      })
        .then((respuesta) => respuesta.json())
        .then((decodificado) => {
          Swal.close();
          console.log(decodificado.last_id);
          Swal.fire({
            title: "¡Archivo guardado!",
            text: "Se  cargó la factura correctamente!!!",
            icon: "success",
            timer: 1500,
          }).then((result) => {
            location.reload();
          });
        });
    }
  }
  function saveLateFotoDocument(last_id, proyect) {
    const fotografia = document.querySelector("#fotografia_late");
    const user_name = $("#user_name_gasto").val();
    const proyecto = proyect;
    if (fotografia.files.length > 0) {
      console.log("foto");
      let formData = new FormData();
      formData.append("fotografia", fotografia.files[0]);
      formData.append("user_name", user_name);
      formData.append("last_id", last_id);
      formData.append("proyecto", proyecto);

      fetch("php/controllers/viaticos/saveLateFotografia.php", {
        method: "POST",
        body: formData,
      })
        .then((respuesta) => respuesta.json())
        .then((decodificado) => {
          Swal.close();
          console.log(decodificado.last_id);
          Swal.fire({
            title: "¡Archivo guardado!",
            text: "Se  cargó la fotografía correctamente!!!",
            icon: "success",
            timer: 1500,
          }).then((result) => {
            loading();
            location.reload();
          });
        });
    }
  }
  function registrarDeducible(
    fecha_compra,
    id_asignacion,
    id_proyecto,
    id_author,
    sitio_gasto,
    tipos_gasto,
    importe_gasto,
    folio_fiscal,
    comentario_gasto,
    coordenadas_gasto
  ) {
    $.ajax({
      url: "php/controllers/viaticos/viaticos_controller.php",
      method: "POST",
      data: {
        mod: "saveSpentDeducible",
        fecha_compra: fecha_compra,
        id_asignacion: id_asignacion,
        id_proyecto: id_proyecto,
        id_author: id_author,
        sitio_gasto: sitio_gasto,
        tipos_gasto: tipos_gasto,
        importe_gasto: importe_gasto,
        folio_fiscal: folio_fiscal,
        comentario_gasto: comentario_gasto,
        coordenadas_gasto: coordenadas_gasto,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        //console.log(data);
        if (data.response == true) {
          var last_id = data.id_gasto;
          //console.log(last_id);
          loading();
          saveTicketDocumentAndFactura(last_id);
        }
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
  function registrarDeduciblePendiente(
    fecha_compra,
    id_asignacion,
    id_proyecto,
    id_author,
    sitio_gasto,
    tipos_gasto,
    importe_gasto,
    comentario_gasto,
    coordenadas_gasto
  ) {
    $.ajax({
      url: "php/controllers/viaticos/viaticos_controller.php",
      method: "POST",
      data: {
        mod: "saveSpentDeduciblePendiente",
        fecha_compra: fecha_compra,
        id_asignacion: id_asignacion,
        id_proyecto: id_proyecto,
        id_author: id_author,
        sitio_gasto: sitio_gasto,
        tipos_gasto: tipos_gasto,
        importe_gasto: importe_gasto,
        comentario_gasto: comentario_gasto,
        coordenadas_gasto: coordenadas_gasto,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        //console.log(data);
        if (data.response == true) {
          var last_id = data.id_gasto;
          //console.log(last_id);
          saveTicketDocument(last_id);
        }
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
  function registrarGastoNoDeducible(
    fecha_compra,
    id_asignacion,
    id_proyecto,
    id_author,
    sitio_gasto,
    tipos_gasto,
    importe_gasto,
    comentario_gasto,
    coordenadas_gasto
  ) {
    $.ajax({
      url: "php/controllers/viaticos/viaticos_controller.php",
      method: "POST",
      data: {
        mod: "saveSpent",
        fecha_compra: fecha_compra,
        id_asignacion: id_asignacion,
        id_proyecto: id_proyecto,
        id_author: id_author,
        sitio_gasto: sitio_gasto,
        tipos_gasto: tipos_gasto,
        importe_gasto: importe_gasto,
        comentario_gasto: comentario_gasto,
        coordenadas_gasto: coordenadas_gasto,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);
        if (data.response == true) {
          var last_id = data.id_gasto;
          console.log(last_id);
          saveTicketDocument(last_id);
        }
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

  $("#edit_destinatario").select2({
    dropdownParent: $("#editarDeposito"),
  });
  $("#edit_proyecto").select2({
    dropdownParent: $("#editarDeposito"),
  });
  $("#edit_tipos_gasto").select2({
    dropdownParent: $("#editarDeposito"),
  });
  $("#destinatario").select2({
    dropdownParent: $("#depositarViatico"),
  });
  $("#proyecto").select2({
    dropdownParent: $("#depositarViatico"),
  });
  $("#tipos_gasto").select2({
    dropdownParent: $("#depositarViatico"),
  });
  $("#proyecto_gasto").select2({
    dropdownParent: $("#registrarGasto"),
  });
  $("#tipos_gasto_gasto").select2({
    dropdownParent: $("#registrarGasto"),
  });
  $("#proyecto_gasto_editar").select2({
    dropdownParent: $("#editarGasto"),
  });
  $("#tipos_gasto_gasto_editar").select2({
    dropdownParent: $("#editarGasto"),
  });
});

var tf = new TableFilter(document.querySelector(".tablaDepositos"), {
  base_path: "js/tablefilter/",
  paging: {
    results_per_page: ["Records: ", [10, 25, 50, 100]],
  },
  responsive: true,
  rows_counter: true,
  btn_reset: true,
  col_1: "select",
  col_4: "select",
  col_7: "none",
});
tf.init();

function loading() {
  Swal.fire({
    title: "Cargando...",
    html: '<img src="images/loading.gif" width="300" height="175">',
    allowOutsideClick: false,
    allowEscapeKey: false,
    showCloseButton: false,
    showCancelButton: false,
    showConfirmButton: false,
  });
}
