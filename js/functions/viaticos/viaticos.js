//|console.log("load_creditos");
$(document).ready(function () {
  $(document).on("change", "#destinatario", function () {
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
          $("#proyecto").empty();
          $("#proyecto").append(
            '<option value"" disabled selected>Elija una opción</option><optgroup label="Proyecto">'
          );
          for (var i = 0; i < data.data.length; i++) {
            $("#proyecto").append(
              '<option value="' +
                data.data[i].id_proyectos +
                '">' +
                data.data[i].nombre_proyecto +
                "</option>"
            );
          }
          $("#proyecto").append("</optgroup>");
          $("#proyecto").prop("disabled", false);
        } else {
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

  $(document).on("click", "#guardar_deposito", function () {
    var id_user = $("#destinatario").val();
    var fecha = $("#fecha_deposito").val();
    var id_asingacion = $("#proyecto").val();
    var sitio = $("#sitio").val();
    var tipos_gasto = $("#tipos_gasto").val();
    var importe = $("#importe").val();
    var id_author = $("#id_autor").val();

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

  $("#destinatario").select2({
    dropdownParent: $("#depositarViatico"),
  });
  $("#proyecto").select2({
    dropdownParent: $("#depositarViatico"),
  });
  $("#tipos_gasto").select2({
    dropdownParent: $("#depositarViatico"),
  });
});

var tf = new TableFilter(document.querySelector(".tablaDepositos"), {
  base_path: "js/tablefilter/",
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
