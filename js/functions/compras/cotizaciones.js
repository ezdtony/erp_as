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

  $(document).on("click", ".btn_add_partida", function () {
    var html_tabla = "";
    var html = "";
    var id_proyecto_cotizacion = $("#id_proyecto_cotizacion").val();
    var id_clasificacion = $("#select_clasificacion_cotizacion").val();
    var id_material = $("#material_cotizacion").val();
    var apply_ul = $("#material_cotizacion option:selected").attr(
      "data-aplica-ul"
    );
    var id_unidad_longitud = $("#id_unidad_longitud").val();
    var id_medida_longitud = $("#id_medida_longitud").val();
    var id_unidad_medida = $("#id_unidad_medida").val();
    var select_marca_cotizacion = $("#select_marca_cotizacion").val();
    var canitdad_cotizacion = $("#canitdad_cotizacion").val();
    var observaciones = $("#observaciones").val();

    var txt_clasificacion = $(
      "#select_clasificacion_cotizacion option:selected"
    ).text();

    var txt_material = $("#material_cotizacion option:selected").text();
    var txt_ul = $("#id_medida_longitud option:selected").text();

    var txt_unidad_medida = $("#id_unidad_medida option:selected").text();
    var txt_marca_cotizacion = $(
      "#select_marca_cotizacion option:selected"
    ).text();
    var descripcion_material = "";

    if (apply_ul != 1) {
      descripcion_material = txt_material;
    } else {
      if (
        (id_unidad_longitud != null && id_medida_longitud == null) ||
        (id_unidad_longitud == null && id_medida_longitud == null)
      ) {
        Swal.fire({
          title: "Atención!!",
          text: "Debe seleccionar una medida de longitud",
          icon: "error",
          confirmButtonText: "Aceptar",
        });
      } else if (id_unidad_longitud != null && id_medida_longitud != null) {
        descripcion_material = txt_material + " " + txt_ul;
      }
    }

    if (
      id_proyecto_cotizacion != null &&
      id_clasificacion != null &&
      id_material != null &&
      apply_ul != undefined &&
      id_unidad_longitud != null &&
      id_medida_longitud != null &&
      id_unidad_medida != null &&
      select_marca_cotizacion != null &&
      canitdad_cotizacion != ""
    ) {
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
        html += '<th scope="col">Concepto</th>';
        html += '<th scope="col">Clasificación</th>';
        html += '<th scope="col"> U.M.</th>';
        html += '<th scope="col">Cantidad</th>';
        html += '<th scope="col">Marca</th>';
        html += '<th scope="col">Observaciones</th>';
        html += '<th scope="col">Quitar</th>';
        html += "</tr>";
        html += "</thead>";
        html += "<tbody>";
        html += "<tr>";
        html +=
          '<th data-id-material="' +
          id_material +
          '" data-id-medida-longitud="' +
          id_medida_longitud +
          '" data-id-marcas="' +
          select_marca_cotizacion +
          '" scope="row">1</th>';
        html += "<td>" + descripcion_material + "</td>";
        html += "<td>" + txt_clasificacion + "</td>";
        html += "<td>" + txt_unidad_medida + "</td>";
        html += "<td>" + canitdad_cotizacion + "</td>";
        html += "<td>" + txt_marca_cotizacion + "</td>";
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

        if (isNaN(last_no_partida)) {
          last_no_partida = 0;
        }
        var no_partida = last_no_partida + 1;

        html_tabla += "<tr>";
        html_tabla +=
          '<th data-id-material="' +
          id_material +
          '" data-id-medida-longitud="' +
          id_medida_longitud +
          '" data-id-marcas="' +
          select_marca_cotizacion +
          '" scope="row">' +
          no_partida +
          "</th>";
        html_tabla += "<td>" + descripcion_material + "</td>";
        html_tabla += "<td>" + txt_clasificacion + "</td>";
        html_tabla += "<td>" + txt_unidad_medida + "</td>";
        html_tabla += "<td>" + canitdad_cotizacion + "</td>";
        html_tabla += "<td>" + txt_marca_cotizacion + "</td>";
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
  $(document).on("click", ".btn_save_solicitud_list", function () {
    var solicitud_index = [];
    loading();
    var id_proyecto = $("#id_proyecto_cotizacion").val();

    console.log(id_proyecto);
    if (id_proyecto != null) {
      if ($("#tablaPreviaSolicitud tr").length > 1) {
        var valores = [];
        $("#tablaPreviaSolicitud tr:last th:first").html();
        $("#tablaPreviaSolicitud tr").each(function () {
          var id_catalogo_material = $(this)
            .find("th:first")
            .attr("data-id-material");
          var id_medidas_de_longitud = $(this)
            .find("th:first")
            .attr("data-id-medida-longitud");
          var id_marcas = $(this).find("th:first").attr("data-id-marcas");
          var no_partida = $(this).find("th:first").html();
          var cantidad = $(this).find("td:eq(3)").html();
          var observaciones = $(this).find("td:eq(5)").html();
          valores.push([
            [id_catalogo_material],
            [id_medidas_de_longitud],
            [id_marcas],
            [no_partida],
            [cantidad],
            [observaciones]
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
  $(document).on("change", "#id_proyecto_cotizacion", function () {
    loading();
    $("#desglose_cotizacion").show();
    Swal.close();
  });
  $(document).on("change", "#select_clasificacion_cotizacion", function () {
    loading();
    var id_clasificacion = this.value;
    $("#material_cotizacion").empty();
    $("#div_unidades_longitud").hide();
    $.ajax({
      url: "php/controllers/compras/compras_controller.php",
      method: "POST",
      data: {
        mod: "getMaterialesPorClasificacion",
        id_clasificacion: id_clasificacion,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);

        if (data.response == true) {
          $("#material_cotizacion").empty();
          $("#material_cotizacion").append(
            '<option value="" disabled selected>Seleccione una opción *</option>'
          );
          for (var i = 0; i < data.data.length; i++) {
            $("#material_cotizacion").append(
              '<option data-aplica-ul="' +
                data.data[i].aplica_ul +
                '" value="' +
                data.data[i].id_catalogo_material +
                '">' +
                data.data[i].codigo_astelecom +
                " | " +
                data.data[i].descripcion_material +
                "</option>"
            );
          }
          $("#material_cotizacion").prop("disabled", false);
          Swal.close();
        } else {
          $("#material_cotizacion").empty();
          $("#material_cotizacion").prop("disabled", true);
          Swal.fire({
            title: "Atención!",
            text: data.message,
            icon: "info",
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
    Swal.close();
  });
  $(document).on("change", "#id_unidad_longitud", function () {
    loading();
    var id_unidad_longitud = this.value;
    $("#id_medida_longitud").empty();
    $.ajax({
      url: "php/controllers/compras/compras_controller.php",
      method: "POST",
      data: {
        mod: "getMedidasLongitud",
        id_unidad_longitud: id_unidad_longitud,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);

        if (data.response == true) {
          $("#id_medida_longitud").empty();
          $("#id_medida_longitud").append(
            '<option value="" disabled selected>Seleccione una opción *</option>'
          );
          for (var i = 0; i < data.data.length; i++) {
            $("#id_medida_longitud").append(
              '<option value="' +
                data.data[i].id_medidas_de_longitud +
                '">' +
                data.data[i].medida_de_longitud_long +
                "" +
                data.data[i].simbolo +
                "</option>"
            );
          }
          $("#id_medida_longitud").prop("disabled", false);
          Swal.close();
        } else {
          $("#id_medida_longitud").empty();
          $("#id_medida_longitud").prop("disabled", true);
          Swal.fire({
            title: "Atención!",
            text: data.message,
            icon: "info",
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
    Swal.close();
  });
  $(document).on("change", "#material_cotizacion", function () {
    loading();
    apply_ul = $(this).find(":selected").attr("data-aplica-ul");
    /* apply_ul = $(this); */
    console.log(apply_ul);
    if (apply_ul == 1) {
      $("#div_unidades_longitud").show();
    } else {
      $("#div_unidades_longitud").hide();
    }
    Swal.close();
  });
  $("#id_proyecto_cotizacion").select2({
    dropdownParent: $("#nuevaCotizacion"),
  });
  $("#id_utilizacion").select2({
    dropdownParent: $("#nuevaCotizacion"),
  });
  $("#id_unidad_medida").select2({
    dropdownParent: $("#nuevaCotizacion"),
  });
  $("#select_clasificacion_cotizacion").select2({
    dropdownParent: $("#nuevaCotizacion"),
  });
  $("#material_cotizacion").select2({
    dropdownParent: $("#nuevaCotizacion"),
  });
  $("#id_unidad_longitud").select2({
    dropdownParent: $("#nuevaCotizacion"),
  });
  $("#id_medida_longitud").select2({
    dropdownParent: $("#nuevaCotizacion"),
  });
  $("#select_marca_cotizacion").select2({
    dropdownParent: $("#nuevaCotizacion"),
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
