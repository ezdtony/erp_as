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
    var articulo = $("#articulo").val();
    var txt_utilizacion = $("#id_utilizacion option:selected").text();
    /*var txt_material = $("#id_material option:selected").text();
        
          var txt_dimension = $("#id_dimension option:selected").text(); */
    var id_u_medida = $("#id_unidad_medida option:selected").val();
    var txt_u_medida = $("#id_unidad_medida option:selected").text();
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
        solicitud_index.push(
          [id_proyecto],
          [valores]
        );
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

  $("#id_proyecto").select2({
    dropdownParent: $("#nuevaCotizacion"),
  });
  $("#id_utilizacion").select2({
    dropdownParent: $("#nuevaCotizacion"),
  });
  $("#id_unidad_medida").select2({
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
