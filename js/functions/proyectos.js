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
