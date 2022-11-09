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
            var htmlTags = "<tr>" + "<td>" + nombre_de_kit + "</td>"; /* +
              "<td>" +
              '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarClasificacion" title="Editar Clasificación" onclick="editarClasificacion(<?= $kits->id_kits_herramienta ?>)"><i class="mdi mdi-pencil"></i> </button>' +
              '<button type="button" class="btn btn-danger" title="Eliminar Clasificación" onclick="eliminarClasificacion(<?= $kits->id_kits_herramienta ?>)"><i class="mdi mdi-delete"></i> </button>' +
              "</td>" + */
            ("</tr>");

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
  $(document).on("click", ".btnAddHerramientaKit", function () {
    loading();
    var id_kit = $(this).attr("data-id-kit");
    $(".saveHerramienta").attr("data-id-kit", id_kit);
    Swal.close();
  });
  $(document).on("click", ".saveHerramienta", function () {
    loading();
    var id_kit = $(this).attr("data-id-kit");

    var nombre_de_herramienta = $("#nombre_de_herramienta").val();
    var marca_de_herramienta = $("#marca_de_herramienta").val();
    var modelo_herramienta = $("#modelo_herramienta").val();
    var numero_serie_herramienta = $("#numero_serie_herramienta").val();
    var selectStatusHerramienta = $("#selectStatusHerramienta").val();
    var selectAlmacenHerramienta = $("#selectAlmacenHerramienta").val();
    var comentarios_herramienta = $("#comentarios_herramienta").val();

    if (
      nombre_de_herramienta == "" ||
      selectStatusHerramienta == "" ||
      selectAlmacenHerramienta == ""
    ) {
      Swal.fire("Atención!", "Todos los campos son obligatorios", "info");
    } else {
      $.ajax({
        url: "php/controllers/compras/herramientas_controller.php",
        method: "POST",
        data: {
          mod: "saveHerramientaKit",
          nombre_de_herramienta: nombre_de_herramienta,
          marca_de_herramienta: marca_de_herramienta,
          modelo_herramienta: modelo_herramienta,
          numero_serie_herramienta: numero_serie_herramienta,
          selectStatusHerramienta: selectStatusHerramienta,
          selectAlmacenHerramienta: selectAlmacenHerramienta,
          comentarios_herramienta: comentarios_herramienta,
          id_kit: id_kit,
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          /* console.log(data); */

          if (data.response == true) {
            var last_id = data.last_id;
            var code = data.code;
            Swal.fire("Éxito!", data.message, "success");
            var htmlTags = "<tr>";
            htmlTags += "<td>" + code + "</td>";
            htmlTags += "<td>" + nombre_de_herramienta + "</td>";
            htmlTags += "<td>" + marca_de_herramienta + "</td>";
            htmlTags += "<td>" + modelo_herramienta + "</td>";
            htmlTags += "<td>" + numero_serie_herramienta + "</td>";
            htmlTags += "<td id='tdStatus" + last_id + "'></td>";
            htmlTags += "<td>" + comentarios_herramienta + "</td>";
            htmlTags += "<td id='tdAlmacen" + last_id + "'></td>";
            htmlTags += "</tr>";

            $("#tablaHerramienta" + id_kit).append(htmlTags);

            $("#addHerramientaKit").modal("hide");
            $("#addHerramientaKit").find("input,textarea,select").val("");
            $("#addHerramientaKit input[type='checkbox']")
              .prop("checked", false)
              .change();
            getStatusTd(last_id, selectStatusHerramienta);
            getAlmacenTd(last_id, selectAlmacenHerramienta);
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

  $(document).on("click", ".deleteHerramienta", function () {
    loading();
    var id_herramienta = $(this).attr("data-id-herramienta");

    Swal.fire({
      title: "¿Estás seguro?",
      text: "¡No podrás revertir esto!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "¡Sí, bórralo!",
    }).then((result) => {
      if (result.isConfirmed) {
        loading();
        $.ajax({
          url: "php/controllers/compras/herramientas_controller.php",
          method: "POST",
          data: {
            mod: "deleteHerramienta",
            id_herramienta: id_herramienta,
          },
        })
          .done(function (data) {
            $("#tr" + id_herramienta).remove();
            Swal.fire({
              title: "¡Eliminado!",
              text: "El registro ha sido eliminado.",
              icon: "success",
              timer: 1200,
            });

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
  });
  $(document).on("click", ".btnAsignarKit", function () {
    loading();
    var id_kit = $(this).attr("data-id-kit");
    $(".asignarKits").attr("data-id-kit", id_kit);

    $.ajax({
      url: "php/controllers/compras/herramientas_controller.php",
      method: "POST",
      data: {
        mod: "getPersonalAssignedKit",
        id_kit: id_kit,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);

        if (data.response == true) {
          Swal.close();
          $("#personal_kit_modal_as").empty();
          for (var i = 0; i < data.data.length; i++) {
            $("#personal_kit_modal_as").append(
              '<li id="li_' +
                data.data[i].id_asignaciones_material +
                '" class="list-group-item"><i class="uil-constructor"> ' +
                data.data[i].nombre_completo +
                '</i>      <button type="button" class="btn btn-danger float-right btn-sm unassign_personal_kit" id="' +
                data.data[i].id_asignaciones_material +
                '"><i class="mdi mdi-window-close"></i> </button>'
            );
          }
        } else {
          $("#personal_kit_modal_as").empty();
          $("#personal_kit_modal_as").append(
            '<li class="list-group-item"><i class="uil-constructor"> AÚN NO SE HA ASIGNADO A NADIE </i>'
          );
        }

        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {});
    Swal.close();
  });
  $(document).on("click", ".unassign_personal_kit", function () {
    var id_asingacion = $(this).attr("id");
    loading();
    $.ajax({
      url: "php/controllers/compras/herramientas_controller.php",
      method: "POST",
      data: {
        mod: "unassignPersonalKit",
        id_asingacion: id_asingacion,
      },
    })
      .done(function (data) {
        Swal.close();
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
  $(document).on("click", ".asignarKits", function () {
    loading();
    var id_kit = $(this).attr("data-id-kit");
    var ids_personal = $("#select_asignar_kit").val();

    console.log(ids_personal);

    $.ajax({
      url: "php/controllers/compras/herramientas_controller.php",
      method: "POST",
      data: {
        mod: "asignarKit",
        id_kit: id_kit,
        ids_personal: ids_personal,
      },
    })
      .done(function (data) {
        Swal.fire({
          title: "¡Asignado!",
          text: "El kit ha sido asignado.",
          icon: "success",
          timer: 1200,
        }).then((result) => {
          loading();
          location.reload();
        });

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

  $(document).on("change", "#statusHerramienta", function () {
    loading();
    var id_status = $(this).val();
    var id_herramienta = $(this).attr("data-id-herramienta");
    $.ajax({
      url: "php/controllers/compras/herramientas_controller.php",
      method: "POST",
      data: {
        mod: "updateStatusHerramienta",
        id_status: id_status,
        id_herramienta: id_herramienta,
      },
    })
      .done(function (data) {
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Status actualizado",
          showConfirmButton: false,
          timer: 1500,
        });

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
  $(document).on("change", "#almacenesHerramienta", function () {
    loading();
    var id_almacen = $(this).val();
    var id_herramienta = $(this).attr("data-id-herramienta");
    $.ajax({
      url: "php/controllers/compras/herramientas_controller.php",
      method: "POST",
      data: {
        mod: "updateAlmacenHerramienta",
        id_almacen: id_almacen,
        id_herramienta: id_herramienta,
      },
    })
      .done(function (data) {
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Almacen actualizado",
          showConfirmButton: false,
          timer: 1500,
        });

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

  $("#select_id_tipos_kits_herramienta").select2({
    dropdownParent: $("#addKit"),
  });
  $("#selectStatusHerramienta").select2({
    dropdownParent: $("#addHerramientaKit"),
  });
  $("#selectAlmacenHerramienta").select2({
    dropdownParent: $("#addHerramientaKit"),
  });
  $("#select_asignar_kit").select2({
    dropdownParent: $("#asignarKitHerramienta"),
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

  function getStatusTd(id_herramienta, id_selected) {
    $.ajax({
      url: "php/controllers/compras/herramientas_controller.php",
      method: "POST",
      data: {
        mod: "getStatusHerramienta",
        last_id: id_herramienta,
        id_selected: id_selected,
      },
    })
      .done(function (data2) {
        var data2 = JSON.parse(data2);
        var html = data2.html;

        $("#tdStatus" + id_herramienta).append(html);
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
  function getAlmacenTd(id_herramienta, id_selected) {
    $.ajax({
      url: "php/controllers/compras/herramientas_controller.php",
      method: "POST",
      data: {
        mod: "getAlmacenHerramienta",
        last_id: id_herramienta,
        id_selected: id_selected,
      },
    })
      .done(function (data2) {
        var data2 = JSON.parse(data2);
        var html = data2.html;

        $("#tdAlmacen" + id_herramienta).append(html);
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
