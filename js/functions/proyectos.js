//|console.log("load_creditos");
$(document).ready(function () {
  $("#modalCrearProyecto").modal({ backdrop: "static", keyboard: false });

  $(document).on("click", "#guardarProyecto", function () {
    //-- DATOS REQUERIDOS --//
    var tipo_proyecto = $("#select_tipo_proyecto").val();
    var region_proyecto = $("#region_proyecto").val();
    var nombre_proyecto = $("#nombre_proyecto").val();
    var fecha_inicio = $("#fecha_inicio").val();
    var estado_proyecto = $("#estado_proyecto option:selected").text();
    var municipio_proyecto = $("#municipio_proyecto option:selected").text();
    //-- --//

    //-- DATOS NO --//
    var descripcion_proyecto = $("#descripcion_proyecto").val();
    var fecha_cierre = $("#fecha_cierre").val();
    var colonia_direccion = $("#colonia_direccion").val();
    var zip_direccion = $("#zip_direccion").val();
    var calle_direccion = $("#calle_direccion").val();
    var num_ext_direccion = $("#num_ext_direccion").val();
    var num_int_direccion = $("#num_int_direccion").val();

    //-- --//

    if (
      tipo_proyecto == "" ||
      region_proyecto == "" ||
      nombre_proyecto == "" ||
      fecha_inicio == "" ||
      estado_proyecto == "" ||
      municipio_proyecto == ""
    ) {
      Swal.fire({
        icon: "error",
        title: "Faltan campos por llenar",
        text: "Por favor, llene todos los campos marcados con un asterisco (*).",
        showConfirmButton: false,
        timer: 2000,
      });
    } else {
      console.log("campos llenos");
      loading();

      $.ajax({
        url: "php/controllers/proyectos/proyects_controller.php",
        method: "POST",
        data: {
          mod: "saveProyect",
          tipo_proyecto: tipo_proyecto,
          region_proyecto: region_proyecto,
          nombre_proyecto: nombre_proyecto,
          fecha_inicio: fecha_inicio,
          estado_proyecto: estado_proyecto,
          municipio_proyecto: municipio_proyecto,
          descripcion_proyecto: descripcion_proyecto,
          fecha_cierre: fecha_cierre,
          colonia_direccion: colonia_direccion,
          zip_direccion: zip_direccion,
          calle_direccion: calle_direccion,
          num_ext_direccion: num_ext_direccion,
          num_int_direccion: num_int_direccion,
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
    }
  });
  $(document).on("click", ".btn_add_personal", function () {
    var id_proyecto = $(this).attr("id");
    console.log(id_proyecto);
    $(".asignar_personal").attr("id", id_proyecto);
    $("#asignar_personal").empty();
    $("#asignar_personal").val(null).trigger("change");
    loading();

    $.ajax({
      url: "php/controllers/proyectos/proyects_controller.php",
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
                data.data[i].id_asignaciones_proyectos +
                '" class="list-group-item"><i class="uil-constructor"> ' +
                data.data[i].nombre_completo +
                '</i>      <button type="button" class="btn btn-danger float-right btn-sm unassign_personal" id="' +
                data.data[i].id_asignaciones_proyectos +
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
      url: "php/controllers/proyectos/proyects_controller.php",
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

  $(document).on("click", ".asignar_personal", function () {
    var id_proyecto = $(this).attr("id");
    var ids_personal = $("#asignar_personal").val();
    console.log(ids_personal);
    if (ids_personal != "") {
      loading();
      $.ajax({
        url: "php/controllers/proyectos/proyects_controller.php",
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

  $(document).on("click", ".deleteProyect", function () {
    id_proyect = $(this).attr("id");

    Swal.fire({
      title: "¿Estás seguro de eliminar este proyecto?",
      text: "Una vez eliminado no podrás recuperarlo",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si, eliminar",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: "php/controllers/proyectos/proyects_controller.php",
          method: "POST",
          data: {
            mod: "deleteProyect",
            id_proyect: id_proyect,
          },
        })
          .done(function (data) {
            var data = JSON.parse(data);
            console.log(data);

            if (data.response == true) {
              Swal.fire({
                title: "El proyecto fue eliminado correctamente!",
                icon: "success",
                timer: 1500,
              }).then((result) => {
                location.reload();
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
      }
    });
  });
  $(document).on("click", ".unactiveProyect", function () {
    id_proyect = $(this).attr("id-proy-change");
    var status_proyect = $(this).attr("data-status-proyecto");
    var real_status = 1;
    if (status_proyect == 1) {
      real_status = 0;
    } else if (status_proyect == 0) {
      real_status = 1;
    }
    console.log(real_status);
    $.ajax({
      url: "php/controllers/proyectos/proyects_controller.php",
      method: "POST",
      data: {
        mod: "changeStatusProyect",
        id_proyect: id_proyect,
        status: real_status
      },
    })
      .done(function (data) {
        var data = JSON.parse(data);
        console.log(data);

        if (data.response == true) {
          if (status_proyect == 1) {
          
            $("#card_proyect_" + id_proyect).removeClass("bg-primary text-white");
            $("#card_proyect_" + id_proyect).addClass("bg-secondary text-white");
            $("#change_"+id_proyect).attr("data-status-proyecto", 0);
          }
          else{

            $("#card_proyect_" + id_proyect).removeClass("bg-secondary text-white");
            $("#card_proyect_" + id_proyect).addClass("bg-primary text-white");
            $("#change_"+id_proyect).attr("data-status-proyecto", 1);
          }
          
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
  $(document).on("click", ".info_proyect_start_date", function () {
    var id_proyecto = $(this).attr("id");
    loading();
    $.ajax({
      url: "php/controllers/proyectos/proyects_controller.php",
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
              data.data[i].id_asignaciones_proyectos +
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
      url: "php/controllers/proyectos/proyects_controller.php",
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
          var fecha_inicio = data.data[0].fecha_inicio.split(" ");

          $("#info_proyect_name").text(data.data[0].nombre_proyecto);
          $("#info_proyect_code").text(
            data.data[0].codigo_proyecto.toUpperCase()
          );
          $("#info_proyect_start_date").text(data.data[0].fecha_inicio);
          $("#info_proyect_close_aprox_date").text(
            data.data[0].fecha_proyectada_cierre
          );
          $("#info_proyect_close_date").text(data.data[0].fecha_cierre_real);
          $("#info_proyect_address").text(data.data[0].direccion_proyecto);
          $("#comentarios_detalle").text(data.data[0].descripcion);
          if (data.data[0].comentario == "") {
            $("#comentarios_detalle").text("Sin comentarios");
          }
          $("#nombre_comentario").text(data.data[0].creador_proyecto);
          $("#nombre_creador").text(
            "Proyecto creado por: " + data.data[0].creador_proyecto
          );
          $("#fecha_creacion").text(
            "Creado el: " + data.data[0].log_creacion + "."
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

  $("#select_tipo_proyecto").select2({
    dropdownParent: $("#modalCrearProyecto"),
  });
  $("#region_proyecto").select2({
    dropdownParent: $("#modalCrearProyecto"),
  });
  $("#estado_proyecto").select2({
    dropdownParent: $("#modalCrearProyecto"),
  });
  $("#municipio_proyecto").select2({
    dropdownParent: $("#modalCrearProyecto"),
  });
  $("#asignar_personal").select2({
    dropdownParent: $("#addPPersonal"),
  });
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
