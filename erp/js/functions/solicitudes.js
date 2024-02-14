console.log("solicitudes.js");

function loading() {
  Swal.fire({
    text: "Cargando...",
    html: '<img src="images/loading.gif" width="300" height="175">',
    allowOutsideClick: false,
    allowEscapeKey: false,
    showCloseButton: false,
    showCancelButton: false,
    showConfirmButton: false,
  });
}

$(document).ready(function () {
  $(document).on("click", ".btn-send_document", function () {
    addDocuument();
  });

  $(document).on("click", ".save_payment_voucher", function () {
    var id_cotizacion = $(this).attr("id");
    const inputFile = document.querySelector("#input_pago");

    var fecha_pago = $("#fecha_pago").val();
    if (inputFile.files.length > 0) {
      if (fecha_pago == "") {
        Swal.fire({
          type: "info",
          title: "Atención",
          text: "Debe ingresar la fecha de pago",
        });
      } else {
        paymentVoucher(id_cotizacion);
      }
    } else {
      Swal.fire({
        type: "info",
        title: "Atención",
        text: "Debe seleccionar un archivo",
      });
    }
  });
  $(document).on("click", ".save_payment_details", function () {
    var id_cotizacion = $(this).attr("id");
    const id_forma_pago = $("#id_forma_pago").val();
    const id_proveedor = $("#id_proveedor").val();
    const cantidad = $("#cantidad_pago").val();
    const cfdi = $("#cfdi").val();
    const comentarios = $("#comentarios_payment_details").val();
    const id_enterprise_payment = $("#id_empresa_pagocon").val();
    if (
      id_forma_pago == "" ||
      cantidad == "" ||
      cfdi == "" ||
      id_proveedor == "" ||
      id_enterprise_payment == ""
    ) {
      Swal.fire({
        icon: "info",
        title: "Atención",
        text: "Debe llenar y/o seleccionar todos los campos",
      });
    } else {
      const pdfFile = document.querySelector("#pdf_pago");
      const xmlFile = document.querySelector("#xml_pago");
      if (pdfFile.files.length > 0 && xmlFile.files.length > 0) {
        if (id_forma_pago == 7) {
          var id_credito = $("#id_credito").val();
          if (id_credito == "") {
            Swal.fire({
              icon: "info",
              title: "Atención",
              text: "Debe seleccionar un crédito",
            });
          } else {
            savePaymentDetailsCredit(id_cotizacion);
          }
        } else {
          savePaymentDetails(id_cotizacion);
        }
      } else {
        Swal.fire({
          icon: "info",
          title: "Atención",
          text: "Debe seleccionar ambos archivos",
        });
      }
    }
  });
  $(document).on("click", ".info_solicitud", function () {
    var id_proyecto = $(this).attr("id");
    //        loading();
    console.log("info_solicitud");
  });

  $(document).on("click", ".btn_add_partida", function () {
    var html_tabla = "";
    var html = "";
    var articulo = $("#articulo").val();
    var txt_utilizacion = $("#id_utilizacion option:selected").text();
    /*var txt_material = $("#id_material option:selected").text();
    
      var txt_dimension = $("#id_dimension option:selected").text(); */
    var id_u_medida = $("#id_um option:selected").val();
    var txt_u_medida = $("#id_um option:selected").text();
    var cantidad = $("#cantidad").val();
    var observaciones = $("#observaciones").val();

    if (articulo != "" && id_u_medida != "" && cantidad != "") {
      if ($("#tablaPreviaSolicitud").length == 0) {
        html += '<h1 class="display-6">Lista de Solicitud</h1>';
        html += '<p class="text-muted font-14">';
        html += "Se enlsitan todos los elementos agregados.";
        html += "</p>";
        html += '<div class="form-floating mb-3">';
        html += "<br>";
        html += '<div class="row">';
        html += '<div class="tab-content">';
        html +=
          '<table class="table mb-0 table-striped dt-responsive  w-100" id="tablaPreviaSolicitud">';
        html += "<thead>";
        html += "<tr>";
        html += '<th scope="col">#</th>';
        html += '<th scope="col">Descripción</th>';
        html += '<th scope="col">Utilización</th>';
        html += '<th scope="col"> U.M.</th>';
        html += '<th scope="col">Cantidad</th>';
        html += '<th scope="col">Observaciones</th>';
        html += '<th scope="col">Quitar</th>';
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        html += "<tr>";
        html += '<th scope="row">1</th>';
        html += "<td>" + articulo + "</td>";
        html += "<td>" + txt_utilizacion + "</td>";
        html += "<td>" + txt_u_medida + "</td>";
        html += "<td>" + cantidad + "</td>";
        html += "<td>" + observaciones + "</td>";
        html +=
          '<td><button type="button" class="btn btn-danger btn_quitar_partida"><i class="mdi mdi-window-close "></i> </button></td>';
        html += "</tr>";
        html += "</tbody>";
        html += "</table>";
        html += "</div>";
        html += "</div >";
        html += "</div >";
        $("#divTablaSolicitudes").append(html);
        $.NotificationApp.send(
          "Agregado",
          "Se agregó la partida a la orden",
          "top-right",
          "#ffffff",
          "info"
        );
        $("#articulo").val("");
        $("#observaciones").val("");
      } else {
        var last_no_partida = parseInt(
          $("#tablaPreviaSolicitud tr:last th:first").html()
        );
        var no_partida = last_no_partida + 1;
        html_tabla += "<tr>";
        html_tabla += '<th scope="row">' + no_partida + "</th>";
        html_tabla += "<td>" + articulo + "</td>";
        html_tabla += "<td>" + txt_utilizacion + "</td>";
        html_tabla += "<td>" + txt_u_medida + "</td>";
        html_tabla += "<td>" + cantidad + "</td>";
        html_tabla += "<td>" + observaciones + "</td>";
        html_tabla +=
          '<td><button type="button" class="btn btn-danger btn_quitar_partida"><i class="mdi mdi-window-close "></i> </button></td>';
        html_tabla += "</tr>";
        $("#tablaPreviaSolicitud").append(html_tabla);
        $.NotificationApp.send(
          "Agregado",
          "Se agregó la partida a la orden",
          "top-right",
          "#ffffff",
          "info"
        );
        $("#articulo").val("");
        $("#observaciones").val("");
      }
    } else {
      Swal.fire({
        title: "Atención!!",
        text: "Debe llenar todos los campos",
        icon: "error",
        confirmButtonText: "Aceptar",
      });
    }
  });
  $(document).on("click", ".btn_quitar_partida", function () {
    $(this).closest("tr").remove();
    $.NotificationApp.send(
      "Eliminado",
      "Se quitó la partida correctamente",
      "top-right",
      "#dddddd",
      "warning"
    );
  });

  $(document).on("click", "#btn_save_solicitud_list", function () {
    var solicitud_index = [];
    loading();
    var id_proyecto = $("#id_proyecto option:selected").val();
    var txt_proyecto = $("#id_proyecto option:selected").text();
    var id_utilizacion = $("#id_utilizacion option:selected").val();
    var txt_utilizacion = $("#id_utilizacion option:selected").text();
    var codigo_chuen = $("#codigo_solicitud_chuen").val();
    console.log("id_proyecto" + id_proyecto);
    console.log("txt_proyecto" + txt_proyecto);

    console.log("id_utilizacion" + id_utilizacion);
    console.log("txt_utilizacion" + txt_utilizacion);
    if (id_proyecto != "" && id_utilizacion != "") {
      if ($("#tablaPreviaSolicitud tr").length > 1) {
        var valores = [];
        $("#tablaPreviaSolicitud tr:last th:first").html();
        $("#tablaPreviaSolicitud tr").each(function () {
          var no_partida = $(this).find("th:first").html();
          var material = $(this).find("td:eq(0)").html();
          var utilizacion = $(this).find("td:eq(1)").html();
          var u_medida = $(this).find("td:eq(2)").html();
          var cantidad = $(this).find("td:eq(3)").html();
          var observaciones = $(this).find("td:eq(4)").html();
          valores.push([
            [no_partida],
            [material],
            [utilizacion],
            [u_medida],
            [cantidad],
            [observaciones],
          ]);
        });
        solicitud_index.push(
          [id_proyecto],
          [txt_proyecto],
          [id_utilizacion],
          [txt_utilizacion],
          [codigo_chuen],
          [valores]
        );
        console.log(solicitud_index);
        $.ajax({
          url: "php/controllers/requests_controller.php",
          method: "POST",
          data: {
            mod: "guardarSolicitud",
            arr_data: solicitud_index,
          },
        })
          .done(function (data) {
            var data = JSON.parse(data);
            console.log(data);

            if (data.response == true) {
              Swal.fire({
                title: "¡Registro exitoso!",
                text: "Se  regisrtaron todas las partidas!!!",
                icon: "success",
                timer: 1500,
              }).then((result) => {
                location.reload();
              });
            } else {
              Swal.fire({
                icon: "error",
                title: "Ocurrio un error al enviar la solicitud",
              });
            }
          })
          .fail(function (message) {
            Swal.fire({
              title: "Datos no registrados!",
              text: "Ocurrió un error al guardar la información",
              icon: "info",
            });
          });
      } else {
        Swal.fire({
          icon: "error",
          title: "Debe agregar al menos una partida!!",
          showConfirmButton: false,
          timer: 2000,
        }).then((result) => {
          $("#createSolicitud").find("input,textarea,select,select2").val("");
          $("#createSolicitud input[type='checkbox']")
            .prop("checked", false)
            .change();
          $("#createSolicitud").modal("hide");
          $("#divTablaSolicitudes").empty();
          location.reload();
        });
      }
    } else {
      Swal.fire({
        icon: "error",
        title: "Debe seleccionar un proyecto y una utilización!!",
        showConfirmButton: false,
        timer: 2000,
      });
    }
  });

  $(document).on("click", ".add_document_request", function () {
    var id_solicitud = $(this).attr("id");
    console.log(id_solicitud);
    $("#id_cotizacion").val(id_solicitud);
    var id_proyecto = $(this).attr("id_proyect");

    $.ajax({
      url: "php/controllers/proyects_controller.php",
      method: "POST",
      data: {
        mod: "getInfoProyect",
        id_proyecto: id_proyecto,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);
        if (data.response == true) {
          $("#lblTituloFacturaProyecto").text(data.data[0].nombre_largo);
          $("#lblCodigoFacturaProyecto").text(data.data[0].codigo_proyecto);
        } else {
          console.log(data);
        }
        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {
        console.log(message);
      });
    $.ajax({
      url: "php/controllers/requests_controller.php",
      method: "POST",
      data: {
        mod: "getInfoRequest",
        id_solicitud: id_solicitud,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        $("#titulo_cotizacion").text(data.data[0].txt_proyectos);
        $("#id_proyecto").val(data.data[0].id_proyectos);
        /*  if (data.response == true) {
          Swal.close();
          var fecha_cr_sql = data.data[0].fecha_creacion.split(" ");
          var fecha_cr = fecha_cr_sql[0];
          var hora_cr = fecha_cr_sql[1];

          $("#info_proyect_name").text(data.data[0].nombre_largo);
          $("#info_proyect_code").text(
            data.data[0].codigo_proyecto.toUpperCase()
          );
          $("#info_proyect_start_date").text(data.data[0].fecha_inicio);
          $("#info_proyect_close_aprox_date").text(
            data.data[0].fecha_cierre_proyectada
          );
          $("#info_proyect_close_date").text("-");
          $("#info_proyect_address").text(data.data[0].direccion_proyecto);
          $("#comentarios_detalle").text(data.data[0].comentario);
          if (data.data[0].comentario == "") {
            $("#comentarios_detalle").text("Sin comentarios");
          }
          $("#nombre_comentario").text(data.data[0].creador_proyecto);
          $("#nombre_creador").text(
            "Proyecto creado por: " + data.data[0].creador_proyecto
          );
          $("#nombre_creador").text(
            "Abierto el: " + fecha_cr + " a las " + hora_cr + " horas."
          );

          $("#infoProyect").modal("show");
        } else {
          Swal.fire({
            icon: "error",
            title: "Ocurrió un error al consultar la información",
          });
        } */
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
  $("#add_details_delivery").change(function () {
    if ($(this).is(":checked")) {
      $("#delivery_details").show();
    } else {
      $("#delivery_details").hide();
    }
  });

  $(document).on("click", ".delivery_details", function () {
    var id_entrega = $(this).attr("id");
    $.ajax({
      url: "php/controllers/requests_controller.php",
      method: "POST",
      data: {
        mod: "getInfoDelivery",
        id_entrega: id_entrega,
      },
    }).done(function (data) {
      var data = JSON.parse(data);
      console.log(data);

      if (data.response == true) {
        Swal.close();
        console.log(data);

        var arr_fecha = data.data[0].fecha_entrega.split(" ");
        var fecha = arr_fecha[0];
        var arr_hora = arr_fecha[1].split(":");
        var hora = arr_hora[0] + ":" + arr_hora[1];
        $("#lbl_entrega_fecha").text(fecha);
        $("#lbl_entrega_hor").text(hora + " hrs.");
        $("#lbl_entrega_comentarios").text(data.data[0].comentarios);
      } else {
        Swal.fire({
          icon: "error",
          title: "Ocurrió un error al consultar la información",
        });
      }

      //--- --- ---//
      //--- --- ---//
    });
  });

  $(document).on("click", ".payment_info_final", function () {
    var id_pago = $(this).attr("id");

    $.ajax({
      url: "php/controllers/requests_controller.php",
      method: "POST",
      data: {
        mod: "getFullInfoPayment",
        id_pago: id_pago,
      },
    }).done(function (data) {
      var data = JSON.parse(data);

      if (data.response == true) {
        Swal.close();
        console.log(data);
        var ruta_img = data.data[0].url_factura;
        var ruta_pdf = data.data[0].url_pdf;
        var ruta_xml = data.data[0].url_xml;

        var img_archive_type = data.data[0].url_factura.split(".");
        if (
          img_archive_type[1] == "png" ||
          img_archive_type[1] == "jpf" ||
          img_archive_type[1] == "jpeg"
        ) {
          var html_img =
            '<img class="zoom" src="' +
            ruta_img +
            '" width="210" height="auto">;</img>';
          $("#img_comprobante_pago").empty();
          $("#img_comprobante_pago").append(html_img);
        }

        $("#lbl_cantidad_pagada").text("$ " + data.data[0].cantidad_pago);
        $("#lbl_pago_fecha").text(data.data[0].fecha_pag);
        $("#lbl_forma_pago").text(data.data[0].tt_forma_pago);
        $("#lbl_empresa_proveedor").text(data.data[0].empresa_proveedor);
        $("#lbl_comentarios").text(data.data[0].comentarios);
        $("#lbl_empresa_pago").text(data.data[0].payment_enterprise_via);

        $("#lbl_pago_cfdi").text(data.data[0].cfdi.toUpperCase());

        var btn_1 = '<form method="get" action="' + ruta_img + '">';
        btn_1 +=
          '<button type="submit" formtarget="_blank" class="btn btn-outline-primary"><i class="mdi mdi-file-image-outline"></i> Descargar imagen </button></form>';

        var btn_2 = "";
        btn_2 +=
          '<a href="' +
          ruta_xml +
          '" download="' +
          ruta_xml +
          '"><button type="button" formtarget="_blank" class="btn btn-outline-success"><i class="mdi mdi-file-excel-outline"></i> XML </button></a>';

        var btn_3 = "";
        btn_3 +=
          '<a href="' +
          ruta_pdf +
          '" download="' +
          ruta_pdf +
          '"><button type="button" formtarget="_blank" class="btn btn-outline-danger"><i class="mdi mdi-file-pdf-box-outline"></i> PDF</button></a>';

        $("#div_descargar_imagen").empty();
        $("#div_descargar_imagen").append(btn_1);
        $("#btn_2").empty();
        $("#btn_2").append(btn_2);
        $("#btn_3").empty();
        $("#btn_3").append(btn_3);
      } else {
        Swal.fire({
          icon: "error",
          title: "Ocurrió un error al consultar la información",
        });
      }

      //--- --- ---//
      //--- --- ---//
    });
  });
  $(document).on("change", ".partida_cotizada", function () {
    var status = 0;
    if ($(this).is(":checked")) {
      status = 1;
    }
    var id_desglose = $(this).attr("id_desglose");

    $.ajax({
      url: "php/controllers/requests_controller.php",
      method: "POST",
      data: {
        mod: "changeStatusRequestList",
        id_desglose: id_desglose,
        status: status,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);

        if (data.response == true) {
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
            title: data.message,
          });
        } else {
        }

        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {});
  });
  $(document).on("change", "#id_forma_pago", function () {
    var forma = $(this).val();
    if (forma == 7) {
      $("#div_credito").show();
    } else {
      $("#div_credito").hide();
    }
  });

  $(document).on("change", ".id_status", function () {
    var id_solicitud = $(this).attr("id");
    var id_status = $(this).val();
    var txt_status = $(this).find("option:selected").text();

    console.log("id_solicitud: " + id_solicitud);
    console.log("id_status: " + id_status);
    console.log("txt_status: " + txt_status);
    html_li = "";
    id_status = parseInt(id_status);
    switch (id_status) {
      case 1:
        html_li += '<i class="mdi mdi-circle text-success"></i> ' + txt_status;
        break;
      case 2:
        html_li += '<i class="mdi mdi-circle text-danger"></i>' + txt_status;
        break;
      case 3:
        html_li += '<i class="mdi mdi-circle text-warning"></i> ' + txt_status;
        break;
      case 4:
        html_li += '<i class="mdi mdi-circle text-info"></i>' + txt_status;
        break;
      case 5:
        html_li += '<i class="mdi mdi-circle text-primary"></i>' + txt_status;
        break;
      case 6:
        html_li += '<i class="mdi mdi-circle text-primary"></i>' + txt_status;
        break;
      case 7:
        html_li += '<i class="mdi mdi-circle text-secondary"></i>' + txt_status;
        break;
      case 8:
        html_li += '<i class="mdi mdi-circle text-primary"></i>' + txt_status;
        break;
    }

    $.ajax({
      url: "php/controllers/requests_controller.php",
      method: "POST",
      data: {
        mod: "changeStatusRequest",
        id_solicitud: id_solicitud,
        id_status: id_status,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);

        if (data.response == true) {
          $("#td_status_" + id_solicitud).empty();
          $("#td_status_" + id_solicitud).html(html_li);
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
            title: data.message,
          });
        } else {
        }

        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {});
  });
  $(document).on("click", ".icon_add_payment_voucher", function () {
    var id_cotizacion = $(this).attr("id");
    $(".save_payment_voucher").attr("id", id_cotizacion);
    var id_proyecto = $(this).attr("id_proyect");
    console.log(id_proyecto);
    $.ajax({
      url: "php/controllers/proyects_controller.php",
      method: "POST",
      data: {
        mod: "getInfoProyect",
        id_proyecto: id_proyecto,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);
        if (data.response == true) {
          $("#lblTituloPagoProyecto").text(data.data[0].nombre_largo);
          $("#lblCodigoPagoProyecto").text(data.data[0].codigo_proyecto);
        } else {
          console.log(data);
        }
        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {
        console.log(message);
      });
  });
  $(document).on("click", ".add_payment_info", function () {
    var id_proyecto = $(this).attr("id_proyect");
    console.log(id_proyecto);
    $.ajax({
      url: "php/controllers/proyects_controller.php",
      method: "POST",
      data: {
        mod: "getInfoProyect",
        id_proyecto: id_proyecto,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);
        if (data.response == true) {
          $("#lblTituloDDetailsProyecto").text(data.data[0].nombre_largo);
          $("#lblCodigoDDetailsProyecto").text(data.data[0].codigo_proyecto);
        } else {
          console.log(data);
        }
        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {
        console.log(message);
      });
  });
  $(document).on("click", ".add_payment_info", function () {
    var id_cotizacion = $(this).attr("id");
    $(".save_payment_details").attr("id", id_cotizacion);
  });
  $(".td_editable").dblclick(function () {
    //alert(this.rowIndex);

    var $td = $(this);
    var _t = $td.text().trim();
    var _w = $td.width();
    var _h = $td.height();
    $td.html("");
    let $input = $("<input type = 'text' value =''>");

    $input
      .appendTo($td)
      .width(_w)
      .height(_h)
      .val(_t)
      .focus()
      .blur(function () {
        let remark = $(this).val();
        let id = $td.parent("tr").attr("id");
        let column_name = $td.attr("column_name");
        var id_solicitud = $("#id_solicitud").val();
        console.log(remark);
        console.log(id);
        console.log(id_solicitud);
        console.log(column_name);

        $td.empty();
        $td.append("<td>" + remark + "</td>");

        $.ajax({
          url: "php/controllers/requests_controller.php",
          method: "POST",
          data: {
            mod: "updateRequest",
            id_index: id_solicitud,
            no_partida: id,
            column_name: column_name,
            value: remark,
          },
        })
          .done(function (data) {
            var data = JSON.parse(data);
            console.log(data);

            if (data.response == true) {
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
                title: data.message,
              });
            } else {
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
                title: data.message,
              });
            }

            //--- --- ---//
            //--- --- ---//
          })
          .fail(function (message) {});

        /*  $.ajax({
            type:'POST',
            url:'ajax_set_remark',
            data: {id: id,remark:remark},
            dataType:'json',
            success:function(data){
                if(data.errno == 0){
                    layer.msg(data.errdesc, {icon: 1});
                    $td.html(remark);
                    $("#update_time_"+id).html(data.date);
                }else{
                    layer.msg(data.errdesc, {icon: 5});
                    $td.html(_t);
                    return false;
                }
            }
        }); */
      });

    /* input.val(html);
    $(this).html(input); */
  });

  $(document).on("click", ".btn_borrar_partida_desglose", function () {
    var id_partida = $(this).attr("id");
    var id_cotizacion = $("#id_solicitud").val();
    console.log(id_partida);
    console.log(id_cotizacion);
    Swal.fire({
      title: "¿Estás seguro?",
      text: "Esta acción no se puede deshacer",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, eliminar",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "php/controllers/requests_controller.php",
          method: "POST",
          data: {
            mod: "deleteRequestItem",
            id_partida: id_partida,
            id_cotizacion: id_cotizacion,
          },
        })
          .done(function (data) {
            var data = JSON.parse(data);
            console.log(data);

            if (data.response == true) {
              Swal.fire({
                title: "Eliminado!",
                icon: "success",
                timer: 1500,
              }).then((result) => {
                location.reload();
              });
            } else {
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
                title: data.message,
              });
            }

            //--- --- ---//
            //--- --- ---//
          })
          .fail(function (message) {});
      } else if (result.isDenied) {
        Swal.close();
      }
    });
  });

  function addDocuument() {
    const inputFile = document.querySelector("#fileinput_request");

    //-- DETALLES DE ENTREGA ---//
    var id_proyecto = $("#id_proyecto").val();
    var id_cotizacion = $("#id_cotizacion").val();
    var comentarios_archivo = $("#comentarios_archivo").val();
    var proveedor_codigo = $("#proveedor_codigoA").val();
    var txt_proyecto = $("#lblTituloFacturaProyecto").text();
    var txt_codigo_proyecto = $("#lblCodigoFacturaProyecto").text();

    if ($("#add_details_delivery").is(":checked")) {
      var fecha = $("#fecha_entrega").val();
      var hora = $("#hora_entrega").val();
      var comentarios_entrega = $("#comentarios_entrega").val();

      console.log(fecha);
      console.log(hora);
      console.log(comentarios_entrega);

      if (fecha == "" || hora == "" || comentarios_entrega == "") {
        Swal.fire({
          icon: "error",
          title: "Algunos campos están vacíos",
        });
        return false;
      } else {
        if (inputFile.files.length > 0) {
          let formData = new FormData();
          formData.append("archivo", inputFile.files[0]); // En la posición 0; es decir, el primer elemento
          formData.append("id_proyecto", id_proyecto);
          formData.append("id_cotizacion", id_cotizacion);
          formData.append("comentarios_archivo", comentarios_archivo);
          formData.append("proveedor_codigo", proveedor_codigo);
          formData.append("txt_proyecto", txt_proyecto);
          formData.append("txt_codigo_proyecto", txt_codigo_proyecto);

          fetch("php/controllers/guardar.php", {
            method: "POST",
            mod: "guardarDocumento",
            body: formData,
          })
            .then((respuesta) => respuesta.json())
            .then((decodificado) => {
              console.log(decodificado.last_id);
              var id_rutas_doc = decodificado.last_id;
              $.ajax({
                url: "php/controllers/requests_controller.php",
                method: "POST",
                data: {
                  mod: "guardarDetallesEntregaCotizacion",
                  fecha: fecha,
                  hora: hora,
                  comentarios_entrega: comentarios_entrega,
                  id_rutas_doc: id_rutas_doc,
                },
              })
                .done(function (data) {
                  var data = JSON.parse(data);
                  console.log(data);

                  if (data.response == true) {
                    Swal.fire({
                      title: "¡Registro exitoso!",
                      text: "Se  regisrtaron todas las partidas!!!",
                      icon: "success",
                      timer: 1500,
                    }).then((result) => {
                      location.reload();
                    });
                  } else {
                    Swal.fire({
                      icon: "error",
                      title: "Ocurrio un error al enviar la solicitud",
                    });
                  }
                })
                .fail(function (message) {
                  Swal.fire({
                    title: "Datos no registrados!",
                    text: "Ocurrió un error al guardar la información",
                    icon: "info",
                  });
                });
            });
        } else {
          // El usuario no ha seleccionado archivos
          alert("Selecciona un archivo");
        }
      }
    } else {
      if (inputFile.files.length > 0) {
        let formData = new FormData();
        formData.append("archivo", inputFile.files[0]); // En la posición 0; es decir, el primer elemento
        formData.append("id_proyecto", id_proyecto);
        formData.append("id_cotizacion", id_cotizacion);
        formData.append("comentarios_archivo", comentarios_archivo);
        formData.append("proveedor_codigo", proveedor_codigo);
        formData.append("txt_proyecto", txt_proyecto);
        formData.append("txt_codigo_proyecto", txt_codigo_proyecto);

        fetch("php/controllers/guardar.php", {
          method: "POST",
          mod: "guardarDocumentoSinEntrega",
          body: formData,
        })
          .then((respuesta) => respuesta.json())
          .then((decodificado) => {
            console.log(decodificado.last_id);
            Swal.fire({
              title: "¡Archivo guardado!",
              text: "Se  subió un archivo correctamente!!!",
              icon: "success",
              timer: 1500,
            }).then((result) => {
              location.reload();
            });
          });
      } else {
        // El usuario no ha seleccionado archivos
        Swal.fire({
          type: "info",
          title: "Atención",
          text: "Debe seleccionar un archivo",
        });
      }
    }

    //-- --- ---//
  }

  function paymentVoucher(id_cotizacion) {
    console.log("paymentVoucher");
    const inputFile = document.querySelector("#input_pago");
    var comentarios_archivo = $("#comentarios_pago").val();
    var id_usuario = $("#id_usuario").val();
    var txt_proyecto = $("#lblTituloPagoProyecto").text();
    var codigo_proyecto = $("#lblCodigoPagoProyecto").text();
    var fecha_pago = $("#fecha_pago").val();

    if (inputFile.files.length > 0) {
      let formData = new FormData();
      formData.append("archivo", inputFile.files[0]);
      formData.append("comentarios_archivo", comentarios_archivo);
      formData.append("id_cotizacion", id_cotizacion);
      formData.append("fecha_pago", fecha_pago);
      formData.append("id_usuario", id_usuario);
      formData.append("txt_proyecto", txt_proyecto);
      formData.append("codigo_proyecto", codigo_proyecto);

      fetch("php/controllers/save_payment_voucher.php", {
        method: "POST",
        mod: "savePaymentVoucher",
        body: formData,
      })
        .then((respuesta) => respuesta.json())
        .then((decodificado) => {
          console.log(decodificado.last_id);
          Swal.fire({
            title: "¡Archivo guardado!",
            text: "Se  agregó el comprobante de pago correctamente!!!",
            icon: "success",
            timer: 1500,
          }).then((result) => {
            location.reload();
          });
        });
    } else {
      // El usuario no ha seleccionado archivos
      alert("Selecciona un archivo");
    }

    //-- --- ---//
  }

  function savePaymentDetails(id_cotizacion) {
    console.log("savePaymentDetails");

    var id_pago = id_cotizacion;
    const id_forma_pago = $("#id_forma_pago").val();
    const cantidad = $("#cantidad_pago").val();
    const cfdi = $("#cfdi").val();
    const id_proveedor = $("#id_proveedor").val();
    const comentarios = $("#comentarios_payment_details").val();
    const id_enterprise_payment = $("#id_empresa_pagocon").val();

    var txt_proyecto = $("#lblTituloDDetailsProyecto").text();
    var codigo_proyecto = $("#lblCodigoDDetailsProyecto").text();

    const pdfFile = document.querySelector("#pdf_pago");
    const xmlFile = document.querySelector("#xml_pago");

    const inputFile = document.querySelector("#input_pago");

    let formData = new FormData();
    formData.append("pdf", pdfFile.files[0]);
    formData.append("xml", xmlFile.files[0]);
    formData.append("id_forma_pago", id_forma_pago);
    formData.append("cantidad", cantidad);
    formData.append("cfdi", cfdi);
    formData.append("id_pago", id_pago);
    formData.append("id_proveedor", id_proveedor);
    formData.append("txt_proyecto", txt_proyecto);
    formData.append("codigo_proyecto", codigo_proyecto);
    formData.append("comentarios", comentarios);
    formData.append("id_enterprise_payment", id_enterprise_payment);

    fetch("php/controllers/save_payment_details.php", {
      method: "POST",
      body: formData,
    })
      .then((respuesta) => respuesta.json())
      .then((decodificado) => {
        console.log(decodificado.last_id);
        Swal.fire({
          title: "¡Archivo guardado!",
          text: "Se  agregó el comprobante de pago correctamente!!!",
          icon: "success",
          timer: 1500,
        }).then((result) => {
          location.reload();
        });
      });
    //-- --- ---//
  }
  function savePaymentDetailsCredit(id_cotizacion) {
    console.log("savePaymentDetails");

    var id_pago = id_cotizacion;
    const id_forma_pago = $("#id_forma_pago").val();
    const cantidad = $("#cantidad_pago").val();
    const cfdi = $("#cfdi").val();
    const id_proveedor = $("#id_proveedor").val();
    const comentarios = $("#comentarios_payment_details").val();
    const id_enterprise_payment = $("#id_empresa_pagocon").val();
    const id_credito = $("#id_credito").val();

    var txt_proyecto = $("#lblTituloDDetailsProyecto").text();
    var codigo_proyecto = $("#lblCodigoDDetailsProyecto").text();

    const pdfFile = document.querySelector("#pdf_pago");
    const xmlFile = document.querySelector("#xml_pago");

    const inputFile = document.querySelector("#input_pago");

    let formData = new FormData();
    formData.append("pdf", pdfFile.files[0]);
    formData.append("xml", xmlFile.files[0]);
    formData.append("id_forma_pago", id_forma_pago);
    formData.append("cantidad", cantidad);
    formData.append("cfdi", cfdi);
    formData.append("id_pago", id_pago);
    formData.append("id_proveedor", id_proveedor);
    formData.append("txt_proyecto", txt_proyecto);
    formData.append("codigo_proyecto", codigo_proyecto);
    formData.append("comentarios", comentarios);
    formData.append("id_enterprise_payment", id_enterprise_payment);
    formData.append("id_credito", id_credito);

    fetch("php/controllers/save_payment_details_credito.php", {
      method: "POST",
      body: formData,
    })
      .then((respuesta) => respuesta.json())
      .then((decodificado) => {
        console.log(decodificado);
        if (decodificado.response) {
          Swal.fire({
            title: "¡Archivo guardado!",
            text: "Se  agregó el comprobante de pago correctamente!!!",
            icon: "success",
            timer: 1500,
          }).then((result) => {
            location.reload();
          });
        }else{
          Swal.fire({
            title: "Error!",
            text: decodificado.message,
            icon: "error",
            timer: 1500,
          });
        }

        
      });
    //-- --- ---//
  }

  $("#id_forma_pago").select2({
    dropdownParent: $("#agregarInformacionPago"),
  });
  $("#id_proyecto").select2({
    dropdownParent: $("#createSolicitud"),
  });
  $("#id_utilizacion").select2({
    dropdownParent: $("#createSolicitud"),
  });
  $("#id_um").select2({
    dropdownParent: $("#createSolicitud"),
  });
  $("#id_proveedor").select2({
    dropdownParent: $("#agregarInformacionPago"),
  });
  $("#id_empresa_pagocon").select2({
    dropdownParent: $("#agregarInformacionPago"),
  });
  $("#id_credito").select2({
    dropdownParent: $("#agregarInformacionPago"),
  });
});
