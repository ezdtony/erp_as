$(document).ready(function () {
  $(document).on("click", ".saveAlmacen", function () {
    loading();
    var nombre_almacen = $("#nombre_almacen").val();
    var direccion_almacen = $("#direccion_almacen").val();

    if (nombre_almacen == "" || direccion_almacen == "") {
      Swal.fire("Atención!", "Todos los campos son obligatorios", "info");
    } else {
      $.ajax({
        url: "php/controllers/compras/herramientas_controller.php",
        method: "POST",
        data: {
          mod: "saveAlmacen",
          nombre_almacen: nombre_almacen,
          direccion_almacen: direccion_almacen,
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          /* console.log(data); */

          if (data.response == true) {
            Swal.fire("Éxito!", data.message, "success");
            var htmlTags =
              "<tr>" +
              "<td>" +
              nombre_almacen +
              '<br><span class="badge badge-info-lighten">' +
              direccion_almacen +
              "</span></td>" +
              "</tr>";

            $("#tablaAlmacenes").append(htmlTags);

            $("#addAlmacen").modal("hide");
            $("#addAlmacen").find("input,textarea,select").val("");
            $("#addAlmacen input[type='checkbox']")
              .prop("checked", false)
              .change();
          } else {
            Swal.fire("Atención!", data.message, "info");
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
  $(document).on("click", ".saveTipoKit", function () {
    loading();
    var abreviatura_tipo_kit = $("#abreviatura_tipo_kit").val();
    var descripcion_tipo_kit = $("#descripcion_tipo_kit").val();

    if (abreviatura_tipo_kit == "" || descripcion_tipo_kit == "") {
      Swal.fire("Atención!", "Todos los campos son obligatorios", "info");
    } else {
      $.ajax({
        url: "php/controllers/compras/herramientas_controller.php",
        method: "POST",
        data: {
          mod: "saveTipoKit",
          abreviatura_tipo_kit: abreviatura_tipo_kit,
          descripcion_tipo_kit: descripcion_tipo_kit,
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          /* console.log(data); */

          if (data.response == true) {
            Swal.fire("Éxito!", data.message, "success");
            var htmlTags =
              "<tr>" +
              "<td>" +
              abreviatura_tipo_kit +
              "</td>" +
              "<td>" +
              descripcion_tipo_kit +
              "</td>" +
              "</tr>";

            $(".table_ClasificacionesKits").append(htmlTags);

            $("#addTipoKit").modal("hide");
            $("#addTipoKit").find("input,textarea,select").val("");
            $("#addTipoKit input[type='checkbox']")
              .prop("checked", false)
              .change();
          } else {
            Swal.fire("Atención!", data.message, "info");
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
  $(document).on("click", ".saveKit", function () {
    loading();
    var select_id_tipos_kits_herramienta = $(
      "#select_id_tipos_kits_herramienta"
    ).val();
    var select_id_tipos_kits_herramienta_text = $(
      "#select_id_tipos_kits_herramienta option:selected"
    ).text();
    var nombre_de_kit = $("#nombre_de_kit").val();

    if (select_id_tipos_kits_herramienta == "" || nombre_de_kit == "") {
      Swal.fire("Atención!", "Todos los campos son obligatorios", "info");
    } else {
      $.ajax({
        url: "php/controllers/compras/herramientas_controller.php",
        method: "POST",
        data: {
          mod: "saveKit",
          select_id_tipos_kits_herramienta: select_id_tipos_kits_herramienta,
          nombre_de_kit: nombre_de_kit,
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          /* console.log(data); */

          if (data.response == true) {
            Swal.fire("Éxito!", data.message, "success");
            var htmlTags =
              "<tr>" +
              "<td>" +
              nombre_de_kit + 
              "</td>" /* +
              "<td>" +
              '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarClasificacion" title="Editar Clasificación" onclick="editarClasificacion(<?= $kits->id_kits_herramienta ?>)"><i class="mdi mdi-pencil"></i> </button>' +
              '<button type="button" class="btn btn-danger" title="Eliminar Clasificación" onclick="eliminarClasificacion(<?= $kits->id_kits_herramienta ?>)"><i class="mdi mdi-delete"></i> </button>' +
              "</td>" + */
              "</tr>";

            $(".tableKitsHerramientas").append(htmlTags);

            $("#addTipoKit").modal("hide");
            $("#addTipoKit").find("input,textarea,select").val("");
            $("#addTipoKit input[type='checkbox']")
              .prop("checked", false)
              .change();
          } else {
            Swal.fire("Atención!", data.message, "info");
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

  $("#select_id_tipos_kits_herramienta").select2({
    dropdownParent: $("#addKit"),
  });
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
});
