if ($.datepicker) {
  // Obtener la fecha actual
  var today = new Date();
  // Calcular la fecha por defecto (hoy + 12 días hábiles)
  var defaultDate = addBusinessDays(today, 3);
  // Configurar la localización en español
  $.datepicker.regional["es"] = {
    closeText: "Cerrar",
    prevText: "Anterior",
    nextText: "Siguiente",
    currentText: "Hoy",
    monthNames: [
      "enero",
      "febrero",
      "marzo",
      "abril",
      "mayo",
      "junio",
      "julio",
      "agosto",
      "septiembre",
      "octubre",
      "noviembre",
      "diciembre",
    ],
    monthNamesShort: [
      "ene",
      "feb",
      "mar",
      "abr",
      "may",
      "jun",
      "jul",
      "ago",
      "sep",
      "oct",
      "nov",
      "dic",
    ],
    dayNames: [
      "domingo",
      "lunes",
      "martes",
      "miércoles",
      "jueves",
      "viernes",
      "sábado",
    ],
    dayNamesShort: ["dom", "lun", "mar", "mié", "jue", "vie", "sáb"],
    dayNamesMin: ["D", "L", "M", "X", "J", "V", "S"],
    weekHeader: "Sm",
    dateFormat: "dd/mm/yy",
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: "",
  };
  $.datepicker.setDefaults($.datepicker.regional["es"]);

  // Inicializar el Datepicker
  $(".datePicker").datepicker({
    defaultDate: defaultDate,
    minDate: defaultDate,
    beforeShowDay: function (date) {
      var dayOfWeek = date.getDay();
      // Permitir solo días hábiles
      if (dayOfWeek === 0 || dayOfWeek === 6) {
        return [false, "", "No es un día hábil"];
      }
      // Bloquear fechas entre hoy y la fecha por defecto
      if (date >= today && date <= defaultDate) {
        return [false, "", "Fecha no disponible"];
      }
      return [true, ""];
    },
  });
} else {
  console.error("jQuery UI Datepicker no está disponible.");
}

function addBusinessDays(startDate, days) {
  var count = 0;
  var currentDate = new Date(startDate.getTime());
  while (count < days) {
    currentDate.setDate(currentDate.getDate() + 1);
    var dayOfWeek = currentDate.getDay();
    if (dayOfWeek !== 0 && dayOfWeek !== 6) {
      // 0: Domingo, 6: Sábado
      count++;
    }
  }
  return currentDate;
}

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

