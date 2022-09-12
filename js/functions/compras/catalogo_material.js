$(document).ready(function () {
  $(document).on("change", "#id_central", function () {
    var id_central = this.value;
    $("#id_zona").empty();
    $.ajax({
      url: "php/controllers/accesos/accesos_controller.php",
      method: "POST",
      data: {
        mod: "getSiteZoneByIDCentral",
        id_central: id_central,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);

        if (data.response == true) {
          $("#id_zona").empty();
          $("#id_zona").append(
            '<option value="" disabled selected>Elija una zona*</option><optgroup label="Zonas">'
          );
          for (var i = 0; i < data.data.length; i++) {
            $("#id_zona").append(
              '<option value="' +
                data.data[i].id_zonas_central +
                '">' +
                data.data[i].descripcion +
                "</option>"
            );
          }
          $("#id_zona").append("</optgroup>");
          $("#id_zona").prop("disabled", false);
        } else {
          $("#id_zona").prop("disabled", true);
          $.NotificationApp.send(
            "Al parecer ésta central no tiene zonas asignadas",
            "",
            "top-right",
            "#06996f",
            "warning"
          );
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

  $(document).on("click", ".guardarNuevoConcepto", function () {
    loading();

    var nombre_material = $("#nombre_material").val();
    var id_clasificacion = $("#select_clasificacion").val();
    var id_unidad_medida = $("#select_unidad_medida").val();

    var apply_ul = "0";
    if ($("#apply_ul").is(":checked")) {
      apply_ul = "1";
    }

    /* var html_tabla = "";
    var html = "";
    var articulo = $("#articulo").val();
    var txt_utilizacion = $("#id_utilizacion option:selected").text();
    var id_u_medida = $("#id_unidad_medida option:selected").val();
    var txt_u_medida = $("#id_unidad_medida option:selected").text();
    var cantidad = $("#cantidad").val();
    var observaciones = $("#observaciones").val();
 */
    if (
      nombre_material != "" &&
      id_clasificacion != "" &&
      id_unidad_medida != ""
    ) {
      $.ajax({
        url: "php/controllers/compras/compras_controller.php",
        method: "POST",
        data: {
          mod: "guardarNuevoConceptoCatalogo",
          nombre_material: nombre_material,
          id_clasificacion: id_clasificacion,
          id_unidad_medida: id_unidad_medida,
          apply_ul: apply_ul,
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          console.log(data);

          if (data.response == true) {
            $("#nombre_material").val("");
            Swal.fire({
              title: "Éxito!!",
              text: "Se registró el nuevo concepto de material",
              icon: "success",
              confirmButtonText: "Aceptar",
              timer: 1000,
            });
          } else {
            Swal.fire({
              title: "Error!!",
              text: "Ocurrió un error al registrar la información",
              icon: "error",
              confirmButtonText: "Aceptar",
            });
          }

          //--- --- ---//
          //--- --- ---//
        })
        .fail(function (message) {
          Swal.fire({
            title: "Error!!",
            text: "Ocurrió un error al enviar o reciibr la información",
            icon: "error",
            confirmButtonText: "Aceptar",
          });
        });
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
  $(document).on("click", ".btn_save_solicitud_list", function () {
    var solicitud_index = [];
    loading();
    var id_proyecto = $("#id_proyecto option:selected").val();
    var txt_proyecto = $("#id_proyecto option:selected").text();
    var id_utilizacion = $("#id_utilizacion option:selected").val();
    var txt_utilizacion = $("#id_utilizacion option:selected").text();

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
            [u_medida],
            [cantidad],
            [observaciones],
            [utilizacion],
          ]);
        });
        solicitud_index.push([id_proyecto], [valores]);
        console.log(solicitud_index);
        $.ajax({
          url: "php/controllers/compras/compras_controller.php",
          method: "POST",
          data: {
            mod: "guardarCotizacion",
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
  $(document).on("click", ".cerrarNuevoConceptoCatalogo", function () {
    loading();
    location.reload();
  });

  $("#select_clasificacion").select2({
    dropdownParent: $("#nuevoConceptoCatalogo"),
  });
  $("#select_unidad_medida").select2({
    dropdownParent: $("#nuevoConceptoCatalogo"),
  });
});
/* Swal.fire({
        title: "¿Estás seguro?",
        text: "¿Deseas guardar el nuevo sitio?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, guardar",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.value) {
          $("#form_nuevo_sitio").submit();
        }
      }); */

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
