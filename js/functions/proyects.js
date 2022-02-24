console.log("proyects.js");

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
  $(document).on("click", ".infoProyect", function () {
    var id_proyecto = $(this).attr("id");
    loading();
    $.ajax({
      url: "php/controllers/proyects_controller.php",
      method: "POST",
      data: {
        mod: "getPersonalAssigned",
        id_proyecto: id_proyecto,
      },
    }).done(function (data) {
      var data = JSON.parse(data);
      console.log(data);

      if (data.response == true) {
        Swal.close();
        $("#lista_asignado_detalle").empty();
        for (var i = 0; i < data.data.length; i++) {
          $("#lista_asignado_detalle").append(
            '<li id="li_' +
              data.data[i].id_asignaciones +
              '" class="list-group-item"><i class="uil-constructor"> ' +
              data.data[i].nombre_completo +
              "</i>"
          );
        }
      } else {
        $("#lista_asignado_detalle").empty();
        $("#lista_asignado_detalle").append(
          '<li class="list-group-item"><i class="uil-constructor"> SIN PERSONAL ASIGNADO </i>'
        );
      }

      //--- --- ---//
      //--- --- ---//
    });

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

    /*   */
  });
  $(document).on("click", "#guardar_proyecto", function () {
    loading();

    var proyect_name = $("#proyect_name").val();
    var proyect_code = $("#proyect_code").val();
    var duracion_proyecto = $("#duracion_proyecto").val();
    var proyect_type = $("#proyect_type").val();
    var estado = $("#estado").val();
    var municipio = $("#municipio").val();
    var colonia_proyecto = $("#colonia_proyecto").val();
    var calle_proyecto = $("#calle_proyecto").val();
    var dir_numero_proyecto = $("#dir_numero_proyecto").val();
    var codigo_postal_proyecto = $("#codigo_postal_proyecto").val();
    var comentarios_proyecto = $("#comentarios_proyecto").val();

    if (
      proyect_name != "" &&
      proyect_type != "" &&
      duracion_proyecto != "" &&
      estado != "" &&
      municipio != "" &&
      colonia_proyecto != "" &&
      calle_proyecto != "" &&
      codigo_postal_proyecto != ""
    ) {
      $.ajax({
        url: "php/controllers/proyects_controller.php",
        method: "POST",
        data: {
          mod: "saveProyect",
          proyect_name: proyect_name,
          proyect_code: proyect_code,
          proyect_type: proyect_type,
          duracion_proyecto: duracion_proyecto,
          estado: estado,
          municipio: municipio,
          colonia_proyecto: colonia_proyecto,
          calle_proyecto: calle_proyecto,
          dir_numero_proyecto: dir_numero_proyecto,
          codigo_postal_proyecto: codigo_postal_proyecto,
          comentarios_proyecto: comentarios_proyecto,
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          console.log(data);

          if (data.response == true) {
            Swal.fire({
              title: "¡Registro exitoso!",
              text: "El proyecto se ha guardado exitosamente",
              text:
                "Se guardó con el código: " + data.proyect_code.toUpperCase(),
              icon: "success",
              timer: 1500,
            }).then((result) => {
              $("#addProyect").find("input,textarea,select").val("");
              $("#addProyect input[type='checkbox']")
                .prop("checked", false)
                .change();
              $("#addProyect").modal("hide");
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
          Swal.fire({
            title: "Datos no registrados!",
            text: "Ocurrió un error al guardar la información",
            icon: "info",
          });
        });
    } else {
      Swal.fire({
        title: "Faltan datos!",
        text: "Por favor ingrese todos los datos requeridos marcados con asterísco (*).",
        icon: "info",
      });
    }

    /*   */
  });
  $(document).on("change", "#estado", function () {
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
          $("#municipio").empty();
          $("#municipio").append(
            '<option value="">Seleccione un municipio</option>'
          );
          for (var i = 0; i < data.data.length; i++) {
            $("#municipio").append(
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
  $(document).on("click", ".btn_add_personal", function () {
    var id_proyecto = $(this).attr("id");
    $(".asignar_personal").attr("id", id_proyecto);
    $("#asignar_personal").empty();
    $("#asignar_personal").val(null).trigger("change");
    loading();

    $.ajax({
      url: "php/controllers/proyects_controller.php",
      method: "POST",
      data: {
        mod: "getPersonalAssigned",
        id_proyecto: id_proyecto,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);

        if (data.response == true) {
          Swal.close();
          $("#personal_asignado_modal_as").empty();
          for (var i = 0; i < data.data.length; i++) {
            $("#personal_asignado_modal_as").append(
              '<li id="li_' +
                data.data[i].id_asignaciones +
                '" class="list-group-item"><i class="uil-constructor"> ' +
                data.data[i].nombre_completo +
                '</i>      <button type="button" class="btn btn-danger float-right btn-sm unassign_personal" id="' +
                data.data[i].id_asignaciones +
                '"><i class="mdi mdi-window-close"></i> </button>'
            );
          }
        } else {
          $("#personal_asignado_modal_as").empty();
          $("#personal_asignado_modal_as").append(
            '<li class="list-group-item"><i class="uil-constructor"> SIN PERSONAL ASIGNADO </i>'
          );
        }

        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {});

    $.ajax({
      url: "php/controllers/proyects_controller.php",
      method: "POST",
      data: {
        mod: "getPersonalAviable",
        id_proyecto: id_proyecto,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);

        if (data.response == true) {
          Swal.close();
          $("#asignar_personal").empty();
          $("#asignar_personal").append(
            '<option value="">Seleccione del personal disponible</option>'
          );
          for (var i = 0; i < data.data.length; i++) {
            $("#asignar_personal").append(
              '<option value="' +
                data.data[i].id_personal +
                '">' +
                data.data[i].nombre_completo +
                "</option>"
            );
          }
        } else {
          const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
              toast.addEventListener("mouseenter", Swal.stopTimer);
              toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
          });

          Toast.fire({
            icon: "info",
            title: "Al parecer no hay personal disponible",
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
      url: "php/controllers/proyects_controller.php",
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
  $(document).on("click", ".btn_desactivar_proyecto", function () {
    var id_proyecto = $(this).attr("id");
    $.ajax({
      url: "php/controllers/proyects_controller.php",
      method: "POST",
      data: {
        mod: "cambiarStatusProyecto",
        prop: "0",
        id_proyecto: id_proyecto,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);
        $("#card_proy_" + id_proyecto).removeClass("bg-info");
        $("#card_proy_" + id_proyecto).addClass("bg-secondary");
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
            title: "Se desactivó con éxito!!",
          });
        } else {
        }

        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {});
  });

  $(document).on("click", ".btn_activar_proyecto", function () {
    var id_proyecto = $(this).attr("id");
    $.ajax({
      url: "php/controllers/proyects_controller.php",
      method: "POST",
      data: {
        mod: "cambiarStatusProyecto",
        prop: "1",
        id_proyecto: id_proyecto,
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);

        if (data.response == true) {
          $("#card_proy_" + id_proyecto).removeClass("bg-secondary");
          $("#card_proy_" + id_proyecto).addClass("bg-info");

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
            title: "Se activó con éxito!!",
          });
        } else {
        }

        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {});
  });

  $(document).on("click", ".asignar_personal", function () {
    var id_proyecto = $(this).attr("id");
    var ids_personal = $("#asignar_personal").val();
    console.log(ids_personal);
    if (ids_personal != "") {
      loading();
      $.ajax({
        url: "php/controllers/proyects_controller.php",
        method: "POST",
        data: {
          mod: "asignarPersonal",
          id_proyecto: id_proyecto,
          ids_personal: ids_personal,
        },
      })
        .done(function (data) {
          var data = JSON.parse(data);
          console.log(data);

          if (data.response == true) {
            Swal.fire({
              icon: "success",
              title: "El personal se asignó con éxito!!",
              showConfirmButton: false,
              timer: 2000,
            }).then((result) => {
              $("#addPPersonal").find("input,textarea,select").val("");
              $("#addPPersonal input[type='checkbox']")
                .prop("checked", false)
                .change();
              $("#addPPersonal").modal("hide");
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Algo salió mal al asignar personal",
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
      Swal.fire({
        icon: "info",
        title: "No se asignaron colaboradores al proyecto!!",
        showConfirmButton: false,
        timer: 2000,
      }).then((result) => {
        $("#addPPersonal").find("input,textarea,select").val("");
        $("#addPPersonal input[type='checkbox']")
          .prop("checked", false)
          .change();
        $("#addPPersonal").modal("hide");
      });
    }
  });

  $("#municipio").select2({
    dropdownParent: $("#addProyect"),
  });
  $("#estado").select2({
    dropdownParent: $("#addProyect"),
  });
  $("#proyect_type").select2({
    dropdownParent: $("#addProyect"),
  });

  $("#asignar_personal").select2({
    dropdownParent: $("#addPPersonal"),
  });

  
});