$(document).ready(function () {
  console.log("ready!");

  $(document).on("click", ".addVacationDay", function () {
    var id_user = $(this).attr("data-id-user");
    var colab_name = $(this).attr("data-user-name");
    $("#colabVactDay").text(colab_name);
    $(".assignVacationDate").attr("data-id-user", id_user);
  });
  $(document).on("click", ".detailVacationDay", function () {
    loading();
    var id_user = $(this).attr("data-id-user");
    var colab_name = $(this).attr("data-user-name");
    $("#colabVactDayDet").text(colab_name);

    $.ajax({
      url: "php/controllers/rh/vacations/vacations_controller.php",
      method: "POST",
      data: {
        mod: "getVacationDayColabDet",
        id_user: id_user,
      },
    })
      .done(function (data) {
        Swal.close();
        var data = JSON.parse(data);
        console.log(data);
        if (data.response == true) {
          $("#tableVacationsDetail > tbody").html(data.html);
        } else {
          errorToast("Ocurrió un error");
        }

        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {
        Swal.close();
        var myToast = Toastify({
          text: data.message,
          duration: 3000,
        });
        myToast.showToast();
      });
  });
  $(document).on("click", ".assignVacationDate", function () {
    loading();
    var id_user = $(this).attr("data-id-user");
    var vacation_day = $("#colabVacationDay").val();
    console.log(id_user);
    console.log(vacation_day);
    var id_vacation_type = $("#colabVacationType").val();

    if (
      vacation_day == undefined ||
      id_vacation_type == undefined ||
      id_vacation_type == ""
    ) {
      Swal.fire({
        title: "Debe seleccionar ingresar todos los datos",
        icon: "error",
      });
    } else {
      $.ajax({
        url: "php/controllers/rh/vacations/vacations_controller.php",
        method: "POST",
        data: {
          mod: "assignVacationDayColab",
          id_user: id_user,
          vacation_day: vacation_day,
          id_vacation_type: id_vacation_type,
        },
      })
        .done(function (data) {
          Swal.close();
          var data = JSON.parse(data);
          console.log(data);
          if (data.response == true) {
            Swal.fire({
              title: data.message,
              icon: "success",
            }).then((result) => {
              loading();
              location.reload();
            });
          } else {
            errorToast("Ocurrió un error");
          }

          //--- --- ---//
          //--- --- ---//
        })
        .fail(function (message) {
          Swal.close();
          var myToast = Toastify({
            text: data.message,
            duration: 3000,
          });
          myToast.showToast();
        });
    }
  });
  $(document).on("dblclick", ".tdSueldoBase", function () {
    loading();
    var id_colab = $(this).attr("data-id-colab");
    var ammount = $(this).attr("data-ammount");

    var html = "";
    html +=
      ' <input type="text" data-id-colab="' +
      id_colab +
      '" id="tdSueldo' +
      id_colab +
      '" class="form-control tdEditSueldo" value="' +
      ammount +
      '">';
    $(this).html(html);
    Swal.close();
    $("#tdSueldo" + id_colab + "").focus();
  });
  $(document).on("focusout", ".tdEditSueldo", function () {
    loading();

    var id_colab = $(this).attr("data-id-colab");
    var ammount = $(this).val();

    $.ajax({
      url: "php/controllers/rh/vacations/vacations_controller.php",
      method: "POST",
      data: {
        mod: "updateBaseGrossSalary",
        id_colab: id_colab,
        ammount: ammount,
      },
    })
      .done(function (data) {
        Swal.close();
        var data = JSON.parse(data);
        console.log(data);
        if (data.response == true) {
          Swal.fire({
            title: data.message,
            icon: "success",
          }).then((result) => {
            loading();

            $("#tdDiario" + id_colab).attr("data-ammount", ammount);
            $("#tdDiario" + id_colab).html("$" + data.diary_gross);
            $("#tdMensual" + id_colab).html("$" + data.mensual_gross);
            Swal.close();
          });
        } else {
          errorToast(data.message);
        }

        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {
        Swal.close();
        var myToast = Toastify({
          text: data.message,
          duration: 3000,
        });
        myToast.showToast();
      });

    Swal.close();
  });

  $(document).on("click", ".payBonusVacation", function () {
    var id_colab = $(this).attr("data-id-user");
    var colab_name = $(this).attr("data-user-name");
    var ammount = $(this).attr("data-ammount");
    console.log(ammount);
    $("#colabVactBonusDayDet").text(colab_name);
    $(".payVacationBonus").attr("data-id-user", id_colab);
    $(".payVacationBonus").attr("data-user-name", colab_name);
    $(".payVacationBonus").attr("data-ammount", ammount);
loading();
    $.ajax({
      url: "php/controllers/rh/vacations/vacations_controller.php",
      method: "POST",
      data: {
        mod: "getBonusPays",
        id_user: id_colab,
      },
    })
      .done(function (data) {
        Swal.close();
        var data = JSON.parse(data);
        console.log(data);
        if (data.response == true) {
          Swal.close();
          $("#tableVacationBonus > tbody").html(data.html);
        } else {
          Swal.close();
          errorToast("Ocurrió un error");
        }

        //--- --- ---//
        //--- --- ---//
      })
      .fail(function (message) {
        Swal.close();
        var myToast = Toastify({
          text: data.message,
          duration: 3000,
        });
        myToast.showToast();
      });
  });

  $(document).on("click", ".payVacationBonus", function () {
    var id_colab = $(this).attr("data-id-user");
    var colab_name = $(this).attr("data-user-name");
    var ammount = $(this).attr("data-ammount");
    $("#ammountBonus").val(ammount);
    $("#ammountBonus").attr("value", ammount);
    console.log(ammount);
    $("#regPayBonus").attr("data-id-user", id_colab);
    $("#colabPayVactBonusDay").text(colab_name);

    $("#modalVacationBonus").modal("hide");
    $("#modalRegVacationBonus").modal("show");
  });

  $(document).on("click", "#regPayBonus", function () {
    loading();
    var id_colab = $(this).attr("data-id-user");
    var ammount = $("#ammountBonus").val();
    var date = $("#date-pay").val();
    if (ammount == "" || date == "") {
      Swal.fire({
        icon: "error",
        title: "Debe ingresar todos los datos!!",
      });
    } else {
      const doc = document.querySelector("#docBonusPay");
      const file = doc.files[0];
      vidFileLength = doc.files.length;

      if (vidFileLength === 0) {
        /* $(".inputAddStudentDocument")
          .siblings(".custom-file-label")
          .removeClass("selected")
          .html("Elegir un archivo"); */
        //Swal.close();
        Swal.fire("Atención!", "Debe elegir un archivo", "info");
        doc.value = "";
      } else {
        var file_n = file.name;
        var f = file_n.split(".");
        //--- --- ---//
        var name = doc.getAttribute("name");
        //--- --- ---//
        name += ".";
        name += f[1];

        if (
          f[f.length - 1] != "png" &&
          f[f.length - 1] != "jpg" &&
          f[f.length - 1] != "PDF" &&
          f[f.length - 1] != "pdf" &&
          f[f.length - 1] != "jpeg"
        ) {
          Swal.fire(
            "Atención!",
            "El archivo debe ser una imagen o PDF",
            "info"
          );
          doc.value = "";
        } else {
          if (doc.files[0].size > 20000000) {
            Swal.close();
            Swal.fire(
              "Atención!",
              "El tamaño máximo del archivo a subir es de 20MB",
              "info"
            );
            doc.value = "";
            return;
          } else {
            folder = "comprobantes_prima_vacacional";
            module_name = "contabilidad";
            var fData = new FormData();
            fData.append("formData", file);
            fData.append("name", name);
            fData.append("folder", folder);
            fData.append("module_name", module_name);
            fData.append("id_colab", id_colab);
            fData.append("ammount", ammount);
            fData.append("date", date);
            fData.append("mod", "saveBonusPay");
            $.ajax({
              url: "php/controllers/accesos/accesos_controller.php",
              method: "POST",
              data: fData,
              contentType: false,
              processData: false,
            })
              .done(function (response) {
                console.log(response);

                var json = JSON.parse(response);
                if (json.response) {
                  Swal.fire(
                    "Atención!",
                    "El pago fue registrado exitosamente",
                    "success"
                  ).then((result) => {
                    loading();
                    location.reload();
                  });
                } else {
                  Swal.fire(
                    "Error!",
                    "Ocurrió un error al intentar subir el comprobante, intentelo nuevamente por favor",
                    "error"
                  );
                }
              })
              .fail(function (error) {
                Swal.fire(
                  "Error!",
                  "Ocurrió un error al intentar comunicarse con la base de datos :(",
                  "error"
                );
                console.log(error);
              });
          }
        }
      }
    }
  });
});
